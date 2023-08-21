<?php
session_start();
include('config/db_connect.php');
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>
<section class="home-section">
    <div class="explanation-section">
        <p class="explanations">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Parturient molestie torquent senectus sagittis dui habitant dictum fringilla. Accumsan condimentum suspendisse condimentum primis enim risus himenaeos platea. Sit turpis natoque per sem hendrerit pulvinar vivamus laoreet. Aliquet ridiculus proin ad sociosqu class neque iaculis varius. Metus malesuada morbi dignissim ridiculus mattis volutpat scelerisque maecenas. Parturient nulla varius venenatis curabitur dictum facilisi morbi morbi.</p>
    </div>
    <div class="cta-section">
        <?php 
            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) { 
                ?>
                    <a class="cta-btn btn" href="history.php"> History</a>
                    <a class="cta-btn btn" href="mood-form.php">Track your mood</a>
                <?php
            } else {
                ?>
                    <a class="cta-btn" href="user-account.php"> Connect</a>
                <?php
            }
        ?>

    </div>
</section>

<?php include('templates/footer.php'); ?>

</html>