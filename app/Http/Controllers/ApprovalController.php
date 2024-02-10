<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\rejectEmail;

use Illuminate\Support\Facades\Redirect;
use App\Models\Meeting;
use App\Models\Meeting_File;
use App\Models\Meeting_Participant;
use App\Models\Participant;
use App\Models\Rejection_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApprovalController extends Controller
{
    public function approvalShow(Request $request, $id, $idLogin)
    {
        $meeting = Meeting::with(['participants', 'contents.actions', 'contents.actions.picParticipant',])->find($id);

        // check apakah permission
        if ($idLogin != session('idLogin')) {
            //dd($idLogin, session('idLogin'));
            return redirect()->route('home')->with('error', 'You do not have permission to edit this meeting.');
        }

        // Periksa apakah sudah pernah approve/ ada tanda tangan
        $ttdUser = Meeting_Participant::where('meeting_id', $meeting->id)
            ->where('participant_id', session('idLogin'))
            ->value('url');

        if ($ttdUser !== null) {
            //  dd($ttdUser);
        }





        // dd($request->all(), $loginId, $idLogin); // $UserIdLink);


        $participants = Participant::all();
        $urls = Meeting_Participant::where('meeting_id', $meeting->id)
            ->where('attendance_status', 1)
            ->pluck('url', 'participant_id');


        if ($meeting) {

            // Ambil data attendance_status dari model Meeting_Participant
            $attendanceStatus = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('attendance_status', 'participant_id');
            $files = Meeting_File::where('meeting_id', $meeting->id)->get();


            // dd($attendanceStatus, $meeting, $participants );
            return view('approval', [
                'meeting' => $meeting,
                'participants' => $participants,
                'attendanceStatus' => $attendanceStatus,
                'files' => $files,
                'urls' => $urls,
                'ttdUser' => $ttdUser,
            ]);
        } else {
            return "Meeting with ID $id not found.";
        }
    }

    public function approving(Request $request, $id, $idLogin)
    {
        $meeting = Meeting::find($id);

        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Meeting Minuetes not Found.');
        }

        // check apakah user sudah approved


        // check apakah permission
        if ($idLogin != session('idLogin')) {
            //dd($idLogin, session('idLogin'));
            return redirect()->route('home')->with('error', 'You do not have permission to Approve this meeting.');
        }










        $request->validate([
            'signatureImage' => 'required',
        ]);

        $signatureData = $request->input('signatureImage');
        $signatory = auth()->user()->id;
        $currentDate = date('dmY');
        $filename = $meeting->id . "-" . $signatory . "-" . $currentDate . '.png';
        $url = 'signatureFile/' . $filename;

        // Simpan file signature di dalam folder public
        $publicPath = public_path($url);

        // Pastikan direktori tujuan ada
        $directory = dirname($publicPath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Simpan file dengan file_put_contents
        file_put_contents($publicPath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData)));


        // Cek apakah data tanda tangan sudah ada dalam pivot
        $attendee = $meeting->participants()
            ->where('participant_id', $signatory)
            ->first();

        if ($attendee) {
            // Jika data sudah ada, lakukan pembaruan (update)
            $meeting->participants()->updateExistingPivot($signatory, [
                'signature' => $filename,
                'url' => $url,
            ]);
        } else {
            // Jika data belum ada, tambahkan catatan baru
            $meeting->participants()->attach($signatory, [
                'attendance_status' => 1,
                'signature' => $filename,
                'url' => $url,
            ]);
        }


        //cek apakah semua sudah approve
        //JIka iya maka ubah status meeting menjdi Approved
        $meeting_participantSignatures = Meeting_Participant::where('meeting_id', $meeting->id)
            ->where('attendance_status', 1)
            ->pluck('signature')
            ->toArray();

        // Mengecek apakah semua peserta telah menandatangani
        $allParticipantsSigned = collect($meeting_participantSignatures)->every(function ($signature) {
            return $signature !== null;
        });

        // Jika semua peserta telah menandatangani, ubah status pertemuan menjadi "Approved"
        if ($allParticipantsSigned) {
            $meeting->meeting_status = 'Approved';
            $meeting->save();
        }

        //dd($allParticipantsSigned, $meeting);

        // dd($signatureData, $signatory, $filename, $url);
        if ($request->input('action') === 'finalize') {
            // Redirect ke route finalize dengan parameter meeting ID
            //return redirect()->route('meeting.finalizing', ['id' => $meetingId, 'idLogin' => $idLogin])->with('action', 'finalize');
            // $meetingData['meeting_status'] = 'Distributed'; 
            $meetingId = $meeting->id;
            return Redirect::route('meeting.finalize', ['id' => $meetingId])->with('success', 'Meeting Minutes Added Successfully.');
        }

        return redirect()->route('home', ['id' => $id])->with('success', 'You Aprroved This Meeting!!.');
   
   
        
    }


    public function rejection(Request $request, $id, $idLogin)
    {
        $meeting = Meeting::find($id);

        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Meeting failed to added.');
        }

        // Mendapatkan penulis pesan penolakan (writer) dari pengguna yang terautentikasi
        $writer = auth()->user()->id;
        $writerName = auth()->user()->name;
        $noteTaker = Participant::find($meeting->note_taker);
        $noteTakerId = $noteTaker->id;
        $noteTakerName = $noteTaker->name;
        $noteTakerEmail =  $noteTaker->email;
        $meeting_name = $meeting->title;
        $meeting_id = $meeting->id;
        //cth:http://127.0.0.1:8000/nolan.com/meeting/160/edit/2
        $linkEdit = url("nolan.com/meeting/{$meeting_id}/edit/{$noteTakerId}");
        //   /meeting/{id}/edit
        // Mendapatkan data pesan penolakan dari request
        $rejectionData = $request->all();

        $rejectionMessage =  $rejectionData['rejectionMessage'];
        // dd($request->all(), $noteTakerName, $noteTakerEmail, $meeting_name, $writerName, $linkEdit,  $rejectionMessage);
        try {
            Mail::to($noteTakerEmail)->send(new rejectEmail($meeting_name,$writerName , $noteTakerName, $linkEdit, $rejectionMessage));
            // Mail::mailable(new picReminderEmail($meeting_name, $meeting_date, $picEmail, $picName, $due_date, $action, $linkView))->to($picEmail)->send();
        } catch (\Throwable $th) {
            dd("error: " . $th->getMessage());
            return redirect()->route('home')->with('error', 'Sorry, Something went wrong.');
        }

        // Simpan pesan penolakan ke dalam tabel "rejection_message"

        Rejection_Message::create([
            'meeting_id' => $meeting->id,
            'message' => $rejectionData['rejectionMessage'], // Sesuaikan dengan nama field di form
            'writer' => $writer,
        ]);

        return redirect()->route('meeting.approval', ['id' => $id,'idLogin' => $idLogin])->with('success', 'Rejection Message delivered.');
    }
}
