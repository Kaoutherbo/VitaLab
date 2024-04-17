<?php
session_start();
@include '../../controllers/config.php';
@include '../../controllers/user/display_donations.php';
@include '../../controllers/user/submit_comment.php';
@include '../../controllers/fetch_user.php';

// Check if the database connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

@include '../../controllers/user/display_comments.php';


$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);
// Get the error ID from the URL parameters
$errorId = isset($_GET['id']) ? $_GET['id'] : null;

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor page</title>
    <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png">
    <!-- Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Styles link -->
    <link rel="stylesheet" href="../../public/styles/styles.css">
    <link rel="stylesheet" href="../../public/styles/main.css">
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
                <li><a href="<?php echo $row_user['role'] == 'admin' ? '../Admin page/admin.php' : '../Donor page/donor.php'; ?>">Dashboard</a></li>
                <li><a href="?all_donations">All Donations</a></li>
                <li><a href="./add-comment.php">Add Comment</a></li>
            </ul>
            <a href="#" class="profile" id="profilePicture">
                <img src="<?php echo $row_user['profilePicture']; ?>" alt="Profile Picture">
            </a>
            <span class="material-symbols-outlined hamburger">menu</span>
            <span class="material-symbols-outlined closeIcone">close</span>
        </div>
    </nav>

    <!-- Donations-->
    <section class="donations All-donations">
    <h2>Search about donation</h2>
        <form method="POST" id="searchForm">
            <div class="" group-inputs>
                <label for="start_date">Start Date:</label>
                <input type="date" name="startDate" id="startDate" style="<?php echo (!empty($errors['start_date']) ? 'border: 1.5px solid red;' : ''); ?>">
                <?php if (!empty($errors['start_date'])) : ?>
                    <small class="error"><?php echo $errors['start_date']; ?></small>
                <?php endif; ?>
            </div>
            <div class="" group-inputs>
                <label for="end_date">End Date:</label>
                <input type="date" name="endDate" id="endDate" style="<?php echo (!empty($errors['end_date']) ? 'border: 1.5px solid red;' : ''); ?>">
                <?php if (!empty($errors['end_date'])) : ?>
                    <small class="error"><?php echo $errors['end_date']; ?></small>
                <?php endif; ?>
            </div>

            <div class="last">
                <label for="blood_group">Blood Group</label>
                <select name="blood_group" id="blood_group" style="<?php echo (!empty($errors['blood_group']) ? 'border: 1.5px solid red;' : ''); ?>" >
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
            <button type="submit" name="search">Search</button>
        </form>

        <div>
            <?php
            if (empty($donations)) {
                echo '<p class="emptyDonation">No donation found.</p>';
            } else {
                // Display donations
                foreach ($donations as $donation_id => $donation) {
                    // Display donation information
                    echo '<article>';
                    echo '<div class="donation-content">';
                    // Display donation details
                    echo '<img src="' . $donation['donation_image'] . '" alt="News 1">';
                    echo '<div>';
                    echo '<div>';
                    echo '<p><span class="material-symbols-outlined">schedule</span>' . $donation['donation_date'] . '</p>';
                    echo '<p><span class="material-symbols-outlined">location_on</span>' . $donation['donation_place'] . '</p>';
                    echo '</div>';
                    echo '<div class="title-bld">';
                    echo '<h3>' . $donation['title'] . '</h3>';
                    echo '<strong>' . $donation['blood_group'] . '</strong>';
                    echo '</div>';
                    echo '<p>' . $donation['description'] . '</p>';
                    echo '<button class="btn-donation"><a href="../auth/donatePage.php?id=' . $donation['id'] . '">Donate Now</a></button>';
                    echo '</div>';
                    echo '</div>';

                    
                    echo '</article>';
                }
            }
            ?>
        </div>

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


    <!-- Scripts -->
    <script src="../../public/js/nav.js"></script>
    <script src="../../public/js/donor.js"></script>
</body>

</html>