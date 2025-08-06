<?php
require './config/database.php';

$form_data = isset($_SESSION['signup-data']) ? $_SESSION['signup-data'] : [
    'name' => '',
    'email' => ''
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Marriage Biodata</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="form-container">
        <?php if (isset($_SESSION['signup-error'])): ?>
            <div class="alert-message error">
                <p><?= $_SESSION['signup-error'];
                    unset($_SESSION['signup-error']); ?></p>
            </div>
        <?php endif ?>

        <div class="form-header">
            <h1>Create Account</h1>
            <p>Join us to create your marriage biodata profile</p>
        </div>

        <form action="<?= ROOT_URL ?>/logic/signup-logic.php" method="POST">
            <div class="form-group">
                <label for="name" class="required-label">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    placeholder="Enter your full name"
                    value="<?= $form_data['name'] ?>">
            </div>

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
                    placeholder="Create a password (min 8 characters)">
            </div>

            <div class="form-group">
                <label for="confirmPassword" class="required-label">Confirm Password</label>
                <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    required
                    placeholder="Confirm your password">
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            </div>

            <p class="auth-link">Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </div>
</body>

</html>