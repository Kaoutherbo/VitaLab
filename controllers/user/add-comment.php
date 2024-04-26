<?php
@include "../config.php";
@include "../fetch_user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $donation_id = isset($_POST['donation_id']) ? intval($_POST['donation_id']) : null;
    $name = $row_user['name'];
    $username = isset($_POST['name']) ? trim($_POST['name']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $donor_id = $row_user['id'];
    
    $is_general = ($donation_id === null || $donation_id === 0) ? 1 : 0;

    
    $errors = [];


    if ($donation_id !== null && $donation_id !== 0) {
        if (isset($donor_id)) {
            $query_check_donation = "SELECT * FROM donation_records WHERE donation_id = '$donation_id' AND donor_id = '$donor_id'";
            $result_check_donation = mysqli_query($conn, $query_check_donation);

            if (mysqli_num_rows($result_check_donation) == 0) {
                $errors['donation'] = "You can only comment and rate donations that you have registered.";
            }
        }
    }
    if (empty($errors)) {
        // Validate username
        if (empty($username)) {
            $errors['name'] = "Name is required.";
        } elseif ($name !== $username) {
            $errors['name'] = "Name does not match the logged-in user.";
        }

        // Validate rating
        if (empty($rating)) {
            $errors['rating'] = "Rating is required.";
        }

        // Validate comment
        if (empty($comment)) {
            $errors['comment'] = "Comment content is required.";
        }
    }

    if (empty($errors)) {
        if ($is_general) {
            $donation_id = 'NULL';
        }

        $query_insert_comment = "INSERT INTO comments (donor_id, donation_id, name, comment, rating, profilePicture, is_general) VALUES ('$donor_id', $donation_id, '$username', '$comment', '$rating', (SELECT profilePicture FROM donors WHERE id = '$donor_id'), '$is_general')";       

        if (mysqli_query($conn, $query_insert_comment)) {
            header("Location: ../../views/Donor page/donor.php");
            exit();
        } else {
            $errors['general'] = "An error occurred while adding the comment.";
        }
    }

    if (!empty($errors)) {
        $errors_json = urlencode(json_encode($errors));

        if ($donation_id === 0 || $donation_id === null) {
            header("Location: ../../views/Donor page/add-comment.php?err=$errors_json");
        } else {
            header("Location: ../../views/Donor page/donor.php?id=$donation_id&err=$errors_json");
        }
        
        exit();
    }
}
