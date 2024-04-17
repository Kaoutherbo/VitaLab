<?php
session_start();
@include "../../controllers/config.php";
@include "../../controllers/fetch_user.php";
@include "../../controllers/auth/updateInfos.php";


$errors = isset($_GET['err']) ? json_decode(urldecode($_GET['err']), true) : array();
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../../public/assets/images/Logo-donation.png" sizes="48x48" type="image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/register.css">
    <title>Update information</title>
</head>

<body>

    <!-- main -->
    <main>
        <section class="container">
            <article class="welcome-message update-infos">
                <div class="infos">
                    <h2>Welcome to the Blood Donation Management System!</h2>
                    <p>
                        Updating your personal information, you help us maintain accurate records and provide the best possible support to our community.We appreciate your commitment to supporting those in need and encourage you to keep your information up to date. Together, we can make a lasting impact and save lives.
                    </p>

                </div>
            </article>


            <article class="container-form">
                <h2>Update information!</h2>
                <form action="../../controllers/auth/updateInfos.php?id=<?php echo $row['id'] ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input type="hidden" name="role" value="<?php echo $row['role'] ?>">
                    <input type="hidden" name="role_user" value="<?php echo $row_user['role'] ?>">
                    
                    <div class="group-inputs">

                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="name" id="username" value="<?php echo $row['name'] ?>" style="<?php echo (!empty($errors['name']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['name'])) : ?>
                                <small class="error"><?php echo $errors['name']; ?></small>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="image">Profile</label>
                            <input type="text" name="profilePicture" id="Image" value="<?php echo $row['profilePicture'] ?>" />
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" style="<?php echo (!empty($errors['email']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['email'])) : ?>
                                <small class="error"><?php echo $errors['email']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="address">Address</label>
                            <input type="address" name="address" id="address" value="<?php echo $row['address'] ?>" style="<?php echo (!empty($errors['address']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['address'])) : ?>
                                <small class="error"><?php echo $errors['address']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="tel">Phone</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo $row['phone'] ?>" style="<?php echo (!empty($errors['phone']) ? 'border: 1.5px solid red;' : ''); ?>" />
                            <?php if (!empty($errors['phone'])) : ?>
                                <small class="error"><?php echo $errors['phone']; ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="last">
                            <label for="role">Blood Type</label>
                            <select name="blood_group" id="blood_group" style="<?php echo (!empty($errors['blood_group']) ? 'border: 1.5px solid red;' : ''); ?>">
                                <option value="" disabled selected>Select Blood Type...</option>
                                <option value="O+" <?php if ($row['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                                <option value="A+" <?php if ($row['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                                <option value="B+" <?php if ($row['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                                <option value="AB+" <?php if ($row['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                <option value="O-" <?php if ($row['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                                <option value="A-" <?php if ($row['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                                <option value="B-" <?php if ($row['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                                <option value="AB-" <?php if ($row['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                            </select>
                            <?php if (!empty($errors['blood_group'])) : ?>
                                <small class="error"><?php echo $errors['blood_group']; ?></small>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php if (!empty($errors['general'])) : ?>
                        <small class="error"><?php echo $errors['general']; ?></small>
                    <?php endif; ?>

                    <div class="group-btns">
                        <button type="submit" name="submit">Save</button>
                        <button><a href="<?php echo $row['role'] == 'admin' ? '../Admin page/admin.php' : '../Donor page/donor.php'; ?>">Cancel</a></button>
                    </div>

                </form>
            </article>

        </section>
    </main>


</body>

</html>