function openEditDialog(id, username, name, email, role) {
    document.getElementById('userId').value = id;
    document.getElementById('username').value = username;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('role').value = role;
    document.getElementById('editUserDialog').style.display = 'block';
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