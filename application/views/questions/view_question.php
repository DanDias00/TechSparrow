<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>- Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: antiquewhite !important;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 20px;
            margin-top: 20px;
        }

        .question-card {
            background-color: white;
            padding: 5px;
            border-radius: 20px;

        }

        .answer-container {
            width: 70vw;
            height: 10vh;


        }

        .comment {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            margin-top: 2px;
            width: 82vw;
            max-width: 100%;
            float: right;

        }

        .vote-buttons {
            width: 10vw;
        }

        .form-group {
            width: 82vw;
            float: right;

            max-width: 100%;
        }

        .btn {
            margin-left: 2.5vw;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="question-card">
            <script type="text/template" id="question-template">
                <div class="question-content">
                    <h2><%-title %></h2>
                    <p><%- body %></p>
                </div>
        <div class="question-meta">
            <span>Asked on <%- created_at %></span>
            <span> - <%- answer_count %> Answers</span>
        </div>
    </script>
            <!-- Placeholder for displaying answers -->
            <script type="text/template" id="answer-template">
                <div class="answers mt-3">
                    <h3>Answers:</h3>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Answer Text Column -->
                                        <div class="col-md-10"><%- body %></div>

                                        <!-- Voting Buttons Column -->
                                        <div class="col-md-2"> <!-- Adjusted to take less space -->
                                            <div class="vote-buttons text-center">
                                                <!-- Upvote Button -->
                                                <a href="#" class="vote-up btn btn-link btn-sm mb-1">Upvote</a>
                                                <div class="vote-count"><%- votes %></div>
                                                <a href="#" class="vote-down btn btn-link btn-sm">Downvote</a>
                                            </div>
                                            <div class="text-muted">Answered by: <%- username %></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </script>

                        <!-- Display comments -->
                        <?php if (!empty($answer['comments'])) : ?>
                            <?php foreach ($answer['comments'] as $comment) : ?>
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
                <?php else : ?>
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

        <script>
            // Define a global variable for the base URL
            var appBaseUrl = "<?php echo base_url(); ?>";
        </script>
        
        <script>
        var Question = Backbone.Model.extend({});
        var Answer = Backbone.Model.extend({});

        var AnswersCollection = Backbone.Collection.extend({
            model: Answer,
            url: appBaseUrl + 'api/answers' // Adjust URL
        });

        var QuestionView = Backbone.View.extend({
            el: '.question-card',
            template: _.template($('#question-template').html()),
            render: function() {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            }
        });

        var AnswerView = Backbone.View.extend({
            tagName: 'div',
            template: _.template($('#answer-template').html()),
            render: function() {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            }
        });

        var AnswersView = Backbone.View.extend({
            el: '.answers',
            initialize: function() {
                this.collection = new AnswersCollection();
                this.listenTo(this.collection, 'sync', this.render);
                this.collection.fetch();
            },
            render: function() {
                this.$el.empty();
                this.collection.each(function(answer) {
                    var view = new AnswerView({ model: answer });
                    this.$el.append(view.render().el);
                }, this);
                return this;
            }
        });

        $(document).ready(function() {
            var question = new Question(<?php echo json_encode($question); ?>);
            var questionView = new QuestionView({ model: question });
            questionView.render();

            new AnswersView();
        });
</script>

</body>
</html>