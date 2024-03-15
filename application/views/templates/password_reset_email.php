<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body { font-family: Arial, sans-serif; line-height: 1.6; }
    .container { width: 80%; max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; }
    .button { background: #0275d8; color: #000000; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; }
    .button a { color: #FFFFFF; text-decoration: none; }
    .footer { font-size: 0.8em; text-align: center; color: #666; }
    .footer a { color: #666; text-decoration: none; }
</style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">Credentials Reset</h1>
    <h2>Hello <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>,</h2>
    <h3>Whoops! looks like you have forgotten your credentials. Don't worry we got you covered!</h3>

    <p>Follow below instructions to reset password</p>

    <p>To reset your password, please click the button below:</p>

    <a href="<?php echo $reset_link; ?>" class="button">Reset Password</a>

    <p>you received this email because you have requsted credential reset. If you did not make this request, please ignore this email.</p>

    <p>Best Regards,<br>
    The Tech Sparrow Team </p>

    <p>You can always contact our <a href="http://yourwebsite.com/support">24/7 support team</a> via live chat and email. We will be happy to help you!</p>
    <p class="footer">© 2024 Tech Sparrow, Inc. All rights reserved.<br>
    123 Sparrow Street, Atlantis, OR, 13499 SL, (+94) 077-676-8338</p>
    <p class="footer">
        <a href="http://yourwebsite.com">View as a Web Page</a>
        <br>
        <a href="http://yourwebsite.com/unsubscribe">unsubscribe</a>
    </p>


</div>
</body>
</html>
