<?php
include "../../controllers/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $profilePicture = $_POST['profilePicture'];
    $last_donation_date = $_POST['last_donation_date'];

    // Prepare the SQL statement
    $sql = "UPDATE `donors` SET `name`='$name', `blood_type`='$blood_type', `contact_number`='$contact_number', `email`='$email', `address`='$address', `profilePicture`='$profilePicture', `last_donation_date`='$last_donation_date' WHERE id = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

// Check if the 'id' parameter is provided in the URL
if (isset($_GET["id"])) {
    // Retrieve the donor information from the database based on the provided 'id'
    $id = $_GET["id"];
    $sql = "SELECT * FROM `donors` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // Check if a donor with the provided 'id' exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the donor information
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle the case where no donor with the provided 'id' is found
        echo "No donor found with the provided ID";
        exit();
    }
} else {
    // Handle the case where the 'id' parameter is not provided in the URL
    echo "No ID provided";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        PHP Complete CRUD Application
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Donor Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Blood Type:</label>
                    <input type="text" class="form-control" name="blood_type" value="<?php echo $row['blood_type'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Number:</label>
                    <input type="text" class="form-control" name="contact_number" value="<?php echo $row['contact_number'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Profile Picture:</label>
                    <input type="text" class="form-control" name="profilePicture" value="<?php echo $row['profilePicture'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Donation Date:</label>
                    <input type="date" class="form-control" name="last_donation_date" value="<?php echo $row['last_donation_date'] ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+
    Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
    
    </html>
    