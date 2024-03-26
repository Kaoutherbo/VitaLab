<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username =  mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $image =  mysqli_real_escape_string($conn, $_POST['Image']);
    $address =  mysqli_real_escape_string($conn, $_POST['Adress']);
    $role =  mysqli_real_escape_string($conn, $_POST['role']);

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $table = ($role == "donor") ? "donors" : "labEmployee";

    $query = "SELECT * FROM $table WHERE name='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Username already exists. Please choose a different one.";
    } else {
        $sql = "INSERT INTO $table (name, password, email, profilePicture, address) VALUES ('$username', '$hashedPassword', '$email', '$image', '$address')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['name'] = $username;
            if ($role == "donor") {
                header("Location: ../../views/Donor page/donor.html");
            } else {
                header("Location: ../../views/Admin page/admin.php");
            }
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();

    header("Location: ../../views/auth/register.html?error=" . urlencode($error));
    exit();
}
?>
