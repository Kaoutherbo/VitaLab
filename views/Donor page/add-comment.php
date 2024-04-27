<?php
// Include necessary files and start session
@include "../../controllers/config.php";
@include "../../controllers/fetch_user.php";
@include '../../controllers/user/add-comment.php';

// Retrieve errors from the URL parameters
$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();

unset($_SESSION['errors']);

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
    <a href="../Home/Home Page.html" class="logo">
      <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
      <p>VitaLab</p>
    </a>
    <div id="container">
      <ul class="ulMenu">
        <li><a href="../Home/Home Page.html">Home</a></li>
        <li><a href="../Home/services.html">Services</a></li>
        <li><a href="../Home/About.php">About Us</a></li>
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

  <main class="comments">
    <section class="container comments-container">
        <article class="container-form">
            <h2>Comment the services!</h2>
            <!-- Updated form action attribute -->
            <form class="add-comment" name="add-comment" action="../../controllers/user/add-comment.php" method="post">
                <input type="hidden" name="donation_id" value="0">
                
                <div class="group-inputs">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="name" id="username" placeholder="Enter your Full name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
                        <?php if (!empty($errors['name'])) : ?>
                            <small class="error"><?php echo $errors['name']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="rating">Rate the services</label>
                        <select name="rating" id="rating" style="<?php echo (!empty($errors['rating']) ? 'border: 1.5px solid red;' : ''); ?>">
                            <option value="" disabled selected>Rate the services</option>
                            <option value="1" <?php echo (isset($_POST['rating']) && $_POST['rating'] == '1') ? 'selected' : ''; ?>>1</option>
                            <option value="2" <?php echo (isset($_POST['rating']) && $_POST['rating'] == '2') ? 'selected' : ''; ?>>2</option>
                            <option value="3" <?php echo (isset($_POST['rating']) && $_POST['rating'] == '3') ? 'selected' : ''; ?>>3</option>
                            <option value="4" <?php echo (isset($_POST['rating']) && $_POST['rating'] == '4') ? 'selected' : ''; ?>>4</option>
                            <option value="5" <?php echo (isset($_POST['rating']) && $_POST['rating'] == '5') ? 'selected' : ''; ?>>5</option>
                        </select>
                        <?php if (!empty($errors['rating'])) : ?>
                            <small class="error"><?php echo $errors['rating']; ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="group">
                    <label for="text">Add Comment</label>
                    <textarea name="comment" id="textarea" cols="30" rows="10" placeholder="Add Comment here .." style="<?php echo (!empty($errors['comment']) ? 'border: 1.5px solid red;' : ''); ?>"></textarea>
                    <?php if (!empty($errors['comment'])) : ?>
                        <small class="error"><?php echo $errors['comment']; ?></small>
                    <?php endif; ?>
                </div>

                <div>
                    <button type="submit" class="btn">Add Comment</button>
                </div>
            </form>
        </article>

        <!-- Welcome message article -->
        <article class="welcome-message comments-register">
            <div class="infos">
                <h2>Welcome to <b>VitaLab</b> Elevating Blood Donation!</h2>
                <p>Your commitment to blood donation can create a life-changing impact. Join our mission to ensure a steady supply of blood for those in need. Be part of our supportive community, where every donation matters and every act of giving can bring hope to someone's life.</p>
            </div>
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
                        <button type="submit"><a href="../../views/auth/updateProfile.php?id=<?php echo $row_user['id']; ?>">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>
    
<!-- Scripts -->
<script src="../../public/js/nav.js"></script>
<script src="../../public/js/profile.js"></script>

</body>

</html>