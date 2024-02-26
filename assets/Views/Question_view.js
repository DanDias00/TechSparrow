
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
        console.log(this.collection.size());
        this.collection.each(function(question) {
            var view = new QuestionView({ model: question });
            this.$el.append(view.render().el);
        }, this);
        return this;
    }
});