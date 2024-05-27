<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CDN for styling (Make sure to use the correct version) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom styles -->
    <style>
        body {
            padding-top: 40px;
            background-color: #f7f7f7;
            color: #5a5a5a;
            background-color: antiquewhite;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-weight: 300;
            margin-bottom: 20px;
        }
        a {
            color: #007bff;
        }
        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profile</h1>
             
                <p>Here, you can view and manage your account details.</p>
                
                <p>
                    <span id="usernameText">Username: <?php echo $user->username; ?></span>
                    <i class="fas fa-edit" onclick="editField('username')"></i>
                    <input type="text" id="usernameInput" value="<?php echo $user->username; ?>" style="display:none;">
                </p>
                
                <p>
                    <span id="emailText">Email: <?php echo $user->email; ?></span>
                    <i class="fas fa-edit" onclick="editField('email')"></i>
                    <input type="text" id="emailInput" value="<?php echo $user->email; ?>" style="display:none;">
                </p>
            
              <!--  <a href="/TechSparrow/index.php/userreputation" class="btn btn-primary">View User Reputation</a> -->

                <p> click below to log out</p>
                <a href="/TechSparrow/index.php/logout" class="btn btn-warning">Log out</a>
                <p> click below to delete account permanently</p>
                <a href="/TechSparrow/index.php/logout" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function editField(field) {
            // Hide text, show input field, and focus on it
            document.getElementById(field + 'Text').style.display = 'none';
            document.getElementById(field + 'Input').style.display = 'inline-block';
            document.getElementById(field + 'Input').focus();
        }
    </script>
</body>
</html>
