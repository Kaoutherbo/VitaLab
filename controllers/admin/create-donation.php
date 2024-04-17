<?php
session_start();
@include '../config.php';

if (isset($_POST["submit"])) {
    if (isset($_SESSION['name'])) {
        $lab_employee_name = $_SESSION['name'];

        $query = "SELECT id FROM LabEmployee WHERE name = '$lab_employee_name'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $lab_employee_id = $row['id'];

            $donation_place = $_POST['location'];
            $donation_date = $_POST['date'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $donation_image = isset($_POST['donation_image']) && !empty($_POST['donation_image']) ? $_POST['donation_image'] : "../../public/assets/images/donation.webp";
            $blood_group = $_POST['blood_group'];
            $errors = array();

            // Validate location
            if (empty($donation_place)) {
                $errors['location'] = "Location is required.";
            }

            // Validate date
            if (empty($donation_date)) {
                $errors['date'] = "Donation date is required.";
            } elseif ($donation_date < date("Y-m-d")) {
                $errors['date'] = "Invalid donation date. Enter a future date.";
            }

            // Validate blood group
            if (empty($blood_group)) {
                $errors['blood_group'] = "Blood group is required.";
            } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
                $errors['blood_group'] = "Invalid blood group selected.";
            }
            // Validate title
            if (empty($title)) {
                $errors['title'] = "Title is required.";
            }
            // Validate description
            if (empty($description)) {
                $errors['description'] = "Description is required.";
            }

            // Check if there are any errors
            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                header("Location: ../../views/Admin page/create-donation.php?err=" . urlencode(json_encode($errors)));
                exit();
            }

            $insert_query = "INSERT INTO donations (donation_place, donation_date, title, description, donation_image, created_by, created_at, blood_group) VALUES ('$donation_place', '$donation_date', '$title', '$description', '$donation_image', '$lab_employee_id', NOW(), '$blood_group')";

            if (mysqli_query($conn, $insert_query)) {
                header("Location: ../../views/Donor page/display_donations.php?msg=New donation created successfully");
                exit();
            } else {
                echo "Failed to create donation. Please try again later.";
            }
        } else {
            echo "Lab employee not found.";
        }
    } else {
        header("Location: ../../views/auth/login.php");
        exit();
    }
}
