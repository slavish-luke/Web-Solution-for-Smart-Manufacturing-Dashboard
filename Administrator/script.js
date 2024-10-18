console.log(rawFactoryData);


function openEditDialog(id, username, password, name, email, role, notes) {
    document.getElementById('userId').value = id;
    document.getElementById('username').value = username;
    document.getElementById('password').value = password;
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

let machineNames = [];
let randomisedData = [];
let powerConsumption = 0;
let productionCount = 0;
let averageSpeed = 0;
console.log(rawFactoryData);
let numMachines = Object.keys(rawFactoryData).length;


if(document.getElementById("stats-container")){

    getMachineNames();
    newRandomData();
    setInterval(newRandomData, 6000);
}


function newRandomData() {
    randomiseData();
    displayRandomisedData();
    console.log(rawFactoryData)
}

function getMachineNames() {
    for (let i = 1; i <= numMachines; i++) {
        machineNames.push(rawFactoryData[i].machine_name);
    }
}

function randomiseData() {
    randomisedData = [];
    for (let i = 1; i <= numMachines; i++) {
        randomisedData.push(rawFactoryData[i]['logs'][Math.floor(Math.random() * rawFactoryData[i]['logs'].length)]);
    }
    console.log(randomisedData);
}

function displayRandomisedData() {
    powerConsumption = 0;
    productionCount = 0;
    averageTemperature = 0;
    averageSpeed = 0;

    for (let i = 0; i < randomisedData.length; i++) {
        powerConsumption += parseFloat(randomisedData[i]['power_consumption']);
        productionCount += parseFloat(randomisedData[i]['production_count']);
        averageTemperature += parseFloat(randomisedData[i]['temperature']);
        averageSpeed += randomisedData[i]['speed'] ? parseFloat(randomisedData[i]['speed']) : 0;
    }

    powerConsumption = Math.ceil(powerConsumption);
    productionCount = Math.ceil(productionCount);
    averageTemperature = (averageTemperature/machineNames.length).toFixed(1);
    averageSpeed = (averageSpeed / machineNames.length).toFixed(2);

    document.getElementById("power-consumption").innerHTML = powerConsumption;
    document.getElementById("production-count").innerHTML = productionCount;
    document.getElementById("average-speed").innerHTML = averageSpeed;

    let chartPowerConsumption = Math.round(powerConsumption / (500 * machineNames.length) * 100);
    let chartProductionCount = Math.round(productionCount / (100 * machineNames.length) * 100);
    let chartAverageSpeed = Math.round(averageSpeed / (0.25 * machineNames.length) * 100);

    document.getElementById("average-temperature").innerHTML = averageTemperature + "&deg;C";
    let chartAverageTemperature = Math.round(averageTemperature / (10 * machineNames.length) * 100);
    document.getElementById("average-temperature-chart").setAttribute("stroke-dasharray", `${chartAverageTemperature} ${(100)}`);

    document.getElementById("power-consumption-chart").setAttribute("stroke-dasharray", `${chartPowerConsumption} 100`);
    document.getElementById("production-count-chart").setAttribute("stroke-dasharray", `${chartProductionCount} 100`);
    document.getElementById("average-speed-chart").setAttribute("stroke-dasharray", `${chartAverageSpeed} 100`);
}


