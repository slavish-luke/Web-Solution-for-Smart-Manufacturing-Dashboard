let uniqueMachineNames = [];
let machineNames = [];
let randomisedData = [];
let powerConsumption = 0;
let productionCount = 0;
let averageTemperature = 0;
let averageSpeed = 0;
let options = "";


console.log(rawFactoryData);
let numMachines = Object.keys(rawFactoryData).length;
getMachineNames();

if(document.getElementById("stats")){
    randomiseData();
    displayRandomisedData();

    setInterval(newRandomData, 6000);
}

if(document.getElementById("notes")){
    console.log(machineNames);
    options = "<h1>Machines</h1>"
    machineNames.forEach(displayMachineChecklist);
    document.getElementById("checklist-container").innerHTML = options;


    options = "<h1>Users</h1>"
    console.log(productionOperators)
    productionOperators.forEach(displayUserChecklist);
    document.getElementById("user-container").innerHTML = options;


    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    let error = urlParams.get("error")
    console.log(error);

    if(error == "empty_note"){
        alert("Note supplied was empty");
        location.replace(window.location.pathname);
    }
}



function newRandomData(){
    randomiseData();
    displayRandomisedData();
}

function getMachineNames(){
    
    for(let i=1; i<=numMachines; i++){
        machineNames.push(rawFactoryData[i].machine_name);
    }
    // console.log(machineNames);
    // uniqueMachineNames = [...new Set(machineNames)];
    // console.log(uniqueMachineNames);
}

function displayMachines(){
    let displayMachines = "<ul>";
    for(let i=0; i<machineNames.length; i++){
        displayMachines += "<li>" + machineNames[i] + "</li>";
    }
    displayMachines += "</ul>";
    console.log(displayMachines)
    
    
    //document.getElementById("machine_names").innerHTML = displayMachines;
}


function randomiseData(){
    randomisedData = [];

    for(let i=1; i<=numMachines; i++){
        randomisedData.push(rawFactoryData[i]['logs'][Math.floor(Math.random() * rawFactoryData[i]['logs'].length)])
    }
    console.log(randomisedData)
}

function displayRandomisedData(){
    powerConsumption = 0;
    productionCount = 0;
    averageTemperature = 0;
    averageSpeed = 0;

    for(let i=0; i<randomisedData.length; i++){
        powerConsumption += parseFloat(randomisedData[i]['power_consumption']);
        productionCount += parseFloat(randomisedData[i]['production_count']);
        averageTemperature += parseFloat(randomisedData[i]['temperature']);
        
        if(randomisedData[i]['speed'] == null){
            averageSpeed += 0;
        }else{
            averageSpeed += (parseFloat(randomisedData[i]['speed']));
        }
    }
    powerConsumption = Math.ceil(powerConsumption);
    productionCount = Math.ceil(productionCount);
    averageTemperature = (averageTemperature/machineNames.length).toFixed(1);
    averageSpeed = (averageSpeed/machineNames.length).toFixed(2);
    
    
    
    document.getElementById("power-consumption").innerHTML = powerConsumption;
    document.getElementById("production-count").innerHTML = productionCount;
    document.getElementById("average-temperature").innerHTML = averageTemperature;
    document.getElementById("average-speed").innerHTML = averageSpeed;
    
    
    let chartPowerConsumption = Math.round(powerConsumption / (500 * machineNames.length) * 100);
    let chartProductionCount = Math.round(productionCount / (100 * machineNames.length) * 100);
    let chartAverageTemperature = Math.round(averageTemperature / (10 * machineNames.length) * 100);
    let chartAverageSpeed = Math.round(averageSpeed / (0.25 * machineNames.length) * 100);
    
    document.getElementById("power-consumption-chart").setAttribute("stroke-dasharray", `${chartPowerConsumption} ${(100)}`);
    document.getElementById("production-count-chart").setAttribute("stroke-dasharray", `${chartProductionCount} ${(100)}`);
    document.getElementById("average-temperature-chart").setAttribute("stroke-dasharray", `${chartAverageTemperature} ${(100)}`);
    document.getElementById("average-speed-chart").setAttribute("stroke-dasharray", `${chartAverageSpeed} ${(100)}`);
}

function displayMachineChecklist(i, id){
    id += 1;
    options += 
    // `
    //     <label class="checkboxes">
    //         <input type="checkbox">
    //         <span class="${id}">${i}</span></label>
    // `
    
    `
        <label class="checkboxes">
            <input type="checkbox" name="machines[]" value="${id}">
            <span class="${id}">${i}</span>
        </label>
    `
}

function displayUserChecklist(i){
    options += 
    `
        <label class="checkboxes">
            <input type="checkbox" name="users[]" value="${i.id}">
            <span class="${i.id}">${i.username}</span>
        </label>
    `
}