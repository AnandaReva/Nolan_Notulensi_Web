@extends('layouts.mainLayout')

@section('title', 'Create Meeting')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingAdd.css') }}">

    <div class="tabel tabel-create table-responsive-lg col-12">
        <form method="POST" action="{{ route('meeting.store') }} " enctype="multipart/form-data">
            @csrf
            <table class="input-meeting table table-bordered-0 align-middle mb-5">
                <tr>
                    <th class=""><label for="title">Meeting title: </label></th>
                    <td class="" colspan="3">
                        <div class="box-input-title border border-black rounded-pill ps-2 p-1">
                            <i class="fa-solid fa-magnifying-glass me-1"></i>
                            <input class="border-0" type="text" id="title" name="title" required
                                placeholder="search meeting name...">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="col-2"><label for="date">Date/Time:</label></th>
                    <td class="col-4"><input type="date" id="date" name="date" required></td>
                    <th class="col-2"><label for="noteTaker">Note Taker:</label></th>
                    <td class="col-4">
                        <select class="form-control" id="note_taker" name="note_taker" required>
                            <option value="">Select Note Taker</option>
                            @foreach ($peserta_tersedia as $peserta)
                                <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}">
                                    {{ $peserta->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class=""><label for="location">Location:</label></th>
                    <td class=""><input type="text" id="location" name="location" required
                            placeholder="location..."></td>
                    <th class=""><label for="inisiator">Meeting Called By:</label></th>
                    <td class="">
                        <select class="form-control" id="inisiator" name="inisiator" required>
                            <option value="">Pilih Meeting Called By</option>
                            @foreach ($peserta_tersedia as $peserta)
                                <option value="{{ $peserta->id }}" data-id="{{ $peserta->id }}">
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
                                <li class="list-group-item d-flex attend" id="attendees-colom-{{ $peserta->id }}"></li>
                            @endforeach
                        </ul>
                    </td>
                    <th class="" style="vertical-align: middle;"><label for="absent">Absent</label></th>
                    <td class="">
                        <ul class="p-0 m-0" id="attend">
                            @foreach ($peserta_tersedia as $peserta)
                                <li class="list-group-item d-flex attend" id="absent-colom-{{ $peserta->id }}"></li>
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
                                    <li class="list-group-item d-flex attend" id="user-colom-{{ $peserta->id }}">
                                        <input onchange="addAttendees(event, {{ $peserta->id }})"
                                            onload="switchAttendees(event, {{ $peserta->id }})" class="d-inline-block"
                                            type="checkbox" name="meetingParticipants[]" id="user_{{ $peserta->id }}"
                                            value="{{ $peserta->id }}">
                                        <label class="form-check-label" for="user_{{ $peserta->id }}"
                                            id="l-user-{{ $peserta->id }}">
                                            {{ $peserta->name }}
                                        </label>
                                    </li>
                                @endforeach
                                {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>

            @include('subFitur.table-discussion')

            <h3 class="mb-4 mt-5">Attachment:</h3>
            <div class="lampiran container mx-auto mb-4 w-75">
                <div id="fileInputs">
                    <div class="form-group">
                        <input type="file" name="files[]" class="form-control-file"
                            accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" multiple required>

                        <button type="button" class="removeFileInput btn btn-danger my-2" style="height: 2.5rem">Delete
                            File</button>
                    </div>
                </div>
                <button type="button" id="addFileInput" class="btn btn-secondary" style="height: 2.5rem">Add Fies</button>

                <script src="{{ asset('js/addFileInput.js') }}"></script>

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
                            history.back(); // Lakukan navigasi kembali jika pengguna setuju
                        }
                    }
                </script>

                <input class="btn btn-outline-info me-4" type="submit" name="action" value="save"
                    onclick="return confirm('Meeting Note wiil be Send to All Attendess for Approval?')">
                <input class="btn btn-outline-danger me-5" type="submit" name="action" value="finalize"
                    onclick="return confirm('Are you sure you want to finalize the meeting, Meeting data cannot be changed?')">
            </div>
        </form>
    </div>
@endsection
