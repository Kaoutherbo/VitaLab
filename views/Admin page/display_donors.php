<?php
// Check if "All donors" link is clicked
$allDonorsClicked = isset($_GET['all_donors']);

// Fetch donor information from the database if "All donors" link is not clicked
if (!$allDonorsClicked) {
    $sql_donor = "SELECT * FROM donors ORDER BY created_at DESC";
    $result_donor = mysqli_query($conn, $sql_donor);
}
?>
