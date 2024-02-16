<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ask a Question - Tech Sparrow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href= "http://localhost/TechSparrow/css/ask_question.css" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif !important;
            font-weight:400 !important;
            background-color: antiquewhite !important;
        }
    </style>
</head>
<body>
    <div class="container col-7 mt-5">
        <h1>Ask a Question</h1>
        <form action="<?php echo base_url('index.php/submit_question'); ?>" method="post">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Be specific and imagine you're asking a question to another person." required>
       
            </div>
            
            <!-- Body -->
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="6" required placeholder="The body of your question contains your problem details and results."></textarea>
            </div>
            
            <!-- Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" placeholder="Add up to 5 tags to describe what your question is about.">
                <small id="tagsHelp" class="form-text text-muted">Separate tags with commas (e.g., java, php, sql).</small>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Your Question</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
