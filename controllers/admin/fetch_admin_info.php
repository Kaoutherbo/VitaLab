<?php
session_start();
include "../../controllers/config.php";


$sql_donor = "SELECT * FROM donors ORDER BY created_at DESC";
$result_donor = mysqli_query($conn, $sql_donor);

$username = '';

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];

    $sql_admin = "SELECT * FROM labEmployee WHERE name = '$username'";
    $result_admin = mysqli_query($conn, $sql_admin);
    $row_admin = mysqli_fetch_assoc($result_admin);
} else {
    header("Location: ../../views/auth/login.html");
    exit();
}
?>