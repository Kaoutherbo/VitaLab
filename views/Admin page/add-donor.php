<?php
include "../../controllers/config.php";

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $profilePicture = $_POST['profilePicture'];
    $last_donation_date = $_POST['last_donation_date'];

    // Check if the user already exists
    $existing_user_query = "SELECT * FROM donors WHERE name='$name'";
    $existing_user_result = mysqli_query($conn, $existing_user_query);
    if (mysqli_num_rows($existing_user_result) > 0) {
        echo "User already exists.";
        exit(); // Stop execution if user already exists
    }

    // Generating current timestamp for created_at and updated_at fields
    $created_at = date("Y-m-d  H:i:s");
    $updated_at = $created_at;
   // Hash the password before saving it in the database
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `donors` (`name`, `blood_type`, `contact_number`, `email`, `password`, `address`, `profilePicture`, `last_donation_date`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $name, $blood_type, $contact_number, $email, $hashed_password, $address, $profilePicture, $last_donation_date, $created_at, $updated_at);

    if ($stmt->execute()) {
        header("Location: admin.php?msg=New record created successfully");
        exit();
    } else {
        echo "Failed: " . $conn->error;
    }
    $stmt->close();
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

   <title>Add New Donor</title>
</head>

<body>
   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Donor</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
   <div class="mb-3">
      <label class="form-label">Full Name:</label>
      <input type="text" class="form-control" name="name" placeholder="John Doe">
   </div>

   <div class="mb-3">
      <label class="form-label">Blood Type:</label>
      <input type="text" class="form-control" name="blood_type" placeholder="A+">
   </div>

   <div class="mb-3">
      <label class="form-label">Contact Number:</label>
      <input type="text" class="form-control" name="contact_number" placeholder="1234567890">
   </div>

   <div class="mb-3">
      <label class="form-label">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
   </div>
    <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

   <div class="mb-3">
      <label class="form-label">Address:</label>
      <input type="text" class="form-control" name="address" placeholder="123 Main St, City, Country">
   </div>

   <div class="mb-3">
      <label class="form-label">Profile Picture URL:</label>
      <input type="text" class="form-control" name="profilePicture" placeholder="http://example.com/profile.jpg">
   </div>

   <div class="mb-3">
      <label class="form-label">Last Donation Date:</label>
      <input type="date" class="form-control" name="last_donation_date">
   </div>

   <div>
      <button type="submit" class="btn btn-success" name="submit">Save</button>
      <a href="LabEmployee.html" class="btn btn-danger">Cancel</a>
   </div>
</form>

      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>