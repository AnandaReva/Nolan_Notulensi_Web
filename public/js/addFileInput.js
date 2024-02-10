// let index = document.querySelectorAll('#fileInputs input[type="file"]').length;
// document.getElementById("addFileInput").addEventListener("click", function () {
//     const fileInput = document.getElementById("fileInputs");
//     fileInput.innerHTML += `
//             <div class="form-group">
//                         <input type="file" name="files[]" class="form-control-file" id="file-${index}"
//                             accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" required hidden>
//                         <button type="button" class="removeFileInput btn btn-danger" id="btn-del-${index}" hidden>Hapus
//                             File</button>
//                         <li class="border p-2 px-3 my-2 d-flex justify-content-between align-items-center"
//                             id="file-item-${index}">
//                             <label for="file-${index}" class="pointer" id="file-name-${index}">
//                                 <i class="fa-solid fa-cloud-arrow-up me-2"></i>
//                                 No File Choosen
//                             </label>
//                             <span class="pointer" id="label-btn-del-${index}"></span>
//                         </li>
//                     </div>
//         `;
// });

document.getElementById("addFileInput").addEventListener("click", function () {
    const fileInput = document.createElement("div");
    fileInput.innerHTML = `
            <div class="form-group">

                <input type="file" name="files[]" class="form-control-file" accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" multiple required>
                <button type="button" class="removeFileInput btn btn-danger my-2" style="height: 2.5rem;">Hapus File</button>
            </div>
        `;
    document.getElementById("fileInputs").appendChild(fileInput);
});

document.addEventListener("click", function (event) {
    if (
        event.target &&
        event.target.className === "removeFileInput btn btn-danger my-2"
    ) {
        event.target.parentElement.remove();
    }
});

// fungsi untuk menghapus file di edit page
function deleteFile(event, id) {
    event.preventDefault();
    const delFileBtn = document.getElementById("delete-file-" + id);
    const file = document.getElementById("file-" + id);
    file.checked = true;
    delFileBtn.parentElement.remove();
}
