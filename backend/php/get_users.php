<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "elderlyAssistance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$userList = array();

if ($result->num_rows > 0) {
    // Fetch all users and store in array
    while ($row = $result->fetch_assoc()) {
        $userList[] = $row;
    }
}

// Close the database connection
$conn->close();

// Send user list as JSON response
header('Content-Type: application/json');
echo json_encode($userList);
?>
