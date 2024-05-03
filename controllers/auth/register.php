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
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
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
    // Validate birthday
    if (empty($birthday)) {
        $errors['birthday'] = "Birthday is required.";
    }else {
        // Check if the user is over 18 years old
        $dob = new DateTime($birthday);
        $now = new DateTime();
        $age = $now->diff($dob)->y;
        if ($age < 18) {
            $errors['birthday'] = "You must be at least 18 years old.";
        }
        // Check if the birthday is not in the future or today
        if ($dob > $now) {
            $errors['birthday'] = "Birthday cannot be in the future.";
        }
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/register.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    // Check if username already exists
    $table = ($role == "donor") ? "donors" : "labEmployee";

    $query = "SELECT * FROM $table WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $errors['name'] = "User already exists.";
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/auth/register.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // bcrypt hashing algorithm 
    $sql = "INSERT INTO $table (name, password, email, profilePicture, address, birthday, blood_group) VALUES ('$username', '$hashedPassword', '$email', '$profilePicture', '$address', '$birthday', '$blood_group')";

    if ($conn->query($sql) === TRUE) {
        // select the login user id from db
        $query = "SELECT id FROM $table WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = $row['id'];
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
