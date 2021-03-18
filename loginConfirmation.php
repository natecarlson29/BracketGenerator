<?php
require_once('database.php');
require_once('UserDB.php');

if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

$userName = filter_input(INPUT_POST, 'userName');
$password = filter_input(INPUT_POST, 'password');

$user = UserDB::getTO($userName);
$hashedPassword = $user->getPassword();

$isValid = true;
if($userName === ''){
    $isValid = false;
    $loginUserNameError = "User name cannot be blank" . $password;
}

if (!password_verify($password, $hashedPassword)){
    $isValid = false;
    $loginPasswordError = "Incorrect Password";
}

if($password === ""){
    $isValid = false;
    $loginPasswordError = "Password cannot be blank";
}

if($isValid === false) {
    include('login.php');
    exit();
}else{
    $_SESSION['user_logged'] = $userName;
}
