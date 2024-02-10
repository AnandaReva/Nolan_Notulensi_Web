@extends('layouts.mainLayout')

@section('title', 'Tambah Pertemuan')

@section('content')


    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingAdd.css') }}">


    <div class="container mt-5">
        <div class="card ">

            <div class="card-body">
                <div class="text-center">
                    <h3>Create Note</h3>
                </div>

                <form method="POST" action="{{ route('meeting.store', ['idLogin' => session('idLogin')]) }}"
                    enctype="multipart/form-data">



                    @csrf
                    <div class="form-group">
                        <label for="title">Meeting title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date/Time</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="note_taker">Note Taker</label>
                            <select class="form-control" id="note_taker" name="note_taker" required>
                                <option value="">Pilih Note Taker</option>
                                @foreach ($peserta_tersedia as $peserta)
                                    <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}">
                                        {{ $peserta->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inisiator">Meeting Called By</label>
                            <select class="form-control" id="inisiator" name="inisiator" required>
                                <option value="">Pilih Meeting Called By</option>
                                @foreach ($peserta_tersedia as $peserta)
                                    <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}">
                                        {{ $peserta->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!--Pilih meeting_participant
                                                Lalu dari list meeting_participant
                                                
                                                    Pilih Attendee(hadir) -->
                    <div class="form-group" id="meetingParticipantsContainer">
                        <label>Meeting Participants</label> <br>
                        @foreach ($peserta_tersedia as $peserta)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="meetingParticipants[]"
                                    id="peserta_{{ $peserta->id }}" value="{{ $peserta->id }}">
                                <label class="form-check-label" for="peserta_{{ $peserta->id }}">
                                    {{ $peserta->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addAttendanceBtn" class="btn btn-secondary">Absensi Rapat</button>

                    <div class="form-group" id="attendeesContainer" style="display: none;">
                        <!-- Checkbox for attendance will be displayed here -->
                    </div>



                    <script src="{{ asset('js/addAttendance.js') }}"></script>

                    </class>
                    
                    <!--

                                            <div class="form-group">
                                                
                                                <label>Attendees</label>
                                                foreach ($peserta_tersedia as $peserta)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="participants[]"
                                                            id="peserta_{ $peserta->id }}" value="{ $peserta->id }}">
                                                        <label class="form-check-label" for="peserta_{ $peserta->id }}">
                                                            { $peserta->name }}
                                                        </label>
                                                    </div>
                                                endforeach
                                            </div>
                                        -->


                    <script src="{{ asset('js/attendance.js') }}"></script>


                    <br>

                    <label><b>Discussion</b></label>
                    <div id="discussion-container">
                        <div id="discussions">
                            <div class="discussion">

                                No. = 1
                                <input class="form-control" type="text" name="discussion[]"
                                    placeholder="Please fill before adding Actions" style="height: 100px;">
                                <!--   <input type="button" class="addAction" value="Add Action" data-discussion-index="0"> -->

                                <button type="button" class="addAction" value="Add Action" data-discussion-index="0"
                                    class=" btn btn-outline-secondary ">
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
                                        <tr>
                                            <td><input type="text" name="item[0][]" id="item_0"
                                                    placeholder="Follow Up Action"></td>
                                            <td><input type="date" name="due[0][]" id="due_0"
                                                    placeholder="Due Date">
                                            </td>
                                            <td>
                                                <select name="pic[0][]" id="pic_0">
                                                    <option value="0">Select PIC</option>
                                                    @foreach ($peserta_tersedia as $option)
                                                        <option value="{{ $option['id'] }}">{{ $option['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- <input type="button" id="addDiscussion" value="Add Discussion"
                                                                                                                                                                                    class="btn btn-outline-primary float-right btn-sm add-action"> -->

                        <button id="addDiscussion" value="Add Discussion" type="button"
                            class="btn btn-outline-primary float-right btn-sm add-action">
                            <i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i> <i
                                    class="fa fa-plus fa-stack-1x fa-inverse"></i></i> Tambah Item Diskusi
                        </button>



                    </div>



                    <script>
                        // kirim data peserta yang tersedia ke javascript dg json
                        var pesertaTersedia = @json($peserta_tersedia);
                    </script>




                    <script src="{{ asset('js/addDiscussion.js') }}"></script>



                    <div id="fileInputs">
                        <div class="form-group">
                            <label for="file">File:</label>
                            <!--<input type="file" name="files[]" class="form-control-file"
                                                                                                                    accept=".pdf, .doc, .docx" required> -->
                            <input type="file" name="files[]" class="form-control-file"
                                accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" required>

                            <button type="button" class="removeFileInput btn btn-danger">Hapus File</button>
                        </div>
                        <button type="button" id="addFileInput" class="btn btn-secondary">Tambahkan File</button>
                    </div>



                    <script src="{{ asset('js/addFileInput.js') }}"></script>










                    <br>
                    <!--
                                                    <div id="finalizeModal" class="modal">
                                                        <div class="modal-content modal-dialog modal-lg">
                                                            <div class="modal-header">
                                                                <span class="close" data-dismiss="moda2l">&times;</span>
                                                                <h2>Meeting minutes will be distributed to attendees for approval or revision</h2>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="submit" class="btn btn-secondary" name="action"
                                                                    value="finalize">Submit</button>



                                                            </div>
                                                        </div>
                                                    </div>
                                                -->


                    <div class="container d-flex justify-content-around">
                        @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary" name="action" value="save"
                            onclick="return confirm('Save meeting minutes without finalizing?')">Save</button>

                        <button type="submit" class="btn btn-secondary" name="action"
                            value="finalize">Finalize</button>

                        <!--  <button type="button" id="modalId" onclick="openModal('finalizeModal')">Finalize</button> -->

                    </div>


                    <script src="{{ asset('js/popUp.js') }}"></script>

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
                </form>
            </div>


        </div>


    </div>
@endsection
