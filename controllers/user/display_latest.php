<?php
// Fetch only the latest 3 donations
$query = "SELECT * FROM donations ORDER BY donation_date DESC LIMIT 3";
$result_Donations = mysqli_query($conn, $query);
?>

