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

    <title>Register</title>
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
            <li><a href="../Home/About.html">About Us</a></li>
            <li><a href="../Home/News.html">Our News</a></li>
            <li><a href="../Home/Contact.html">Contact</a></li>
        </ul>
        <span class="material-symbols-outlined hamburger">menu</span>
        <span class="material-symbols-outlined closeIcone">close</span>
    </nav>

    <!-- main -->
    <main>
        <section class="container">
            <article class="welcome-message register-welcome">
                <div class="infos">
                    <h2>Welcome to <b>Vitalab Laboratory</b> Your Partner in Blood Donation Management!</h2>
                    
                    <p>
                        Whether you are a first-time donor or a regular participant, your generosity and commitment to helping others are greatly appreciated. Join us in our efforts to make a lasting difference in our community and beyond.
                    </p>
                </div>
            </article>
            <article class="container-form">
                <h2>Register now!</h2>
                <form action="../../controllers/auth/register.php" method="post">
                    <div class="group-inputs">

                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="name" id="username" placeholder="Enter your Full name" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['name'])) : ?>
                                <small class="error"><?php echo $errors['name']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="image">Profile Picture</label>
                            <input type="text" name="profilePicture" id="profilePicture" placeholder="Enter your profile image" />
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" style="<?php echo (!empty($errors['email']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['email'])) : ?>
                                <small class="error"><?php echo $errors['email']; ?></small>
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
                            <label for="Address">Address</label>
                            <input type="text" name="Address" id="address" placeholder="Enter your address" style="<?php echo (!empty($errors['address']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['address'])) : ?>
                                <small class="error"><?php echo $errors['address']; ?></small>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="role">Role</label>
                            <select name="role" id="role" style="<?php echo (!empty($errors['role']) ? 'border: 1.5px solid red;' : ''); ?>">
                                <option value="" selected disabled hidden>Select your role....</option>
                                <option value="donor">Donor</option>
                                <option value="lab_employee">Admin</option>
                            </select>
                            <?php if (!empty($errors['role'])) : ?>
                                <small class="error"><?php echo $errors['role']; ?></small>
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
                        <div>
                            <label for="tel">Phone</label>
                            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" style="<?php echo (!empty($errors['phone']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['phone'])) : ?>
                                <small class="error"><?php echo $errors['phone']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn">Register</button>
                        <p>Already have an account? <a href="./login.php">Log in</a></p>
                    </div>

                </form>
            </article>
        </section>
    </main>
    <script src="../../public/js/nav.js"></script>
</body>

</html>