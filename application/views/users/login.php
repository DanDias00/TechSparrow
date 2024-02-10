
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="path/to/your/css/bootstrap.min.css"> <!-- Bootstrap for styling, if you're using it -->
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <?php if($this->session->flashdata('login_failed')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('login_failed'); ?>
    </div>
    <?php endif; ?>

    <?php echo form_open('User/login'); ?>
    
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>

    <?php echo form_close(); ?>
</div>

<script src="path/to/your/js/jquery.min.js"></script>
<script src="path/to/your/js/bootstrap.min.js"></script>
</body>
</html>
