@extends('layouts.mainLayout')

@section('title', 'Edit Meeting')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingAdd.css') }}">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>Edit Note</h3>
                </div>


                <form method="POST" action="{{ route('meeting.update', ['id' => $meeting->id, 'idLogin' => $idLogin]) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT') <!-- Tambahkan ini untuk metode PUT -->
                    <div class="form-group">
                        <label for="title">Meeting title</label>
                        <input type="text" class="form-control" id="title" name="title" required
                            value="{{ $meeting->title }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date/Time</label>
                                <input type="date" class="form-control" id="date" name="date" required
                                    value="{{ $meeting->date }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required
                                    value="{{ $meeting->location }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="note_taker">Note Taker</label>
                                <select class="form-control" id="note_taker" name="note_taker" required>

                                    @foreach ($peserta_tersedia as $peserta)
                                        <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}"
                                            {{ $meeting->note_taker == $peserta->id ? 'selected' : '' }}>
                                            {{ $peserta->name }}
                                        </option>
                                    @endforeach
                                </select>



                            </div>
                            <div class="form-group">
                                <label for="inisiator">Meeting Called By</label>

                                <select class="form-control" id="inisiator" name="inisiator" required>

                                    @foreach ($peserta_tersedia as $peserta)
                                        <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}"
                                            {{ $meeting->inisiator == $peserta->id ? 'selected' : '' }}>
                                            {{ $peserta->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Peserta -->
                    <!-- Inside your Blade template -->
                    <div class="form-group">
                        <label>Attendees</label>
                        @foreach ($participants as $participant)
                            @if ($attendanceStatus->has($participant->id))
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="participants[]"
                                        id="peserta_{{ $participant->id }}" value="{{ $participant->id }}"
                                        @if ($attendanceStatus[$participant->id] === 1) checked @endif>
                                    <label class="form-check-label" for="peserta_{{ $participant->id }}">
                                        {{ $participant->name }}
                                        @if ($attendanceStatus[$participant->id] === 1)
                                            : <b style="color: lightgreen">Hadir</b>
                                        @elseif ($attendanceStatus[$participant->id] === 0)
                                            : <b style="color: red">Abstain</b>
                                        @endif
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <br>

                    <!-- -->
                    <label>Add New Participants</label>
                    <div class="form-group" id="meetingParticipantContainer">
                        <!-- Checkbox for meeting participant will be displayed here -->
                        @foreach ($nonMeetingParticipants as $id => $name)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="newParticipants[]"
                                    id="newPeserta_{{ $id }}" value="{{ $id }}">
                                <label class="form-check-label" for="newPeserta_{{ $id }}">
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addAttendanceBtn" class="btn btn-secondary">Absention for new
                        Participant</button>

                    <div class="form-group" id="attendeesContainer" style="display: none;">
                        <!-- Checkbox for attendance will be displayed here -->
                    </div>


                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                    <script src="{{ asset('js/newParticipantAttendance.js') }}"></script>
                    

                    <br>
















                    <!-- Tombol "Tambah Diskusi" -->
                    <!-- Define idxFromBlade as 0 and increment it for each new action -->
                    <script>
                        var idxFromBlade = @json($idx); // Convert PHP variable $idx to a JavaScript variable
                    </script>
                    <label><b>Discussion</b></label>
                    <div id="discussion-container">
                        <div id="discussions">
                            @foreach ($meeting->contents as $index => $content)
                                <div class="discussion" data-discussion-index="{{ $index }}">
                                    <textarea class="form-control" name="discussion[{{ $index }}][content]"
                                        placeholder="Please fill before adding Actions">{{ $content->discussion }}</textarea>
                                    <button type="button" class="addAction" value="Add Action"
                                        class="btn btn-outline-secondary">
                                        <i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i> <i
                                                class="fa fa-plus fa-stack-1x fa-inverse"></i></i> Tambah Action
                                    </button>
                                    <div class="actions">
                                        <table class="table">
                                            <tr>
                                                <th>Follow Up Action:</th>
                                                <th>Due Date:</th>
                                                <th>PIC:</th>
                                            </tr>
                                            @foreach ($content->actions as $idx => $action)
                                                <tr>
                                                    <td> index discussion = {{ $index }}
                                                        index action = {{ $idx }}
                                                        <input type="text"
                                                            name="discussion[{{ $index }}][actions][{{ $idx }}][item]"
                                                            value="{{ $action->item }}" placeholder="Follow Up Action">
                                                    </td>
                                                    <td>
                                                        <input type="date"
                                                            name="discussion[{{ $index }}][actions][{{ $idx }}][due]"
                                                            value="{{ $action->due }}">
                                                    </td>
                                                    <td>
                                                        <select
                                                            name="discussion[{{ $index }}][actions][{{ $idx }}][pic]">
                                                            <option value="">Select PIC</option>

                                                            @foreach ($peserta_tersedia as $option)
                                                                <option value="{{ $option->id }}"
                                                                    {{ $action->pic == $option->id ? 'selected' : '' }}>
                                                                    {{ $option->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>





                    <!-- <input type="button" id="addDiscussion" value="Add Discussion"
                                                                                                                                                                                                                                                                                                                                                                                                        class="btn btn-outline-primary float-right btn-sm add-action"> -->

                    <button id="addDiscussion" value="Add Discussion" type="button"
                        class="btn btn-outline-primary float-right btn-sm add-action">
                        <i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i> <i
                                class="fa fa-plus fa-stack-1x fa-inverse"></i></i> Tambah Item Diskusi
                    </button>

                    <div id="discussions">
                        <!-- Discussion elements will be added here dynamically -->
                    </div>

                    <script>
                        // Initialize arrays to store discussions and actions
                        var newDiscussions = [];
                        var newActions = [];

                        // Convert PHP data (if needed) to JavaScript variables
                        var pesertaTersedia = @json($peserta_tersedia);
                    </script>



                    <script src="{{ asset('js/addDiscussionEdit.js') }}"></script>

                    <br>
                    <div id="fileInputs">
                        <div class="form-group">
                            <label for="file">Hapus FIle:</label>
                            @foreach ($meetingFiles as $meetingFile)
                                <div>
                                    <input type="checkbox" name="selected_files[]"
                                        value="{{ $meetingFile->id }}:{{ $meetingFile->fileName }}:{{ $meetingFile->url }}">
                                    {{ $meetingFile->fileName }}
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <button type="button" id="addFileInput" class="btn btn-primary">Tambahkan File</button>
                    <script src="{{ asset('js/addFileInput.js') }}"></script>
                    <br>
                    <br>



                    <div class="container d-flex justify-content-around">
                        <!-- Modal Rejection Message -->
                        <button type="button" class="modal-button" onclick="openModal('modal1')">Reject Message</button>

                        <!-- Modal pertama -->
                        <div id="modal1" class="modal">
                            <div class="modal-content modal-dialog modal-lg">

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


                                    <button type="button" class="close-button"
                                        onclick="closeModal('modal1')">Close</button>
                                </div>
                            </div>
                        </div>




                        <!-- Modal Revision HIstory -->
                        <button type="button" class="modal-button" onclick="openModal('modal2')">Revision
                            History</button>

                        <!-- Modal kedua -->
                        <div id="modal2" class="modal">
                            <div class="modal-content modal-dialog modal-lg">



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
                                                        {{ $revisionHistory->discussion_log['content'] }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($revisionHistory->discussion_log['action']))
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
                                                                    @foreach ($revisionHistory->discussion_log['action'] as $actionDiscussionLog)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>
                                                                                @if (!empty($actionDiscussionLog['item']))
                                                                                    {{ $actionDiscussionLog['item'] }}
                                                                                @else
                                                                                    N/A
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (!empty($actionDiscussionLog['due']))
                                                                                    {{ $actionDiscussionLog['due'] }}
                                                                                @else
                                                                                    (No Due)
                                                                                @endif
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
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="close-button" onclick="closeModal('modal2')">Close</button>
                            </div>
                        </div>
                        <script src="{{ asset('js/popUp.js') }}"></script>





                    </div>
            </div>

            <div class="card">
                <strong>Signature:</strong>
                <div class="card-body-signature">
                    <br>
                    @foreach ($participants as $participant)
                        @if ($attendanceStatus->has($participant->id) && $attendanceStatus[$participant->id] === 1)
                            @if ($participant->id === auth()->user()->id)
                            @else
                                <div class="signature-box" style="border: black solid 1px">
                                    <img src="{{ asset($urls[$participant->id]) }}" alt="signature" width="200"
                                        height="200">
                                    <div>{{ $participant->name }}</div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>


            <div class="container d-flex justify-content-around">
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <button type="submit" class="btn btn-primary"
                    onclick="return confirm(' Update meeting data without finalizing?')">Update</button>

                <button type="submit" class="btn btn-secondary" name="action" value="finalize">Finalize</button>

                <!--  <button type="submit" class="btn btn-info" name="finalize" value="finalize"
                                                                                    onclick="return confirm('Are you sure you want to finalize the meeting, Meeting data cannot be changed?')">Finalize</button> -->


            </div>
            </form>
        </div>



    </div>





    </div>
    <br>

    <div class="button-container">
        <button type="button" onclick="confirmGoBack()">Back</button>

        <script>
            function confirmGoBack() {
                var leaveConfirm = confirm(' Are you sure you want to come back ? Unsaved data will be lost.');

                if (leaveConfirm) {
                    history.back(); // Lakukan navigasi kembali jika pengguna setuju
                }
            }
        </script>

    </div>





@endsection
