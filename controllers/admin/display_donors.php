<?php 
$allDonorsClicked = isset($_GET['all_donors']);

if ($allDonorsClicked) {
    $sql_donor = "SELECT * FROM donors ORDER BY created_at DESC";
    $result_donor = mysqli_query($conn, $sql_donor);
} else {
    $sql_donor_all = "SELECT * FROM donors ORDER BY created_at DESC";
    $result_donor = mysqli_query($conn, $sql_donor_all);
}
?>
