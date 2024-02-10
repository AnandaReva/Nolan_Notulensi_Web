@extends('layouts.mainLayout')

@section('title', 'Detail Meeting')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingDetail.css') }}">
    <br>
    <div class="container">

        <h1>ini Approval</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if ($meeting)
            <div class="card">

                <div class="card-body">


                    <div class="text-center">
                        <h3>{{ $meeting->title }}</h3>
                    </div> <br>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th><strong>Date/Time:</strong></th>


                                <th><strong>Note Taker:</strong></th>


                                <th><strong>Location:</strong></th>


                                <th><strong>Meeting Called By:</strong></th>

                            </tr>
                            <tr>
                                <td>{{ $meeting->date }}</td>
                                <td>{{ $meeting->noteTaker->name }}</td>

                                <td>{{ $meeting->location }}</td>
                                <td>{{ $meeting->meetingCalledBy->name }}</td>







                            </tr>






                            <!--
                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                            <td><strong>Status Pertemuan:</strong></td>
                                                                                                                                                                                                                                                                                                            <td>{ $meeting->meeting_status }}</td>
                                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                        <td><strong>Former ID:</strong></td>
                                                                                                                                                                                                                                                                                                                        <td>{ $meeting->former_id }}</td>
                                                                                                                                                                                                                                                                                                                    </tr> -->




                        </tbody>
                    </table>
                </div>



            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Meeting Attendees:</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                            @if ($attendanceStatus->has($participant->id))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $participant->name }}</td>
                                    <td>
                                        @if ($attendanceStatus[$participant->id] === 1)
                                            Hadir
                                        @elseif ($attendanceStatus[$participant->id] === 0)
                                            Tidak Hadir
                                        @else
                                            
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>



            <div class="card">
                <div class="card-body">
                    <h3>Diskusi:</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Discussion</th>
                                    <th>Follow Up Actions</th>
                                    <th>Due Date</th>
                                    <th>PIC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meeting->contents as $content)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $content->discussion }}</td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach ($content->actions as $action)
                                                    <li>
                                                        @if ($action->item)
                                                            {{ $action->item }}
                                                        @else
                                                            (No Item)
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach ($content->actions as $action)
                                                    <li>
                                                        @if ($action->due)
                                                            {{ $action->due }}
                                                        @else
                                                            (No Due)
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach ($content->actions as $action)
                                                    <li>
                                                        @if ($action->picParticipant)
                                                            {{ $action->picParticipant->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <strong>Lampiran:</strong>
                    <ul>
                        @foreach ($files as $file)
                            <li>
                                <a href="{{ asset($file->url) }}"
                                    download="{{ $file->fileName }}">{{ $file->fileName }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>



            <div class="card">
                <strong>Signature:</strong>
                <div class="card-body-signature">
                    <br>
                    @foreach ($participants as $participant)
                        @if ($attendanceStatus->has($participant->id) && $attendanceStatus[$participant->id] === 1)
                            <div class="signature-box">
                                <img src="{{ asset($urls[$participant->id]) }}" alt="signature" width="200"
                                    height="200">
                                <div>{{ $participant->name }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>





            <div class="button-container">
                <button onclick="history.back()">Back</button>

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
                    <button type="button" id="modalId" onclick="openModal('approveModal')">Approve</button>

                    <button type="button" id="modalId" onclick="openModal('rejectModal')">Reject</button>
                @endif


            </div>


            <div id="rejectModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content modal-dialog modal-lg">
                    <div class="modal-header">
                        <span class="close" data-dismiss="modal">&times;</span>
                        <h2>Enter Rejection Message</h2>
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
                            <div class="text-center">


                                <button type="submit" class="btn btn-primary">Send</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div id="approveModal" class="modal">
                <div class="modal-content modal-dialog modal-lg">
                    <div class="modal-header">
                        <span class="close" data-dismiss="moda2l">&times;</span>
                        <h2>Please fill the Signature Box</h2>
                    </div>
                    <div class="modal-body">
                        <form id="signature-form"
                            action="{{ route('meeting.approve', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}"
                            method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="signature">Signature:</label> <br>
                                <canvas id="signature-canvas" width="400" height="200" style="border: 2px solid #000;"
                                    width="400" height="200" required></canvas>
                                <button type="button" id="reset-signature">Reset</button>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <script src="{{ asset('js/sign.js') }}"></script>


                        </form>

                    </div>
                </div>
            </div>





            <script src="{{ asset('js/popUp.js') }}"></script>






            <style>
                .button-container {

                    text-align: center;
                }

                .button-container button {
                    margin: 0 10px;
                    /* Memberikan jarak 10px antara tombol */
                }
            </style>




    </div>
@else
    <p>Rapat tidak ditemukan.</p>
    @endif
    </div>
@endsection
