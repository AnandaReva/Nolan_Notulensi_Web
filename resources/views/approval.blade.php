@extends('layouts.mainLayout')

@section('title', 'Approval Meeting')

@section('content')
    <div class="tabel tabel-create table-responsive-lg col-12">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if ($meeting)

            <form method="POST">
                <table class="input-meeting table table-bordered-0 align-middle mb-5">
                    <tr>
                        <th class="col-2"><label for="date">Date/Time</label></th>
                        <td class="col-4">
                            <input disabled class="form-control" type="datetime" id="date" name="date" required
                                placeholder="yyyy-mm-dd" value="{{ $meeting->date }}">
                        </td>
                        <th class="col-2"><label for="noteTaker">Note Taker</label></th>
                        <td class="col-4">
                            <select disabled class="form-control" id="note_taker" name="note_taker" required>
                                <option value="{{ $meeting->noteTaker->name }}">{{ $meeting->noteTaker->name }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class=""><label for="location">Location</label></th>
                        <td class="">
                            <input disabled class="form-control" type="text" id="location" name="location" required
                                placeholder="location..." value="{{ $meeting->location }}">
                        </td>
                        <th class=""><label for="inisiator">Meeting Called By</label></th>
                        <td class="">
                            <select disabled class="form-control" id="inisiator" name="inisiator" required>
                                <option value="{{ $meeting->meetingCalledBy->name }}">{{ $meeting->meetingCalledBy->name }}
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="" style="vertical-align: middle;"><label for="attendees">Attendees</label></th>
                        <td class="">
                            <ul class="p-0 m-0" id="attend">
                                @foreach ($participants as $peserta)
                                    @if ($attendanceStatus->has($peserta->id))
                                        @if ($attendanceStatus[$peserta->id] === 0)
                                            <li class="list-group-item d-flex attend"
                                                id="attendees-colom-{{ $peserta->id }}">
                                            </li>
                                        @else
                                            <li class="list-group-item d-flex attend"
                                                id="attendees-colom-{{ $peserta->id }}">
                                                <input disabled onchange="switchAttendees(event, {{ $peserta->id }})"
                                                    class="d-inline-block" type="checkbox" name="participants[]"
                                                    id="peserta_{{ $peserta->id }}" value="{{ $peserta->id }}" checked>
                                                <label class="form-check-label" for="peserta_{{ $peserta->id }}"
                                                    id="l-mahasiswa-{{ $peserta->id }}">
                                                    {{ $peserta->name }}
                                                </label>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <th class="" style="vertical-align: middle;"><label for="absent">Absent</label></th>
                        <td class="">
                            <ul class="p-0 m-0" id="attend">
                                @foreach ($participants as $peserta)
                                    @if ($attendanceStatus->has($peserta->id))
                                        @if ($attendanceStatus[$peserta->id] === 1)
                                            <li class="list-group-item d-flex attend"
                                                id="absent-colom-{{ $peserta->id }}">
                                            </li>
                                        @else
                                            <li class="list-group-item d-flex attend"
                                                id="absent-colom-{{ $peserta->id }}">
                                                <input disabled onchange="switchAttendees(event, {{ $peserta->id }})"
                                                    class="d-inline-block" type="checkbox" name="participants[]"
                                                    id="peserta_{{ $peserta->id }}" value="{{ $peserta->id }}">
                                                <label class="form-check-label" for="peserta_{{ $peserta->id }}"
                                                    id="l-mahasiswa-{{ $peserta->id }}">
                                                    {{ $peserta->name }}
                                                </label>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>

                @include('subFitur.table-discussion')

                <h3 class="mb-4 mt-5">Lampiran:</h3>
                <div class="lampiran container ms-0 mb-4 w-75">
                    <ul class="my-3" id="listfile">
                        @foreach ($files as $meetingFile)
                            <li class="p-2 px-3 my-2 d-flex justify-content-between align-items-center">
                                <span>
                                    <a href="{{ asset($meetingFile->url) }}" download="{{ $meetingFile->fileName }}">
                                        {{ $meetingFile->fileName }}
                                    </a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <h3 class="mb-4 mt-5">Signature:</h3>
                <div class="signature container">
                    <div class="row p-4 text-center align-items-center">
                        @foreach ($participants as $participant)
                            @if ($attendanceStatus->has($participant->id) && $attendanceStatus[$participant->id] === 1)
                                <div class="border col col-3 d-flex flex-column justify-content-between"
                                    style="border: black solid 1px">
                                    
                                    <div class="frame-ttd p-2 px-1 w-100"
                                        style="height: 70%; background-image: url({{ asset($urls[$participant->id]) }})">
                                        {{-- <img src="{{ asset($urls[$participant->id]) }}" class="object-fit-cover"
                                            alt="signature"> --}}
                                    </div>
                                    <p class=" text-center">{{ $participant->name }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="btn-create mt-5 mb-5 text-end">
                    <button class="btn btn-outline-dark me-4" type="button" onclick="history.back()">Back</button>

                    @if ($ttdUser !== null)
                        You already approved this meeting.
                        @if ($meeting->note_taker === session('idLogin'))
                            <!-- cek dia note taker apa bukan -->

                            <form id="signature-form"
                                action="{{ route('meeting.finalizing', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}"
                                method="POST">
                                @csrf

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Finalize</button>
                                </div>

                            </form>
                        @endif
                    @else
                        <button class="btn btn-outline-danger me-4" type="button" id="modalId"
                            onclick="openModal('rejectModal')">Reject</button>

                        <button class="btn btn-outline-success me-5" type="button" id="modalId"
                            onclick="openModal('approveModal')">Approve</button>
                    @endif

                </div>

            </form>

            <div id="rejectModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content modal-dialog modal-lg p-3 shadow-lg">
                    <div class="modal-header">
                        <h2>Enter Rejection Message</h2>
                        <span class="close" data-dismiss="modal">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form
                            action="{{ route('meeting.reject', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rejectionMessage">Rejection Message:</label>
                                <textarea name="rejectionMessage" id="rejectionMessage" class="form-control" rows="6" required></textarea>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" style="background: purple" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="approveModal" class="modal">
                <div class="modal-content modal-dialog modal-lg p-3 shadow-lg">
                    <div class="modal-header">
                        <h2>Please fill the Signature Box</h2>
                        <span class="close" data-dismiss="moda2l">&times;</span>
                    </div>
                    <div class="modal-body mx-auto">
                        <form id="signature-form"
                            action="{{ route('meeting.approve', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}"
                            method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="signature">Signature:</label> <br>
                                <canvas id="signature-canvas" width="400" height="200"
                                    style="border: 2px solid #000;" width="400" height="200" required></canvas>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger me-3" id="reset-signature">Reset</button>
                                <button style="background: purple" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <script src="{{ asset('js/sign.js') }}"></script>


                        </form>

                    </div>
                </div>
            </div>

            <script src="{{ asset('js/popUp.js') }}"></script>
        @else
            <p>Rapat tidak ditemukan.</p>
        @endif
    </div>
@endsection
