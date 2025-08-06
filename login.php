<?php

require './config/database.php';

$form_data = isset($_SESSION['login-data']) ? $_SESSION['login-data'] : [
    'email' => ''
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Marriage Biodata</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="form-container">
        <?php if (isset($_SESSION['login-error'])): ?>
            <div class="alert-message error">
                <p><?= $_SESSION['login-error'];
                    unset($_SESSION['login-error']); ?></p>
            </div>
        <?php elseif (isset($_SESSION['signup-success'])): ?>
            <div class="alert-message success">
                <p><?= $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']); ?></p>
            </div>
        <?php endif ?>

        <div class="form-header">
            <h1>Welcome Back</h1>
            <p>Login to access your marriage biodata profile</p>
        </div>

        <form action="<?= ROOT_URL ?>/logic/login-logic.php" method="POST">
            <div class="form-group">
                <label for="email" class="required-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="Enter your email address"
                    value="<?= $form_data['email'] ?>">
            </div>

            <div class="form-group">
                <label for="password" class="required-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Enter your password">
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-primary">Log In</button>
            </div>

            <p class="auth-link">Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>