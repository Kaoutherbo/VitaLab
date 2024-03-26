<?php
session_start();
include '../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function verify_password($input_password, $username, $conn) {
    // Fetch hashed password from LabEmployee table based on username
    $sql = "SELECT password FROM LabEmployee WHERE name = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        // display the user info
        echo  "<br>Username: " . $username;
        echo  "<br>Stored Password: " . $stored_password;

        // Compare hashed input password with stored hashed password
        if (password_verify($input_password, $stored_password)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false; // Username not found or query error
    }
}


$username = "Boutheldja Kaouther";
$input_password = "123"; 

if (verify_password($input_password, $username, $conn)) {
    echo "Password verified successfully!";
} else {
    echo "Incorrect password or username.";
}

// Close the connection
$conn->close();

?>
