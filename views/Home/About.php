<?php
include '../../controllers/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
  <!-- Icons link -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <!-- Styles link -->
  <link rel="stylesheet" href="../../public/styles/styles.css" />
  <link rel="stylesheet" href="../../public/styles/Donates.css" />
  <link rel="stylesheet" href="../../public/styles/main.css">
  <!-- swiper js link -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../../public/styles/swiper.css" />
</head>

<body>
  <!-- Navigation Bar -->
  <nav>
    <a href="./Home Page.html" class="logo">
      <img src="../../public/assets/images/Logo-donation.png" alt="VitaLab Logo" width="36px">
      <p>VitaLab</p>
    </a>
    <ul class="ulMenu">
      <li><a href="./Home Page.html">Home</a></li>
      <li><a href="./services.html">Services</a></li>
      <li><a href="./About.php">About Us</a></li>
      <li><a href="./Privacy.html">Privacy policy</a></li>
      <li><a href="./Contact.html">Contact</a></li>
    </ul>
    <span class="material-symbols-outlined hamburger">menu</span>
    <span class="material-symbols-outlined closeIcone">close</span>
  </nav>

  <!-- Welcome -->
  <section class="Welcome">
    <article>
      <p>Donate to blood contribute</p>
      <strong>Your blood can <b>bring smile</b> in any one person face</strong>
      <div class="buttons">
      <button class="btn"><a href="../Donor page/donor.php">Donate Now</a></button>
        <button class="btn">
          <a href="../auth/login.php">Login Now</a>
        </button>
      </div>
    </article>
  </section>

  <!-- About us -->
  <section class="about">
    <article>

      <div>
        <h3>Who are we ?</h3>
        <span>We are here not for income, but for outcome</span>
        <p>
          Which is the same as saying through shrinking from toil and pain.
          These cases are perfectly simple and easy to distinguish. In a free
          hour, when untrammelled and when nothing prevents
        </p>
        <button>Explore More</button>
      </div>

      <div>
        <img src="../../public/assets/images/who-are-we.jpeg" alt="who_are_we" width="600px" />
      </div>
    </article>
  </section>

  <!-- Get Involved  -->
  <section class="getInvolved">
    <h3>Get Involved</h3>
    <div class="involved">
      <article>
        <div>
          <img src="../../public/assets/images/Image_donor.jpg" alt="Become a Donor" width="270px" height="220px" />
        </div>
        <div>
          <h3>Become a Donor</h3>
          <p>
            Join our community of lifesavers by becoming a blood donor. Your
            simple act of donating blood can make a significant impact on
            someone's life. Learn more about the donation process and how you
            can contribute.
          </p>
          <button>Learn More</button>
        </div>
      </article>

      <article>
        <div>
          <img src="../../public/assets/images/Why_Donor.PNG" alt="Why give blood" width="270px" height="220px" />
        </div>
        <div>
          <h3>Why Give Blood?</h3>
          <p>
            Discover the compelling reasons behind blood donation. From saving
            lives to contributing to community health, learn about the
            numerous benefits and positive impacts that come with the selfless
            act of giving blood.
          </p>
          <button>Learn More</button>
        </div>
      </article>

      <article>
        <div>
          <img src="../../public/assets/images/blood-donors-smile.webp" alt="How Donation Helps" height="200px" />
        </div>
        <div>
          <h3>How Donation Helps</h3>
          <p>
            Explore the far-reaching effects of your blood donation.
            Understand the vital role it plays in medical treatments,
            emergencies, and maintaining a stable blood supply. Learn more
            about the incredible ways your donation makes a difference.
          </p>
          <button>Learn More</button>
        </div>
      </article>
    </div>
  </section>

  <!-- Our Achievements -->
  <section class="achievement">
    <article>
      <span class="material-symbols-outlined">social_leaderboard</span>
      <h4>25</h4>
      <p>Year experiance</p>
    </article>

    <article>
      <span class="material-symbols-outlined">stethoscope</span>
      <h4>3225</h4>
      <p>Happy Donors</p>
    </article>

    <article>
      <span class="material-symbols-outlined">trophy</span>
      <h4>90</h4>
      <p>Total Awards</p>
    </article>

    <article>
      <span class="material-symbols-outlined">diversity_1</span>
      <h4>3168</h4>
      <p>Happy Recipient</p>
    </article>
  </section>


  <!-- Donation process -->
  <section class="Donates">
    <p>What we do ?</p>
    <h2>Donation Process</h2>

    <div class="process_donate">
      <!-- Process Bar Line -->
      <div class="process_donate_line">
        <div class="line-progress"></div>
      </div>

      <!-- Process articles -->
      <div class="process_donate_list">
        <!-- Left Box -->
        <article class="process_donate_item">
          <div class="card_box">
            <!-- Number Code-->
            <div class="point_box">
              <div class="card_point">01</div>
            </div>

            <!-- Name Code-->
            <div class="card_meta_box">
              <div class="card_meta">Registration</div>
            </div>
          </div>

          <!-- Card Code-->
          <div class="card_item">
            <div class="card_inner">
              <div class="card_img-box">
                <span class="material-symbols-outlined"> person_add </span>
                <p>
                  Start your journey by registering with us. Fill out the
                  required information to become a donor.
                </p>
              </div>
            </div>

            <div class="arrow"></div>
          </div>
        </article>

        <!-- Right Box -->
        <article class="process_donate_item">
          <div class="card_box">
            <!-- Name Code-->
            <div class="card_meta_box">
              <div class="card_meta">Screen Test</div>
            </div>

            <!-- Number Code-->
            <div class="point_box">
              <div class="card_point">02</div>
            </div>
          </div>

          <!-- Card -->
          <div class="card_item">
            <div class="card_inner">
              <div class="card_img-box">
                <span class="material-symbols-outlined"> experiment </span>
                <p>
                  Undergo a screening test to ensure your eligibility for
                  donation. This step helps maintain the health and safety of
                  both the donor and the recipient.
                </p>
              </div>
            </div>
            <div class="arrow"></div>
          </div>
        </article>

        <!-- Left Box -->
        <article class="process_donate_item">
          <div class="card_box">
            <!-- Number-->
            <div class="point_box">
              <div class="card_point">03</div>
            </div>

            <!-- Name -->
            <div class="card_meta_box">
              <div class="card_meta">Donation</div>
            </div>
          </div>

          <!-- Card -->
          <div class="card_item">
            <div class="card_inner">
              <div class="card_img-box">
                <span class="material-symbols-outlined">
                  volunteer_activism
                </span>
                <p>
                  Once cleared, proceed with the donation process. Your
                  contribution can make a significant impact on someone's
                  life.
                </p>
              </div>
            </div>

            <div class="arrow"></div>
          </div>
        </article>

        <!-- Right Box -->
        <article class="process_donate_item">
          <div class="card_box">
            <!-- Name-->
            <div class="card_meta_box">
              <div class="card_meta">Rest & Refresh</div>
            </div>

            <!-- Number -->
            <div class="point_box">
              <div class="card_point">04</div>
            </div>
          </div>

          <!-- Card -->
          <div class="card_item">
            <div class="card_inner">
              <div class="card_img-box">
                <span class="material-symbols-outlined"> relax </span>

                <p>
                  After the donation, take some time to rest and refresh. Our
                  team will ensure you are comfortable and provide any
                  necessary post-donation care.
                </p>
              </div>
            </div>
            <div class="arrow"></div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- Call for Donation -->
  <section class="call">
    <div>
      <p>Start Donation</p>
      <h2>Call Now: +213 27 72 70 17</h2>
      <div>
        <p>
          <span class="material-symbols-outlined">location_on</span> VitaLab
          Laboratory, Chlef
        </p>
        <p>
          <span class="material-symbols-outlined">mail</span>
          <a href="vitalab.dz@gmail.com">vitalab.dz@gmail.com</a>
        </p>
      </div>
    </div>
  </section>

  <!-- Testimonials  -->
  <?php
$sql = "SELECT c.comment, c.rating, d.profilePicture, d.name
        FROM comments c
        JOIN donors d ON c.donor_id = d.id
        WHERE c.is_general = 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<section class="swiper">
            <div class="testimonials swiper-container">
              <p>Testimonials</p>
              <h2>What Our Clients Say</h2>
              <div class="swiper-wrapper">';

    while ($row = $result->fetch_assoc()) {
        echo '<article class="swiper-slide">
                <div class="card">
                    <div>
                        <div>
                            <img src="' . $row["profilePicture"] . '" alt="" width="55px" height="55px" />
                            <span><b>' . $row["name"] . '</b><br/>Donor</span>
                        </div>
                        <div class="rating">';

        for ($i = 0; $i < $row["rating"]; $i++) {
            echo '<img src="../../public/assets/images/Star_fill.png" alt="star" width="20px" />';
        }

        echo '          </div>
                    </div>
                    <img src="../../public/assets/images/quotes.png" alt="" width="50px" id="quotes" />
                    <p>' . $row["comment"] . '</p>
                </div>
            </article>';
    }

    echo '      </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
          </div>
      </section>';
} else {
    echo '<p>No comments found.</p>';
}

$conn->close();
?>

  <!-- Footer -->
  <footer>
    <div class="footer-nav">
      <a href="./Home Page.html" class="logo">
        <img src="../../public/assets/images/Logo-donation.PNG" alt="VitaLab Logo" width="36px" />
        <p>VitaLab</p>
      </a>
      <div class="social">
        <p>Our socials</p>
        <a href="#"><img src="../../public/assets/images/socials/icon-facebook.svg" alt="icon-facebook" /></a>
        <a href="#"><img src="../../public/assets/images/socials/icon-twitter.svg" alt="icon-twitter" /></a>
        <a href="#"><img src="../../public/assets/images/socials/icon-pinterest.svg" alt="icon-pinterest" /></a>
        <a href="#"><img src="../../public/assets/images/socials/icon-instagram.svg" alt="icon-instagram" /></a>
      </div>
    </div>

    <div class="end">
      <ul>
        <li><a href="./Home Page.html">Home</a></li>
        <li><a href="./services.html">Services</a></li>
        <li><a href="./About.php">About Us</a></li>
        <li><a href="./Privacy.html">Privacy policy</a></li>
        <li><a href="./Contact.html">Contact</a></li>
      </ul>
      <div>
        <input type="text" placeholder="Enter your email" />
        <button>Subscribe</button>
      </div>
    </div>
    <hr />
    <p>© 2024 VitaLab. All rights reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="../../public/js/swiper.js"></script>
  <script src="../../public/js/nav.js"></script>
  <!-- For the donation process -->
  <script src="../../public/js/script.js"></script>
  
</body>

</html>