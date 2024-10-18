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
