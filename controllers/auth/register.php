<?php
@include '../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['name']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);
    $image = $conn->real_escape_string($_POST['Image']);
    $address = $conn->real_escape_string($_POST['Adress']);
    $role = $conn->real_escape_string($_POST['role']);

    // Hash the password before saving it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Determine the table based on the selected role
    $table = ($role == "donor") ? "donors" : "labEmployee";

    // Check if username already exists
    $check_query = "SELECT * FROM $table WHERE name='$username'";
    $result = $conn->query($check_query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists, set error message
        $error = "Username already exists. Please choose a different one.";
    } else {
        // SQL query to insert user data into appropriate table
        $sql = "INSERT INTO $table (name, password, email, profilePicture, address) VALUES ('$username', '$hashed_password', '$email', '$image', '$address')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect user
            $_SESSION['name'] = $username;
            if ($role == "donor") {
                header("Location: ../../views/Donor page/donor.html");
            } else {
                header("Location: ../../views/Admin page/admin.php");
            } // Redirect after successful registration
            exit();
        } else {
            // Registration failed, set error message
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();

    // Redirect user back to registration form with error message
    header("Location: ../../views/auth/register.html?error=" . urlencode($error));
    exit();
}
?>
