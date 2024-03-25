<?php
@include '../config.php';
session_start(); // start or resumes an existing session (Sessions are used to persist data across multiple HTTP requests.)

if ($_SERVER["REQUEST_METHOD"] == "POST") { // action in form  is set to POST, so we know it's a submission of the form

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['name']);
    $password = $_POST['password'];
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);


    $table = ($role == "donor") ? "donors" : "labEmployee";
    

    $query = "SELECT * FROM $table WHERE name='$username' AND email='$email'"; 
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['name'] = $username;
            if ($role == "donor") {
                header("Location: ../../views/Donor page/donor.html");
            } else {
                header("Location: ../../views/Admin page/admin.php");
            }
            exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header('Location: ../../auth/login.html');
    }

    mysqli_close($conn);

}

?>
