function openEditDialog(id, username, name, email, role, notes) {
    document.getElementById('userId').value = id;
    document.getElementById('username').value = username;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    const roles = {
        "Administrator": 1,
        "Auditor": 2,
        "Factory Manager": 3,
        "Production Operator": 4
    };
    const roleId = roles[role] || null;
    document.getElementById('role').value = roleId;
    document.getElementById('notes').value = notes;
    document.getElementById("editUserForm").action = "admin-user-update.php";
    document.getElementById("dialogTitle").innerText = "Edit User";
    document.getElementById("submitButton").value = "Update User";
    document.getElementById("deleteButton").style.display = "block";
    document.getElementById("editUserDialog").style.display = 'block';
}

function setAction(action) {
    document.getElementById("formAction").value = action;
}

function deleteUser() {
    if (confirm('Are you sure you want to delete this user?')) {
        document.getElementById("formAction").value = 'Delete User';
        document.getElementById("editUserForm").submit();
    }
}

function closeEditDialog() {
    document.getElementById('editUserDialog').style.display = 'none';
}
window.onclick = function(event) {
    var modal = document.getElementById('editUserDialog');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openAddUserDialog() {
    document.getElementById("editUserForm").reset();
    document.getElementById("userId").value = '';
    document.getElementById("editUserForm").action = "admin-user-add.php";
    document.getElementById("dialogTitle").innerText = "Add New User";
    document.getElementById("submitButton").value = "Add New User";
    document.getElementById("deleteButton").style.display = "none";
    document.getElementById("editUserDialog").style.display = "block";
}
