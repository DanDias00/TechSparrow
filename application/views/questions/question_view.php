<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question - Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Protest+Strike&display=swap" rel="stylesheet">

    <style>

        body {
            font-family: "Poppins", sans-serif !important;
			font-weight:400 !important;
            background-color: antiquewhite !important;
        }
     
       .question{
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            background-color: white;
      
        }
        .question-header h1{
            font-family: "Poppins", sans-serif;
			font-weight:800;
        }
        .votes{
            margin-right: 20px;
            text-align: center;
        }
        .question-content{
            margin-right: 20px;
            
        }
        .question-meta{
            margin-top: 20px;

       }
    </style>
</head>
<body>

    <div class="container mt-4">
     <div class="row align-items-center">
            <div class="question-header col-6 d-flex justify-content-center">
                <h1>All Questions</h1>
            </div>
            <div class="ask-header col-6 d-flex justify-content-center">
                 <!-- Search form -->
                <form action="search" method="get" class="d-flex me-2">
                    <input type="search" name="q" class="form-control" placeholder="Search questions...">
                    <button type="submit" class="btn btn-outline-success ml-2">Search</button>
                </form>
                <a href="ask" class="btn btn-warning">Ask a Question</a>
            </div>
        </div>
        <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $question): ?>
        <div class="question mt-4">
        <div class="votes">
           <!--<span><?php echo $question['votes']; ?> votes</span> -->
        </div>
        <div class="question-content">
            <h3><a href="<?php echo base_url('index.php/view_question/' . $question['id']); ?>"><?php echo $question['title']; ?></a></h3>
            <p><?php echo $question['body']; ?></p>
        </div>

        <div class="question-meta d-flex justify-content-between">
        <span><?php echo $question['answer_count']; ?> answers</span>
        <!-- Assuming you have the username available -->
        <span class="text-muted">Asked by: <?php echo $question['username']; ?></span>
    </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="text-center">
            <h1>No questions found.</h1>
            <a href="<?php echo base_url('index.php/questions'); ?>" class="btn btn-primary">Go to All Questions</a>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>



