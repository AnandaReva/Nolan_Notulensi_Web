@extends('layouts.mainLayout')

@section('title', 'Meeting')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">

    @if (session('status') == 'berhasil')
        <div class="alert alert-success text-center" role="alert">
            <h4>{{ session('message') }}</h4>
        </div>
    @endif

    {{-- <div class="profile-box card">
        <p>id: {{ session('idLogin') }}</p>
        <p>Name: {{ session('nameLogin') }}</p>
        <p>Email: {{ session('emailLogin') }}</p>

    </div> --}}

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

    <div class="table-responsive w-100 mt-5">
        <table class="table table-bordered align-middle text-center w-100">
            <thead>
                <tr>
                    <th class="col-1">#</th>
                    <th class="col-8">Meeting Title</th>
                    <th class="col-2">Dates</th>
                    <th class="col-1">Actions</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $counter = ($meetings->currentPage() - 1) * $meetings->perPage() + 1;
                @endphp

                {{-- @dump($userRole) --}}

                @foreach ($meetings as $meeting)




                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td class="text-start"><a href="{{ route('meeting.show', $meeting->id) }}">{{ $meeting->title }}</a>
                        </td>
                        <td>{{ $meeting->date }}</td>
                        <td class="d-flex gap-2 justify-content-evenly px-3">
                            {{-- Kalo Dia Note Taker --}}
                            @if ($meeting->note_taker == session('idLogin'))
                                <form action="{{ route('meeting.edit', ['id' => $meeting->id]) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="bg-transparent border-0">
                                        <i class="fa-solid fa-pencil text-success"></i>
                                    </button>
                                </form>

                                {{-- rejection message --}}
                                @if ($meeting->rejectionMessages->isNotEmpty())
                                    <button type="button" class="bg-transparent border-0" onclick="openModal('modal1')">
                                        <i class="fa-regular fa-message text-warning"></i>
                                    </button>
                                @endif


                                <!-- Modal RejMsg -->
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

                                <script src="{{ asset('js/popUp.js') }}"></script>

                                {{-- delete button --}}
                                <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST"
                                    id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-transparent border-0"
                                        onclick="showConfirmDelete({{ $meeting->id }});">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </form>
                                <script>
                                    function showConfirmDelete(meetingId) {
                                        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                                            // Tambahkan ID ke form sebelum mengirimkan
                                            var deleteForm = document.getElementById('deleteForm');
                                            deleteForm.action = deleteForm.action.replace(/\/\d+$/, '/' + meetingId);
                                            deleteForm.submit(); // Lanjutkan dengan mengirimkan form jika dikonfirmasi
                                        }
                                    }
                                </script>




                                {{-- Cek apakah User sebagai Notekaer adalah peserta Hadri (approval) --}}
                                @php
                                    $idLogin = session('idLogin');
                                @endphp

                                @if (in_array('attendee', $userRole) && in_array($idLogin, $meeting->participants->pluck('id')->toArray()))
                                    {{--  Note Taker Attendee Berhak Apporve --}}
                                    <a
                                        href="{{ route('meeting.approval', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}">
                                        <i class="fa-regular text-success fa-lg fa-circle-check"></i>
                                    </a>
                                @endif






                                {{-- Kalo Dia Bukan Note Taker --}}
                            @else
                                @if (isset($userRole[$meeting->id]))
                                    @if ($userRole[$meeting->id] == 'attendee')
                                        {{--   @dump($meeting->id, session('idLogin')) --}}

                                        <a
                                            href="{{ route('meeting.approval', ['id' => $meeting->id, 'idLogin' => session('idLogin')]) }}">
                                            <i class="fa-regular text-success fa-lg fa-circle-check"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('meeting.show', $meeting->id) }}">
                                            <i class="fa-regular text-info fa-lg fa-eye"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('meeting.show', $meeting->id) }}">
                                        <i class="fa-regular text-secondary fa-lg fa-eye"></i>
                                    </a>
                                    <!-- Tidak ada data peran pengguna, mungkin tampilkan pesan default atau tindakan lainnya -->
                                @endif
                            @endif
                        </td>
                    </tr>


                @endforeach
            </tbody>
        </table>
    </div>
    <button type="button" id="add_discussion" class="btn btn-outline-primary d-block p-2 align-self-start mt-5">
        <a href="{{ route('meeting.add', ['idLogin' => session('idLogin')]) }}">
            <i class="fa-solid fa-plus border rounded-circle p-1 me-2"></i>Add The Note
        </a>
    </button>

    <div class="my-5">{{ $meetings->links() }}</div>
@endsection
