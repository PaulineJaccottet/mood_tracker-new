<?php include('templates/head.php'); ?>

<body>
    <div class="header-page">

        <div class="logo">
            <a class="nav-item header-title-page" href="index.php">My mood tracker</a>
        </div>
        
        <div class="nav-bar nav-bar-page">
            <a class="nav-item" href="history.php">History</a>
            <a class="nav-item" href="mood-form.php">new entry</a>

            <?php 
                include('templates/account-log.php');
            ?>
        </div>
       
    </div>