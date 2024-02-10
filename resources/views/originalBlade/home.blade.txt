@extends('layouts.mainLayout')

@section('title', 'Meeting')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">

    <div class="card">
        @if (session('status') == 'berhasil')
            <div class="alert alert-success text-center" role="alert">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif

        <div class="profile-box card">
            <p>id: {{ session('idLogin') }}</p>
            <p>Name: {{ session('nameLogin') }}</p>
            <p>Email: {{ session('emailLogin') }}</p>

        </div>

        <div class="container mt-5">
            <div class="text-center">
                <h3>Welcome to Notulensi Apps</h3>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                <form action="{{ route('home') }}" method="GET" class="row g-3">
                    <div class="col-auto">
                        <input type="text" name="keyword" class="form-control" placeholder="Search Keywords..."
                            value="{{ $keyword }}">
                    </div>
                    <div class="col-auto">
                        <input type="date" name="date" class="form-control" value="{{ $date }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif

            <br>

            <p class="btn btn-secondary btn-sm">
                <i class="fas fa-eye"></i>
            </p>


            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="">Meeting Title</th>
                        <th class="">Dates</th>
                        <th class="">NoteTaker</th>

                        <th class=""></th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = ($meetings->currentPage() - 1) * $meetings->perPage() + 1;
                    @endphp
                    @foreach ($meetings as $meeting)
                        <!-- Cek apakah  user peserta meeting-->
                        @php
                            // Check if the user is a participant in the current meeting
                            $isParticipant = in_array(auth()->user()->id, $meeting->participants->pluck('id')->toArray());
                        @endphp

                        @if ($isParticipant)
                            <!-- Display meeting information -->
                            <tr>
                                <td class="text-center">{{ $counter++ }}</td>

                                @php
                                    $visited = false; // Inisialisasi variabel visited
                                @endphp

                                @if ($meeting->note_taker == session('idLogin'))
                                    <!-- Note Taker: Finalize, Edit, Read Rejection Message, Hapus -->
                                    <td>
                                        Approval/finalizing <a
                                            href="{{ route('meeting.approval', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}">
                                            {{ $meeting->title }}</a>



                                    </td>
                                    <td>{{ $meeting->date }}</td>
                                    <td>{{ $meeting->note_taker }}</td>

                                    <td>
                                        <form
                                            action="{{ route('meeting.edit', ['id' => $meeting->id, 'idLogin' => $idLogin]) }}"
                                            method="POST">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn btn-secondary btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        @if ($meeting->rejectionMessages->isNotEmpty())
                                            <button type="button" class="modal-button btn btn-light btn-sm"
                                                onclick="openModal('modal1')">
                                                <i class="fa fa-comment"></i> </button>
                                        @endif



                                        <!-- Modal RejMsg -->
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
                                                            @if ($meeting->rejectionMessages)
                                                                @foreach ($meeting->rejectionMessages as $rejectMessage)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $rejectMessage->writer }}</td>
                                                                        <td>{{ $rejectMessage->created_at }}</td>
                                                                        <td>{{ $rejectMessage->message }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="4">Tidak ada pesan penolakan untuk
                                                                        pertemuan
                                                                        ini.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>


                                                    <button type="button" class="close-button"
                                                        onclick="closeModal('modal1')">Close</button>
                                                </div>
                                            </div>
                                        </div>


                                        <script src="{{ asset('js/popUp.js') }}"></script>

                                    </td>
                                    <td>
                                        <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST"
                                            id="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="showConfirmDelete({{ $meeting->id }});">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <script>
                                            function showConfirmDelete(meetingId) {
                                                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                                                    var deleteForm = document.getElementById('deleteForm');
                                                    deleteForm.action = deleteForm.action.replace(/\/\d+$/, '/' + meetingId);
                                                    deleteForm.submit();
                                                }
                                            }
                                        </script>
                                    </td>
                                @else
                                    <!-- Selain Note Taker -->
                                    <td>
                                        @if (isset($userRole[$meeting->id]))
                                            @if ($userRole[$meeting->id] == 'attendee')
                                                Approval <a
                                                    href="{{ route('meeting.approval', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}">
                                                    {{ $meeting->title }}</a>
                                            @else
                                                View<a href="{{ route('meeting.show', $meeting->id) }}">
                                                    {{ $meeting->title }}</a>
                                            @endif
                                        @else
                                            View<a href="{{ route('meeting.show', $meeting->id) }}">
                                                {{ $meeting->title }}</a>
                                            <!-- Tidak ada data peran pengguna, mungkin tampilkan pesan default atau tindakan lainnya -->
                                        @endif
                                        @php
                                            $visited = true; // Set visited menjadi true karena pengguna sudah mengunjungi pertemuan
                                        @endphp

                                    </td>
                                    <td>{{ $meeting->date }}</td>
                                    <td>{{ $meeting->note_taker }}</td>

                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <!--  <td>
                                                                            if ($visited)
                                                                                <i class="btn btn-secondary btn-sm">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </i>
                                                                            endif
                                                                        </td>-->
                                @endif
                            </tr>
                        @endif





                    @endforeach
                </tbody>
            </table>

            <div class="my-5">{{ $meetings->links() }}</div>
            <button type="button" id="add_discussion" class="btn btn-outline-primary float-right btn-sm">
                <a href="{{ route('meeting.add', ['idLogin' => session('idLogin')]) }}">

                    <i class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                    </i> Add The Note
                </a>
            </button>
        </div>
    </div>

    
@endsection
