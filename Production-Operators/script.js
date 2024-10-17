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


if(document.getElementById("home-container")){
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

    if(localStorage.getItem("flashing-warning") == "true"){
        document.getElementById("flashing-warning").checked = true;

    }else if(localStorage.getItem("flashing-warning") == "false"){
        document.getElementById("flashing-warning").checked = false;
    
    }else{
        document.getElementById("flashing-warning").checked = true;
    }


    document.getElementById("temperature-slider").addEventListener('change', function() {
        if (document.getElementById("temperature-slider").checked){
            console.log('Slider is ON');
            localStorage.setItem("temperature", "F");
            displayRandomisedData();
        }else {
            console.log('Slider is OFF');
            localStorage.setItem("temperature", "C");
            displayRandomisedData();
        }
    });

    document.getElementById("flashing-warning").addEventListener('change', function() {
        if (document.getElementById("flashing-warning").checked){
            console.log('Slider is ON');
            localStorage.setItem("flashing-warning", "true");
        }else {
            console.log('Slider is OFF');
            localStorage.setItem("flashing-warning", "false");
        }
    });


    randomiseData();
    displayRandomisedData();

    setInterval(newRandomData, 6000);

    document.getElementById("settings-dropdown").addEventListener('toggle', function(){
        console.log(document.getElementById("settings-dropdown").open)
        if(document.getElementById("settings-dropdown").open){
            console.log(document.getElementById("user-icon"))
            console.log(document.getElementById("user-icon").src)
            document.getElementById("user-icon").src = "../Style/Images/settings-cog.svg"
            document.getElementById("settings-icon").style.visibility = "hidden";
        
        }else{
            document.getElementById("user-icon").src = "../Style/Images/user-solid.svg"
            document.getElementById("settings-icon").style.visibility = "visible";
        }
    });


    console.log(tasks)
    console.log(machines)
    let machinesAssigned = [];
    let machinesOperational = 0;
    let machinesMaintenance = 0;
    let machinesOutOfOrder = 0;

    for(let i=0; i<tasks.length; i++){
        machinesAssigned.push(tasks[i]['machine_id'])
    }
    machinesAssigned = [...new Set(machinesAssigned)];
    
    for(let i=0; i<machines.length; i++){
        if(machines[i]['operational_status'] == "active"){
            machinesOperational++;
        
        }else if(machines[i]['operational_status'] == "maintenance"){
            machinesMaintenance++;

        }else{
            machinesOutOfOrder++;
        }
    }
    
    document.getElementById("assigned").innerHTML = machinesAssigned.length;
    document.getElementById("operational").innerHTML = machinesOperational;
    document.getElementById("maintenance").innerHTML = machinesMaintenance;
    document.getElementById("out-of-order").innerHTML = machinesOutOfOrder;
    document.getElementById("num-jobs").innerHTML = tasks.length;
}




if(document.getElementById("machines")){
    let machineList = document.getElementById("machine-list");
    let machineContainers = document.getElementsByClassName("machine-container");
    let currentPage = document.getElementById("current-page");
    let prevPage = document.getElementById("prev-page");
    let nextPage = document.getElementById("next-page");

    let pageId = 0;
    let machinesPerPage = machineContainers.length;
    let maxPageId = Math.max(0, Math.floor((machines.length - 1) / machinesPerPage));


    function updateList() {
        console.log(machines);
        for (var i = 0; i < machinesPerPage; i++) {
            let machineContainer = machineContainers[i];
            let machineName = machineContainer.querySelector(".machine-name");
            let machineImage = machineContainer.querySelector(".machine-image");
            let machineStatus = machineContainer.querySelector(".machine-status");
            let machineOperator = machineContainer.querySelector(".machine-operator");
            
            let machine = machines[pageId * machinesPerPage + i];
            if (machine) {
                // Display machine name
                machineName.textContent = machine["name"];

                // Display machine image
                machineImage.src = machine["img_address"];

                // Display machine status with icon
                machineStatus.querySelector("span").textContent = machine["operational_status"];
                machineStatus.querySelector("img").src = "../Style/Images/" + machine["operational_status"] + ".svg";

                // Display or hide machine operator
                if (machine["operator_name"]) {
                    machineOperator.querySelector("span").textContent = machine["operator_name"];
                    machineOperator.visibility = "visible";
                } else machineOperator.style.visibility = "hidden";

                machineContainer.style.visibility = "visible";
            } else machineContainer.style.visibility = "hidden";
        }
    }

    let machineDetails = document.getElementById("machine-details");
    // let machineDisplay = machineDetails.getElementById("machine-display");
    // let machineStats = machineDetails.getElementById("machine-stats");
    let returnButton = document.getElementById("return-button");

    function displayStat(id, value) {
        document.getElementById(id).textContent = value ? value : "N/A";
    }

    function displayMachineInfo(index) {
        let machine = machines[pageId * 8 + index];
        console.log(machine["name"]);
        document.getElementById("machine-name").textContent = machine["name"];
        document.getElementById("machine-image").src = machine["img_address"];

        displayStat("machine-status", machine["operational_status"]);
        displayStat("machine-error-code", machine["error_code"]);
        displayStat("machine-log", machine["maintenance_log"]);
        displayStat("machine-operator", machine["operator_name"]);
        displayStat("machine-temp", machine["temperature"]);
        displayStat("machine-pressure", machine["pressure"]);
        displayStat("machine-vibration", machine["vibration"]);
        displayStat("machine-humidity", machine["humidity"]);
        displayStat("machine-power", machine["power"]);
        displayStat("machine-count", machine["production_count"]);
        displayStat("machine-speed", machine["speed"]);

        machineList.style.display = "none";
        machineDetails.style.display = "block";
    }

    for (var i = 0; i < machinesPerPage; i++) {
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

if(document.getElementById("jobs")) {
    let jobContainers = document.getElementsByClassName("job-container");
    let currentPage = document.getElementById("current-page");
    let prevPage = document.getElementById("prev-page");
    let nextPage = document.getElementById("next-page");


    let pageId = 0;
    let jobsPerPage = jobContainers.length;
    let maxPageId = Math.max(0, Math.floor((tasks.length - 1) / jobsPerPage));


    function updateList() {
        console.log(jobs);
        for (var i = 0; i < jobsPerPage; i++) {
            let jobContainer = jobContainers[i];
            let jobDesc = jobContainer.querySelector(".job-description");
            let machineName = jobContainer.querySelector(".job-machine");
            
            let task = tasks[pageId * jobsPerPage + i];
            if (task) {
                // Display task description
                jobDesc.textContent = task["job_desc"];

                // Display machine name
                machineName.textContent = task["machine_name"];

                jobContainer.style.visibility = "visible";
            } else jobContainer.style.visibility = "hidden";
        }
    }

    // function completeJob(index) {
    //     let machine = machines[pageId * 8 + index];
    //     
    // }

    // for (var i = 0; i < machinesPerPage; i++) {
    //     let buttonId = i;
    //     jobContainers[i].addEventListener("click", () => completeJob(buttonId));
    // }

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
    
    updateList();
}

if(document.getElementById("notes")){
    console.log(machines);
    options = "<h1 class='checkbox-header'>Machines</h1>"
    machines.forEach(displayMachineChecklist);
    document.getElementById("checklist-container").innerHTML = options;


    options = "<h1 class='checkbox-header'>Users</h1>"
    console.log(factoryManagers)
    factoryManagers.forEach(displayUserChecklist);
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

    console.log(localStorage.getItem("flashing-warning"))
    console.log(localStorage.getItem("flashing-warning") == "true")
    if(localStorage.getItem("flashing-warning") == "true"){
        document.getElementById("warning").style.animation = "warning-blink 1s infinite";
    
    }else{
        document.getElementById("warning").style.animation = "none";
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

function displayMachineChecklist(i){
    options += 
    `
        <label class="checkboxes">
            <input type="checkbox" name="machines[]" value="${i.id}">
            <span class="${i.id}">${i.name}</span>
        </label>
    `;
}

function displayUserChecklist(i){
    options += 
    `
        <label class="checkboxes">
            <input type="checkbox" name="users[]" value="${i.id}">
            <span class="${i.id}">${i.username}</span>
        </label>
    `;
}