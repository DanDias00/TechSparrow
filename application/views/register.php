<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Optional: Include your CSS file here -->
</head>
<body>

<div class="container">
    <h1>Register</h1>

    <?php if(validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php echo form_open('User/register'); ?>
    
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirm">Confirm Password:</label>
        <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>

    <?php echo form_close(); ?>
</div>

</body>
</html>
