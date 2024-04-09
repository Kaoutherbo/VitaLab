
<?php 
@include '../config.php';

// Fetch donor's account information from the database
$username = '';

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];

    $sql_donor = "SELECT id, name, profilePicture, address, email FROM donors WHERE name = '$username'";
    $result_donor = mysqli_query($conn, $sql_donor);
    $row_donor = mysqli_fetch_assoc($result_donor);
} else {
    header("Location: ../../views/auth/login.php");
    exit();
}

?>
