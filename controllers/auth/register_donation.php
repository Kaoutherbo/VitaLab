<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "kaouther";
    $password = "";
    $dbname = "laboratory";
    

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $event = $_POST['event'];

    // SQL query to insert donation registration data into database
    $sql = "INSERT INTO donations (username, email, blood_group, phone, address, event) VALUES ('$username', '$email', '$blood_group', '$phone', '$address', '$event')";

    if ($conn->query($sql) === TRUE) {
        // Donation registration successful
        $_SESSION['donation_success'] = true;
        header("Location: donation_success.php"); // Redirect to success page after successful donation registration
    } else {
        // Donation registration failed
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
