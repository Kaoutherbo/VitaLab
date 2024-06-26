<?php
@include "../../controllers/fetch_user.php";
@include "../../controllers/admin/search_donor.php";
@include "../../controllers/admin/display_by_blood_type.php";
@include "../../controllers/admin/display_donors.php";

$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);


$bloodTypeData = [];
foreach ($blood_groups as $type => $count) {
    $bloodTypeData[] = "['$type', $count]";
}

// Convert the PHP array to a JavaScript format
$bloodTypeDataJS = implode(',', $bloodTypeData);


$sql = "SELECT d.donation_date, SUM(dr.blood_volume) AS total_blood_volume
        FROM donations d
        JOIN donation_records dr ON d.id = dr.donation_id
        GROUP BY d.donation_date
        ORDER BY d.donation_date ASC";
        
$result = mysqli_query($conn, $sql);


$donationData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = $row['donation_date'];
        $total_volume = $row['total_blood_volume'];
        $donationData[] = "['$date', $total_volume]";
    }
}



$donationDataJS = implode(',', $donationData);// joins element of array into string

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/styles.css">
    <link rel="stylesheet" href="../../public/styles/labEmpl.css">
    <!-- Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!--Draw the charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Google Charts library
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawDonorHealthChart);

        function drawDonorHealthChart() {
            var data = google.visualization.arrayToDataTable([
                ['Blood Type', 'Donations'],
                <?php echo $bloodTypeDataJS; ?>
            ]);

            var options = {
                title: 'Donors Blood Type',
                backgroundColor: '#FED5D5',
                colors: ['#18A810', '#F28E2B', '#FB373A', '#4563FC', '#59A14F', '#EDC948', '#75288D', '#FF9DA7'],
                chartArea: {
                    width: '80%',
                    height: '80%'

                },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('bloodTypeChart'));
            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawDonorActivitiesChart);

        function drawDonorActivitiesChart() {
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
                        color: '#1ECB2D',
                        width: 0.4
                    }
                }
            }

            var chart = new google.visualization.ComboChart(document.getElementById('dailyActivitiesChart'));
            chart.draw(data, options);
        }
    </script>


    <title>Lab Employee</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">

        <a href="../Home/Home Page.html" class="logo">
            <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
            <p>VitaLab</p>
        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../Home/Home Page.html">
                    <i class='bx bxs-home'></i>
                    <span class="text">Home</span>
                </a>
            </li>

            <li>
                <form action="admin.php" method="get">
                    <input type="hidden" name="all_donors" value="1">
                    <div type="submit" class="link-button" onclick="this.parentNode.submit();">
                        <i class="bx"><span class="material-symbols-outlined">diversity_3</span></i>
                        <span class="text">All donors</span>
                    </div>
                </form>
            </li>

            <li>
                <a href="create-donation.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Add Donation</span>
                </a>
            </li>
            <li>
                <a href="../../views/Donor page/display_donations.php">
                    <i class='bx bxs-calendar'></i>
                    <span class="text">All donations</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Statistics</span>
                </a>
            </li>
            <li>
                <a href="../auth/register-donor.php">
                    <i class='bx bxs-user-plus'></i>
                    <span class="text">Register Donor</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Team</span>
                </a>
            </li>
        </ul>

        <ul class="side-menu">
            <li id="settingsLink">
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="../../controllers/auth/logout.php" class="logout">
                    <i class="bx"><span class="material-symbols-outlined">logout</span></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- Main content section -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <div>
                <i class='bx bx-menu'></i>
                <a href="#" class="nav-link">Categories</a>
            </div>

            <div>
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>

                <a href="#" class="notification">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a>

                <a href="#" class="profile" id="profilePicture">
                    <img src="<?php echo $row_user['profilePicture']; ?>" alt="Profile Picture">
                </a>
            </div>
        </nav>

        <main>
            <div class="head-title">
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>

            <section class="box-info">

                <?php foreach ($blood_groups as $type => $count) : ?>
                    <article>
                        <form action="" method="post">
                            <input type="hidden" name="blood_group" value="<?php echo $type; ?>" />
                            <div class="article-btn" onclick="this.parentNode.submit();">
                                <i class='bx bxs-group'></i>
                                <span class='text'>
                                    <h3><?php echo $type; ?></h3>
                                    <p><?php echo $count; ?> donor</p>
                                </span>
                            </div>
                        </form>
                    </article>
                <?php endforeach; ?>
            </section>

            <!-- Graphs section -->
            <section class="graphs-section">
                <h3>Statistics</h3>
                <div class="graphs" style="margin: 2rem 0">
                    <div id="bloodTypeChart" style="width: 100%; height: 400px;"></div>
                    <div id="dailyActivitiesChart" style="width: 100%; height: 400px;"></div>
                </div>

            </section>

            <!-- Table data section -->
            <section class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Donors</h3>
                        <!-- Search form -->
                        <form action="" method="post" class="form-donor">
                            <div class="form-input">
                                <input type="text" name="search_term" placeholder="Search donors..." style="<?php echo (!empty($errors['searchTerm']) ? 'border: 1.5px solid red;' : ''); ?>">
                                <button type="submit" class="search-btn" aria-label="Search">
                                    <i class='bx bx-search'></i>
                                </button>
                            </div>
                            <?php if (!empty($errors['searchTerm'])) : ?>
                                <small class="error" style="margin: 0 2rem"><?php echo htmlspecialchars($errors['searchTerm']); ?></small>
                            <?php endif; ?>
                        </form>


                        <button class="add-btn">
                            <a href="add-donor.php">Add Donor</a>
                            <i class='bx bx-plus'></i>
                        </button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Donor</th>
                                <th>Date of Registration</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Blood type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($result_donor_filtered) || isset($result_search)) {
                                $result_to_use = isset($result_donor_filtered) ? $result_donor_filtered : $result_search;
                                if (mysqli_num_rows($result_to_use) === 0) {
                                    echo "<tr><td colspan='4'>No donors found</td></tr>";
                                } else {
                                    while ($row_donor = mysqli_fetch_assoc($result_to_use)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_donor['id'] . "</td>";
                                        echo "<td>";
                                        echo "<img src='" . $row_donor['profilePicture'] . "' alt='Profile Picture'>";
                                        echo "<p>" . $row_donor['name'] . "</p>";
                                        echo "</td>";
                                        echo "<td>" . $row_donor['created_at'] . "</td>";
                                        echo "<td>" . $row_donor['email'] . "</td>";
                                        echo "<td>" . $row_donor['address'] . "</td>";
                                        echo "<td>" . $row_donor['blood_group'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='update-donor.php?id=" . $row_donor['id'] . "' class='status edit'><span class='material-symbols-outlined'>edit</span></a>";
                                        echo "<a href='../../controllers/admin/delete-donor.php?id=" . $row_donor['id'] . "' class='status delete'><span class='material-symbols-outlined'>delete</span></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                if (mysqli_num_rows($result_donor) > 0 || $allDonorsClicked) {
                                    while ($row_donor = mysqli_fetch_assoc($result_donor)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_donor['id'] . "</td>";
                                        echo "<td>";
                                        echo "<img src='" . $row_donor['profilePicture'] . "' alt='Profile Picture'>";
                                        echo "<p>" . $row_donor['name'] . "</p>";
                                        echo "</td>";
                                        echo "<td>" . $row_donor['created_at'] . "</td>";
                                        echo "<td>" . $row_donor['email'] . "</td>";
                                        echo "<td>" . $row_donor['address'] . "</td>";
                                        echo "<td>" . $row_donor['blood_group'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='../auth/updateProfile.php?id=" . $row_donor['id'] . "' class='status edit'><span class='material-symbols-outlined'>edit</span></a>";
                                        echo "<a href='../../controllers/admin/delete-donor.php?id=" . $row_donor['id'] . "' class='status delete'><span class='material-symbols-outlined'>delete</span></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No donors found</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
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
                        <button type="submit">
                            <a href="../../views/auth/updateProfile.php?id=<?php echo $row_user['id']; ?>&role=<?php echo $row_user['role']; ?>">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <script src="../../public/js/admin.js"></script>
</body>

</html>