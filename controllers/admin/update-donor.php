<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $profilePicture = isset($_POST['profilePicture']) && !empty($_POST['profilePicture']) ? $_POST['profilePicture'] : "../../public/assets/images/user.jpg";
    $last_donation_date = $_POST['last_donation_date'];

    $errors = array();

    // Validate username
    if (empty($name)) {
        $errors['name'] = "Username is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $name))) {
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

    // Validate blood group
    if (empty($blood_group)) {
        $errors['blood_group'] = "Blood group is required.";
    } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
        $errors['blood_group'] = "Invalid blood group selected.";
    }
    if($last_donation_date > date("Y-m-d")){
      $errors['last_donation_date'] = "Last donation date can't be in the future."; 
    }
    
     $existing_user_query = "SELECT * FROM donors WHERE name='" . $name . "' AND id != '" . $id . "'";
     $existing_user_result = $conn->query($existing_user_query);
     if ($existing_user_result->num_rows > 0) {
         $errors['name'] = "User already exists.";
     }
 
     if (count($errors) > 0) {
         $_SESSION['errors'] = $errors;
         header("Location: ../../views/Admin page/update-donor.php?id=" . $id . "&err=" . urlencode(json_encode($errors)));
         exit();
     }

    $sql = "UPDATE `donors` SET `name`='$name', `blood_group`='$blood_group', `email`='$email', `address`='$address', `profilePicture`='$profilePicture', `last_donation_date`='$last_donation_date' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../../views/Admin page/admin.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `donors` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
 
        echo "No donor found with the provided ID";
        exit();
    }
} else {

    $errors['general'] = "No ID provided";
    $_SESSION['errors'] = $errors;
    header("Location: ../../views/Admin page/update-donor.php?id=" . $id . "&err=" . urlencode(json_encode($errors)));
    exit();
}
?>