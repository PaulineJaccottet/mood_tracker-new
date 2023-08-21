<?php 
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true){
        ?>
        <div class="account-logout">
            <a class="nav-item" href="user-account.php">Account</a>
            <a class="nav-item logout-btn" href="logout.php"><img class="logout-icon" src="log-out.svg" alt="Log out icon"></a>
        </div><?php
    } else {
        ?> <a class="nav-item" href="user-account.php">log in</a><?php
    }
?>