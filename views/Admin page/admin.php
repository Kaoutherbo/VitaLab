<?php
@include "fetch_donor_info.php";
@include "search_donor.php";
@include "display_by_blood_type.php";
@include "display_donors.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/styles.css">
    <link rel="stylesheet" href="../../public/styles/labEmpl.css">
    <!-- Icons link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
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
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>

            <li>
                <a href="donations.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Donations</span>
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
            <li>
                <a href="setting.php">
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
        <!-- Box info section -->
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>

            <a href="#" class="profile">
                <img src="<?php echo $row_admin['profilePicture']; ?>" alt="Profile Picture">
                <!-- for the profile section-->
                <p><?php echo $row_admin['address']; ?></p>
                <p><?php echo $row_admin['email']; ?></p>
                <p><?php echo $row_admin['name']; ?></p>

            </a>
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

                <?php foreach ($blood_types as $type => $count) : ?>
                    <article>
                        <form action="" method="post">
                            <input type="hidden" name="blood_type" value="<?php echo $type; ?>" />
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

            <!-- Table data section -->
            <section class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Donors</h3>
                        <!-- Search form -->
                        <form action="" method="post" class="form-donor">
                            <div class="form-input">
                                <input type="text" name="search_term" placeholder="Search donors...">
                                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                            </div>
                        </form>
                        <a href="add-donor.php" class="add-btn"><i class='bx bx-plus'></i></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Donor</th>
                                <th>Date of Registration</th>
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
                                        echo "<td>";
                                        echo "<img src='" . $row_donor['profilePicture'] . "' alt='Profile Picture'>";
                                        echo "<p>" . $row_donor['name'] . "</p>";
                                        echo "</td>";
                                        echo "<td>" . $row_donor['created_at'] . "</td>";
                                        echo "<td>" . $row_donor['blood_type'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='update-donor.php?id=" . $row_donor['id'] . "' class='status completed'>Update</a>";
                                        echo "<a href='delete-donor.php?id=" . $row_donor['id'] . "' class='status completed'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                if (mysqli_num_rows($result_donor) > 0 || $allDonorsClicked) {
                                    while ($row_donor = mysqli_fetch_assoc($result_donor)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<img src='" . $row_donor['profilePicture'] . "' alt='Profile Picture'>";
                                        echo "<p>" . $row_donor['name'] . "</p>";
                                        echo "</td>";
                                        echo "<td>" . $row_donor['created_at'] . "</td>";
                                        echo "<td>" . $row_donor['blood_type'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='update-donor.php?id=" . $row_donor['id'] . "' class='status completed'>Update</a>";
                                        echo "<a href='delete-donor.php?id=" . $row_donor['id'] . "' class='status completed'>Delete</a>";
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

    <script src="../../public/js/admin.js"></script>
</body>

</html>