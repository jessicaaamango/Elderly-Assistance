<?php
// Start session to access user information
session_start();

// Check if user is logged in with valid session data and has the 'user' role
if (isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'staff') {
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

    // Retrieve user information based on session data (user email)
    $email = $_SESSION['user_email'];

    // SQL query to retrieve user details based on email
    $sql = "SELECT * FROM staff WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();

        // Close the database connection
        $conn->close();

        // Send user details as JSON response
        header('Content-Type: application/json');
        echo json_encode($user);
    } else {
        // User not found in database
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    // User not authenticated or lacks proper role
    echo json_encode(array('error' => 'Unauthorized'));
}
?>