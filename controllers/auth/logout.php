<?php
session_start();
session_unset();
session_destroy(); // Destroy the session
header("Location: ../../views/Home/Home Page.html"); // Redirect to home page after logout
exit();
?>
