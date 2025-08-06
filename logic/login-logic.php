<?php

require '../config/database.php';

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email)) {
        $_SESSION['login-error'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login-error'] = "Please enter a valid email";
    } elseif (empty($password)) {
        $_SESSION['login-error'] = "Password is required";
    }

    if (isset($_SESSION['login-error'])) {
        $_SESSION['login-data'] = $_POST;
        header('location: ' . ROOT_URL . '/login.php');
        die();
    }

    $fetch_user_query = "SELECT * FROM users WHERE email='$email'";
    $fetch_user_result = mysqli_query($connection, $fetch_user_query);

    if (mysqli_num_rows($fetch_user_result) == 1) {
        $user_record = mysqli_fetch_assoc($fetch_user_result);
        $db_password = $user_record['password'];

        if (password_verify($password, $db_password)) {
            $_SESSION['user-id'] = $user_record['id'];
            $_SESSION['user-name'] = $user_record['name'];
            $_SESSION['user-email'] = $user_record['email'];

            $_SESSION['login-success'] = "Welcome back, " . $user_record['name'] . "!";

            header('location: ' . ROOT_URL . '/index.php');
            die();
        } else {
            $_SESSION['login-error'] = "Incorrect password";
        }
    } else {
        $_SESSION['login-error'] = "User not found";
    }

    header('location: ' . ROOT_URL . '/login.php');
    die();
} else {
    header('location: ' . ROOT_URL . '/login.php');
    die();
}
