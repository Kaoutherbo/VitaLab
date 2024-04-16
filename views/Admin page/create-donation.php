<?php
@include '../../controllers/config.php';
@include "../../controllers/admin/fetch_donor_info.php";
@include '../../controllers/admin/create-donation.php';

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
   <link rel="stylesheet" href="../../public/styles/styles.css">
   <link rel="stylesheet" href="../../public/styles/Donates.css">
   <link rel="stylesheet" href="../../public/styles/main.css">
   <title>Create a donation</title>
</head>

<body>
   <!-- main -->
   <main class="create-donation">

      <div>
         <article class="right">
            <h3>Organize a Donation Campaign</h3>
            <p>Create a donation event, raise awareness, and inspire others to participate. Together, let's ensure a steady supply of blood for those in need.</p>
            <img src="../../public/assets/images/hand.png" alt="Create a Donation Campaign" width="300px" height="250px">
         </article>

         <article class="left">
            <h3>Create a Donation</h3>
            <form action="#" method="post">
               <div>
                  <div class="group">
                     <label for="text">Date</label>
                     <input type="date" name="date" placeholder="Date" style="<?php echo (!empty($errors['date']) ? 'border: 1.5px solid red;' : ''); ?>">
                     <?php if (!empty($errors['date'])) : ?>
                        <small class="error"><?php echo $errors['date']; ?></small>
                     <?php endif; ?>
                  </div>
                  <div class="group">
                     <label for="text">Location</label>
                     <input type="text" name="location" placeholder="Location" style="<?php echo (!empty($errors['location']) ? 'border: 1.5px solid red;' : ''); ?>">
                     <?php if (!empty($errors['location'])) : ?>
                        <small class="error"><?php echo $errors['location']; ?></small>
                     <?php endif; ?>
                  </div>
               </div>
               <div>
                  <div class="group">
                     <label for="text">Image URL</label>
                     <input type="text" name="donation_image" placeholder="Image">
                  </div>
                  <div class="group">
                     <label for="text">Title</label>
                     <input type="text" name="title" placeholder="Title" style="<?php echo (!empty($errors['title']) ? 'border: 1.5px solid red;' : ''); ?>">
                     <?php if (!empty($errors['title'])) : ?>
                        <small class="error"><?php echo $errors['title']; ?></small>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="group">
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

               <div class="group">
                  <label for="text">Description</label>
                  <textarea name="description" id="textarea" cols="30" rows="10" placeholder="Add Description here .." style="<?php echo (!empty($errors['description']) ? 'border: 1.5px solid red;' : ''); ?>"></textarea>
                  <?php if (!empty($errors['description'])) : ?>
                     <small class="error" ><?php echo $errors['description']; ?></small>
                  <?php endif; ?>
               </div>
               <input type="hidden" name="lab_employee_id" value="<?php echo $row_admin['id']; ?>">
               <button type="submit" name="submit">Submit</button>
            </form>

         </article>

      </div>
   </main>


</body>

</html>