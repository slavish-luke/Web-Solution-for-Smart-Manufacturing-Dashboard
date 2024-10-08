const machineName = new URLSearchParams(window.location.search).get('machine');
const machine_name = document.getElementById('machine-name');
machine_name.textContent = machineName;