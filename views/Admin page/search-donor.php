<?php
include "../../controllers/config.php";


// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_term"])) {
    $search_term = $_POST["search_term"];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `donors` WHERE name LIKE ? OR blood_type LIKE ? OR contact_number LIKE ? OR email LIKE ? OR address LIKE ?");
    $search_term = '%' . $search_term . '%'; // Add wildcard '%' to search for partial matches
    $stmt->bind_param("sssss", $search_term, $search_term, $search_term, $search_term, $search_term);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['name']}</p>";
        }
    } else {
        echo "<p>No donors found matching the search criteria.</p>";
    }

    $stmt->close(); // Close prepared statement
}
?>

<!-- Display searched donors -->
<?php
// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_term"])) {
    $search_term = $_POST["search_term"];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `donors` WHERE name LIKE ? OR blood_type LIKE ? OR contact_number LIKE ? OR email LIKE ? OR address LIKE ?");
    $search_term = '%' . $search_term . '%'; // Add wildcard '%' to search for partial matches
    $stmt->bind_param("sssss", $search_term, $search_term, $search_term, $search_term, $search_term);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr><th>Name</th><th>Date of Registration</th><th>Blood type</th><th>Status</th><th>Action</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            // Display donor information in a table row
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "<td>{$row['blood_type']}</td>";
            echo "<td><span class='status completed'>Completed</span></td>";
            echo "<td>";
            // Update button
            echo "<a href='update-donor.php?name={$row['name']}' class='status completed'>Update</a>";
            // Delete button
            echo "<a href='delete-donor.php?name={$row['name']}' class='status completed'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No donors found matching the search criteria.</p>";
    }

    $stmt->close(); // Close prepared statement
}
?>
