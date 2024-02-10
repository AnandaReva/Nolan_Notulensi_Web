@extends('layouts.mainLayout')

@section('title', 'Detail Meeting')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/meetingDetail.css') }}">
    <br>
    <div class="container">


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










            <div class="button-container">
                <button onclick="history.back()">Back</button>


            </div>

            <style>
                .button-container {
                    text-align: center;
                }
            </style>
    </div>
@else
    <p>Rapat tidak ditemukan.</p>
    @endif
    </div>
@endsection
