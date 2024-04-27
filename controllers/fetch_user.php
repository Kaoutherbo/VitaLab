<?php
session_start();
include "../../controllers/config.php";

$username = '';

if (isset($_SESSION['login'])) {
    $id = $_SESSION['login'];

    $sql_role = "SELECT role FROM labEmployee WHERE id = '$id'";
    $result_role = mysqli_query($conn, $sql_role);
    
    // Check if the user is a labEmployee
    if (mysqli_num_rows($result_role) == 0) {
        $sql_role = "SELECT role FROM donors WHERE id = '$id'";
        $result_role = mysqli_query($conn, $sql_role);
    }

    // Fetch the user's role
    if ($row_role = mysqli_fetch_assoc($result_role)) {
        $role = $row_role['role'];

        $table = ($role == "donor") ? "donors" : "labEmployee";

        $sql_query = "SELECT * FROM $table WHERE id = '$id'";
        $result_query = mysqli_query($conn, $sql_query);
        $row_user = mysqli_fetch_assoc($result_query);
    } else {
        header("Location: ../../views/auth/login.php");
        exit();
    }
} else {
    header("Location: ../../views/auth/login.php");
    exit();
}
?>