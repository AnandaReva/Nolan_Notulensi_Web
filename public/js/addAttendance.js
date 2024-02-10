document.addEventListener('DOMContentLoaded', function () {
    // Menangani klik pada tombol "attendance"
    document.getElementById('addAttendanceBtn').addEventListener('click', function () {
        showAttendanceContainer();
    });

    // Fungsi untuk menampilkan div attendeesContainer
    function showAttendanceContainer() {
        // Dapatkan semua checkbox yang dipilih
        var selectedParticipants = document.querySelectorAll('input[name="meetingParticipants[]"]:checked');

        // Bersihkan div attendeesContainer
        var attendeesContainer = document.getElementById('attendeesContainer');
        attendeesContainer.innerHTML = '';

        // Tambahkan checkbox untuk setiap meeting participant yang dipilih
        selectedParticipants.forEach(function (participant) {
            var participantId = participant.value;
            var participantName = document.querySelector('label[for="peserta_' + participantId + '"]').innerText;

            var checkbox = document.createElement('div');
            checkbox.className = 'form-check';
            checkbox.innerHTML = '<input class="form-check-input" type="checkbox" name="attendanceParticipants[]" ' +
                'id="hadir_' + participantId + '" value="' + participantId + '">';
            checkbox.innerHTML += '<label class="form-check-label" for="hadir_' + participantId + '">' +
                participantName + '</label>';

            attendeesContainer.appendChild(checkbox);
        });

        // Tampilkan div attendeesContainer
        attendeesContainer.style.display = 'block';
    }
});