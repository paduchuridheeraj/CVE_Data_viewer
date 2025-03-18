document.addEventListener("DOMContentLoaded", function() {
    fetchCVEData();

    function fetchCVEData() {
        fetch('http://localhost/cve_project/api.php') // Ensure this URL is correct
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('cveTable').getElementsByTagName('tbody')[0];
                tableBody.innerHTML = ''; // Clear existing data

                data.forEach(cve => {
                    const row = tableBody.insertRow();
                    row.insertCell(0).innerText = cve.cve_id;
                    row.insertCell(1).innerText = cve.description;
                    row.insertCell(2).innerText = cve.score !== null ? cve.score : 'N/A';
                    row.insertCell(3).innerText = new Date(cve.last_modified).toLocaleString();
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
});