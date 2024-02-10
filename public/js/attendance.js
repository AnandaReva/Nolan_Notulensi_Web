document.addEventListener("DOMContentLoaded", function() {
    const noteTakerSelect = document.getElementById("note_taker");
    const inisiatorSelect = document.getElementById("inisiator");
    const participantCheckboxes = document.querySelectorAll('input[name="participants[]"]');

    function updateParticipantCheckboxes() {
        const selectedNoteTakerValue = noteTakerSelect.value;
        const selectedInisiatorValue = inisiatorSelect.value;

        participantCheckboxes.forEach(function(checkbox) {
            const pesertaValue = checkbox.value;
            const shouldCheck = pesertaValue === selectedNoteTakerValue || pesertaValue ===
                selectedInisiatorValue;
            checkbox.checked = shouldCheck;
        });
    }

    noteTakerSelect.addEventListener("change", updateParticipantCheckboxes);
    inisiatorSelect.addEventListener("change", updateParticipantCheckboxes);

    // Panggil fungsi sekali saat halaman dimuat untuk mengatur kondisi awal
    updateParticipantCheckboxes();
});