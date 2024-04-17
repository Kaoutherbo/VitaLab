<?php

@include '../../controllers/config.php';
@include '../../controllers/user/display_latest.php';
@include '../../controllers/user/add-comment.php';
@include '../../controllers/fetch_user.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


@include '../../controllers/user/display_comments.php';

$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);

$errorId = isset($_GET['id']) ? $_GET['id'] : null;

$currentDonorId = $row_user['id'];

$sql = "SELECT d.donation_date, SUM(dr.blood_volume) AS total_blood_volume
FROM donations d
JOIN donation_records dr ON d.id = dr.donation_id
JOIN donors do ON dr.donor_id = do.id
WHERE do.id = $currentDonorId
GROUP BY d.donation_date
ORDER BY d.donation_date ASC
";

$result = mysqli_query($conn, $sql);

$donationData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = $row['donation_date'];
        $total_volume = $row['total_blood_volume'];
        $donationData[] = "['$date', $total_volume]";
    }
}

$donationDataJS = implode(',', $donationData);


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

    <!--Draw the charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Metric', 'Value'],
                ['Blood Pressure', 20],
                ['Heart Rate', 15],
                ['Cholesterol', 30],
                ['Hemoglobin', 35]
            ]);

            var options = {
                title: 'Donor Health Information',
                backgroundColor: '#FED5D5',
                chartArea: {
                    width: '75%',
                    height: '75%'

                },
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('healthChart'));

            chart.draw(data, options);
        }
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var data = google.visualization.arrayToDataTable([
                ['Donation Date', 'Total Blood Volume'],
                <?php echo $donationDataJS; ?>
            ]);

            var options = {
                title: 'Donor Blood Volume Over Time',
                backgroundColor: '#FED5D5',
                vAxis: {
                    title: 'Total Blood Volume'
                },
                hAxis: {
                    title: 'Donation Date'
                },
                seriesType: 'bars',
                series: {
                    0: {
                        type: 'bars',
                        color: '#1ECB2D'
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('comboChart'));
            chart.draw(data, options);
        }
    </script>


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

    <!-- Donations Only the latest 3-->
    <section class="donations">

        <article class="news-welcome">
            <p>Welcome donor!</p>
            <strong>Discover <b>cutting-edge diagnostics</b> through donor-driven research!</strong>
        </article>
        <h2>Latest Donations</h2>

        <div>
            <?php
            if (empty($donations)) {
                echo '<p class="emptyDonation">No donation found.</p>';
            } else {
                // Display donations
                foreach ($donations as $donation_id => $donation) {
                    
                    echo '<article>';
                    echo '<div class="donation-content">';
                    
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

                    // Display comments for this donation
                    echo '<div class="comments_rates">';
                    echo '<h3>Comments</h3>';
                    echo ' <div class="comments-contents">';
                    if (isset($comments[$donation_id]) && count($comments[$donation_id]) > 0) {
                        
                        foreach ($comments[$donation_id] as $comment_row) {
                            echo '<div>';
                            echo '<div>';
                            echo '<div class="user">';
                           
                            echo '<img src="' . $comment_row['profilePicture'] . '" alt="Profile Picture" class="profilePicture">';
                            echo '<strong>' . $comment_row['name'] . '</strong>';
                            echo '</div>';

                        
                            echo '<div class="rating">';
                            for ($i = 0; $i < $comment_row['rating']; $i++) {
                                echo '<img src="../../public/assets/images/Star_fill.png" alt="star" class="star" />';
                            }
                            echo '</div>';
                            echo '</div>';
                            
                            echo '<p>' . $comment_row['comment'] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No comments for this donation.</p>';
                    }
                    echo '<form class="input-comments" action="../../controllers/user/add-comment.php" method="post">';
                    echo '<input type="hidden" name="name" value="' . $row_user['name'] . '">';
                    echo '<input type="hidden" name="donation_id" value="' . $donation_id . '">';
                    echo '<input type="text" placeholder="Add comment..." name="comment" style="';
                    if ($errorId == $donation_id && !empty($errors['comment'])) {
                        echo 'border: 1.5px solid red;';
                    }
                    echo '">';

                    if ($errorId == $donation_id && !empty($errors['comment'])) {
                        echo '<small class="error" style="position: absolute; bottom: 0; left: 10px; margin: 0 0 -1.1rem 0">' . $errors['comment'] . '</small>';
                    }
                    echo '<div>';
                    echo '<button type="submit" name="add-comment">Add comment</button>';
                    echo '<select name="rating" id="rating" style="';
                    if ($errorId == $donation_id && !empty($errors['rating'])) {
                        echo 'border: 1.5px solid red;';
                    }
                    echo '">';
                    echo '<option value="" disabled selected>Rates the service...</option>';
                    echo '<option value="1">1</option>';
                    echo '<option value="2">2</option>';
                    echo '<option value="3">3</option>';
                    echo '<option value="4">4</option>';
                    echo '<option value="5">5</option>';
                    echo '</select>';
                    if ($errorId == $donation_id && !empty($errors['rating'])) {
                        echo '<small class="error" style="position: absolute; bottom: 0; right: 10%; margin: 0 0 -1rem 0">' . $errors['rating'] . '</small>';
                    }
                    echo '</div>';
                    if ($errorId == $donation_id && !empty($errors['donation'])) {
                        echo '<small class="error" style="position: absolute; bottom: 100px; left: 20px"> ' . $errors['donation'] . '</small>';
                    }
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</article>';
                }
            }
            ?>
        </div>
    </section>
    
    <h2><?php echo "<h2>{$row_user['name']}'s Health Progress</h2>"; ?></h2>

    <!-- Graph -->
    <section class="graphs-section">
        <div class="graphs">
            <div id="healthChart" style="width: 600px; height: 500px; "></div>
            <div id="comboChart" style="width: 600px; height: 500px; "></div>
        </div>
    </section>

    <!-- Donation History Section -->
    <section class="donation-history">
        <h2 style="margin-top: 2rem;">Donation History</h2>
        <table>
            <thead>
                <tr>
                    <th>Name of Donation</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Blood Volume</th>
                    <th>Blood Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $current_donor_id = $row_user['id'];
                $query = "SELECT donations.*, donation_records.blood_volume
          FROM donation_records 
          INNER JOIN donations ON donation_records.donation_id = donations.id 
          WHERE donation_records.donor_id = $current_donor_id";


                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($donation = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $donation['title'] . '</td>';
                        echo '<td>' . $donation['donation_date'] . '</td>';
                        echo '<td>' . $donation['donation_place'] . '</td>';
                        echo '<td>' . $donation['blood_volume'] . '</td>';
                        echo '<td>' . $donation['blood_group'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No donation history found for the current donor.</td></tr>';
                }
                ?>

            </tbody>
        </table>
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
                <li><a href="../Home/Home Page.html">Home</a></li>
                <li><a href="../Home/services.html">Services</a></li>
                <li><a href="../Home/About.php">About Us</a></li>
                <li><a href="./display_donations.php">Donations</a></li>
                <li><a href="../Home/Contact.html">Contact</a></li>
            </ul>
            <div>
                <input type="text" placeholder="Enter your email">
                <button>Subscribe</button>
            </div>
        </div>
        <hr>
        <p>© 2024 VitaLab. All rights reserved.</p>
    </footer>

    <script src="../../public/js/nav.js"></script>
    <script src="../../public/js/profile.js"></script>

</body>

</html>