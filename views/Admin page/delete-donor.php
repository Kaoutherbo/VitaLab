<?php
include "../../controllers/config.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `donors` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        header("Location: admin.php?msg=Data deleted successfully");
        exit();
    } else {
        echo "Failed: " . $stmt->error;
    }
    
    $stmt->close(); // Close prepared statement
} else {
    echo "No ID provided.";
}
?>
