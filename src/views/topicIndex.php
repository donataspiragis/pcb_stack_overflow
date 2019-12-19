
{% extends 'layout.php' %}
{% block title %}Topic{% endblock %}
{% block body %}

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        {% if data != NULL %}
        <div class="container">
            <p><b>Creation Date: </b>{{data.CreationDate}}</p>
            {% if data.LastEditDate != NULL %}
            <p><b>Last time modified at: </b>{{data.LastEditDate}}</p>
            {% endif %}
            <h4 class="display-8 text-danger">Topic views = {{data.ViewCount}}</h4>
            <h1 class="display-4">{{data.Title}}</h1>
            <p class="lead">{{data.RemarksHtml}}</p>
            <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/topic/destroy/{{data.TopicID}}">Delete Topic</a>
            <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/topic/edit/{{data.TopicID}}">Edit Topic</a>
        </div>
        <div class="container">
            <div class="border border-primary">
                {% if data.ExampleTitle != NULL %}
                <h3><b></b>Best rated example:</h3>
                <p><b>Creation Date: </b>{{data.ExampleCreationDate}}</p>
                {% if data.ExampleLastEditDate != NULL %}
                <p><b>Last time modified at: </b>{{data.ExampleLastEditDate}}</p>
                {% endif %}
                <h4 class="display-8 text-danger">Example score = {{data.ExampleScore}}</h4>
                <h1 class="display-4">{{data.ExampleTitle}}</h1>
                <p class="lead">{{data.ExampleBodyHtml}}</p>
                <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/examples/index/{{data.TopicID}}">More examples</a>
                {% endif %}
                {% if data.ExampleTitle == NULL %}
                <h4 class="display-8 text-danger">No example exist</h4>
                <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/examples/create/{{data.TopicID}}">More examples</a>
                {% endif %}
            </div>
        </div>
        {% endif %}
        {% if data == NULL %}
        <div class="container">
            <h4 class="display-8 text-danger">Topic was deleted or not created</h4>
        </div>
        {% endif %}


    </div>
</div>

{% endblock %}