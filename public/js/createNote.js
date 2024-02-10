function addAttendees(event, id) {
    event.preventDefault();
    const colomAttendees = document.getElementById("attendees-colom-" + id);
    const colomAbsent = document.getElementById("absent-colom-" + id);
    const selectedParticipants = document.getElementById("user_" + id);
    const selectedParticipantsLabel = document.getElementById("l-user-" + id);

    if (selectedParticipants.checked) {
        const meetingParticipants = selectedParticipants.cloneNode(true);
        meetingParticipants.id = "peserta_" + id;
        meetingParticipants.setAttribute(
            "onchange",
            "switchAttendees(event," + id + ")"
        );
        if (meetingParticipants.name == "newParticipants[]") {
            // ini menyesuaikan dengan yg di controller
            meetingParticipants.setAttribute(
                "name",
                "attendanceStatusNewParticipants[]"
            );
        } else {
            meetingParticipants.setAttribute(
                "name",
                "attendanceParticipants[]"
            );
        }
        const meetingParticipantsLabel =
            selectedParticipantsLabel.cloneNode(true);
        meetingParticipantsLabel.id = "l-mahasiswa-" + id;
        meetingParticipantsLabel.setAttribute("for", `peserta_${id}`);

        colomAttendees.appendChild(meetingParticipants);
        colomAttendees.appendChild(meetingParticipantsLabel);
    } else {
        const attendeesParticipants = document.getElementById("peserta_" + id);
        const attendeesParticipantsLabel = document.getElementById(
            "l-mahasiswa-" + id
        );
        try {
            colomAttendees.removeChild(attendeesParticipants);
            colomAttendees.removeChild(attendeesParticipantsLabel);
        } catch (error) {
            colomAbsent.removeChild(attendeesParticipants);
            colomAbsent.removeChild(attendeesParticipantsLabel);
        }
    }
}

// fungsi pindah attendees
function switchAttendees(event, id) {
    event.preventDefault();
    var checkbox = document.getElementById("peserta_" + id);
    var checkboxLabel = document.getElementById("l-mahasiswa-" + id);
    var colomAttendees = document.getElementById("attendees-colom-" + id);
    var colomAbsent = document.getElementById("absent-colom-" + id);

    if (checkbox.checked) {
        colomAttendees.appendChild(checkbox);
        colomAttendees.appendChild(checkboxLabel);
    } else {
        colomAbsent.appendChild(checkbox);
        colomAbsent.appendChild(checkboxLabel);
    }
}

// fungsi tambah aksi
function addNewAction(event, id) {
    var actionCol = document.getElementById("action-col-" + id);
    let actionIndex = document.querySelectorAll(
        `#action-col-${id} #actions`
    ).length;
    var dueDateCol = document.getElementById("due-date-col-" + id);
    var pic = document.getElementById("pic-" + id);

    var newAction = document.createElement("input");
    newAction.className = "w-100 mb-3";
    newAction.id = "actions";
    newAction.type = "text";

    newAction.setAttribute(
        "name",
        `newDiscussion[${id}][actions][${actionIndex}][item]`
    );

    // newAction.setAttribute("name", "item[" + id + "][]");
    var newDueDate = document.createElement("input");
    newDueDate.className = "mb-3";
    newDueDate.id = "dueDate";
    newDueDate.type = "date";

    newDueDate.setAttribute(
        "name",
        `newDiscussion[${id}][actions][${actionIndex}][due]`
    );

    let newPic = document.createElement("select");
    newPic.id = "pic_0";

    newPic.setAttribute(
        "name",
        `newDiscussion[${id}][actions][${actionIndex}][pic]`
    );

    let option = [];
    option[0] = document.createElement("option");
    option[0].value = "0";
    option[0].textContent = "Select PIC";
    newPic.appendChild(option[0]);

    console.log(pesertaTersedia.length, pesertaTersedia[5]);

    for (let i = 0; i < pesertaTersedia.length; i++) {
        option[i + 1] = document.createElement("option");
        option[i + 1].value = pesertaTersedia[i].id;
        option[i + 1].textContent = pesertaTersedia[i].name;
        newPic.appendChild(option[i + 1]);
    }

    actionCol.appendChild(newAction);
    dueDateCol.appendChild(newDueDate);
    pic.appendChild(newPic);

    event.preventDefault();
}

function addAction(event, id) {
    var actionCol = document.getElementById("action-col-" + id);
    let actionIndex = document.querySelectorAll("actions").length;
    var dueDateCol = document.getElementById("due-date-col-" + id);
    var pic = document.getElementById("pic-" + id);

    var newAction = document.createElement("input");
    newAction.className = "w-100 mb-3";
    newAction.id = "actions";
    newAction.type = "text";

    newAction.setAttribute("name", "item[" + id + "][]");
    // newAction.setAttribute("name", "item[" + id + "][]");
    var newDueDate = document.createElement("input");
    newDueDate.className = "mb-3";
    newDueDate.id = "dueDate";
    newDueDate.type = "date";

    newDueDate.setAttribute("name", "due[" + id + "][]");

    let newPic = document.createElement("select");
    newPic.id = "pic_0";

    newPic.setAttribute("name", "pic[" + id + "][]");

    let option = [];
    option[0] = document.createElement("option");
    option[0].value = "0";
    option[0].textContent = "Select PIC";
    newPic.appendChild(option[0]);

    for (let i = 0; i < pesertaTersedia.length; i++) {
        option[i + 1] = document.createElement("option");
        option[i + 1].value = pesertaTersedia[i].id;
        option[i + 1].textContent = pesertaTersedia[i].name;
        newPic.appendChild(option[i + 1]);
    }

    actionCol.appendChild(newAction);
    dueDateCol.appendChild(newDueDate);
    pic.appendChild(newPic);

    event.preventDefault();
}

// fungsi tambah diskusi

function addRow(event, checkpoint) {
    var container = document.querySelector("#discussion-container tbody");
    let discussionIndex = document.querySelectorAll("#discussion").length;
    let mytable = document.getElementById("discussion-container");

    let newRow = mytable.insertRow();
    let cell1 = newRow.insertCell();
    cell1.textContent = discussionIndex + 1;

    let cell2 = newRow.insertCell();
    cell2.classList.add("text-start", "col-4");
    let inputDiscussion = document.createElement("textarea");
    inputDiscussion.setAttribute("rows", "4");
    inputDiscussion.setAttribute("cols", "30");
    inputDiscussion.classList.add("form-control");
    inputDiscussion.id = "discussion";
    if (checkpoint == "edit") {
        inputDiscussion.name =
            "newDiscussion[" + discussionIndex + "][content]";
    } else {
        inputDiscussion.name = "discussion[]";
    }
    // inputDiscussion.name = "discussion[][content]";
    cell2.appendChild(inputDiscussion);

    let cell3 = newRow.insertCell();
    cell3.classList.add("text-start", "col-4");
    cell3.setAttribute("name", "item[0][]");
    cell3.id = "action-col-" + discussionIndex;

    let cell4 = newRow.insertCell();
    cell4.classList.add("col-1");
    cell4.setAttribute("name", "due[0][]");
    cell4.id = "due-date-col-" + discussionIndex;

    let cell5 = newRow.insertCell();
    cell5.classList.add("col-2");
    let pic = document.createElement("div");
    pic.id = "pic-" + discussionIndex;
    cell5.appendChild(pic);
    let add = document.createElement("button");
    add.classList.add("border-0", "bg-transparent");
    add.id = "add-action";
    if (checkpoint == "edit") {
        add.setAttribute(
            "onclick",
            "addNewAction(event," + discussionIndex + ")"
        );
    } else {
        add.setAttribute("onclick", "addAction(event," + discussionIndex + ")");
    }
    add.innerHTML += `
    <i class="fa-solid fa-plus border border-black rounded-circle p-1"></i>
    `;
    cell5.appendChild(add);

    event.preventDefault();
}

// fungsi untuk upload file
// let inputFiles = document.querySelectorAll('#fileInputs input[type="file"]');
// inputFiles.forEach((inputFile, index) => {
//     console.log(index);
//     inputFile.addEventListener("change", (e) => {
//         let fileName = e.target.files[0].name;
//         showFile(fileName, index);
//     });
// });

// function showFile(fileName, index) {
//     btnDel = document.getElementById("label-btn-del-" + index);
//     const boxfile = document.getElementById("file-name-" + index);
//     btnDel.innerHTML = "";
//     boxfile.innerHTML =
//         `<i class="fa-solid fa-cloud-arrow-up me-2"></i>` + fileName;

//     const delFile = document.createElement("label");
//     delFile.setAttribute("for", "btn-del-" + index);
//     delFile.id = "btn-del-" + index;
//     btnDel.appendChild(delFile);
//     const iconDel = `
//         <i class="fa-solid fa-circle-xmark text-danger fa-lg"></i>
//     `;
//     delFile.innerHTML += iconDel;
// }

// add file
// let index = document.querySelectorAll('#fileInputs input[type="file"]').length;
// let addBtnFile = document.getElementById("addFileInput");
// addBtnFile.addEventListener("click", function () {
//     const fileInput = document.getElementById("fileInputs");

//     let group = document.createElement("div");
//     group.classList.add("form-group");

//     let inputFile = document.createElement("input");
//     inputFile.classList.add("form-control-file");
//     inputFile.id = "file-" + index;
//     inputFile.setAttribute("name", "files[]");
//     inputFile.hidden = true;
//     inputFile.required = true;
//     inputFile.setAttribute(
//         "accept",
//         ".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png"
//     );
//     group.appendChild(inputFile);

//     let hapus = document.createElement("button");
//     hapus.classList.add("removeFileInput", "btn", "btn-danger");
//     hapus.id = "btn-del-" + index;
//     hapus.hidden = true;
//     hapus.textContent = "Hapus File";

//     group.appendChild(hapus);

//     let item = document.createElement("li");
//     item.classList.add(
//         "border",
//         "p-2",
//         "px-3",
//         "my-2",
//         "d-flex",
//         "justify-content-between",
//         "align-items-center"
//     );
//     item.id = "file-item-" + index;

//     group.appendChild(item);

//     let label = document.createElement("label");
//     label.setAttribute("for", "file-" + index);
//     label.classList.add("pointer");
//     label.id = "file-name-" + index;
//     label.innerHTML = `
//         <i class="fa-solid fa-cloud-arrow-up me-2"></i>
//                                 No File Choosen
//     `;

//     item.appendChild(label);

//     let span = document.createElement("span");
//     span.classList.add("pointer");
//     span.id = "label-btn-del-" + index;

//     item.appendChild(span);

//     fileInput.appendChild(group);

//     // fileInput.innerHTML += `
//     //         <div class="form-group">
//     //                     <input type="file" name="files[]" class="form-control-file" id="file-${index}"
//     //                         accept=".pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .jpeg, .jpg, .png" required hidden>
//     //                     <button type="button" class="removeFileInput btn btn-danger" id="btn-del-${index}" hidden>Hapus
//     //                         File</button>
//     //                     <li class="border p-2 px-3 my-2 d-flex justify-content-between align-items-center"
//     //                         id="file-item-${index}">
//     //                         <label for="file-${index}" class="pointer" id="file-name-${index}">
//     //                             <i class="fa-solid fa-cloud-arrow-up me-2"></i>
//     //                             No File Choosen
//     //                         </label>
//     //                         <span class="pointer" id="label-btn-del-${index}"></span>
//     //                     </li>
//     //                 </div>
//     //     `;
// });

// document.addEventListener("click", function (event) {
//     if (
//         event.target &&
//         event.target.className === "removeFileInput btn btn-danger"
//     ) {
//         event.target.parentElement.remove();
//     }
// });
