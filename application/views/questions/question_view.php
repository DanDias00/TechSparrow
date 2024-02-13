<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question - Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
    </style>
</head>
<body>
    <!-- You can integrate Bootstrap or any other CSS framework to match the styling of StackOverflow -->
<div class="container">
    <h1>All Questions</h1>
    <?php foreach ($questions as $question): ?>
    <div class="question">
        <div class="votes">
            <span><?php echo $question['votes']; ?> votes</span>
        </div>
        <div class="question-content">
            <h2><a href="/questions/view/<?php echo $question['id']; ?>"><?php echo $question['title']; ?></a></h2>
            <p><?php echo $question['body']; ?></p>
        </div>
        <div class="question-meta">
            <span><?php echo $question['answers_count']; ?> answers</span>
            <span><?php echo $question['views']; ?> views</span>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>



