<?php
@include "../../controllers/config.php";
@include "../../controllers/fetch_user.php";
$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']); // clean up the session
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
  <!-- Icons link -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <!-- Styles link -->
  <link rel="stylesheet" href="../../public/styles/main.css">
  <link rel="stylesheet" href="../../public/styles/register.css">
  <link rel="stylesheet" href="../../public/styles/donor.css">

  <title>Add comment</title>
</head>

<body>
  <!-- Navigation Bar -->
  <nav>
        <a href="./Home Page.html" class="logo">
            <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
            <p>VitaLab</p>
        </a>
        <div id="container">
            <ul class="ulMenu">
                <li><a href="../Home/Home Page.html">Home</a></li>
                <li><a href="../Home/services.html">Services</a></li>
                <li><a href="../Home/About.html">About Us</a></li>
                <li><a href="./display_donations.php">Donations</a></li>
                <li><a href="../Home/Contact.html">Contact</a></li>
            </ul>
            <a href="#" class="profile" id="profilePicture">
                <img src="<?php echo $row_user['profilePicture']; ?>" alt="Profile Picture">
            </a>
            <span class="material-symbols-outlined hamburger">menu</span>
            <span class="material-symbols-outlined closeIcone">close</span>

        </div>
    </nav>

  <!-- main -->
  <main class="login">

    <section class="container login-container">
      <article class="container-form">
        <h2>Comment the services!</h2>
        <form action="../../controllers/user/submit_comment.php" method="post">
          <div class="group-inputs">
            <div>
              <label for="username">Username</label>
              <input type="text" name="name" id="username" placeholder="Enter your Full name"  style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>"/>
              <?php if (!empty($errors['name'])) : ?>
                <small class="error"><?php echo $errors['name']; ?></small>
              <?php endif; ?>
            </div>
            
            <div>
                  <label for="rating">Rate the services</label>
                  <select name="rating" id="rating" style="<?php echo (!empty($errors['rating']) ? 'border: 1.5px solid red;' : ''); ?>">
                     <option value="" selected disabled hidden>Rate the services</option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                  </select>
                  <?php if (!empty($errors['rating'])) : ?>
                     <small class="error"><?php echo $errors['rating']; ?></small>
                  <?php endif; ?>
               </div>

               <div>
                  <label for="text">Add Comment</label>
                  <textarea name="comment" id="textarea" cols="30" rows="10" placeholder="Add Comment here .." style="<?php echo (!empty($errors['comment']) ? 'border: 1.5px solid red;' : ''); ?>"></textarea>
                  <?php if (!empty($errors['comment'])) : ?>
                     <small class="error" ><?php echo $errors['comment']; ?></small>
                  <?php endif; ?>
               </div>
            

          <div>
            <button type="submit" class="btn">Add Comment</button>
          </div>

        </form>
      </article>
      <article class="welcome-message login-welcome">
        <div class="infos">
        <h2>Welcome to <b>Vitalab Laboratory</b> Your Partner in Blood Donation Management!</h2>
                    
        <p>Join us in saving lives by donating blood. Your contribution can make a significant difference in someone's life. Together, we can ensure that hospitals have an adequate blood supply to help those in need.</p>

        </div>
      </article>
    </section>

     <!-- for the profile section-->
     <section class="account" id="accountSection">
        <div class="container">
            <span class="material-symbols-outlined closeBtn" id="closeBtn">close</span>

            <div class="infos">
                <div>
                    <img src="<?php echo $row_user['profilePicture']; ?>" alt="Profile Picture">
                </div>

                <div>
                    <h2><span class="material-symbols-outlined">Person</span> Username</h2>
                    <p><?php echo $row_user['name']; ?></p>
                    <h2><span class="material-symbols-outlined">Mail</span>Email</h2>
                    <p><?php echo $row_user['email']; ?></p>
                    <h2><span class="material-symbols-outlined">location_on</span>Address</h2>
                    <p><?php echo $row_user['address']; ?></p>
                    <div class="secondary_info">
                        <div>
                            <h2><span class="material-symbols-outlined">relax</span>Blood Group</h2>
                            <p><?php echo $row_user['blood_group']; ?></p>

                        </div>
                        <div>
                            <h2><span class="material-symbols-outlined">admin_panel_settings</span>Role</h2>
                            <p><?php echo $row_user['role']; ?></p>
                        </div>
                    </div>

                    <div class="btns2">
                        <button class="logout">
                            <a href="../../controllers/auth/logout.php">
                                <i class="bx"><span class="material-symbols-outlined">logout</span></i>
                            </a>
                        </button>
                        <button type="submit"><a href="../../views/auth/updateProfile.php?id=<?php echo $row_user['id']; ?>" class="button">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>

  </main>
  <script src="../../public/js/nav.js"></script>
    <script src="../../public/js/donor.js"></script>
</body>

</html>