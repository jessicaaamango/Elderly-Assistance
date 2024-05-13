<?php
// Start session to store user information
session_start();

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

// Check if email and password are provided via POST request
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieve email and password from POST request
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Hash the entered password using SHA2 (or your preferred hashing method)
    $hashed_entered_password = hash('sha256', $password);

    // SQL queries to retrieve user with matching email from each table
    $sql1 = "SELECT * FROM users WHERE email = '$email'";
    $sql2 = "SELECT * FROM staff WHERE email = '$email'";

    // Execute the first SQL query (for users table)
    $result1 = $conn->query($sql1);

    // Execute the second SQL query (for staff table)
    $result2 = $conn->query($sql2);

    // Check if either query returned a result
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
    } elseif ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
    } else {
        // No user found with the provided email
        echo "Invalid email or password.";
        $conn->close();
        exit();
    }

    // Verify hashed entered password against stored hashed password
    $stored_hashed_password = $row['password'];
    if ($hashed_entered_password === $stored_hashed_password) {
        // Authentication successful, store user info in session
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $row['role'];
        $_SESSION['user_title'] = $row['title'];

        // Redirect to the appropriate dashboard based on role
        if ($_SESSION['user_role'] === 'user') {
            header("Location: user_dashboard.html");
            exit();
        } elseif ($_SESSION['user_role'] === 'staff' && $_SESSION['user_title'] !== 'CEO') {
            header("Location: staff_dashboard.html");
            exit();
        } 
        elseif ($_SESSION['user_role'] === 'staff' && $_SESSION['user_title'] === 'CEO') {
            header("Location: ceo_dashboard.html");
            exit();
        } elseif ($_SESSION['user_role'] === 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        }
    } else {
        // Invalid password
        echo "Invalid email or password.";
    }
} else {
    echo "Invalid input data. Please provide email and password.";
}

$conn->close();
?>