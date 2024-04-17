<?php
session_start();
@include '../config.php';

// Check if form is submitted for filtering donations
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];
    $blood_group = $_POST['blood_group'];

    $errors = array();
    // Validate blood group
    if (empty($blood_group)) {
        $errors['blood_group'] = "Blood group is required.";
    } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
        $errors['blood_group'] = "Invalid blood group selected.";
    }
    // Validate date
    if (empty($start_date)) {
        $errors['start_date'] = "Start Donation date is required.";
    } elseif ($start_date > date("Y-m-d")) {
        $errors['start_date'] = "Invalid donation date. Enter a past date.";
    }
    // Validate date
    if (empty($end_date)) {
        $errors['end_date'] = "End Donation date is required.";
    }
    if($start_date > $end_date) {
        $errors['start_date'] = "The start date cannot be later than the end date.";
    }
    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/Donor page/display_donations.php?err=" . urlencode(json_encode($errors)));
        exit();
    }

    $query = "SELECT * FROM donations WHERE donation_date BETWEEN '$start_date' AND '$end_date' AND blood_group = '$blood_group'";
    $result_Donations = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM donations";
    $result_Donations = mysqli_query($conn, $query);
}

// Check if the user clicked on "All Donations"
if (isset($_GET['all_donations'])) {
    $query = "SELECT * FROM donations";
    $result_Donations = mysqli_query($conn, $query);
}


?>