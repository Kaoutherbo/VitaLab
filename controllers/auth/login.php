<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $table = ($role == "donor") ? "donors" : "labEmployee";

    $query = "SELECT * FROM $table WHERE name='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) { // problem with password 
            $_SESSION['name'] = $username;

            if ($role == "donor") {
                header("Location: ../../views/Donor page/donor.html");
            } else {
                header("Location: ../../views/Admin page/admin.php");
            }
            exit();
        } else {
            $error = "Incorrect password. Please try again.";

            header("Location: ../../views/auth/login.html?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "User not found. Please register first.";
        
        header("Location: ../../views/auth/login.html?error=" . urlencode($error));
        exit();
    }
}
?>
