<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laboratory";
    try {
    // add connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    }catch(exception $e){
        die("Connection failed: ". mysqli_connect_error());
    }
?>