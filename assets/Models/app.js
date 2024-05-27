// Define a Backbone model for an individual question
var Question = Backbone.Model.extend({
    defaults: {
        title: '',
        body: '',
        answer_count: 0,
        username: ''
    }
});

// Define a collection to hold question models
var QuestionCollection = Backbone.Collection.extend({
    model: Question,
    url: '/api/questions'  // Set this to the endpoint that returns your question data
});
