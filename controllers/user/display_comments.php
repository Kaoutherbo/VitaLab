<?php
// Fetch all comments
$query = "SELECT * FROM comments";
$result_Comments = mysqli_query($conn, $query);

// Initialize arrays to store donations and comments
$donations = [];
$comments = [];

// Populate donations array
while ($row = mysqli_fetch_assoc($result_Donations)) {
    $donations[$row['id']] = $row;
}

// Populate comments array
while ($row = mysqli_fetch_assoc($result_Comments)) {
    $donation_id = $row['donation_id'];
    if (!isset($comments[$donation_id])) {
        $comments[$donation_id] = [];
    }
    $comments[$donation_id][] = $row;
}

?>
