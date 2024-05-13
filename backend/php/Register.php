<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if form fields are provided via POST request
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['age'], $_POST['roomNumber'], $_POST['illness'], $_POST['phoneNumber'], $_POST['role'])) {
    // Retrieve and sanitize input data
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $address = $conn->real_escape_string($_POST['address']);
    $age = (int)$_POST['age'];
    $roomNumber = $conn->real_escape_string($_POST['roomNumber']);
    $illness = $conn->real_escape_string($_POST['illness']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $role = $conn->real_escape_string($_POST['role']);

    // Hash the password (for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert new user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password, address, age, room_number, illness, phone_number, role) VALUES ('$firstName', '$lastName', '$email', '$hashed_password', '$address', $age, '$roomNumber', '$illness', '$phoneNumber', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        $dashboardLink = "user_dashboard.php"; // Replace with your dashboard URL
        // Redirect to login page after successful registration
        // header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid input data. Please provide all required fields.";
}

$conn->close();
?>