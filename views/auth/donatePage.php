<?php
session_start();
@include '../../controllers/config.php';
@include '../../controllers/user/fetch_donor_info.php';

$donation_id = $_GET['id'];

$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']); // clean up the session
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
        <img src="<?php echo $row_donor['profilePicture']; ?>" alt="Profile Picture">
      </a>
      <span class="material-symbols-outlined hamburger">menu</span>
      <span class="material-symbols-outlined closeIcone">close</span>

    </div>
  </nav>

  <!-- main -->
  <main>

    <section class="container">
      <article class="welcome-message">
        <h2 class="donate-title">Welcome to the Blood Donation Registration!</h2>
        <p>Your donation can save lives. Register now to become a blood donor and make a difference in someone's life.</p>
        <img src="../../public/assets/images/give_blood2.png" alt="" width="380px" height="170px">
      </article>
      <article class="container-form">
        <h2>Register for Donation</h2>
        <form action="../../controllers/auth/register_donation.php?id=<?php echo $donation_id; ?>" method="post">
          <input name="donation_id" value="<?php echo $donation_id; ?>" type="hidden">
          <input name="donor_id" value="<?php echo $row_donor['name']; ?>" type="hidden">
          <div class="group-inputs">
            <div>
              <label for="username">Full Name</label>
              <input type="text" name="username" id="username" placeholder="Enter your Full name" />
              <?php if (!empty($errors['name'])) : ?>
                <small class="error"><?php echo $errors['name']; ?></small>
              <?php endif; ?>
            </div>
            <div>
              <label for="tel">Phone</label>
              <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" />
              <?php if (!empty($errors['phone'])) : ?>
                <small class="error"><?php echo $errors['phone']; ?></small>
              <?php endif; ?>
            </div>
            <div>
              <label for="number">Age</label>
              <input type="number" name="age" id="age" placeholder="Enter your age" />
              <?php if (!empty($errors['age'])) : ?>
                <small class="error"><?php echo $errors['age']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="number">Weight</label>
              <input type="number" name="weight" id="weight" placeholder="Enter your weight" />
              <?php if (!empty($errors['weight'])) : ?>
                <small class="error"><?php echo $errors['weight']; ?></small>
              <?php endif; ?>
            </div>

            <div>
              <label for="text">Health</label>
              <select name="health" id="health">
                <option value="" selected disabled hidden>Do you have any diseases?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <?php if (!empty($errors['health'])) : ?>
                <small class="error"><?php echo $errors['health']; ?></small>
              <?php endif; ?>
            </div>

            <div class="donate-options">
              <label for="gender">Gender</label>
              <select name="gender" id="gender">
                <option value="" selected disabled hidden>Select your Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <?php if (!empty($errors['gender'])) : ?>
                <small class="error"><?php echo $errors['gender']; ?></small>
              <?php endif; ?>
            </div>

          </div>
          <div>
            <?php if (!empty($errors['general'])) : ?>
              <small class="error"><?php echo $errors['general']; ?></small>
            <?php endif; ?>

            <div class="group-btns">
              <button type="submit" name="submit">Donate</button>
              <button><a href="../../views/Donor page/donor.php">Cancel</a></button>
            </div>
          </div>
        </form>
      </article>
    </section>

  </main>
  <!-- Account -->
  <section class="account" id="accountSection">
    <div class="container">

      <div>
        <span class="material-symbols-outlined closeBtn" id="closeBtn">close</span>
        <img src="<?php echo $row_donor['profilePicture']; ?>" alt="Profile Picture">
      </div>

      <h3>Username</h3>
      <p><?php echo $row_donor['name']; ?></p>
      <h3>Email</h3>
      <p><?php echo $row_donor['email']; ?></p>
      <h3>Address</h3>
      <p><?php echo $row_donor['address']; ?></p>
      <div class="btns2">
        <button class="logout">
          <a href="../../controllers/auth/logout.php">
            <i class="bx"><span class="material-symbols-outlined">logout</span></i>
          </a>
        </button>
        <button type="submit"><a href="/updateAccount"><span class="material-symbols-outlined">edit</span></a></button>
      </div>
    </div>
  </section>

  <script src="../../public/js/nav.js"></script>
  <script src="../../public/js/donor.js"></script>
</body>

</html>