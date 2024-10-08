let uniqueMachineNames = [];
let machineNames = [];
let randomisedData = [];
let powerConsumption = 0;
let productionCount = 0;
let averageTemperature = 0;
let averageSpeed = 0;
let options = "";
let modal = document.getElementById("myModal");
let span = document.getElementsByClassName("close")[0];


if(!document.getElementById("machines")) {
    console.log(rawFactoryData);
    var numMachines = Object.keys(rawFactoryData).length;
    getMachineNames();
}

if(document.getElementById("stats")){
    console.log(document.getElementById("temperature-slider").checked)
    console.log("local storage: " + localStorage.getItem("temperature"))

    if(localStorage.getItem("temperature") == "F"){
        document.getElementById("temperature-slider").checked = true;

    }else{
        document.getElementById("temperature-slider").checked = false;
    }

    document.getElementById("temperature-slider").addEventListener('change', function() {
        if (document.getElementById("temperature-slider").checked){
            console.log('Slider is ON');
            localStorage.setItem("temperature", "F")
            displayRandomisedData();
        }else {
            console.log('Slider is OFF');
            localStorage.setItem("temperature", "C")
            displayRandomisedData();
        }
    });

    randomiseData();
    displayRandomisedData();

    setInterval(newRandomData, 6000);
}




if(document.getElementById("machines")){

    let machineList = document.getElementById("machine-list");
    let machineContainers = document.getElementsByClassName("machine-container");
    let currentPage = document.getElementById("current-page");
    let prevPage = document.getElementById("prev-page");
    let nextPage = document.getElementById("next-page");

    let machineDetails = document.getElementById("machine-details");
    let returnButton = document.getElementById("return-button");

    let pageId = 0;
    let maxPageId = Math.max(0, Math.floor((machines.length - 1) / 10));


    function updateList() {
        console.log(machines);
        for (var i = 0; i < machineContainers.length; i++) {
            let machineContainer = machineContainers[i];
            let machineName = machineContainer.querySelector(".machine-name");
            let machineImage = machineContainer.querySelector(".machine-image");
            let machineStatus = machineContainer.querySelector(".machine-status");
            let machineOperator = machineContainer.querySelector(".machine-operator");
            
            let machine = machines[pageId * 10 + i];
            if (machine) {
                console.log(machine["name"]);
                machineName.textContent = machine["name"];
                machineImage.src = "../Style/Images/Machines/" + machine["img_address"];
                machineStatus.textContent = "Status: " + machine["operational_status"];
                machineOperator.textContent = machine["operator_name"] ? "Operator: " + machine["operator_name"] : "";
                machineContainer.style.visibility = "visible";
            } else {
                machineContainer.style.visibility = "hidden";
            }
        }
    }

    function displayMachineInfo(index) {
        let machine = machines[pageId * 10 + index];
        console.log(machine["name"]);
        machineDetails.querySelector(".machine-content").textContent = machine["name"];
        machineList.style.display = "none";
        machineDetails.style.display = "block";
    }

    for (var i = 0; i < machineContainers.length; i++) {
        let buttonId = i;
        machineContainers[i].addEventListener("click", () => displayMachineInfo(buttonId));
    }

    prevPage.addEventListener("click", () => {
        if (pageId > 0) pageId--;
        currentPage.textContent = pageId + 1;
        updateList();
    });

    nextPage.addEventListener("click", () => {
        if (pageId < maxPageId) pageId++;
        currentPage.textContent = pageId + 1;
        updateList();
    });


    returnButton.addEventListener("click", () => {
        machineDetails.style.display = "none";
        machineList.style.display = "block";
    });

    updateList();
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

    if(error == "blank_form"){

        modal.style.display = "block";
        document.getElementById("error-message").innerHTML = "To send a message, fill out the form fields"

    }else if(error == "empty_note"){
        
        modal.style.display = "block";
        document.getElementById("error-message").innerHTML = "Message required"
    
    }else if(error == "no_users"){

        modal.style.display = "block";
        document.getElementById("error-message").innerHTML = "Select a user"
    }



    span.onclick = function() {
        modal.style.display = "none";
    }
    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            //location.replace(window.location.pathname);
            history.replaceState(null, '', window.location.pathname);
        }
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
    document.getElementById("average-speed").innerHTML = averageSpeed;
    
    
    let chartPowerConsumption = Math.round(powerConsumption / (500 * machineNames.length) * 100);
    let chartProductionCount = Math.round(productionCount / (100 * machineNames.length) * 100);
    let chartAverageSpeed = Math.round(averageSpeed / (0.25 * machineNames.length) * 100);

    if(document.getElementById("temperature-slider").checked){
        document.getElementById("average-temperature").innerHTML = Math.round(averageTemperature * (9/5) + 32) +"&deg;F";
        let chartAverageTemperature = Math.round(averageTemperature / (10 * machineNames.length) * 100);
        chartAverageTemperature = chartAverageTemperature;
        console.log(chartAverageTemperature);
        document.getElementById("average-temperature-chart").setAttribute("stroke-dasharray", `${chartAverageTemperature} ${(100)}`);
    
    }else{
        document.getElementById("average-temperature").innerHTML = averageTemperature + "&deg;C";
        let chartAverageTemperature = Math.round(averageTemperature / (10 * machineNames.length) * 100);
        document.getElementById("average-temperature-chart").setAttribute("stroke-dasharray", `${chartAverageTemperature} ${(100)}`);
    }
    
    
    document.getElementById("power-consumption-chart").setAttribute("stroke-dasharray", `${chartPowerConsumption} ${(100)}`);
    document.getElementById("production-count-chart").setAttribute("stroke-dasharray", `${chartProductionCount} ${(100)}`);
    document.getElementById("average-speed-chart").setAttribute("stroke-dasharray", `${chartAverageSpeed} ${(100)}`);
}

function displayMachineChecklist(i, id){
    id += 1;
    options += 
    
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

