<?php
header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password
$dbname = "cve_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the response header to JSON
header('Content-Type: application/json');

// Build the SQL query
$sql = "SELECT * FROM cve_data"; // Fetch all records

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $cve_list = [];
    while ($row = $result->fetch_assoc()) {
        $cve_list[] = $row;
    }
    echo json_encode($cve_list);
} else {
    echo json_encode([]);
}

// Debugging output
if ($result->num_rows === 0) {
    echo "No records found in the database.";
}

$conn->close();
?>