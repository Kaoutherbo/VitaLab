<?php

$blood_groups = array(
    'O+' => 0,
    'A+' => 0,
    'B+' => 0,
    'AB+' => 0,
    'O-' => 0,
    'A-' => 0,
    'B-' => 0,
    'AB-' => 0
);

// Count donors by blood type
$sql_counts = "SELECT blood_group, COUNT(*) AS count FROM donors GROUP BY blood_group";
$result_counts = mysqli_query($conn, $sql_counts);

while ($row_count = mysqli_fetch_assoc($result_counts)) {
    $blood_group = $row_count['blood_group'];
    $count = $row_count['count'];
    $blood_groups[$blood_group] = $count;
}

// Handle filtering donors by blood type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blood_group'])) {
    $bloodType = $_POST['blood_group'];
    $sql_donor_filtered = "SELECT * FROM donors WHERE blood_group = '$bloodType' ORDER BY created_at DESC";
    $result_donor_filtered = mysqli_query($conn, $sql_donor_filtered);
}
?>
