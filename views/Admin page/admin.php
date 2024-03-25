<?php
	session_start();
    include "../../controllers/config.php";

    // Fetch donor information from the database
    $sql_donor = "SELECT * FROM donors ORDER BY created_at DESC";
    $result_donor = mysqli_query($conn, $sql_donor);


// Check if user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: ../../views/auth/login.html");
    exit();
}

// Fetch admin information from the database
$username = $_SESSION['name'];
$sql_admin = "SELECT * FROM labEmployee WHERE name = '$username'";
$result_admin = mysqli_query($conn, $sql_admin);
$row_admin = mysqli_fetch_assoc($result_admin);
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
    <link rel="stylesheet" href="../../public/styles/labEmpl.css">
    <link rel="stylesheet" href="../../public/styles/styles.css">
    <!-- Icons link -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />

    <link
    rel="icon"
    href="../../public/assets/images/Logo-donation.png"
    sizes="48x48"
    type="image/png"
    />
    <title>Lab Employee</title>
</head>
<body>
   <!-- SIDEBAR -->
	<section id="sidebar">
		
		<a href="../Home/Home Page.html"class="logo">
            <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
            <p>VitaLab</p>
        </a>

		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="../Home/Home Page.html">
					<i class='bx bxs-home' ></i>
					<span class="text">Home</span>
				</a>
			</li>

			<li>
				<a href="./all-donors">
					<i class="bx"><span class="material-symbols-outlined">diversity_3</span></i>
					<span class="text">All donors</span>
				</a>
			</li>

			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>

			<li>
				<a href="donations.php">
					<i class='bx bxs-calendar-event' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>

		<ul class="side-menu">
			<li>
				<a href="setting.php">
					<i class='bx bxs-cog' ></i>
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

    <!-- CONTENT -->
    <section id="content">
       <!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>

			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
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

        <!-- MAIN -->
        <main>
            <div class="head-title">
				<ul class="breadcrumb">
					<li>
						<a href="#">Dashboard</a>
					</li>
					<li><i class='bx bx-chevron-right' ></i></li>
					<li>
						<a class="active" href="#">Home</a>
					</li>
				</ul>
			</div>


			<section class="box-info">
				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>O+</h3>
						<p>15 donor</p>
					</span>
				</article>

				<article>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>A+</h3>
						<p>8 donor</p>
					</span>
				</article>

				<article>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>B+</h3>
						<p>3 donor</p>
					</span>
				</article>
				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>AB+</h3>
						<p>5 donor</p>
					</span>
				</article>

				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>O-</h3>
						<p>9 donor</p>
					</span>
				</article>
				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>A-</h3
						<p> 12 donor</p>
					</span>
				</article>
				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>B-</h3>
						<p>7 donor</p>
					</span>
				</article>
				<article>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>AB-</h3>
						<p>2 donor</p>
					</span>
				</article>

			</section>


            <section class="table-data">
            <div class="order">
        <div class="head">
            <h3>Recent Donors</h3>
            <!-- Search form -->
            <form action="search-donor.php" method="post" class="form-donor">
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
                    // Check if there are any donors
                    if (mysqli_num_rows($result_donor) > 0) {
                        // Loop through each donor and display their information
                        while ($row_donor = mysqli_fetch_assoc($result_donor)) {
                ?>
                <tr>
                    <td>
                        <img src="<?php echo $row_donor['profilePicture']; ?>" alt="Profile Picture">
                        <p><?php echo $row_donor['name']; ?></p>
                    </td>
                    <td><?php echo $row_donor['created_at']; ?></td>
                    <td><?php echo $row_donor['blood_type']; ?></td>
                    <td>
                        <!-- Update button -->
                        <a href="update-donor.php?id=<?php echo $row_donor['id']; ?>" class="status completed">Update</a>
                       <!-- Delete button -->
                       <a href="delete-donor.php?id=<?php echo $row_donor['id']; ?>" class="status completed">Delete</a>

                    </td>
                </tr>
                <?php
                        }
                    } else {
                        // Display a message if there are no donors
                        echo "<tr><td colspan='4'>No donors found</td></tr>";
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
