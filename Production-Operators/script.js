let allMachineNames = [];
let machineNames = [];
let randomisedData = [];
let powerConsumption = 0;
let productionCount = 0;
let averageTemperature = 0;
let averageSpeed = 0;


console.log(rawFactoryData);
getMachineNames();
randomiseData();
displayRandomisedData();

function newRandomData(){
    randomiseData();
    displayRandomisedData();
}

function getMachineNames(){
    for(let i=0; i<rawFactoryData.length; i++){
        allMachineNames.push(rawFactoryData[i]['machine_name']);
    }
    machineNames = [...new Set(allMachineNames)];
        
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
    let machineNum = Math.floor((Math.random() * (rawFactoryData.length/machineNames.length)) + 1);
    for(let i=0; i<machineNames.length; i++){
        randomisedData.push(rawFactoryData[machineNum + "" + i])

    }
    console.log(randomisedData)
}

function displayRandomisedData(){
    for(let i=0; i<randomisedData.length; i++){
        powerConsumption += parseFloat(randomisedData[i]['power_consumption']);
        productionCount += parseFloat(randomisedData[i]['production_count']);
        averageTemperature += parseFloat(randomisedData[i]['temperature']);
        
        if(randomisedData[i]['speed'] == ""){
            averageSpeed += 0;
        }else{
            averageSpeed += (parseFloat(randomisedData[i]['speed']));
        }
        console.log(parseFloat(randomisedData[i]['speed']));
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
