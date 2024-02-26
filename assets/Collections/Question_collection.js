var QuestionsCollection = Backbone.Collection.extend({
    model: Question,
    url: 'api/questions',
    initialize: function() {
        console.log("Collection initialized.");
    }
});