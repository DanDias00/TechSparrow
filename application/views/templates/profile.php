<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Profile</h1>
                    <p>Welcome to your profile page, <?php echo $_SESSION['username']; ?>!</p>
                    <p>Here, you can view and manage your account details.</p>
                    <p>Click <a href="/TechSparrow/index.php/logout">here</a> to log out.</p>
                </div>
            </div>
        </div>
    </body>
</html>
