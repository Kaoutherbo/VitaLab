<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../views/Home/Home Page.html");
exit();
?>
