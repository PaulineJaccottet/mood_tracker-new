<?php
session_start();
include('./config/db_connect.php');
?>

<!DOCTYPE html>
<html>

<?php include('templates/header-page.php');

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
?>
    <section>
        <h1>My mood history</h1>
        <div class="entries-list">

            <?php

            $sql = 'SELECT *, (sleep_value + sadness_value + anxiety_value + pleasure_value + desire_value + appetite_value + memory_value + focussing_value) / 8  AS average FROM mood_entry ORDER BY created_at DESC';
            $result = mysqli_query($conn, $sql);

            //Fetch the resulting row as an array 
            $entries = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($entries as $entry) {
                $values = [
                    'focussing' => 'Focussing',
                    'memory' => 'Memory',
                    'appetite' => 'Appetite',
                    'desire' => 'Desire',
                    'pleasure' => 'Pleasure',
                    'anxiety' => 'Anxiety',
                    'sadness' => 'Sadness',
                    'sleep' => 'Sleep',
                ];

                $date = 'created_at';
                $id = 'id';
                $idConnectedUser = $_SESSION['USER_ID'];
                $creator = 'created_by';
                $average = 'average';
             

                if ($entry[$creator] == $idConnectedUser) {
         
                ?>
                    <div class="row mood-entry">
                        <form class="delete-btn" action="add.php" method="POST">
                            <input type='hidden' name='id_to_delete' value='<?php echo $entry[$id] ?>'>
                            <input class="delete-input" type="submit" name='delete' value='X' class="delete-btn">
                        </form>
                        <div class="date-entry"><?= $entry[$date] ?></div>
                        <div class="category-box">
                            <?php
                            foreach ($values as $name => $label) { ?>
                                <div class="category-box-inner">
                                    <!-- <p class="category-value"><?php echo htmlspecialchars($entry[$name . '_value']) ?></p> -->
                                    <p class="category-name"><?php echo $label ?></p>

                                    <div class="value-bg">
                                        <div class="mood-value" style="--width:<?php echo htmlspecialchars($entry[$name . '_value']) ?>0%">
                                            <div class="gradient-bg"> </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (htmlspecialchars($entry[$name . '_note'])) { ?>

                                        <div class="category-content">
                                            <div class="click-btn">+</div>
                                            <p class="category-note"><?= htmlspecialchars($entry[$name . '_note']) ?></p>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <div class="average-mood">
                            <p>Average</p>

                            <div class="gradient-bg">
                                <div class="cursor-average" style="--margin-left: <?php echo htmlspecialchars($entry[$average]) * 10 ?>%;"><img src="img/cursor-average.svg" alt=""></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            <?php } ?>

        </div>
    </section>

<?php

} else {
    header('Location: user-account.php');
    exit;
} ?>


<?php include('templates/footer.php'); ?>

</html>