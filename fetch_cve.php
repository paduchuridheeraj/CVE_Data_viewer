<?php
$baseUrl = "https://services.nvd.nist.gov/rest/json/cves/2.0";
$startIndex = 0; // Starting index for pagination
$resultsPerPage = 10; // Number of results to fetch per API call

// Fetch data from the API
$response = file_get_contents("$baseUrl?startIndex=$startIndex&resultsPerPage=$resultsPerPage");

// Check if the response is valid
if ($response === FALSE) {
    die("Error fetching data from the API.");
}

// Decode the JSON response
$data = json_decode($response, true);

// Print the response for debugging
echo "<pre>";
print_r($data);
echo "</pre>";

// Check if 'vulnerabilities' key exists
if (!isset($data['vulnerabilities'])) {
    die("Invalid response structure. Please check the API.");
}

// Database connection
$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password
$dbname = "cve_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
foreach ($data['vulnerabilities'] as $item) {
    $cve_id = $item['cve']['id'];
    $description = $item['cve']['descriptions'][0]['value']; // Get the first description
    $score = $item['metrics']['cvssMetricV2'][0]['cvssData']['baseScore'] ?? null; // Get the CVSS score
    $last_modified = $item['cve']['lastModified'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO cve_data (cve_id, description, score, last_modified) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssds", $cve_id, $description, $score, $last_modified);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
}

$stmt->close();
$conn->close();
echo "Data fetched and stored successfully!";
?>