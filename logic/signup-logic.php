<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($name)) {
        $_SESSION['signup-error'] = "Name is required";
    } elseif (empty($email)) {
        $_SESSION['signup-error'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['signup-error'] = "Please enter a valid email";
    } elseif (empty($password)) {
        $_SESSION['signup-error'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $_SESSION['signup-error'] = "Password must be at least 8 characters";
    } elseif ($password !== $confirmPassword) {
        $_SESSION['signup-error'] = "Passwords do not match";
    }

    if (!isset($_SESSION['signup-error'])) {
        $user_check_query = "SELECT * FROM users WHERE email='$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['signup-error'] = "Email already exists";
        }
    }

    if (isset($_SESSION['signup-error'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . '/signup.php');
        die();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_user_query = "INSERT INTO users (name, email, password) 
                             VALUES ('$name', '$email', '$hashed_password')";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = "Registration successful. Please log in.";
            header('location: ' . ROOT_URL . '/login.php');
            die();
        } else {
            $_SESSION['signup-error'] = "Registration failed";
            header('location: ' . ROOT_URL . '/signup.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . '/signup.php');
    die();
}
