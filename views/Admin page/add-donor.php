<?php
session_start();
@include "../../controllers/config.php";
@include "../../controllers/admin/add-donor.php";

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
   <title>Add New Donor</title>
</head>

<body>
   <!-- main -->
   <main>
      <section class="container">

         <article class="container-form">
            <h2>Add Donor!</h2>
            <form action="" method="post">
               <div class="group-inputs">

                  <div>
                     <label for="username">Username</label>
                     <input type="text" name="name" id="username" placeholder="Enter the Full name" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
                     <?php if (!empty($errors['name'])) : ?>
                        <small class="error"><?php echo $errors['name']; ?></small>
                     <?php endif; ?>
                  </div>
                  <div>
                     <label for="image">Image</label>
                     <input type="text" name="profilePicture" id="Image" placeholder="Enter the profile image" />
                  </div>

                  <div>
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email" placeholder="Enter the email" style="<?php echo (!empty($errors['email']) ? 'border: 1.5px solid red;' : ''); ?>" />
                     <?php if (!empty($errors['email'])) : ?>
                        <small class="error"><?php echo $errors['email']; ?></small>
                     <?php endif; ?>
                  </div>
                  <div>
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" placeholder="Enter the password" style="<?php echo (!empty($errors['password']) ? 'border: 1.5px solid red;' : ''); ?>"/>
                     <?php if (!empty($errors['password'])) : ?>
                        <small class="error"><?php echo $errors['password']; ?></small>
                     <?php endif; ?>
                  </div>
                  <div>
                     <label for="address">Address</label>
                     <input type="text" name="address" id="address" placeholder="Enter the address" style="<?php echo (!empty($errors['address']) ? 'border: 1.5px solid red;' : ''); ?>"/>
                     <?php if (!empty($errors['address'])) : ?>
                        <small class="error"><?php echo $errors['address']; ?></small>
                     <?php endif; ?>
                  </div>

                  <div class="donate-options">
                     <label for="blood_group">Blood Group</label>
                     <select name="blood_group" id="blood_group" style="<?php echo (!empty($errors['blood_group']) ? 'border: 1.5px solid red;' : ''); ?>">
                        <option value="" selected disabled hidden>Select your blood group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
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
                  <button type="submit" name="submit">Save</button>
                  <button><a href="admin.php">Cancel</a></button>
               </div>

            </form>
         </article>
         <article class="welcome-message">
            <h2>Welcome, Lab Employee!</h2>
            <p>Add new donors to our Blood Donation Management System to help save lives. Your efforts in recruiting donors are invaluable and can make a significant difference in ensuring an adequate blood supply for those in need.</p>
            <img src="../../public/assets/images/add-donor.jpg" alt="Add Donor" width="390px" height="150px">
         </article>

      </section>
   </main>
</body>

</html>