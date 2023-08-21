<?php

?>

<!DOCTYPE html>
<html>

<?php
session_start();
include('config/db_connect.php');
include('templates/header-page.php');

?>

<section class="user-section">
    <?php


    $sql = 'SELECT * FROM users ORDER BY id';
    $result = mysqli_query($conn, $sql);

    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {

    // ----------------------User connected-------------------- //
        ?>
        <div class="connected-user">
            <div class="user-infos">
                <h3>Your Informations</h3>
                <p><?php echo $_SESSION['USER_NAME'] ?></p>
                <p><?php echo $_SESSION['USER_EMAIL'] ?></p>
            </div>

            <div class="tracking-infos">
                <h3>Your Tracking record</h3>
                <p>to be added</p>
                <a class="cta-btn" href="history.php"> history</a>
                <a class="cta-btn" href="mood-form.php">Track your mood</a>
            </div>
        </div>

        <?php

    } else {

    // ----------------------No user connected-------------------- //

    ?>
        <div class="registration-box">
            <form class="user-form registration-form" action="registration.php" method="POST">
                <label for="">Username</label>
                <input class="registration-input" type="text" name="username">

                <label for="">Email</label>
                <input class="registration-input" type="email" name="user_email" id="user_email_registration">

                <label for="">Password</label>
                <input class="registration-input" type="password" name="password">

                <label for="">Password confirmation</label>
                <input class="registration-input" type="password" name="password_confirmation">

                <?php
                if (isset($_SESSION['registration_status']) && !$_SESSION['registration_status']['success']) {
                    echo '<div class="error-message">';

                    foreach ($_SESSION['registration_status']['fields'] as $fields => $message) {
                        echo '</p>' . $message . '</p>';
                    }
                    echo '</div>';
                }
                ?>
                <input class="btn " type="submit" name="user_registration" value="Register">
            </form>
        </div>

        <div class="login-box">
            <form class="user-form registration-form" action="login.php" method="POST">

                <label for="">Email</label>
                <input class="registration-input" type="email" name="user_email_login" id="user_email_login">

                <label for="">Password</label>
                <input class="registration-input" type="password" name="password_login">

                <input class="btn" type="submit" name="user_login" value="Login">

                <?php
                if (isset($_SESSION['login_status']) && !$_SESSION['login_status']['success']) {
                    echo '<div class="error-message">';

                    foreach ($_SESSION['login_status']['fields'] as $fields => $message) {
                        echo '</p>' . $message . '</p>';
                    }

                    echo '</div>';
                }
                ?>
            </form>
        </div>

    <?php
    }
    ?>

</section>

<?php
unset($_SESSION['registration_status']);
include('templates/footer.php');
?>

</html>