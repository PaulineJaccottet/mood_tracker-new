<?php

// include('config/db_connect.php');

// Connect to database
// $connn = mysqli_connect('host', 'username', 'password', 'db name')
$conn = mysqli_connect('localhost', 'mymood', 'test1234', 'project_mood-tracker');

//Check connection
if (!$conn) {
    echo mysqli_connect_error();
}


//Write query for all entries
// * = all


//Make query & get result


// //Free result from memory
// mysqli_free_result($result);

// //Close connction
// mysqli_close($conn);

// print_r($entries);

?>