<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $profilePicture = !empty($_POST['profilePicture']) ? $_POST['profilePicture'] : "../../public/assets/images/user.jpg";
    $address = mysqli_real_escape_string($conn, $_POST['Address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);

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

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // Validate address
    if (empty($address)) {
        $errors['address'] = "Address is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9\s\.,]+$/', $address)) {
        $errors['address'] = "Please enter a valid address.";
    }
    // Validate role
    if (empty($role)) {
        $errors['role'] = "Role is required.";
    }
    // Validate blood group
    if (empty($blood_group)) {
        $errors['blood_group'] = "Blood group is required.";
    } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
        $errors['blood_group'] = "Invalid blood group selected.";
    }
    // Validate phone
    if (empty($phone)) {
        $errors['phone'] = "Phone is required.";
    } elseif (!preg_match("/^\+?[0-9]+$/", $phone)) {
        $errors['phone'] = "Please enter a valid phone number.";
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/register.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    // Check if username already exists
    $table = ($role == "donor") ? "donors" : "labEmployee";
    
    $query = "SELECT * FROM $table WHERE name='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $errors['name'] = "Username already exists.";
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/register.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // bcrypt hashing algorithm 
    $sql = "INSERT INTO $table (name, password, email, profilePicture, address, phone, blood_group) VALUES ('$username', '$hashedPassword', '$email', '$profilePicture', '$address', '$phone', '$blood_group')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $username;
        if ($role == "donor") {
            header("Location: ../../views/Donor page/donor.php");
            exit();
        } else {
            header("Location: ../../views/Admin page/admin.php");
            exit();
        }
    } else {
        $errors['general'] = "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/register.php?err=" . urlencode(json_encode($errors)));
        exit();
    }
}
