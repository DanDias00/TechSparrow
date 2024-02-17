
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .auth-inner {
            width: 300px;
        }
        .social-login {
            margin-bottom: 1rem;
        }

        
    </style>
</head>
<body>

<div class="auth-wrapper">
        <div class="auth-inner">
             <h2>Register</h2>
                <?php if($this->session->flashdata('register_failed')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('register_failed'); ?>
                </div>
                <?php endif; ?>

                <?php echo form_open('User/register'); ?>
                
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm your password" required>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>

                <!-- Additional Links -->
                <p class="forgot-password text-right">
                    Forgot <a href="#">password?</a>
                </p>
                <p class="text-right">
                    Already an account? <a href="login">Log in</a>
                </p>

                <?php echo form_close(); ?>
</div>

<script src="path/to/your/js/jquery.min.js"></script>
<script src="path/to/your/js/bootstrap.min.js"></script>
</body>
</html>

