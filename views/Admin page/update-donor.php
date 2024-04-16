<?php
session_start();
@include "../../controllers/config.php";
@include "../../controllers/admin/update-donor.php";

$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../../public/styles/main.css">
   <link rel="stylesheet" href="../../public/styles/register.css">
   <title>Update Donor</title>
</head>

<body>

   <!-- main -->
   <main>
      <section class="container">
         <article class="welcome-message">
            <h2>Welcome, Lab Employee!</h2>
            <p>Update donor information in our Blood Donation Management System to ensure accurate records and continued support for those in need. Your attention to detail and dedication contribute to the success of our blood donation program.</p>
            <img src="../../public/assets/images/update-donor.jpg" alt="Update Donor" width="390px" height="160px">
         </article>


         <article class="container-form">
            <h2>Update Donor!</h2>
            <form action="update-donor.php?id=<?php echo $row['id'] ?>" method="post">
               <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
               <div class="group-inputs">

                  <div>
                     <label for="username">Username</label>
                     <input type="text" name="name" id="username" value="<?php echo $row['name'] ?>" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
                     <?php if (!empty($errors['name'])) : ?>
                        <small class="error"><?php echo $errors['name']; ?></small>
                     <?php endif; ?>
                  </div>
                  <div>
                     <label for="image">Image</label>
                     <input type="text" name="profilePicture" id="Image" value="<?php echo $row['profilePicture'] ?>" />
                  </div>

                  <div>
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" style="<?php echo (!empty($errors['email']) ? 'border: 1.5px solid red;' : ''); ?>" />
                     <?php if (!empty($errors['email'])) : ?>
                        <small class="error"><?php echo $errors['email']; ?></small>
                     <?php endif; ?>
                  </div>

                  <div>
                     <label for="address">Address</label>
                     <input type="address" name="address" id="address" value="<?php echo $row['address'] ?>" style="<?php echo (!empty($errors['address']) ? 'border: 1.5px solid red;' : ''); ?>"/>
                     <?php if (!empty($errors['address'])) : ?>
                        <small class="error"><?php echo $errors['address']; ?></small>
                     <?php endif; ?>
                  </div>

                  <div class="date">
                     <label class="form-label">Last Donation Date:</label>
                     <input type="date" name="last_donation_date" value="<?php echo $row['last_donation_date'] ?>" style="<?php echo (!empty($errors['last_donation_date']) ? 'border: 1.5px solid red;' : ''); ?>">
                     <?php if (!empty($errors['last_donation_date'])) : ?>
                        <small class="error"><?php echo $errors['last_donation_date']; ?></small>
                     <?php endif; ?>
                  </div>

                  <div class="last">
                     <label for="role">Blood Type</label>
                     <select name="blood_group" id="blood_group" style="<?php echo (!empty($errors['blood_group']) ? 'border: 1.5px solid red;' : ''); ?>">
                        <option value="" disabled selected>Select Blood Type...</option>
                        <option value="O+" <?php if ($row['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                        <option value="A+" <?php if ($row['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                        <option value="B+" <?php if ($row['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                        <option value="AB+" <?php if ($row['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                        <option value="O-" <?php if ($row['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                        <option value="A-" <?php if ($row['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                        <option value="B-" <?php if ($row['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                        <option value="AB-" <?php if ($row['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                     </select>
                     <?php if (!empty($errors['blood_group'])) : ?>
                        <small class="error"><?php echo $errors['blood_group']; ?></small>
                     <?php endif; ?>
                  </div>

               </div>
               <?php if (!empty($errors['general'])) : ?>
                        <small class="error"><?php echo $errors['general']; ?></small>
                     <?php endif; ?>

               <div class="group-btns">
                  <button type="submit" name="submit">Update</button>
                  <button><a href="admin.php">Cancel</a></button>
               </div>

            </form>
         </article>

      </section>
   </main>


</body>

</html>