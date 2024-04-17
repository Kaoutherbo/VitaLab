<?php
include "../../controllers/config.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $stmt = $conn->prepare("DELETE FROM `donors` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        header("Location: ../../views/Admin page/admin.php?msg=Data deleted successfully");
        exit();
    } else {
        echo "Failed: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "No ID provided.";
}
?>
