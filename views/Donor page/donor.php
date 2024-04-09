<?php

@include '../../controllers/config.php';
@include '../../controllers/user/display_latest.php';
@include '../../controllers/user/submit_comment.php';
@include '../../controllers/user/fetch_donor_info.php';

// Check if the database connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


@include '../../controllers/user/display_comments.php';
$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);

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

    <!-- Donations Only the latest 3-->
    <section class="donations">

        <article class="news-welcome">
            <p>Welcome donor!</p>
            <strong>Discover <b>cutting-edge diagnostics</b> through donor-driven research!</strong>
        </article>
        <h2>Latest Donations</h2>

        <div>
            <?php
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
                echo '<strong>' . $donation['blood_type'] . '</strong>';
                echo '</div>';
                echo '<p>' . $donation['description'] . '</p>';
                echo '<button class="btn-donation"><a href="../auth/donatePage.php?id=' . $donation['id'] . '">Donate Now</a></button>';

                echo '</div>';
                echo '</div>';

                // Display comments for this donation
                echo '<div class="comments_rates">';
                echo '<h3>Comments</h3>';
                echo ' <div class="comments-contents">';
                if (isset($comments[$donation_id]) && count($comments[$donation_id]) > 0) {
                    // Display each comment
                    foreach ($comments[$donation_id] as $comment_row) {
                        echo '<div>';
                        echo '<div>';
                        echo '<div class="user">';
                        // Display donor's profile picture and name
                        echo '<img src="' . $comment_row['profilePicture'] . '" alt="Profile Picture" class="profilePicture">';
                        echo '<strong>' . $comment_row['name'] . '</strong>';
                        echo '</div>';

                        // Display rating
                        echo '<div class="rating">';
                        for ($i = 0; $i < $comment_row['rating']; $i++) {
                            echo '<img src="../../public/assets/images/Star_fill.png" alt="star" class="star" />';
                        }
                        echo '</div>';
                        echo '</div>';
                        // Display comment
                        echo '<p>' . $comment_row['comment'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    // No comments for this donation
                    echo '<p>No comments for this donation.</p>';
                }
                // Form for adding comments and rates
                echo '<form class="input-comments" action="../../controllers/user/submit_comment.php" method="post">';
                echo '<input type="hidden" name="donation_id" value="' . $donation_id . '">';
                echo '<input type="text" placeholder="Add comment..." name="comment-content">';
                echo '<div>';
                echo '<button type="submit" name="add-comment">Add comment</button>';
                echo '<select name="rating" id="rating">';
                echo '<option value="" disabled selected>Rates the service...</option>';
                echo '<option value="1">1</option>';
                echo '<option value="2">2</option>';
                echo '<option value="3">3</option>';
                echo '<option value="4">4</option>';
                echo '<option value="5">5</option>';
                echo '</select>';
                echo '</div>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
                echo '</article>';
            }
            ?>
        </div>

    </section>

    <!-- Donation History Section -->
    <section class="donation-history">
        <h2>Donation History</h2>
        <table>
            <thead>
                <tr>
                    <th>Name of Donation</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Blood Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $current_donor_id = $row_donor['id'];
                $query = "SELECT donations.* 
                FROM donation_records 
                INNER JOIN donations ON donation_records.donation_id = donations.id 
                WHERE donation_records.donor_id = $current_donor_id";

                $result = mysqli_query($conn, $query);

                // Check if there are any donations in the history
                if (mysqli_num_rows($result) > 0) {
                    // Fetch and display the donation history
                    while ($donation = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $donation['title'] . '</td>';
                        echo '<td>' . $donation['donation_date'] . '</td>';
                        echo '<td>' . $donation['donation_place'] . '</td>';
                        echo '<td>' . $donation['blood_type'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    // No donation history found for the current donor
                    echo '<tr><td colspan="4">No donation history found for the current donor.</td></tr>';
                }
                ?>
                
            </tbody>
        </table>
    </section>

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

    <!-- Footer -->
    <footer>
        <div class="footer-nav">
            <a href="./Home Page.html" class="logo">
                <img src="../../public/assets/images/Logo-donation.PNG" alt="VitaLab Logo" width="36px">
                <p>VitaLab</p>
            </a>
            <div class="social">
                <p>Our socials</p>
                <a href="#"><img src="../../public/assets/images/socials/icon-facebook.svg" alt="icon-facebook"></a>
                <a href="#"><img src="../../public/assets/images/socials/icon-twitter.svg" alt="icon-twitter"></a>
                <a href="#"><img src="../../public/assets/images/socials/icon-pinterest.svg" alt="icon-pinterest"></a>
                <a href="#"><img src="../../public/assets/images/socials/icon-instagram.svg" alt="icon-instagram"></a>
            </div>

        </div>

        <div class="end">
            <ul>
                <li><a href="./Home Page.html">Home</a></li>
                <li><a href="./services.html">Services</a></li>
                <li><a href="./About.html">About Us</a></li>
                <li><a href="news" name="donations">Donations</a></li>
                <li><a href="./Contact.html">Contact</a></li>
            </ul>
            <div>
                <input type="text" placeholder="Enter your email">
                <button>Subsecribe</button>
            </div>
        </div>
        <hr>
        <p>© 2024 VitaLab. All rights reserved.</p>
    </footer>

    <script src="../../public/js/nav.js"></script>
    <script src="../../public/js/donor.js"></script>
</body>

</html>