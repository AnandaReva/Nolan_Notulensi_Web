@extends('layouts.mainLayout')

@section('title', 'Detail Meeting')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingDetail.css') }}">
    <br>
    <div class="container">

        <h1>ini Finalize
        </h1>

        @if ($meeting)
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success alert-sm mb-2">
                        {{ session('success') }}
                    </div>
                @endif

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
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $participant->name }}</td>
                                    <td>{{ $participant->email }}</td>
                                    <td>
                                        @if ($attendanceStatus->has($participant->id))
                                            @if ($attendanceStatus[$participant->id] === 1)
                                                Hadir
                                            @else
                                                Abstain
                                            @endif
                                        @else
                                            Abstain
                                        @endif
                                    </td>
                                </tr>
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
                        @if (
                            $attendanceStatus->has($participant->id) &&
                                $attendanceStatus[$participant->id] === 1 &&
                                $urls->has($participant->id))
                            <div class="signature-box">
                                <div class="signature">
                                    <img src="{{ asset($urls[$participant->id]) }}" alt="signature" width="200"
                                        height="200">



                                </div>
                                <div>{{ $participant->name }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

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

                <button onclick="window.location.href='/nolan.com/home'">Back</button>

                <!--Saat di finalize akan mengubah status meeting majadi distributed -->
                <button type="button" id="modalId" onclick="openModal('finalizeModal')">Finalize</button>

            </div>






            <style>
                .button-container {

                    text-align: center;
                }

                .button-container button {
                    margin: 0 10px;
                    /* Memberikan jarak 10px antara tombol */
                }
            </style>

            <script src="{{ asset('js/popUp.js') }}"></script>



    </div>
@else
    <p>Rapat tidak ditemukan.</p>
    @endif
    </div>
@endsection
