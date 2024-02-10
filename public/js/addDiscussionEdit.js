

// Menambahkan action secara dinamis dalam setiap diskusi yang telah ada
document.addEventListener("click", function (e) {
    if (e.target && e.target.className == "addAction") {
        e.preventDefault();
        var actionDiv = document.createElement("div");
        actionDiv.className = "action";
        var discussionDiv = e.target.closest(".discussion");
        var discussionIndex = discussionDiv.getAttribute("data-discussion-index");
        var actionsContainer = discussionDiv.querySelector(".actions");
        var actionIndex = actionsContainer.querySelectorAll("input[type='text']").length;

        actionDiv.innerHTML = `
            <table class="table"> 
                <tr>
                    index discussion = ${discussionIndex}
                </tr>
                <tr>
                    <td>
                        <input type="text" name="discussion[${discussionIndex}][actions][${actionIndex}][item]" id="item_${discussionIndex}_${actionIndex}" placeholder="Follow Up Action">
                    </td>
                    <td>
                        <input type="date" name="discussion[${discussionIndex}][actions][${actionIndex}][due]" id="due_${discussionIndex}_${actionIndex}">
                    </td>
                    <td>
                        <select name="discussion[${discussionIndex}][actions][${actionIndex}][pic]" id="pic_${discussionIndex}_${actionIndex}">
                            <option value="0">Select PIC</option> <!-- Placeholder -->
                            ${pesertaTersedia.map(option => `<option value="${option.id}">${option.name}</option>`).join('')}
                        </select>
                    </td>
                </tr>
            </table>
        `;

        actionsContainer.appendChild(actionDiv);
    }
});


// menambahkan discussion baru secara dinamis
document.getElementById("addDiscussion").addEventListener("click", function (e) {
    e.preventDefault();

    // Create a new discussion and increment the index
    var newDiscussionIndex = newDiscussions.length;
    var newDiscussion = {
        discussionIndex: newDiscussionIndex,
        content: "",
        actions: [],
    };

    newDiscussions.push(newDiscussion);

    var discussionDiv = document.createElement("div");
    discussionDiv.className = "discussion";

    discussionDiv.setAttribute("data-discussion-index", newDiscussionIndex);

    discussionDiv.innerHTML = ` 
       <h4>New Discussion ${newDiscussionIndex}</h4>
       <textarea class="form-control" name="newDiscussion[${newDiscussionIndex}][content]"
           placeholder="Please fill before adding Actions"></textarea>
       <button type="button" class="addActionNew" data-discussion-index="${newDiscussionIndex}">
           <i class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i> <i
               class="fa fa-plus fa-stack-1x fa-inverse"></i></i> Tambah Action
       </button>
       <div class="actions"></div>
    `;

    document.getElementById("discussions").appendChild(discussionDiv);
});

// Menambahkan action dinamis untuk newDiscussion
document.addEventListener("click", function (e) {
    if (e.target && e.target.className == "addActionNew") {
        e.preventDefault();
        var discussionIndex = e.target.getAttribute("data-discussion-index");

        console.log("Button clicked for discussionIndex: " + discussionIndex); // Tambahkan ini

        // Create a new action and increment the index
        var newActionIndex = newDiscussions[discussionIndex].actions.length;

        var newAction = {
            item: "",
            due: null, // Default to null
            pic: 0, // Default to 0
        };

        newDiscussions[discussionIndex].actions.push(newAction);

        var actionDiv = document.createElement("div");
        actionDiv.className = "action";

        actionDiv.innerHTML = ` discussion index: ${discussionIndex}
            <input type="text" name="newDiscussion[${discussionIndex}][actions][${newActionIndex}][item]"
                placeholder="Follow Up Action">
            <input type="date" name="newDiscussion[${discussionIndex}][actions][${newActionIndex}][due]">
            <select name="newDiscussion[${discussionIndex}][actions][${newActionIndex}][pic]">
                <option value="0">Select PIC</option>
                ${pesertaTersedia.map(option => `<option value="${option.id}">${option.name}</option>`).join('')}
            </select>
        `;

        e.target.nextElementSibling.appendChild(actionDiv);
    }
});
