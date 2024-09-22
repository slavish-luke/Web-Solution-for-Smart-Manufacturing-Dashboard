let allMachineNames = [];
let machineNames = [];


console.log(rawFactoryData);

for(let i=0; i<rawFactoryData.length; i++){
    allMachineNames.push(rawFactoryData[i]['machine_name'])
}
machineNames = [...new Set(allMachineNames)]

console.log(machineNames)

let displayMachines = "<ul>";
for(let i=0; i<machineNames.length; i++){
    displayMachines += "<li>" + machineNames[i] + "</li>";
}
displayMachines += "</ul>"

document.getElementById("machine_names").innerHTML = displayMachines;