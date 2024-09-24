let allMachineNames = [];
let machineNames = [];
let randomisedData = [];


console.log(rawFactoryData);

for(let i=0; i<rawFactoryData.length; i++){
    allMachineNames.push(rawFactoryData[i]['machine_name']);
}
machineNames = [...new Set(allMachineNames)];

console.log(machineNames);

let displayMachines = "<ul>";
for(let i=0; i<machineNames.length; i++){
    displayMachines += "<li>" + machineNames[i] + "</li>";
}
displayMachines += "</ul>";
console.log(displayMachines)

document.getElementById("machine-list").innerHTML = displayMachines;


console.log(rawFactoryData.length);
let machineNum = Math.floor((Math.random() * (rawFactoryData.length/machineNames.length)) + 1);
console.log(machineNum)
for(let i=0; i<machineNames.length; i++){
    randomisedData.push(rawFactoryData[machineNum + "" + i])

}
console.log(randomisedData)