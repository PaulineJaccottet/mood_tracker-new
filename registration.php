<?php
// In relation with user.account.php, related with the registration form.


session_start();
include('config/db_connect.php');

function isEmailExists($conn, $users, $email)
{
    $sql = "SELECT * FROM " . $users . " WHERE email='" . $email . "'";

    $results = $conn->query($sql);
    $row = $results->fetch_assoc();

    return (is_array($row)  && count($row) > 0);
}

// ----------------------------------------------------------- //
// ----------------------User registration-------------------- //
// ----------------------------------------------------------- //

if (isset($_POST['user_registration'])) {

    $name = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['user_email']);
    $password =$_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $status = [
        'success' => true,
        'message' => '',
        'fields' => []
    ];

    if (isEmailExists($conn, 'users', $email)) {
        $status['success'] = false;
        $status['fields']['user_email'] = 'This email is already registered.';
        $_SESSION['registration_status'] = $status;
      
        header('Location: user-account.php'); 
        exit;
        // If user already exist, no need to check other requirements.
    }

    if (empty($name)) {
        $status['success'] = false;
        $status['fields']['username'] = 'Please complete this field.';
    }

    if (empty($email)) {
        $status['success'] = false;
        $status['fields']['user_email'] = 'Please complete the email field.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status['success'] = false;
        $status['fields']['user_email'] = 'Please enter a valid email.';
    }

    if (empty($password)) {
        $status['success'] = false;
        $status['fields']['password'] = 'Please complete the password field.';
    } elseif (strlen($password) < 4) {
        $status['success'] = false;
        $status['fields']['password'] = 'The password should contain at least 4 characters and 1 number.';
    } elseif (!preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $status['success'] = false;
        $status['fields']['password'] = 'The password should contain at least 4 characters and 1 number.';
    }

    if (empty($password_confirmation)) {
        $status['success'] = false;
        $status['fields']['password_confirmation'] = 'Please complete the password confirmation field.';
    }

    if ($password != $password_confirmation) {
        $status['success'] = false;
        $status['fields']['password_confirmation'] =  'The password and the password confirmation dosen\'t match with the password.';
    }

    if (!$status['success']) {
        $_SESSION['registration_status'] = $status;
        
        header('Location: user-account.php'); 
        exit;
    }

    $statment = $conn->prepare("INSERT INTO users( username, email, password ) VALUES (?, ?, ?)");
    $statment ->bind_param("sss", $name, $email, $hashedPassword);

    if ($statment->execute()) {
        // Insertion successful

        header('Location: mood-form.php');
        exit;

    } else {
        // Insertion failed
        $_SESSION['registration_status'] = [
            'success' => false,
            'message' => 'Registration failed. Please try again later.'
        ];

       header('Location: user-account.php'); 
        exit;
    }

    unset($_SESSION['registration_status']);
}
