// Get the add modal
var modal1 = document.getElementById('add-machine-modal');

// Get the button that opens the add modal
var btn1 = document.getElementById("add-button");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the add modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}

// When the user clicks on <span> (x), close add the modal
span1.onclick = function() {
    modal1.style.display = "none";
}


// Get the remove modal
var modal2 = document.getElementById('remove-machine-modal');

// Get the button that opens the remove modal
var btn2 = document.getElementById("remove-button");

// Get the <span> element that closes the remove modal
var span2 = document.getElementsByClassName("close")[1];

// When the user clicks the button, open the remove modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the remove modal
span2.onclick = function() {
    modal2.style.display = "none";
}


// Get the edit modal
var modal3 = document.getElementById('edit-task-modal');

// Get the button that opens the edit modal
var btn3 = document.getElementById("edit-task-button");

// Get the <span> element that closes the edit modal
var span3 = document.getElementsByClassName("close")[2];

// When the user clicks the button, open the edit modal 
btn3.onclick = function() {
    modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the edit modal
span3.onclick = function() {
    modal3.style.display = "none";
}


