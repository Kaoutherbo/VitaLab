<?php
session_start();
@include '../../controllers/config.php';
@include '../../controllers/fetch_user.php';


$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donate</title>
  <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- Icons link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
  <link rel="stylesheet" href="../../public/styles/main.css">
  <link rel="stylesheet" href="../../public/styles/register.css">
  <link rel="stylesheet" href="../../public/styles/donor.css">
</head>

<body>
  <!-- Navigation Bar -->
  <nav>
    <a href="../../Home/Home Page.html" class="logo">
      <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
      <p>VitaLab</p>
    </a>
    <div id="container">
      <ul class="ulMenu">
        <li><a href="../Home/Home Page.html">Home</a></li>
        <li><a href="../Home/services.html">Services</a></li>
        <li><a href="../Home/About.php">About Us</a></li>
        <li><a href="../Home/Privacy.html">Privacy Policy</a></li>
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
  <main>
    <section class="container">
      <article class="welcome-message register-donation">
        <div class="info">
          <h2 class="donate-title">Join Our <b>Life-Saving</b> Blood Donation Initiative!</h2>
          <p>Your choice to donate blood can save lives and offer hope to those in need. Join a compassionate community making a significant impact. Each donation can change a life, providing a path to recovery and a brighter future. Register now to become a blood donor and be a hero to others.</p>
        </div>
      </article>


      <article class="container-form">
        <h2>Register for Donation</h2>
        <form action="../../controllers/auth/register_donation_admin.php" method="post">
          <div class="group-inputs">
            <div>
              <label for="numer">Donor ID</label>
              <input type="number" name="donor_id" id="donor_id" placeholder="Enter your Full name" style="<?php echo (!empty($errors['donor_id']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['donor_id'])) : ?>
                <small class="error"><?php echo $errors['donor_id']; ?></small>
              <?php endif; ?>
            </div>
            
            <div>
              <label for="number">Donation ID</label>
              <input type="number" name="donation_id" id="donation" placeholder="Enter the id of the donation" style="<?php echo (!empty($errors['donation']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['donation'])) : ?>
                <small class="error"><?php echo $errors['donation']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="tel">Phone</label>
              <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" style="<?php echo (!empty($errors['phone']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['phone'])) : ?>
                <small class="error"><?php echo $errors['phone']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="number">Weight</label>
              <input type="number" name="weight" id="weight" placeholder="Enter your weight" style="<?php echo (!empty($errors['weight']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['weight'])) : ?>
                <small class="error"><?php echo $errors['weight']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="text">Health</label>
              <select name="health" id="health" style="<?php echo (!empty($errors['health']) ? 'border: 1.5px solid red;' : ''); ?>">
                <option value="" selected disabled hidden>Do you have any diseases?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <?php if (!empty($errors['health'])) : ?>
                <small class="error"><?php echo $errors['health']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="blood_volume">Blood Volume (in ml)</label>
              <input type="number" name="blood_volume" id="blood_volume" placeholder="Enter your blood volume (in ml)" style="<?php echo (!empty($errors['blood_volume']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['blood_volume'])) : ?>
                <small class="error"><?php echo $errors['blood_volume']; ?></small>
              <?php endif; ?>
            </div>


          </div>
          <div>
            <?php if (!empty($errors['general'])) : ?>
              <small class="error"><?php echo $errors['general']; ?></small>
            <?php endif; ?>

            <div class="group-btns">
              <button type="submit" name="submit">Donate</button>
              <button><a href="../../views/Admin page/admin.php">Cancel</a></button>
            </div>
          </div>
        </form>
      </article>
    </section>

  </main>

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

  <script src="../../public/js/nav.js"></script>
  <script src="../../public/js/profile.js"></script>
</body>

</html>