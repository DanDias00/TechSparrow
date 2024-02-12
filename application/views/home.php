
<!--
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to TechSparrow!</h1>

	<div id="body">
	<a href="<?php echo site_url('User/register'); ?>" style="padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; margin-right: 10px;">Register</a>
        <a href="<?php echo site_url('User/login'); ?>" style="padding: 10px; background-color: #008CBA; color: white; text-decoration: none;">Login</a>
   


</form>
</div>

</body>
</html>
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Protest+Strike&display=swap" rel="stylesheet">

	<style>

		/* Add custom styles here */

		body{
			font-family: "Poppins", sans-serif;
			font-weight:200;
		}
		
		.welcome-container{
			background-color: antiquewhite;
			background-size: cover;
			background-position:center;
			background-repeat: repeat;
			
		}
		.welcome-container h2{
			font-family: "Poppins", sans-serif;
			font-weight:800;
			text-align: center;
			
		}


		.speech-bubble {
            position: relative;
            padding: 40px;
            margin: 20px;
            border-radius: 20px;
        }

		.about{

			background-color: #f9f9f9;
			padding: 20px;
			border-radius: 20px;
			
		}



        .speech-bubble::after {
            content: '';
            position: absolute;
            border: 20px solid transparent;
        }

      
		.testimonial-text {
    	font-style: italic;
    	margin-bottom: 15px;
		}

		em {
			font-weight: bold;
		}
		
		/* move CSS to a css file */

	</style>
</head>
<body>

<!-- Welcome Page Content -->
<div class="welcome-container">
	<div class="row">
	<h2 class="mt-4">Welcome to <span style="color: ;">Tech</span> <span style="color: chocolate;">Sparrow!</span></h2>
	</div>

	<div class="container my-5">
		<div class="row justify-content-around">
        <!-- Left speech bubble -->
        	<div class="col-md-5">
            	<div class="speech-bubble orange bg-light">
                	<h4>Find the best answer to your technical question, help others, be part of the global coummunity</h4>
                	<a href="<?php echo site_url('User/register'); ?>" class="btn btn-warning mt-3 ">Join the community</a>
            	</div>
        	</div>

        <!-- Right speech bubble -->
        <div class="col-md-5">
            <div class="speech-bubble blue bg-light">
                <h4>Already part of the global technical knowledge community?</h4>
                <a href="<?php echo site_url('User/login'); ?>" class="btn btn-warning mt-3">Login</a>
            </div>
        </div>
    </div>

	<div class="about mt-3">
		<h2 class="text-center mb-4">Tech <span style="color:chocolate ;">Sparrow </span> Global</h2>
		<p class="text-center">Tech Sparrow is a global community of tech enthusiasts and professionals dedicated to pushing the boundaries of technology. 
		We are a platform where you can find the best answers to your technical questions, help others, and be part of a global community of tech professionals solving real-world problems and creating a brighter future. 
		Our mission is to help you connect with other tech professionals, share your knowledge, and learn from others. 
		Join us and be part of the global technical knowledge community!</p>
	</div>
	
	<div class="row testimonial-container">
    <div class="col-12">
        <h2 class="text-center mb-4">Customer Testimonials</h2>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="<?php echo base_url('images/sparrow.jpg'); ?>"class="d-block w-100" alt="Customer 1">
                        </div>
                        <div class="col-md-8">
                            <p class="testimonial-text">"Sed ut perspiciatis unde omnis iste natus error sit 
								voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab 
								illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo."</p>
                            <em>- John Doe, CEO Wirklink</em>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
						<img src="<?php echo base_url('images/sparrow.jpg'); ?>" alt="Customer 2">
                        </div>
                        <div class="col-md-8">
                            <p class="testimonial-text">"Sed ut perspiciatis unde omnis iste natus error sit 
								voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab 
								illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo."</p>
                            <em>- Brian Hatten, Director Oracle</em>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
						<img src="<?php echo base_url('images/sparrow.jpg'); ?>"class="d-block w-100" alt="Customer 3">
                        </div>
                        <div class="col-md-8">
                            <p class="testimonial-text">"Sed ut perspiciatis unde omnis iste natus error sit 
								voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab 
								illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo."</p>
                            <em>- Maya Stern, CTO Burkett Technologies</em>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


</body>
</html>
