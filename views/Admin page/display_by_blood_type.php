<?php
// Initialize blood type counts
$blood_types = array(
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
$sql_counts = "SELECT blood_type, COUNT(*) AS count FROM donors GROUP BY blood_type";
$result_counts = mysqli_query($conn, $sql_counts);

while ($row_count = mysqli_fetch_assoc($result_counts)) {
    $blood_type = $row_count['blood_type'];
    $count = $row_count['count'];
    $blood_types[$blood_type] = $count;
}

// Handle filtering donors by blood type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blood_type'])) {
    $bloodType = $_POST['blood_type'];
    $sql_donor_filtered = "SELECT * FROM donors WHERE blood_type = '$bloodType' ORDER BY created_at DESC";
    $result_donor_filtered = mysqli_query($conn, $sql_donor_filtered);
}
?>
