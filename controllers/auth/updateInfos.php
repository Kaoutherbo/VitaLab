<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $profilePicture = isset($_POST['profilePicture']) && !empty($_POST['profilePicture']) ? $_POST['profilePicture'] : "../../public/assets/images/user.jpg";
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $role_user = $_POST['role_user'];

    
    
    $errors = array();

    // Validate username
    if (empty($username)) {
        $errors['name'] = "Username is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $username))) {
        $errors['name'] = "Username can only contain letters.";
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
    
    // Determine the table based on the user's role
    $table = ($role == "donor") ? "donors" : "labEmployee";

    $existing_user_query = "SELECT * FROM $table WHERE name='" . $name . "' AND id != '" . $id . "'";
    $existing_user_result = $conn->query($existing_user_query);
    if ($existing_user_result->num_rows > 0) {
        $errors['name'] = "User with this name already exists.";
    }


    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location:../../views/auth/updateProfile.php?id=". $id. "&err=". urlencode(json_encode($errors)));
        exit();
    }

    $table = ($role == "donor") ? "donors" : "labEmployee";

    $sql = "UPDATE $table SET `name`='$name', `blood_group`='$blood_group', `email`='$email', `address`='$address', `profilePicture`='$profilePicture', `phone`='$phone' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($role_user == "admin") {
            header("Location: ../../views/Admin page/admin.php?msg=Data updated successfully");
        } else {
            header("Location: ../../views/Donor page/donor.php?msg=Data updated successfully");
        }
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $role = $_GET["role"] ?? "donor"; 

    $table = ($role == "donor") ? "donors" : "labEmployee";

    $sql = "SELECT * FROM `$table` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No user found with the provided ID";
        exit();
    }
} else {
    $errors['general'] = "No ID provided";
    $_SESSION['errors'] = $errors;
    header("Location: ../../views/auth/updateProfile.php?id=" . $id . "&err=" . urlencode(json_encode($errors)));
    exit();
}

?>