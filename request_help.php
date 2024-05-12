<?php
session_start();

// Check if user is logged in with valid session data and has the 'user' role
if (isset($_SESSION['user_id'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['room_number'])) {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "elderlyAssistance";

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['room_number'] = $user['room_number'];

    // Prepare SQL statement to insert help request
    $sql = "INSERT INTO help_requests (user_id, first_name, last_name, request_time, resolved, resolved_time, room_number)
            VALUES (?, ?, ?, NOW(), NULL, NULL, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("issi", $_SESSION['user_id'], $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['room_number']);

        // Execute the statement
        if ($stmt->execute()) {
            // Help request inserted successfully
            echo "Help request submitted successfully!";
        } else {
            // Error executing SQL statement
            echo "Failed to submit help request: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // Error preparing SQL statement
        echo "Database error: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // Session data not complete
    echo "Incomplete session data";
}
?>
