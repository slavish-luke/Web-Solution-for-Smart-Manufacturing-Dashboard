// Get the modal
var modal1 = document.getElementById('add-machine-modal');

// Get the button that opens the modal
var btn1 = document.getElementById("add-button");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}


// Get the second modal
var modal2 = document.getElementById('remove-machine-modal');

// Get the button that opens the modal
var btn2 = document.getElementById("remove-button");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[1];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}

let machineNames = [];
let randomisedData = [];
let powerConsumption = 0;
let productionCount = 0;
let averageSpeed = 0;

console.log(rawFactoryData);
let numMachines = Object.keys(rawFactoryData).length;
getMachineNames();

function newRandomData() {
    randomiseData();
    displayRandomisedData();
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
    averageSpeed = 0;

    for (let i = 0; i < randomisedData.length; i++) {
        powerConsumption += parseFloat(randomisedData[i]['power_consumption']);
        productionCount += parseFloat(randomisedData[i]['production_count']);
        averageSpeed += randomisedData[i]['speed'] ? parseFloat(randomisedData[i]['speed']) : 0;
    }

    powerConsumption = Math.ceil(powerConsumption);
    productionCount = Math.ceil(productionCount);
    averageSpeed = (averageSpeed / machineNames.length).toFixed(2);

    document.getElementById("power-consumption").innerHTML = powerConsumption;
    document.getElementById("production-count").innerHTML = productionCount;
    document.getElementById("average-speed").innerHTML = averageSpeed;

    let chartPowerConsumption = Math.round(powerConsumption / (500 * machineNames.length) * 100);
    let chartProductionCount = Math.round(productionCount / (100 * machineNames.length) * 100);
    let chartAverageSpeed = Math.round(averageSpeed / (0.25 * machineNames.length) * 100);

    document.getElementById("power-consumption-chart").setAttribute("stroke-dasharray", `${chartPowerConsumption} 100`);
    document.getElementById("production-count-chart").setAttribute("stroke-dasharray", `${chartProductionCount} 100`);
    document.getElementById("average-speed-chart").setAttribute("stroke-dasharray", `${chartAverageSpeed} 100`);
}
