<?php
session_start();
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

  <title>Login</title>
</head>

<body>
  <!-- Navigation Bar -->
  <nav>
    <a href="../Home/Home Page.html" class="logo">
      <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
      <p>VitaLab</p>
    </a>
    <ul class="ulMenu">
      <li><a href="../Home/Home Page.html">Home</a></li>
      <li><a href="../Home/services.html">Services</a></li>
      <li><a href="../Home/About.php">About Us</a></li>
      <li><a href="../Home/Privacy.html">Privacy Policy</a></li>
      <li><a href="../Home/Contact.html">Contact</a></li>
    </ul>
    <span class="material-symbols-outlined hamburger">menu</span>
    <span class="material-symbols-outlined closeIcone">close</span>
  </nav>

  <!-- main -->
  <main class="login">
   <section class="container login-container">
      <article class="container-form">
        <h2>Login now!</h2>
        <form action="../../controllers/auth/login.php" method="post">
          <div class="group-inputs">
            <div>
              <label for="username">Username</label>
              <input type="text" name="name" id="username" placeholder="Enter your Full name" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['name'])) : ?>
                <small class="error"><?php echo $errors['name']; ?></small>
              <?php endif; ?>
            </div>
            <div>
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="Enter your password" style="<?php echo (!empty($errors['password']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['password'])) : ?>
                <small class="error"><?php echo $errors['password']; ?></small>
              <?php endif; ?>
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" name="email" id="email" placeholder="Enter your email" style="<?php echo (!empty($errors['email']) ? 'border: 1.5px solid red;' : ''); ?>" />
              <?php if (!empty($errors['email'])) : ?>
                <small class="error"><?php echo $errors['email']; ?></small>
              <?php endif; ?>
            </div>
            <div>
              <label for="role">Role</label>
              <select name="role" id="role" aria-placeholder="Select a role..." style="<?php echo (!empty($errors['role']) ? 'border: 1.5px solid red;' : ''); ?>">
                <option value="" selected disabled hidden>Select your role....</option>
                <option value="donor">Donor</option>
                <option value="lab_employee">Admin</option>
              </select>
              <?php if (!empty($errors['role'])) : ?>
                <small class="error"><?php echo $errors['role']; ?></small>
              <?php endif; ?>
            </div>
          </div>

          <div>
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="./register.php">Sign up</a> </p>
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

  </main>
  <script src="../../public/js/nav.js"></script>
</body>

</html>