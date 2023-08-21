<?php
// In relation with user.account.php, related with the login form.

session_start();
include('config/db_connect.php');

if (isset($_POST['user_login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email_login']);
    $userInputPassword = mysqli_real_escape_string($conn, $_POST['password_login']);

    $statment = $conn->prepare("SELECT * FROM users WHERE email=?");
    $statment->bind_param("s", $email);

    $statment->execute();


    $result = $statment->get_result();

    $status = [
        'success' => true,
        'message' => '',
        'fields' => []
    ];

    if($row = $result->fetch_assoc()) {
        $storedHash = $row['password'];

        if (password_verify($userInputPassword, $storedHash)) {
          $_SESSION['is_logged_in'] = true;
          $_SESSION['USER_ID'] = $row['id'];
          $_SESSION['USER_NAME'] = $row['username'];
          $_SESSION['USER_EMAIL'] = $row['email'];

          header('Location: user-account.php'); 
          exit;

        } else {
            $status['success'] = false;
            $status['fields']['password'] = 'Your password or your username is incorrect';

            $_SESSION['login_status'] = $status;

            header('Location: user-account.php'); 
            exit;
        }

    } else {
        $status['success'] = false;
        $status['fields']['password'] = 'Your password or your username is incorrect';

        $_SESSION['login_status'] = $status;

        header('Location: user-account.php'); 
        exit;
    };

} 