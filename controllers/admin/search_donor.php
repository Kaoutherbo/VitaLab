<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_term'])) {
    $searchTerm = $_POST['search_term'];
    $errors = array();

    // validate searchTerm
    if (empty($searchTerm)) {
        $errors['searchTerm'] = "Field is required";
    } elseif (!ctype_alpha(str_replace(' ', '', $searchTerm))) {
        $errors['searchTerm'] = "Username can only contain letters.";
    }
    // Check if there are any errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../views/Admin page/admin.php?err=" . urlencode(json_encode($errors)));
        exit();
    }
    
    $sql_search = "SELECT * FROM donors WHERE name LIKE '%$searchTerm%' ORDER BY created_at DESC";
    $result_search = mysqli_query($conn, $sql_search);
}
?>
