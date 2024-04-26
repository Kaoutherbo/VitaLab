<?php
session_start();
@include '../config.php';

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $profilePicture = isset($_POST['profilePicture']) && !empty($_POST['profilePicture']) ? $_POST['profilePicture'] : "../../public/assets/images/user.jpg";

    $errors = array();

    // Validate username
    if (empty($name)) {
        $errors['name'] = "Username is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $name))) {
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

    // Validate blood group
    if (empty($blood_group)) {
        $errors['blood_group'] = "Blood group is required.";
    } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
        $errors['blood_group'] = "Invalid blood group selected.";
    }

    // Check if the user already exists
    $existing_user_query = "SELECT * FROM donors WHERE name='" . $name . "'";
    $existing_user_result = $conn->query($existing_user_query);
    if ($existing_user_result->num_rows > 0) {
        $errors['name'] = "User already exists.";
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/Admin page/add-donor.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    $created_at = date("Y-m-d H:i:s");
    $updated_at = $created_at;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // default hashing algorithm

    $insert_query = "INSERT INTO donors (name, blood_group, email, password, address, profilePicture, created_at, updated_at) VALUES ('$name', '$blood_group', '$email', '$hashed_password', '$address', '$profilePicture', '$created_at', '$updated_at')";

    if ($conn->query($insert_query) === TRUE) {
        header("Location: ../../views/Admin page/admin.php?msg=New record created successfully");
        exit();
    } else {
        echo "Failed: " . $conn->error;
    }
}
?>
