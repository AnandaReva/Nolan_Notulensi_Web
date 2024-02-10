@extends('layouts.mainLayout')

@section('title', 'Fianalize Meeting')

@section('content')

    @if ($meeting)
        <div class="tabel tabel-create table-responsive-lg col-12">
            <form method="POST" action="{{ route('meeting.update', ['id' => $meeting->id]) }}" enctype="multipart/form-data">
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
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="btn-create mt-5 mb-5 text-end">
                    <!--Saat di finalize akan mengubah status meeting majadi distributed -->
                    <button class="btn btn-outline-info me-4" type="button" id="modalId"
                        onclick="openModal('finalizeModal')">Finalize</button>
                    <button class="btn btn-outline-dark me-4" type="button" onclick="history.back()">Back</button>
                </div>

            </form>





            <div id="finalizeModal" class="modal">
                <div class="modal-content modal-dialog modal-lg">
                    <div class="modal-header">
                        <span class="close" data-dismiss="moda2l">&times;</span>
                        <h2>Meeting minutes will be distributed to attendees for approval or revision </h2>
                    </div>
                    <div class="modal-body">
                        <form id="signature-form"
                            action="{{ route('meeting.finalizing', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}"
                            method="POST">
                            @csrf

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


            <div class="button-container">



            </div>








            <script src="{{ asset('js/popUp.js') }}"></script>
        </div>
    @else
        <p>Meeting Minuetes Not Found.</p>
    @endif
@endsection
