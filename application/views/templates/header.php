<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TechSparrow</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <!-- Navbar toggler button for mobile view -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/TechSparrow/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/TechSparrow/index.php/questions">Questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/TechSparrow/">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/TechSparrow/">Contact</a>
        </li>
         <!-- User icon link, shown only when logged in -->
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE): ?>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/TechSparrow/index.php/Myprofile">
            <i class="fa fa-user" aria-hidden="true"></i> My Profile
          </a>
        </li>
      </ul>
    <?php endif; ?>
      </ul>
    </div>

   

    <!-- Brand logo -->
    <a class="navbar-brand ms-auto" href="#">Logo</a>
  </div>
</nav>


<!-- Bootstrap JS (optional, for toggling the navbar on small screens) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
