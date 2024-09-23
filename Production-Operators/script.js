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


for(let i=0; i<randomisedData.length; i++){
    powerConsumption += parseFloat(randomisedData[i]['power_consumption']);
    productionCount += parseFloat(randomisedData[i]['production_count']);
    averageTemperature += parseFloat(randomisedData[i]['temperature']);
    
    if(randomisedData[i]['speed'] == ""){
        averageSpeed += 0;
    }else{
        averageSpeed += (parseFloat(randomisedData[i]['speed'])*(parseFloat(randomisedData[i]['production_count'])));
    }
    console.log(parseFloat(randomisedData[i]['speed']));
}
powerConsumption = Math.ceil(powerConsumption);
productionCount = Math.ceil(productionCount);
averageTemperature = (averageTemperature/10).toFixed(1);
averageSpeed = (averageSpeed/10).toFixed(2);

// averageTemperature = Math.ceil(averageTemperature);
// averageSpeed = Math.ceil(averageSpeed);


console.log(averageSpeed);
document.getElementById("power-consumption").innerHTML = powerConsumption;
document.getElementById("production-count").innerHTML = productionCount;
document.getElementById("average_temperature").innerHTML = averageTemperature;
document.getElementById("average-speed").innerHTML = averageSpeed;