<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('config/db_connect.php');

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
$creator = 'created_by';

//SUBMIT BUTTON
if (isset($_POST['submit'])) {

    $moodDataArray = array();
    $notesArray = array();

    $col_names = array();
    $col_values = array();
    foreach ($values as $name => $label) {
        $col_names[] = "`".$name.'_value'."`";
        $col_names[] = "`".$name.'_note'."`";

        $col_values[] = (htmlspecialchars($_POST[$name.'_value'] ?? 1));
        $col_values[] = (htmlspecialchars($_POST[$name.'_note'] ?? ''));
        
    }

    
    $col_names_string = implode(',', $col_names);
    $col_values_string = implode(',', $col_values);

    $creator = $_SESSION['USER_ID'];


    // // prepare and bind
    $statment = $conn->prepare("INSERT INTO mood_entry ($col_names_string, created_by) VALUES (?, ?, ? ,? , ?, ?, ?, ?, ?,?, ?, ?,?, ?, ?,?, ?)");
    $statment->bind_param("isisisisisisisisi", $col_values[0], $col_values[1], $col_values[2], $col_values[3], $col_values[4], $col_values[5], $col_values[6], $col_values[7], $col_values[8], $col_values[9], $col_values[10], $col_values[11], $col_values[12], $col_values[13], $col_values[14], $col_values[15], $creator);

    $statment->execute();

    header('Location: index.php');

    if(empty($_POST[$name.'_value'])) {
        $errors["$name.'_value'"] = 'Please rate all the catregories.';
    }
}

//DELETE BUTTON
if(isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM mood_entry WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)) {
        header('Location:history.php');
    } else {
        echo 'query error : ' . mysqli_error($conn);
    }
}

?>