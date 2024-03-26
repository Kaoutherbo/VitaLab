<?php
// Handle searching for donors
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_term'])) {
    $searchTerm = $_POST['search_term'];
    $sql_search = "SELECT * FROM donors WHERE name LIKE '%$searchTerm%' ORDER BY created_at DESC";
    $result_search = mysqli_query($conn, $sql_search);
}
?>
