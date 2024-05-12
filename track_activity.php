<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if user is logged in and has the 'user' role
if (isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user') {
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

    $email = $_SESSION['user_email'];

    // Fetch user information based on user email from the database
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name, room_number FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // Store the result set

    // Bind result variables
    $stmt->bind_result($userID, $firstName, $lastName, $roomNumber);

    // Check if user exists
    if ($stmt->fetch()) {
        // User information retrieved successfully, proceed to track activity
        $stmt->free_result(); // Free the result set before executing another query

        $timestamp = date('Y-m-d H:i:s'); // Current timestamp
        $activityType = "Button Click"; // Activity type (customize as needed)

        // Prepare SQL statement to insert activity into database
        $insertStmt = $conn->prepare("INSERT INTO help_requests (user_id, first_name, last_name, request_time, resolved, resolved_time, room_number) VALUES (?, ?, ?, ?, 0, NULL, ?)");
        $insertStmt->bind_param("issss", $userID, $firstName, $lastName, $timestamp, $roomNumber);
        $insertStmt->execute();

        echo "Activity tracked successfully.";
    } else {
        echo "Error: User not found.";
    }

    // Close statements and database connection
    $stmt->close();
    $insertStmt->close();
    $conn->close();
} else {
    // User is not logged in or unauthorized
    http_response_code(401); // Unauthorized
    echo "User not logged in or unauthorized.";
}
?>

