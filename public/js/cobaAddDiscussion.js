// JavaScript to handle dynamic actions
document.getElementById("addDiscussion").addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah pengiriman formulir utama
    var discussionDiv = document.createElement("div");
    discussionDiv.className = "discussion";
    var discussionIndex = document.querySelectorAll(".discussion").length;

    discussionDiv.innerHTML = `
        <textarea class="form-control" rows="4" type="text" name="discussion[]"> </textarea>
        <button type="button" class="addAction" value="Add Action"
            data-discussion-index="${discussionIndex}"
            class="btn btn-outline-secondary btn-sm float-right btn-sm add-action">
            <i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i> <i
                    class="fa fa-plus fa-stack-1x fa-inverse"></i></i> Tambah Action
        </button>
        <div class="actions">
            <div class="action">
                <table class="table">
                    <tr>
                        <th>Follow Up Action:</th>
                        <th>Due Date:</th>
                        <th>PIC:</th>
                        <th>Action</th>
                    </tr>
                    <td>
                        <input type="text" name="item[${discussionIndex}][]" id="item_${discussionIndex}"
                            placeholder="Follow Up Action">
                    </td>
                    <td>
                        <input type="date" name="due[${discussionIndex}][]" id="due_${discussionIndex}">
                    </td>
                    <td>
                        <select name="pic[${discussionIndex}][]" id="pic_${discussionIndex}">
                            <option value="0">Select PIC</option> <!-- Placeholder -->
                            ${pesertaTersedia.map(option => `<option value="${option.id}">${option.name}</option>`).join('')}
                        </select>
                    </td>
                    <tr>
                    </tr>
                </table>
            </div>
            <button type="button" class="removeDiscussion btn btn-danger" data-discussion-index="${discussionIndex}">
                Hapus Discussion
            </button>
        </div>
    `;

    document.getElementById("discussions").appendChild(discussionDiv);

    // Tambahkan event listener untuk menghapus discussion
    addRemoveDiscussionListener(discussionIndex);
});

// Fungsi untuk menghapus discussion
function removeDiscussion(discussionIndex) {
    var discussionContainer = document.getElementById("discussions");
    var discussions = discussionContainer.querySelectorAll(".discussion");
    if (discussionIndex >= 0 && discussionIndex < discussions.length) {
        discussionContainer.removeChild(discussions[discussionIndex]);
    }
}

// Event listener untuk tombol "Hapus Discussion"
function addRemoveDiscussionListener(discussionIndex) {
    var removeDiscussionButtons = document.querySelectorAll(".removeDiscussion");
    var removeDiscussionButton = removeDiscussionButtons[removeDiscussionButtons.length - 1];
    removeDiscussionButton.addEventListener("click", function () {
        removeDiscussion(discussionIndex);
    });
}

// Add action dynamically within each discussion
document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("addAction")) {
        e.preventDefault();
        var actionDiv = document.createElement("div");
        actionDiv.className = "action";
        var discussionIndex = e.target.getAttribute("data-discussion-index");

        actionDiv.innerHTML = `
        <table class="table">
               <tr>

               </tr>

               <tr>
                 <td>
                    <input type="text" name="item[${discussionIndex}][]" id="item_${discussionIndex}" placeholder="Follow Up Action">
                 </td>
                 <td>
                 <input type="date" name "due[${discussionIndex}][]" id="due_${discussionIndex}">
                 </td>
                 <td>
                 <select name="pic[${discussionIndex}][]" id="pic_${discussionIndex}">
                    <option value="0">Select PIC</option> <!-- Placeholder -->
                     ${pesertaTersedia.map(option => `<option value="${option.id}">${option.name}</option>`).join('')}
                   </select>
                   </td>
               </tr>
        </table>
        `;

        e.target.parentNode.querySelector(".actions").appendChild(actionDiv);

        // Tambahkan event listener untuk menghapus action
        addRemoveActionListener(discussionIndex);
    }
});

// Fungsi untuk menghapus action di dalam discussion
function removeAction(discussionIndex, actionIndex) {
    var discussion = document.querySelectorAll(".discussion")[discussionIndex];
    var actions = discussion.querySelectorAll(".action");
    if (actionIndex >= 0 && actionIndex < actions.length) {
        discussion.querySelector(".actions").removeChild(actions[actionIndex]);
    }
}

// Event listener untuk tombol "Hapus Action"
function addRemoveActionListener(discussionIndex) {
    var removeActionButtons = document.querySelectorAll(".removeAction");
    var removeActionButton = removeActionButtons[removeActionButtons.length - 1];
    removeActionButton.addEventListener("click", function () {
        removeAction(discussionIndex, discussionIndex);
    });
}


// Fungsi untuk menghapus diskusi
function removeDiscussion(discussionIndex) {
    var discussionContainer = document.getElementById("discussions");
    var discussions = discussionContainer.querySelectorAll(".discussion");
    if (discussionIndex >= 0 && discussionIndex < discussions.length) {
        discussionContainer.removeChild(discussions[discussionIndex]);
    }
}

// Fungsi untuk menghapus aksi di dalam diskusi
function removeAction(discussionIndex, actionIndex) {
    var discussion = document.querySelectorAll(".discussion")[discussionIndex];
    var actions = discussion.querySelectorAll(".action");
    if (actionIndex >= 0 && actionIndex < actions.length) {
        discussion.querySelector(".actions").removeChild(actions[actionIndex]);
    }
}

// Mendengarkan klik pada tombol "Hapus Discussion"
document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("removeDiscussion")) {
        var discussionIndex = e.target.getAttribute("data-discussion-index");
        removeDiscussion(discussionIndex);
    }
});

// Mendengarkan klik pada tombol "Hapus Action"
document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("removeAction")) {
        var discussionIndex = e.target.getAttribute("data-discussion-index");
        var actionIndex = e.target.getAttribute("data-action-index");
        removeAction(discussionIndex, actionIndex);
    }
});
