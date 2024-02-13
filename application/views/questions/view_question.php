<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>- Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $question['title']; ?></h2>
        <p><?php echo $question['body']; ?></p>
        <div class="question-meta">
            <span>Asked on <?php echo date('F j, Y', strtotime($question['created_at'])); ?></span>
            <span> - <?php echo $question['answer_count']; ?> Answers</span>
        </div>
    
        <!-- Placeholder for displaying answers -->
            <div class="answers">
                <h3>Answers:</h3>
                <?php if (!empty($answers)): ?>
                    <?php foreach ($answers as $answer): ?>
                        <div class="card mt-3">
                            <div class="card-body">
                                <?php echo $answer['body']; ?>
                                <div class="d-flex justify-content-end">
                                    <p class="text-muted mb-0">Answered by: <?php echo $answer['username']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No answers yet. Be the first to answer!</p>
                <?php endif; ?>
            </div>

        <!-- Placeholder for answer form -->
        <div class="answer-form mt-4">
    <h4>Submit Your Answer</h4>
    <form action="<?php echo base_url('index.php/answer/submit'); ?>" method="post">
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
