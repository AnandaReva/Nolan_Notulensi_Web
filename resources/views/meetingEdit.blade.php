@extends('layouts.mainLayout')

@section('title', 'Edit Meeting')

@section('content')

    @if (session('status') == 'success')
        <div class="alert alert-success text-center" role="alert">
            <h4>{{ session('message') }}</h4>
        </div>
    @endif



    <div class="tabel tabel-create table-responsive-lg col-12">

        @if (session('status') == 'fail')
            <div class="alert alert-error text-center" role="alert">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif



        <form method="POST" action="{{ route('meeting.update', ['id' => $meeting->id, 'idLogin' => $idLogin]) }}"
            enctype="multipart/form-data">

            {{-- untuk input title tapi dihidden karena dah ada di navbar --}}
            <input hidden type="text" class="form-control" id="title" name="title" required
                value="{{ $meeting->title }}">




            @csrf
            @method('PUT') <!-- Tambahkan ini untuk metode PUT -->
            <table class="input-meeting table table-bordered-0 align-middle mb-5">
                <tr>
                    <th class="col-2"><label for="date">Date/Time</label></th>
                    <td class="col-4">
                        <input class="form-control" type="date" id="date" name="date" required
                            placeholder="yyyy-mm-dd" value="{{ $meeting->date }}">
                    </td>
                    <th class="col-2"><label for="noteTaker">Note Taker</label></th>
                    <td class="col-4">
                        <select class="form-control" id="note_taker" name="note_taker" required>
                            @foreach ($peserta_tersedia as $peserta)
                                <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}"
                                    {{ $meeting->note_taker == $peserta->id ? 'selected' : '' }}>
                                    {{ $peserta->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class=""><label for="location">Location</label></th>
                    <td class="">
                        <input class="form-control" type="text" id="location" name="location" required
                            value="{{ $meeting->location }}">
                    </td>
                    <th class=""><label for="inisiator">Meeting Called By</label></th>
                    <td class="">
                        <select class="form-control" id="inisiator" name="inisiator" required>
                            @foreach ($peserta_tersedia as $peserta)
                                <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}"
                                    {{ $meeting->inisiator == $peserta->id ? 'selected' : '' }}>
                                    {{ $peserta->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="" style="vertical-align: middle;"><label for="attendees">Attendees</label></th>
                    <td class="">
                        <ul class="p-0 m-0" id="attend">
                            @foreach ($peserta_tersedia as $peserta)
                                @if ($attendanceStatus->has($peserta->id))
                                    @if ($attendanceStatus[$peserta->id] === 0)
                                        <li class="list-group-item d-flex attend" id="attendees-colom-{{ $peserta->id }}">
                                        </li>
                                    @else
                                        <li class="list-group-item d-flex attend" id="attendees-colom-{{ $peserta->id }}">
                                            <input onchange="switchAttendees(event, {{ $peserta->id }})"
                                                class="d-inline-block" type="checkbox" name="attendanceParticipants[]"
                                                id="peserta_{{ $peserta->id }}" value="{{ $peserta->id }}" checked>
                                            <label class="form-check-label" for="peserta_{{ $peserta->id }}"
                                                id="l-mahasiswa-{{ $peserta->id }}">
                                                {{ $peserta->name }}
                                            </label>
                                        </li>
                                    @endif
                                @else
                                    <li class="list-group-item d-flex attend" id="attendees-colom-{{ $peserta->id }}">
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <th class="" style="vertical-align: middle;"><label for="absent">Absent</label></th>
                    <td class="">
                        <ul class="p-0 m-0" id="attend">
                            @foreach ($peserta_tersedia as $peserta)
                                @if ($attendanceStatus->has($peserta->id))
                                    @if ($attendanceStatus[$peserta->id] === 1)
                                        <li class="list-group-item d-flex attend" id="absent-colom-{{ $peserta->id }}">
                                        </li>
                                    @else
                                        <li class="list-group-item d-flex attend" id="absent-colom-{{ $peserta->id }}">
                                            <input onchange="switchAttendees(event, {{ $peserta->id }})"
                                                class="d-inline-block" type="checkbox" name="attendanceParticipants[]"
                                                id="peserta_{{ $peserta->id }}" value="{{ $peserta->id }}">
                                            <label class="form-check-label" for="peserta_{{ $peserta->id }}"
                                                id="l-mahasiswa-{{ $peserta->id }}">
                                                {{ $peserta->name }}
                                            </label>
                                        </li>
                                    @endif
                                @else
                                    <li class="list-group-item d-flex attend" id="absent-colom-{{ $peserta->id }}">
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <div class="nav-item dropdown">
                            <a class="btn btn-outline-dark p-1" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-plus border border-black rounded-circle p-1 me-2"></i>
                                Add
                                attendees
                            </a>
                            <ul class="dropdown-menu px-2" style="height: 10rem">
                                @foreach ($peserta_tersedia as $peserta)
                                    @if ($attendanceStatus->has($peserta->id))
                                        <li class="list-group-item d-flex attend" id="user-colom-{{ $peserta->id }}">
                                        </li>
                                    @else
                                        <li class="list-group-item d-flex attend" id="user-colom-{{ $peserta->id }}">
                                            {{-- name="meetingParticipantsEdit[]" ini beda dengan yg di create untuk memnyesuaikan dengan controllernya dan createNote.js --}}
                                            <input onchange="addAttendees(event, {{ $peserta->id }})"
                                                class="d-inline-block" type="checkbox" name="newParticipants[]"
                                                id="user_{{ $peserta->id }}" value="{{ $peserta->id }}"
                                                @if (isset($attendanceStatus[$peserta->id])) checked @endif>
                                            <label class="form-check-label" for="user_{{ $peserta->id }}"
                                                id="l-user-{{ $peserta->id }}">
                                                {{ $peserta->name }}
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                                {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>

            @include('subFitur.table-discussion')

            <div class="d-flex gap-5 justify-content-center">
                <!-- Modal Rejection Message -->
                <button type="button" class="modal-button btn btn-danger" onclick="openModal('modal1')">Reject
                    Message</button>

                <!-- Modal pertama -->
                <div id="modal1" class="modal">
                    <div class="modal-content modal-dialog modal-lg p-3 shadow-lg">

                        <h3>Rejection Message</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Message</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rejectionMessages as $rejectMessage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rejectMessage->Writer->name }}</td>
                                            <td>{{ $rejectMessage->created_at }}</td>
                                            <td>
                                                {{ $rejectMessage->message }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-3"
                                    onclick="closeModal('modal1')">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal Revision HIstory -->
                <button type="button" class="modal-button btn btn-info" onclick="openModal('modal2')">Revision
                    History</button>

                <!-- Modal kedua -->
                <div id="modal2" class="modal">
                    <div class="modal-content modal-dialog modal-lg p-3 shadow-lg">
                        <h3>Revision History:</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Edited By</th>
                                        <th>Date</th>
                                        <th>Discussion</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($revisionHistories as $revisionHistory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $revisionHistory->editorParticipant->name }}</td>
                                            <td>{{ $revisionHistory->created_at }}</td>
                                            <td>
                                                <div>
                                                    @foreach ($revisionHistory->discussion_log as $discussion)
                                                        {{ $discussion['content'] ?? 'N/A' }}<br>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                @if (count($revisionHistory->discussion_log) > 0)
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Follow Up Action</th>
                                                                <th>Due Date</th>
                                                                <th>PIC</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($revisionHistory->discussion_log as $discussion)
                                                                @if (isset($discussion['action']) && is_array($discussion['action']))
                                                                    @foreach ($discussion['action'] as $actionDiscussionLog)
                                                                        <tr>
                                                                            <td>{{ $loop->parent->iteration }}</td>
                                                                            <td>{{ $actionDiscussionLog['item'] ?? 'N/A' }}
                                                                            </td>
                                                                            <td>{{ $actionDiscussionLog['due'] ?? '(No Due)' }}
                                                                            </td>
                                                                            <td>
                                                                                @if (!empty($actionDiscussionLog['pic']))
                                                                                    @php
                                                                                        $picValue = (int) $actionDiscussionLog['pic'];
                                                                                        $participantName = '';
                                                                                    @endphp

                                                                                    @foreach ($participants as $participant)
                                                                                        @if ($participant->id === $picValue)
                                                                                            @php
                                                                                                $participantName = $participant->name;
                                                                                            @endphp
                                                                                            {{ $participantName }}
                                                                                        @endif
                                                                                    @endforeach

                                                                                    @if (empty($participantName))
                                                                                        -
                                                                                    @endif
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td>{{ $loop->parent->iteration }}</td>
                                                                        <td colspan="3">No Action</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    No Action
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-3 "
                                onclick="closeModal('modal2')">Close</button>
                        </div>
                    </div>
                </div>
                <script src="{{ asset('js/popUp.js') }}"></script>
            </div>

            <h3 class="mb-4 mt-5">Attachments:</h3>
            <div class="lampiran container mx-auto mb-4 w-75">
                @foreach ($meetingFiles as $meetingFile)
                    <div hidden>
                        <input type="checkbox" id="file-{{ $meetingFile->id }}" name="selected_files[]"
                            value="{{ $meetingFile->id }}:{{ $meetingFile->fileName }}:{{ $meetingFile->url }}">
                        {{ $meetingFile->fileName }}
                    </div>
                    <li class="border p-2 px-3 my-2 d-flex justify-content-between align-items-center">
                        <span>{{ $meetingFile->fileName }}</span>
                        <label class="pointer" for="{{ $meetingFile->id }}" id="delete-file-{{ $meetingFile->id }}"
                            onclick="deleteFile(event, {{ $meetingFile->id }})">
                            <i class="fa-solid fa-circle-xmark text-danger fa-lg" aria-hidden="true"></i>
                        </label>
                    </li>
                @endforeach

                <div id="fileInputs">
                    <div class="form-group">
                        <input type="file" name="files[]" class="form-control-file"
                            accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" multiple>

                        <button type="button" class="removeFileInput btn btn-danger my-2" style="height: 2.5rem">Delete
                            File</button>
                    </div>
                </div>
                <br>
                <button type="button" id="addFileInput" class="btn btn-secondary" style="height: 2.5rem">Add
                    File</button>

                <script src="{{ asset('js/addFileInput.js') }}"></script>
            </div>


            <h3 class="mb-4 mt-5">Signature:</h3>
            <div class="signature container">
                <div class="row p-4 text-center align-items-center">
                    @foreach ($participants as $participant)
                        @if ($attendanceStatus->has($participant->id) && $attendanceStatus[$participant->id] === 1)
                            <div class="border col col-3" style="border: black solid 1px">
                                <div class="frame-ttd p-2 px-1 w-100" style="height: 80%">
                                    @if ($urls[$participant->id] != null)
                                        <img src="{{ asset($urls[$participant->id]) }}" alt="signature" width="200"
                                            height="200">
                                    @else
                                    @endif


                                </div>
                                <p class="text-center">{{ $participant->name }}</p>
                            </div>
                        @else
                        @endif
                    @endforeach
                </div>
            </div>



            <div class="btn-create mt-5 mb-5 text-end">
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-outline-dark me-4" type="button" onclick="confirmGoBack()">Back</button>
                <script>
                    function confirmGoBack() {
                        var leaveConfirm = confirm(' Are you sure you want to come back ? Unsaved data will be lost.');

                        if (leaveConfirm) {
                            history.back();
                        }
                    }
                </script>

                <input class="btn btn-outline-info me-4" type="submit" name="action" value="finish"
                    onclick="return confirm('Are you sure you want to update meeting data?')">
                <input class="btn btn-outline-danger me-5" type="submit" name="action" value="finalize"
                    onclick="return confirm('Are you sure you want update meeting data and Finalizing it?')">
            </div>
        </form>
    </div>

@endsection
