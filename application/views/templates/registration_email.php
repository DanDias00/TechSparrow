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
    .container { width: 100%; max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; }
    .button { background: #0275d8; color: #000000; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; }
    .button a { color: #FFFFFF; text-decoration: none; }
    .footer { font-size: 0.8em; text-align: center; color: #666; }
    .footer a { color: #666; text-decoration: none; }
</style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">Welcome to the Tech Sparrow Platform!</h1>
    <p>Hello <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>,</p>
    <p>Thank you for registering with Tech Sparrow!</p>

    <p> We're thrilled to have you join our community of tech enthusiasts and professionals dedicated to pushing the boundaries of technology.</p>
    <p>10,000+ businesses and personal worldwide use Tech Sparrow to actively engage and communicate among tech professionals solving real-world problems and creating a brighter future!.</p>
    <p>Our mission is to help you connect with other tech professionals, share your knowledge, and learn from others.</p>
    <p>Dive in and explore all that Tech Sparrow has to offer!</p>
    <p>Best Regards,<br>
    The Tech Sparrow Team </p>

    <p>Here are a few things you can do to get started:</p>
    <a href="http://[::1]/TechSparrow/index.php/User/login" class="button">LOGIN TO YOUR ACCOUNT</a>
    <h3>Have a question?</h3>
    <p>Check our <a href="http://yourwebsite.com/knowledgebase">FAQ</a> for a quick answer.</p>
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
