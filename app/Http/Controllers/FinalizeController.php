<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FinalizeEmail;
use App\Mail\picReminderEmail;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Meeting_File;
use App\Models\Meeting_Participant;
use App\Models\Participant;

class FinalizeController extends Controller
{
    public function finalizeShow($id)
    {

           // untuk ngambil last path di url
           $currentUrl = last(explode('/', url()->current()));

        $meeting = Meeting::with(['participants', 'contents.actions', 'contents.actions.picParticipant'])->find($id);

        $participants = Participant::all();
        $urls = Meeting_Participant::where('meeting_id', $meeting->id)
            ->where('attendance_status', 1)
            ->pluck('url', 'participant_id');



        if ($meeting) {

            // Ambil data attendance_status dari model Meeting_Participant
            $attendanceStatus = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('attendance_status', 'participant_id');
            $files = Meeting_File::where('meeting_id', $meeting->id)->get();
            // dd($attendanceStatus, $meeting, $participants );
            return view('finalizing', [
                'meeting' => $meeting,
                'participants' => $participants,
                'attendanceStatus' => $attendanceStatus,
                'files' => $files,
                'urls' => $urls,
                'currentUrl' => $currentUrl,
                'judul' => $meeting->title,
            ]);
        } else {
            return "Rapat dengan ID $id tidak ditemukan.";
        }
    }

    public function finalizing(Request $request, $id, $idLogin)
    {
        // ubah status meeting menjadi 'Distributed'
        $meeting = Meeting::find($id);
        $meeting->update(['meeting_status' => 'Distributed']);

        $meeting_id = $meeting->id;
        $meeting_name = $meeting->title;
        $meeting_date = $meeting->date;

        // Ambil data peserta hadir
        $meeting_attendees = Meeting_Participant::where('meeting_id', $id)
            ->get(['participant_id', 'attendance_status']);

        // Ubah obj ke array
        $ids = $meeting_attendees->pluck('participant_id')->toArray();
        $attendanceStatuses = $meeting_attendees->pluck('attendance_status')->toArray();

        // Ambil data peserta berdasarkan ID yang sudah diambil
        $meeting_attendees_email = Participant::whereIn('id', $ids)
            ->get(['id', 'email']);

        // Ubah obj ke array
        $emails = $meeting_attendees_email->pluck('email')->toArray();

        // Satukan ids, attendanceStatus, dan emails menjadi objek
        $combinedData = array_map(function ($id, $attendanceStatus, $email) {
            return (object)[
                'id' => $id,
                'attendanceStatus' => $attendanceStatus,
                'email' => $email,
            ];
        }, $ids, $attendanceStatuses, $emails);

 //       dd($request->all(), $combinedData , $meeting);


        foreach ($combinedData as $data) {
            // Akses properti objek
            $id = $data->id;
            $attendanceStatus = $data->attendanceStatus;
            $email = $data->email;

            // Gunakan if-else untuk memeriksa attendanceStatus
            if ($attendanceStatus == 1) {
                $LinkApproval = url("nolan.com/meeting/{$meeting_id}/approval/{$id}");
                //cth approval_link: http://127.0.0.1:8000/nolan.com/meeting/149/approval/4
                try {
                    Mail::to($email)->send(new FinalizeEmail($meeting_name, $LinkApproval));
                } catch (\Throwable $th) {
                    dd("error: " . $th->getMessage());
                    return redirect()->route('home')->with('error', 'Sorry, Something went wrong.');
                }


                //   echo " ID: $id AttendanceStatus: $attendanceStatus Email: $email, link: $Link <br>" . PHP_EOL;
            }/* else {
                $Link = url("nolan.com/meeting/{$meeting_id}");
                // cth view_link: http://127.0.0.1:8000/nolan.com/meeting/158
                try {
                    Mail::to($email)->send(new FinalizeEmail($meeting_name, $Link));
                } catch (\Throwable $th) {
                    dd("error: " . $th->getMessage());
                    // return redirect()->route('home')->with('error', 'Sorry, Something went wrong.');
                }  } */
        };



        //Kirim remainder PICs
      //  $meetingPIC = Meeting::with(['contents.actions', 'contents.actions.picParticipant'])->find($meeting_id);

        foreach ($meeting->contents as $content) {
            foreach ($content->actions as $action) {
                $pic = $action->picParticipant;

                if ($pic) {
                    $picEmail = $pic->email;
                    $picName = $pic->name;
                    $due_date = $action->due;
                    $action = $action->item;
                    // cth view http://127.0.0.1:8000/nolan.com/meeting/150
                    $linkView = url("nolan.com/meeting/{$meeting_id}");
                    try {
                        Mail::to($picEmail)->send(new picReminderEmail($meeting_name, $meeting_date, $picEmail, $picName, $due_date, $action, $linkView));
                        // Mail::mailable(new picReminderEmail($meeting_name, $meeting_date, $picEmail, $picName, $due_date, $action, $linkView))->to($picEmail)->send();
                    } catch (\Throwable $th) {
                        dd("error: " . $th->getMessage());
                        return redirect()->route('home')->with('error', 'Sorry, Something went wrong.');
                    }

                    // echo " action:", $action, "due:", $due_date, " email:", $picEmail, " name", $picName, "link", $linkView, "<br>" . PHP_EOL;
                }
            }
        }


        return redirect()->route('home', ['id' => $id])->with('success', 'Meeting Minutes Have Been Distributed for Approval!!');
    }
}
