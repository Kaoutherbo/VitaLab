<?php
session_start();
include "../config.php";
@include '../../controllers/user/fetch_donor_info.php';

$errors = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $health = mysqli_real_escape_string($conn, $_POST['health']);
    $blood_volume = mysqli_real_escape_string($conn, $_POST['blood_volume']);
    $donation_id = isset($_POST['donation_id']) ? mysqli_real_escape_string($conn, $_POST['donation_id']) : null;
    $name = isset($_POST['donor_id']) ? mysqli_real_escape_string($conn, $_POST['donor_id']) : null;


     $query_blood_info = "SELECT blood_group, donation_date FROM donations WHERE id = '$donation_id'";
     $result_blood_info = mysqli_query($conn, $query_blood_info);
     if ($result_blood_info) {
         $row_blood_info = mysqli_fetch_assoc($result_blood_info);
         $donation_blood_type = $row_blood_info['blood_group'];
         $donation_date = $row_blood_info['donation_date'];
     } else {
         $errors['general'] = "Donation information not found.";
     }

    // Test if the date of donation is less than the current date
    $current_date = date("Y-m-d H:i:s");
    if ($donation_date < $current_date) {
        $errors['general'] = "Donation date is expired.";
    }

    if(empty($errors)){
    // Validate username
    if (empty($username)) {
        $errors['name'] = "Username is required.";
    } elseif($name != $username){
        $errors['name'] = "Enter correct username.";
    }

    // Validate blood_volume
    if (empty($blood_volume)) {
        $errors['blood_volume'] = "blood volume is required.";
    } elseif($blood_volume > 500){
        $errors['blood_volume'] = "Blood volume is too big.";
    }

    // Validate phone
    if (empty($phone)) {
        $errors['phone'] = "Phone is required.";
    } elseif (!preg_match("/^\+?[0-9]+$/", $phone)) {
        $errors['phone'] = "Please enter a valid phone number.";
    }

    // Validate weight
    if (empty($weight)) {
        $errors['weight'] = "Weight is required.";
    } elseif (!is_numeric($weight)) {
        $errors['weight'] = "Please enter numeric values only.";
    } elseif ($weight < 50) {
        $errors['weight'] = "Must be at least 50kg to register.";
    }

    // Validate health
    if (empty($health)) {
        $errors['health'] = "Health is required.";
    } elseif (!in_array($health, ['yes', 'no'])) {
        $errors['health'] = "Invalid Health selected.";
    } elseif ($health === "yes") {
        $errors['health'] = "Must not have any diseases to donate.";
    }

    // Validate age
    if (empty($age)) {
        $errors['age'] = "Age is required.";
    } elseif ($age < 18 || $age > 65) {
        $errors['age'] = "Must be between 18 and 65 years old to register.";
    } elseif (!ctype_digit($age)) {
        $errors['age'] = "Please enter numeric values only.";
    }

    if ($donation_id === null) {
        $errors['general'] = "Invalid donation ID.";
    }

    $query = "SELECT id, blood_group FROM donors WHERE name = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $donor_id = $row['id'];
        $blood_group = $row['blood_group'];
    } else {
        $errors['name'] = "Donor information not found.";
    }

    // Check if the donor has already registered for the same donation
    if (empty($errors)) {
        $query = "SELECT * FROM donation_records WHERE donor_id = '$donor_id' AND donation_id = '$donation_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors['general'] = "You have already registered for this donation.";
        }
    }

   
    // Check if the donor's blood type is compatible with the donation blood type
    if (!empty($blood_group)) {
        switch ($blood_group) {
            case 'A+':
                if (!in_array($donation_blood_type, ['A+', 'AB+'])) {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'B+':
                if (!in_array($donation_blood_type, ['B+', 'AB+'])) {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'AB+':
                if ($donation_blood_type !== 'AB+') {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'O+':
                if (!in_array($donation_blood_type, ['A-', 'B-', 'AB-', 'O-'])) {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'A-':
                if (!in_array($donation_blood_type, ['A-', 'A+', 'AB+', 'AB-'])) {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'B-':
                if (!in_array($donation_blood_type, ['B-', 'B+', 'AB+', 'AB-'])) {
                    $errors["blood_group"] = "The donated blood does not match your blood type.";
                }
                break;
            case 'AB-':
                if (!in_array($donation_blood_type, ['AB-', 'AB+'])) {
                    $errors["general"] = "The donated blood does not match your blood type.";
                }
                break;
        }
    } 

}
    // Check if there are any errors
    if (count($errors) > 0) {
        // Store errors and donation ID in session
        $_SESSION['errors'] = $errors;
        $_SESSION['id'] = $donation_id;
        header("Location: ../../views/auth/donatePage.php?id=$donation_id&err=" . urlencode(json_encode($errors)));
        exit();
    }

    $query = "INSERT INTO donation_records (donor_id, donation_id, blood_group, blood_volume) 
              VALUES ('$donor_id', '$donation_id', '$blood_group', '$blood_volume')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: ../../views/Donor page/donor.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../../views/auth/donatePage.php");
    exit();
}
?>
