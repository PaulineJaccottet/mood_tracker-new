<option value="" disabled selected>What is your mood?</option>

<?php
for ($i = 1; $i <= 10; $i++) {
?>
    <option class="value-option" value="<?= $i ?>"><?= $i ?></option>
<?php
}

?>