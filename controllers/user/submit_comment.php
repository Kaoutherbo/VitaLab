<?php
session_start();
@include '../../controllers/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-comment'])) { // add condition
    // Check if the user is logged in
    if (isset($_SESSION['name'])) {
        // Get form data
        $comment_donor_name = $_SESSION['name'];
        $comment = $_POST['comment-content'];
        $rating = $_POST['rating'];
        $donation_id = $_POST['donation_id'];

        $errors = array();

        // get the id of the donator from  session name
        $query_id =  "SELECT id FROM donors WHERE name ='$comment_donor_name'";
        $result_check_donation = mysqli_query($conn, $query_id);
        $row_donor = mysqli_fetch_assoc($result_check_donation);
        $donor_id = $row_donor['id'];

        // Check if the donor has made the selected donation
        $query_check_donation = "SELECT * FROM donation_records WHERE donation_id = '$donation_id' AND donor_id = '$donor_id'";
        $result_check_donation = mysqli_query($conn, $query_check_donation);
        if (mysqli_num_rows($result_check_donation) == 0) {
            $errors['donation'] = "You can only comment and rate donations that you have register.";
        }
        if (empty($errors)) {
            // Validate rating
            if (empty($rating)) {
                $errors['rating'] = "Rating is required.";
            } elseif (!in_array($rating, ['1', '2', '3', '4', '5'])) {
                $errors['rating'] = "Invalid rating selected.";
            }
            // Validate comment
            if (empty($comment)) {
                $errors['comment'] = "Comment content is required.";
            }
        }
        // Check if there are any errors
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors; // Store errors for this specific donation
            header("Location: ../../views/Donor page/display_donations.php?id=$donation_id&err=" . urlencode(json_encode($errors)));
            exit();
        }


        // Retrieve donor id and profile picture from the donors table
        $query_donor_info = "SELECT id, profilePicture FROM donors WHERE name = '$comment_donor_name'";
        $result_donor_info = mysqli_query($conn, $query_donor_info);

        if ($result_donor_info && mysqli_num_rows($result_donor_info) > 0) {
            $row_donor_info = mysqli_fetch_assoc($result_donor_info);
            $donor_id = $row_donor_info['id'];
            $profilePicture = $row_donor_info['profilePicture'];

            // Insert comment into the database
            $query_insert_comment = "INSERT INTO comments (donor_id, donation_id, comment, rating, profilePicture, name) 
                  VALUES ('$donor_id', '$donation_id', '$comment', '$rating', '$profilePicture', '$comment_donor_name')";
            if (mysqli_query($conn, $query_insert_comment)) {
                // Comment inserted successfully, redirect back to the donor page
                header("Location: ../../views/Donor page/display_donations.php");
                exit;
            } else {
                // Error inserting comment
                echo "Error: " . $query_insert_comment . "<br>" . mysqli_error($conn);
            }
        } else {
            // Error retrieving donor info
            echo "Error: Donor information not found for user '$comment_donor_name'";
        }
    } else {
        // User is not logged in, handle accordingly
        echo "You must be logged in to add a comment.";
    }
}
