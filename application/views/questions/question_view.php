<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question - Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/TechSparrow/css/question.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Protest+Strike&display=swap" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    
    <style>
 
    body {
    font-family: "Poppins", sans-serif !important;
    font-weight:400 !important;
    background-color: antiquewhite !important;
}

.question{
    background-color:white;
    padding:20px;
    border-radius:20px;
    margin-top:20px;
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

.tag-label{
    background-color: cornflowerblue;
    border-radius: 5px;
 
    padding: 5px;
}
.question-tags{
    margin-top: 10px;
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
        <!-- Container for Backbone.js to render into -->
        <div id="questions-container"></div>
    </div>
    <!-- Backbone.js template for questions -->
    <script type="text/template" id="question-template">
    <div class="votes">
        <!-- Placeholder for any vote-related markup -->
    </div>
    <div class="question-content">
        <h3><a href="<%= 'view_question/' + id %>"><%= title %></a></h3>
        <p><%= body %></p>
    </div>
    <div class="question-meta d-flex justify-content-between">
        <span><%= answer_count %> answers</span>
        <span class="text-muted">Asked by: <%= username %></span>
    </div>
    <div class="question-tags">
        <% _.each(tags, function(tag) { %>
            <span class="tag-label"><%= tag %></span>
        <% }); %>
    </div>

</script>
<script type="text/javascript">
    // Define a global variable for the base URL
    var appBaseUrl = "<?php echo base_url(); ?>";
</script>
<script>

var Question = Backbone.Model.extend({
    defaults: {
        title: '',
        body: '',
        answer_count: 0,
        username: '',
        tags: []
    }
});

var QuestionsCollection = Backbone.Collection.extend({
    model: Question,
    url: 'api/questions',
    initialize: function() {
        console.log("Collection initialized.");
    }
});

var QuestionView = Backbone.View.extend({
    tagName: 'div',
    className: 'question mt-4',
    template: _.template($('#question-template').html()),
    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

var QuestionsView = Backbone.View.extend({
    el: '#questions-container',
    initialize: function() {
    console.log("QuestionsView initialized.");
    this.listenTo(this.collection, 'sync', this.render);
    this.collection.fetch({
        success: function(collection, response, options) {
            console.log("Fetch successful:", response);
            
        },
        error: function(collection, response, options) {
            console.error("Fetch error:", response.responseText);
        }
    });
},

    render: function() {
        this.$el.empty(); // Clear the container before rendering new items
        this.collection.each(function(question) {
            var view = new QuestionView({ model: question });
            this.$el.append(view.render().el);
        }, this);
        return this;
    }
});

$(document).ready(function() {
    var questionsCollection = new QuestionsCollection();
    console.log(questionsCollection);
    new QuestionsView({ collection: questionsCollection });
});

</script>
</body>
</html>



