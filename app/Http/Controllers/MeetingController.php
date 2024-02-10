<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FinalizeEmail;
use App\Mail\picReminderEmail;
use Illuminate\Support\Facades\Redirect;

use App\Models\Action;
use App\Models\Content;
use App\Models\Meeting;
use App\Models\Meeting_File;
use App\Models\Meeting_Participant;
use App\Models\Participant;
use App\Models\Revision_History;
use App\Models\Rejection_Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $date = $request->input('date');



        $userId = auth()->user()->id;





        $meetings = Meeting::query();

        //dd($meetings, $Allmeetings);

        $participants = Participant::all();
        $rejectionMessages = Rejection_Message::all();


        if ($keyword) {
            $meetings->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('location', 'like', '%' . $keyword . '%')
                    ->orWhere('inisiator', 'like', '%' . $keyword . '%')
                    ->orWhere('note_taker', 'like', '%' . $keyword . '%')
                    ->orWhere('meeting_status', 'like', '%' . $keyword . '%')
                    ->orWhereHas('participants', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('contents', function ($query) use ($keyword) {
                        $query->where('discussion', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($date) {
            $meetings->whereDate('date', '=', $date);
        }
        // dd($meetings);



        //    $meetings = $meetings->with('participants')->paginate(5);

        $meetings = Meeting::whereHas('participants', function ($query) use ($userId) {
            $query->where('participant_id', $userId);
        })->with('participants')->paginate(5);


        /*      // Data Meeting yang dihadiri oleh user yang login
         $meetings = Meeting::whereHas('participants', function ($query) use ($userId) {
            $query->where('participant_id', $userId);
        })->get();
        dd($meetings); */



        $attendanceData = [];
        $userRole = []; // Menyimpan peran pengguna yang login



        foreach ($meetings as $meeting) {
            foreach ($meeting->participants as $participant) {
                $attendanceStatus = Meeting_Participant::where('meeting_id', $meeting->id)
                    ->where('participant_id', $participant->id)
                    ->pluck('attendance_status', 'participant_id')
                    ->first();

                $attendanceData[$meeting->id][$participant->id] = $attendanceStatus;
                // dd($attendanceData);

                // Periksa status pengguna yang login
                if (session('idLogin') == $participant->id) {
                    $userRole[$meeting->id] = ($attendanceStatus == 1) ? 'attendee' : 'absentee';
                }
            }
        }



        //Unutk notif rejection messages
        // Group rejection messages by meeting_id

        // judul page
        $judul = "Welcome to Nolan";


        // untuk ngambil last path di url
        $currentUrl = last(explode('/', url()->current()));

        $idLogin = session('idLogin');
        return view('home', compact('meetings', 'participants', 'attendanceData', 'userRole', 'keyword', 'date', 'rejectionMessages', 'idLogin', 'judul', 'currentUrl'));
    }


    public function show($id)
    {

        // untuk ngambil last path di url
        $currentUrl = last(explode('/', url()->current()));

        $meeting = Meeting::with(['participants', 'contents.actions', 'contents.actions.picParticipant'])->find($id);

        $participants = Participant::all();
        $meetingParticipants = Meeting_Participant::all();

        //dd($meeting->inisiator, $meeting->noteTaker);

        if ($meeting) {

            // Ambil data attendance_status dari model Meeting_Participant
            $attendanceStatus = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('attendance_status', 'participant_id');
            // $url = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('url', 'participant_id');
            $urls = Meeting_Participant::where('meeting_id', $meeting->id)
                ->where('attendance_status', 1)
                ->pluck('url', 'participant_id');


            $files = Meeting_File::where('meeting_id', $meeting->id)->get();
            // dd($attendanceStatus, $meeting, $participants );
            // dd($url, $signatures);
            //  dd($urls);

            return view('meetingDetail', [
                'meeting' => $meeting,
                'participants' => $participants,
                'attendanceStatus' => $attendanceStatus,
                'meeetingParticipants' => $meetingParticipants,
                'files' => $files,
                'urls' => $urls,
                'currentUrl' => $currentUrl,
                'judul' => $meeting->title,
                //'signatures' => $signatures,
            ]);
        } else {
            return "Rapat dengan ID $id tidak ditemukan.";
        }
    }


    public function add()
    {

        // untuk ngambil last path di url
        $currentUrl = last(explode('/', url()->current()));

        $peserta_tersedia = Participant::all();
        return view('meetingAdd', [
            'peserta_tersedia' => $peserta_tersedia,
            'judul' => 'Create Note',
            'currentUrl' => $currentUrl,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'inisiator' => 'required|string|max:255',
            'note_taker' => 'required|string|max:255',
            'former_id' => 'nullable|integer',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpeg,jpg,png|max:10240',

        ]);

        // if ($request->input('action') === 'save') {
        // Set status pertemuan sebagai "Open" ketika pertemuan dibuat
        $meetingData = $request->all();

        $meetingData['meeting_status'] = 'Open';

        $meeting = Meeting::create($meetingData);
        $meetingId = $meeting->id;

        $files = $request->file('files');

        if ($files) {
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();

                // Simpan file ke folder public
                $file->move(public_path('meetingFile'), $fileName);

                Meeting_File::create([
                    'meeting_id' => $meeting->id,
                    'fileName' => $fileName,
                    'url' => 'meetingFile/' . $fileName, // Sesuaikan path dengan struktur folder di public
                ]);
            }
        }

        // Mendapatkan array ID peserta rapat
        $meetingParticipants = $request->input('meetingParticipants', []);

        // Mendapatkan array ID peserta rapat yang hadir
        $attendingparticipants = $request->input('attendanceParticipants', []);

        // Mendapatkan meeting ID (pastikan variabel $meetingId sesuai dengan ID rapat yang sedang berlangsung)

        foreach ($meetingParticipants as $participantId) {
            // anggota $attendingparticipants attendanceStatus =1 sisnya 0
            $attendanceStatus = in_array($participantId, $attendingparticipants) ? 1 : 0;

            // Simpan data absensi ke database
            Meeting_Participant::create([
                'meeting_id' => $meetingId,
                'participant_id' => $participantId,
                'attendance_status' => $attendanceStatus,
            ]);
        }

        //  dd('meting Participant', $meetingParticipants, $attendingparticipants, $ou);

        foreach ($request->discussion as $key => $discussion) {
            // Periksa apakah content tidak kosong
            if (!empty($discussion)) {
                // Simpan data discussion ke database
                $content = new Content([
                    'discussion' => $discussion,
                    'meeting_id' => $meetingId, // Gunakan $meetingId yang sudah ditentukan
                ]);
                $content->save();

                if (isset($request->item[$key]) && is_array($request->item[$key])) {
                    $atLeastOneNotEmpty = false; // Variabel flag

                    foreach ($request->item[$key] as $idx => $item) {
                        // Periksa apakah setidaknya satu di antara item, pic, atau due tidak kosong
                        if (!empty($item) || !empty($request->pic[$key][$idx]) || !empty($request->due[$key][$idx])) {
                            $atLeastOneNotEmpty = true;
                        }

                        // Validasi dan sanitasi ID PIC
                        $pic = $request->pic[$key][$idx];
                        if ($atLeastOneNotEmpty) {
                            if ($pic >= 1 && $pic <= 6) {
                                // Simpan data action ke database dengan mengaitkannya dengan discussion yang sesuai
                                $action = new Action([
                                    'content_id' => $content->id,
                                    'item' => $item,
                                    'due' => $request->due[$key][$idx],
                                    'pic' => $pic,
                                ]);
                                $action->save();
                            } else {
                                // Jika $pic tidak ada atau di luar rentang yang valid, atur nilai PIC menjadi NULL
                                $action = new Action([
                                    'content_id' => $content->id,
                                    'item' => $item,
                                    'due' => $request->due[$key][$idx],
                                    'pic' => null,
                                ]);
                                $action->save();
                            }
                        }
                    }
                }
            }
        }






        if ($request->input('action') === 'save') {
            //  $meetingData['meeting_status'] = 'Open'; // Ubah status menjadi 'Open'
            return redirect()->route('home')->with('success', 'Meeting Minutes created Successfully.');
            // dd($meetingData, $meetingParticipants, $attendingparticipants);
        } elseif ($request->input('action') === 'finalize') {
            // Redirect ke route finalize dengan parameter meeting ID
            //return redirect()->route('meeting.finalizing', ['id' => $meetingId, 'idLogin' => $idLogin])->with('action', 'finalize');
            // $meetingData['meeting_status'] = 'Distributed';

            return Redirect::route('meeting.finalize', ['id' => $meetingId])->with('success', 'Meeting Minutes Added Successfully.');
        }

        // Kirim email ke semua peserta hadir unutk approval dan ttd

    }

    public function destroy($id)
    {
        // Cari pertemuan berdasarkan ID
        $meeting = Meeting::find($id);

        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Meeting not found.');
        }

        // Hapus file terkait jika ada
        if (Storage::exists('public/' . $meeting->file)) {
            Storage::delete('public/' . $meeting->file);
        }

        // Hapus pertemuan dari basis data
        $meeting->delete();


        return redirect()->route('home')->with('success', 'Meeting minutes successfully deleted.');
    }



    public function edit($id)
    {

        // untuk ngambil last path di url
        $currentUrl = last(explode('/', url()->current()));

        // Cek apakah user adalah note taker untuk pertemuan dengan ID yang diberikan
        $meeting = Meeting::find($id);
        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Meeting not found.');
        }

        if ($meeting->note_taker != session('idLogin')) {
            return redirect()->route('home')->with('error', 'You do not have permission to edit this meeting.');
        }

        // Cari meeting berdasarkan ID
        $meeting = Meeting::with(['participants', 'contents.actions'])->find($id);
        $attendanceStatus = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('attendance_status', 'participant_id');
        $meetingFiles = Meeting_File::where('meeting_id', $meeting->id)->get();
        $revisionHistories = Revision_History::where('meeting_id', $meeting->id)->get();
        $rejectionMessages = Rejection_Message::where('meeting_id', $meeting->id)->get();
        $urls = Meeting_Participant::where('meeting_id', $meeting->id)
            ->where('attendance_status', 1)
            ->pluck('url', 'participant_id');


        // Decode JSON data within revisionHistories
        foreach ($revisionHistories as $revisionHistory) {
            $discussionData = json_decode($revisionHistory->discussion_log, true);

            // Jika $discussionData merupakan array, loop untuk setiap elemen
            if (is_array($discussionData)) {
                foreach ($discussionData as &$discussion) {
                    // Decode the "action" field again
                    $discussion['action'] = json_decode($discussion['action'], true);
                }
            } else {
                // Jika $discussionData bukan array, decode "action" langsung
                $discussionData['action'] = json_decode($discussionData['action'], true);
            }

            $revisionHistory->discussion_log = $discussionData;
        }

        //dd($revisionHistories);

        $participants = Participant::all();
        $peserta_tersedia = Participant::all();
        $idx = 0;

        $peserta_hadir = Meeting_Participant::where('meeting_id', $meeting->id)
            ->pluck('participant_id')
            ->toArray();


        $meetingParticipants = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('participant_id')->toArray();

        // Mencari particpant yang bukan Meeting_participant
        $nonMeetingParticipants = Participant::whereNotIn('id', $meetingParticipants)
            ->pluck('name', 'id')
            ->toArray();

        // dd($peserta_hadir);

        /*    $peserta_hadir = Meeting_Participant::where('meeting_id', $meeting->id)
            ->pluck('participant_id')
            ->toArray();


        $meetingParticipants = Meeting_Participant::where('meeting_id', $meeting->id)->pluck('participant_id')->toArray();

        // Mencari particpant yang bukan Meeting_participant
        $nonMeetingParticipants = Participant::whereNotIn('id', $meetingParticipants)
            ->pluck('name', 'id')
            ->toArray(); */



        // dd($meetingParticipants, $peserta_hadir, $nonMeetingParticipants);



        $idLogin = session('idLogin');

        // dd($meeting->contents);

        return view('meetingEdit', [
            'meeting' => $meeting,
            'participants' => $participants,
            'peserta_tersedia' => $peserta_tersedia,
            'attendanceStatus' => $attendanceStatus,
            'meetingFiles' => $meetingFiles,
            'idx' => $idx,
            'revisionHistories' => $revisionHistories,
            'rejectionMessages' => $rejectionMessages,
            'urls' => $urls,
            'idLogin' => $idLogin,
            'nonMeetingParticipants' => $nonMeetingParticipants,
            'currentUrl' => $currentUrl,
            'judul' => $meeting->title,

        ]);
    }

    public function update(Request $request, $id)
    {
        $meeting = Meeting::find($id);


        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Meeting tidak ditemukan.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'inisiator' => 'required|string|max:255',
            'note_taker' => 'required|string|max:255',
            'former_id' => 'nullable|integer',
            'pic' => 'nullable|integer',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpeg,jpg,png|max:10240',
        ]);
        // dd($data);

        $meetingData = [
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'inisiator' => $request->input('inisiator'),
            'note_taker' => $request->input('note_taker'),
            'former_id' => $request->input('former_id'),
        ];
        // dd($meetingData);
        //update table meeting
        $meeting->update($meetingData);

        //  $allParticipants = Participant::pluck('id')->toArray();
        $selectedParticipants = $request->input('attendanceParticipants', []);

        $peserta_hadir = Meeting_Participant::where('meeting_id', $meeting->id)
            ->pluck('participant_id')
            ->toArray();
        $attendanceStatus = [];


        foreach ($peserta_hadir as $participantId) {
            $status = in_array($participantId, $selectedParticipants) ? 1 : 0;
            $attendanceStatus[$participantId] = $status;
        }

        // Update table meeting_participant
        foreach ($attendanceStatus as $participantId => $status) {
            Meeting_Participant::where([
                'meeting_id' => $meeting->id,
                'participant_id' => $participantId,
            ])->update([
                'attendance_status' => $status,
            ]);
        }

        // $mp = Meeting_Participant::where('meeting_id', $meeting->id);

        // dd($selectedParticipants, $peserta_hadir, $attendanceStatus, $mp);

        $newParticipants = $request->input('newParticipants');

        $attendanceStatusNewParticipants = $request->input('attendanceStatusNewParticipants', []);

        // dd($selectedParticipants, $peserta_hadir, $attendanceStatus, $newParticipants, $attendanceStatusNewParticipants);

        if ($newParticipants && is_array($newParticipants)) {
            foreach ($newParticipants as $participantId) {
                // Assuming $meetingId is the ID of the meeting you want to associate participants with
                $meetingParticipant = new Meeting_Participant([
                    'meeting_id' => $meeting->id,
                    'participant_id' => $participantId,
                    'attendance_status' => in_array($participantId, $attendanceStatusNewParticipants) ? 1 : 0,
                ]);

                $meetingParticipant->save();
            }
        }

        // Periksa absensi untuk new participant



        // dd($attendanceStatus, $newParticipants, $attendanceStatusNewParticipants);



        //$meetingData['attendanceStatus'] = $attendanceStatus;

        $meetingId = $meeting->id;


        Content::where('meeting_id', $meetingId)->delete(); //hapus semua content dan action dari meeting_id


        // $discussionDataArray = [];
        // $discussionData = $request->input('discussion');

        // if (!is_null($discussionData) && is_array($discussionData)) {
        //     foreach ($discussionData as $discussionIndex => $discussion) {

        //         // Check if the discussion content is not empty
        //         if (!empty($discussion['content'])) {
        //             // Create and save the Content model only if the content is not empty
        //             $content = new Content([
        //                 'discussion' => $discussion['content'],
        //                 'meeting_id' => $meetingId,
        //             ]);
        //             $content->save();

        //             $actionsForDiscussion = [];

        //             if (isset($discussion['actions']) && is_array($discussion['actions'])) {
        //                 foreach ($discussion['actions'] as $actionIndex => $actionData) {
        //                     // Validasi dan simpan data tindakan ke dalam tabel tindakan
        //                     if (!empty($actionData['item'])) {

        //                         $picValue = $actionData['pic'] !== '0' ? $actionData['pic'] : null;
        //                         $action = new Action([
        //                             'content_id' => $content->id, // Hubungkan dengan diskusi yang sesuai
        //                             'item' => $actionData['item'],
        //                             //   'due' => $actionData['due'],
        //                             'due' => $actionData['due'] ?? null,
        //                             // 'pic' => $actionData['pic'],
        //                             $picValue,
        //                         ]);
        //                         $action->save();

        //                         // Simpan tindakan ke dalam array tindakan untuk diskusi saat ini
        //                         $actionsForDiscussion[] = [
        //                             'item' => $actionData['item'],
        //                             // 'due' => $actionData['due'],
        //                             'due' => $actionData['due'] ?? null,
        //                             // 'pic' => $actionData['pic'],
        //                             'pic' => $actionData['pic'] ?? null,
        //                         ];
        //                     }
        //                 }
        //             }

        //             // Simpan data diskusi dan tindakan ke dalam array
        //             $discussionDataArray[] = [
        //                 'content' => $discussion['content'],
        //                 'actions' => $actionsForDiscussion,
        //             ];
        //         }
        //     }
        // }

        // dd($discussionDataArray);

        ////////////

        $newDiscussionDataArray = $request->newDiscussion;

        // dd($newDiscussionDataArray, $discussionDataArray);

        if (is_array($newDiscussionDataArray)) {
            foreach ($newDiscussionDataArray as $newDiscussionData) {
                $contentDiscussion = $newDiscussionData['content'];
                $actionsForDiscussion = [];

                // Check if actions are associated with the new discussion
                if (isset($newDiscussionData['actions']) && is_array($newDiscussionData['actions'])) {
                    foreach ($newDiscussionData['actions'] as $actionData) {
                        $item = $actionData['item'];
                        $due = $actionData['due'];
                        $pic = $actionData['pic'];

                        // Check if the item of the action is not empty
                        if (!empty($item)) {
                            $actionsForDiscussion[] = [
                                'item' => $item,
                                'due' => $due,
                                'pic' => $pic,
                            ];
                        }
                    }
                }

                // dd($contentDiscussion);

                // Check if the content of the new discussion is not empty
                if (!empty($contentDiscussion)) {
                    // Save new discussion data to the database
                    $newContent = new Content([
                        'discussion' => $contentDiscussion,
                        'meeting_id' => $meetingId,
                    ]);
                    $newContent->save();
                    // dd($newContent);

                    // Save action data to the database if there are associated actions
                    if (!empty($actionsForDiscussion)) {

                        foreach ($actionsForDiscussion as $actionData) {
                            // Process and save action data to the database

                            $picValue = $actionData['pic'] !== '0' ? $actionData['pic'] : null;
                            // dd($picValue);

                            $newAction = new Action([
                                'content_id' => $newContent->id, // Associate action with the newly saved content
                                'item' => $actionData['item'],
                                'due' => $actionData['due'] ?? null,
                                'pic' => $picValue,
                            ]);

                            $newAction->save();
                        }
                    }
                }
            }
        }

        //  dd($newDiscussionDataArray, $discussionDataArray);

        // dd($request->all(), $newDiscussionDataArray);
        //dd($discussionDataArray, );




        ///
        // Hapus fie yang dihapus


        $selectedFiles = $request->input('selected_files', []);
        $fileDataArray = [];

        foreach ($selectedFiles as $fileInfo) {
            list($id, $fileName, $url) = explode(':', $fileInfo);

            $fileDataArray[] = [
                'id' => $id,
                'fileName' => $fileName,
                'url' => $url,
            ];
        }

        // Now $fileDataArray contains the id, fileName, and url of each selected file.

        // dd($selectedFiles);
        foreach ($selectedFiles as $fileInfo) {
            list($id, $fileName) = explode(':', $fileInfo);

            // Hapus file dari database berdasarkan id
            Meeting_File::find($id)->delete();

            // Dapatkan path lengkap file di storage
            $filePath = public_path('meetingFile') . '/' . $fileName;

            // Hapus file dari storage berdasarkan path lengkap
            if (file_exists($filePath) && unlink($filePath)) {
                // Penghapusan berhasil
                // Tambahkan log atau tindakan lain yang diperlukan
            } else {
                // Penghapusan gagal
                // Tambahkan penanganan kesalahan
            }
        }



        ////////
        // Tambahkan file baru

        /*

        if ($request->hasFile('files')) {
            $newFilesData = [];

            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                //  $file->storeAs('meetingFile', $fileName);
                $file->storeAs('meetingFile', $fileName, 'public');


                $newFilesData[] = [
                    'fileName' => $fileName,
                    'url' => 'meetingFile/' . $fileName,
                    'meeting_id' => $meeting->id,
                ];

                // Uncomment the following line to save file information to the database
                $meetingFile = new Meeting_File();
                $meetingFile->fileName = $fileName;
                $meetingFile->url = 'meetingFile/' . $fileName;
                $meetingFile->meeting_id = $meeting->id;
                $meetingFile->save();
            }

            //  dd($meetingData, $newFilesData, $discussionDataArray, $attendanceStatus,); // Print information about new files
        } */

        if ($request->hasFile('files')) {
            $newFilesData = [];

            // dd($request->file('files'));
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();

                // Simpan file ke folder public
                $file->move(public_path('meetingFile'), $fileName);

                $newFilesData[] = [
                    'fileName' => $fileName,
                    'url' => 'meetingFile/' . $fileName,
                    'meeting_id' => $meeting->id,
                ];

                // Uncomment the following line to save file information to the database
                $meetingFile = new Meeting_File();
                $meetingFile->fileName = $fileName;
                $meetingFile->url = 'meetingFile/' . $fileName;
                $meetingFile->meeting_id = $meeting->id;
                $meetingFile->save();
            }

            //  dd($meetingData, $newFilesData, $discussionDataArray, $attendanceStatus,); // Print information about new files
        }




        // dd($meetingData, $discussionDataArray, $attendanceStatus);


        // Simpan discussion baru ke history revisi
        $editedDiscussionData = $newDiscussionDataArray;

        // Pastikan $newDiscussionDataArray adalah array yang valid
        if (is_array($editedDiscussionData)) {
            // Inisialisasi array untuk menyimpan data yang sudah dipisah
            $separatedData = [];

            foreach ($editedDiscussionData as $data) {
                // Ambil konten discussion
                $discussionContent = $data['content'];

                // Inisialisasi array untuk menyimpan actions
                $actions = [];

                if (isset($data['actions']) && is_array($data['actions'])) {
                    // Loop melalui setiap action
                    foreach ($data['actions'] as $action) {
                        // Ambil item, due, dan pic dari setiap action
                        $item = $action['item'];
                        $due = $action['due'];
                        $pic = $action['pic'];

                        // Tambahkan action ke array actions
                        $actions[] = [
                            'item' => $item,
                            'due' => $due,
                            'pic' => $pic,
                        ];
                    }
                }

                // Tambahkan data yang sudah dipisah ke array separatedData
                $separatedData[] = [
                    'content' => $discussionContent,
                    'actions' => $actions,
                ];
            }

            // Sekarang, $separatedData berisi data yang sudah dipisah

            // Inisialisasi array untuk menyimpan objek Revision_History
            $revisionHistoryArray = [];

            // Inisialisasi array untuk menyimpan semua diskusi
            $allDiscussions = [];

            foreach ($separatedData as $data) {
                $discussionContent = $data['content'];

                // Ambil data actions dalam format JSON
                $actions = json_encode($data['actions']);

                // Simpan data diskusi ke dalam array
                if (!empty($discussionContent)) {
                    $allDiscussions[] = [
                        'content' => $discussionContent,
                        'action' => $actions,
                    ];
                }
            }

            // Simpan semua data diskusi dalam satu entri ID
            if (!empty($allDiscussions)) {
                $revisionHistoryArray[] = [
                    'meeting_id' => $meetingId,
                    'discussion_log' => json_encode($allDiscussions),
                    'editor' => $request->input('note_taker'),
                ];
            }

            // Simpan semua data sekaligus setelah loop selesai
            if (!empty($revisionHistoryArray)) {
                Revision_History::insert($revisionHistoryArray);
            }


            // dd($);

        } else {
            // Handle jika $newDiscussionDataArray bukan array yang valid
            // Contoh: tampilkan pesan kesalahan atau tindakan lain yang sesuai
            redirect()->back()->with('fail', 'Error, Something is Wrong, Please re-enter the Submission.');
        }



        if ($request->input('action') === 'finalize') {
            // Redirect ke route finalize dengan parameter meeting ID
            //return redirect()->route('meeting.finalizing', ['id' => $meetingId, 'idLogin' => $idLogin])->with('action', 'finalize');
            // $meetingData['meeting_status'] = 'Distributed';

            return redirect()->route('meeting.finalize', ['id' => $meetingId])->with('success', 'Meeting Minutes Updated Successfully.');
        }


        
      //  return redirect()->route('meeting.edit', ['id' => $meetingId])->with('success', 'Meeting Minutes Updated Successfully.');
        return redirect()->route('home')->with('success', 'Meeting Minutes Updated Successfully.');

    }
}
