<?php
session_start();
include('config/db_connect.php');
?>

<!DOCTYPE html>
<html>
<?php include('templates/header-page.php');

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


if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
?>

    <section class="enter-mood">
        <h1 class="title-form">What is your today's mood on a 1-10 scale ?</h1>
        <div>
            <span class="scale"><span class="scale-value bad">1</span><span class="scale-value good">10</span></span>
        </div>


        <form class="new-entry" action="add.php" method="POST">
            <?php

            $totalValues = count($values);
            $average = 0;

            foreach ($values as $name => $label) {
            ?>
                <div class="type-bloc">
                    <div class="value-bloc">
                        <label for=""><?php echo $label ?></label>
                        <select id="<?php echo $name . '_value' ?>" class="value-selector" name="<?php echo $name . '_value' ?>" required>
                            <?php echo include('templates/options-value.php'); ?>
                        </select>
                    </div>
                    <div class="note-bloc">
                        <!-- <label for="">Notes</label> -->
                        <textarea name="<?php echo $name . '_note' ?>" id="<?php echo $name . '_note' ?>" cols="27" rows="2" placeholder="notes"></textarea>
                    </div>
                </div>

            <?php
            }
            ?>
            <div class="sumbit-bloc">
                <input class="btn" type="submit" name="submit" value="Save">
            </div>
        
        </form>
    </section>

<?php
} else {
    header('Location: user-account.php');
    exit;
}

include('templates/footer.php');
?>

</html>