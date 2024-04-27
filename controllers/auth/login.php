<?php
session_start();
include '../config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $errors = array();
    // Validate username
    if (empty($username)) {
        $errors['name'] = "Username is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $username))) {
        $errors['name'] = "Username can only contain letters.";
    }
    // Validate password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password should be at least 6 characters long.";
    }
    // Validate role
    if (empty($role)) {
        $errors['role'] = "Role is required.";
    }
    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }
    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/login.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    $table = ($role == "donor") ? "donors" : "labEmployee";
    $query = "SELECT * FROM $table WHERE name='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // select the login user id from db
            $query = "SELECT id FROM $table WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login'] = $row['id'];
            $_SESSION['donor_id'] = $row['id'];
            if ($role == "donor") {
                header("Location: ../../views/Donor page/donor.php");
            } else {
                header("Location: ../../views/Admin page/admin.php");
            }
            exit();
        } else {
            $errors['password'] = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $errors['name'] = "User not found. Please register first.";
    }

    $_SESSION['errors'] = $errors;
    header("Location: ../../views/auth/login.php?err=" . urlencode(json_encode($errors)));
    exit();
}
