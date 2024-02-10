
// Menangani klik pada tombol "attendance"
document.getElementById('addAttendanceBtn').addEventListener('click', function () {
    console.log("Button clicked!"); // Add this line
    showAttendanceContainer();
});


// Fungsi untuk menampilkan div attendeesContainer
function showAttendanceContainer() {
    // Dapatkan semua checkbox yang dipilih
    var selectedParticipants = document.querySelectorAll('input[name="newParticipants[]"]:checked');

    // Bersihkan div attendeesContainer
    var attendeesContainer = document.getElementById('attendeesContainer');
    attendeesContainer.innerHTML = '';

    // Tambahkan checkbox untuk setiap meeting participant yang dipilih
    selectedParticipants.forEach(function (participant) {
        var participantId = participant.value;
        var participantName = document.querySelector('label[for="newPeserta_' + participantId + '"]').innerText;

        var checkbox = document.createElement('div');
        checkbox.className = 'form-check';
        checkbox.innerHTML = ' <input class="form-check-input" type="checkbox" name="attendanceStatusNewParticipants[]" ' +
            'id="absensi_' + participantId + '" value="' + participantId + '">' +
            '<label class="form-check-label" for="absensi_' + participantId + '">' +
            participantName + '</label>';

 

        attendeesContainer.appendChild(checkbox);
    });

    // Tampilkan div attendeesContainer
    attendeesContainer.style.display = 'block';
}
