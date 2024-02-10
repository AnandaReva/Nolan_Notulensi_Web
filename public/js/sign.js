// Mengambil elemen-elemen yang diperlukan
const canvas = document.getElementById("signature-canvas");

const resetButton = document.getElementById("reset-signature");

const ctx = canvas.getContext("2d");
let isDrawing = false;
let lastX = 0;
let lastY = 0;

// Fungsi untuk menggambar pada canvas
function draw(e) {
    if (!isDrawing) return; // Berhenti jika tidak sedang digambar
    ctx.strokeStyle = "#000"; // Warna garis hitam
    ctx.lineWidth = 2; // Ketebalan garis
    ctx.lineJoin = "round";
    ctx.lineCap = "round";

    // Mulai menggambar dari posisi terakhir
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();

    // Simpan posisi terakhir
    [lastX, lastY] = [e.offsetX, e.offsetY];
}

// Event listener untuk memulai menggambar
canvas.addEventListener("mousedown", (e) => {
    isDrawing = true;
    [lastX, lastY] = [e.offsetX, e.offsetY];
});

// Event listener untuk menggambar saat mouse digerakkan
canvas.addEventListener("mousemove", draw);

// Event listener untuk menghentikan menggambar
canvas.addEventListener("mouseup", () => isDrawing = false);
canvas.addEventListener("mouseout", () => isDrawing = false);



// Event listener untuk tombol Reset
resetButton.addEventListener("click", () => {
    // Membersihkan canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);
});

// Event listener untuk tombol Submit
const submitButton = document.querySelector("#signature-form button[type='submit']");
submitButton.addEventListener("click", (e) => {
    e.preventDefault(); // Mencegah pengiriman formulir otomatis

    // Mengambil gambar dari canvas sebagai data URL (base64)
    const imageDataUrl = canvas.toDataURL("image/png");

    // Mengisi input yang tersembunyi dengan data tanda tangan
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'signatureImage');
    hiddenInput.setAttribute('value', imageDataUrl);
    document.querySelector("#signature-form").appendChild(hiddenInput);

    // Submit formulir
    document.querySelector("#signature-form").submit();
});
