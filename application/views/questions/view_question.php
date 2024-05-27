<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>- Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color:antiquewhite !important;
        }
        .card{
            background-color:white;
            padding:20px;
            border-radius:20px;
            margin-top:20px;
        }
        .question-card{
            background-color:white;
            padding:5px;
            border-radius:20px;
        
        }

        .answer-container{
            width: 70vw;
            height:10vh;
        

        }
        .comment{
            background-color:white;
            padding:10px;
            border-radius:10px;
            margin-top:2px;
            width: 82vw;
            max-width: 100%;
            float:right;
           
        }

        .vote-buttons {
            width: 10vw;
        }
    
        .form-group{
            width: 82vw;
            float:right;
            
            max-width: 100%;
        }

        .btn {
           margin-left: 2.5vw;
        }

        </style>
</head>
<body>
    <div class="container mt-5">
        <div class ="question-card">
        <div class="question-content">
            <h2><?php echo $question['title']; ?></h2>
            <p><?php echo $question['body']; ?></p>
        </div>
        <div class="question-meta">
            <span>Asked on <?php echo date('F j, Y', strtotime($question['created_at'])); ?></span>
           <!-- <span> - <?php echo !empty($answers) ? $answers[0]['answer_count'] : '0'; ?> Answers</span> -->

        </div>
        </div>
    
        <!-- Placeholder for displaying answers -->
            <div class="answers mt-3">
                <h3>Answers:</h3>
                <?php if (!empty($answers)): ?>
                    <?php foreach ($answers as $answer): ?>
                        <div class="card mt-3">
                        <div class="card-body">
        <div class="row">
            <!-- Answer Text Column -->
            <div class="col-md-10"> <!-- Adjusted to take more space -->
                <?php echo $answer['body']; ?>
            </div>
            
            <!-- Voting Buttons Column -->
            <div class="col-md-2"> <!-- Adjusted to take less space -->
                <div class="vote-buttons text-center">
                    <!-- Upvote Button -->
                    <a href="<?php echo base_url('votes/upvote/' . $answer['id']); ?>" class="vote-up btn btn-link btn-sm mb-1">
                        <i class="fa fa-caret-up fa-2x" aria-hidden="true">Upvote</i>
                    </a>
                    <!-- Vote Count -->
                    <div class="vote-count">
                        <?php echo 5; ?>
                    </div>
                    <!-- Downvote Button -->
                    <a href="<?php echo base_url('votes/downvote/' . $answer['id']); ?>" class="vote-down btn btn-link btn-sm">
                        <i class="fa fa-caret-down fa-2x" aria-hidden="true">Downvote</i>
                    </a>
                </div>
                <div class="text-muted">Answered by: <?php echo $answer['username']; ?></div>
            </div>
        </div>
    </div>
                        </div>
                        
                        <!-- Display comments -->
                            <?php if (!empty($answer['comments'])): ?>
                                 <?php foreach ($answer['comments'] as   $comment): ?>
                                        <div class="comment">
                                          <!-- Display comment details -->
                                            <?php echo $comment['body']; ?>
                                            <div class="d-flex justify-content-end mr-4">
                                                 <p><small>Commented by: <?php echo $comment['username']; ?></small></p>
                                            </div>
                                        </div>
                                     <?php endforeach; ?>
                            <?php endif; ?>

                            <!-- Comment submission form -->
                            <div class="comment-form">
                            <form action="<?php echo base_url('index.php/submit_comment'); ?>" method="post">
                                    <input type="hidden" name="answer_id" value="<?php echo $answer['id']; ?>">
                                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                                    <div class="form-group">
                                        <textarea name="comment_body" placeholder="Add a comment.." class="form-control mt-2"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Comment</button>
                                </form>
                            </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No answers yet. Be the first to answer!</p>
                <?php endif; ?>
            </div>

        <div class="answer-form mt-4">
    <h4>Have a solution? Submit Your Answer</h4>
    <form action="<?php echo base_url('index.php/submit_answer'); ?>" method="post">
        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
        <div class="form-group">
            <textarea class="form-control" name="body" rows="3" required placeholder="Type your answer here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Submit Answer</button>
    </form>
    
</div>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>