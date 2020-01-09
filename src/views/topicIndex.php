{% extends 'layout.php' %}
{% block title %}Topic{% endblock %}
{% block body %}

<div class="container">
        {% if data != NULL %}
        <div class="container p-5 my-3 bg-dark text-white">
            <h4 class="text-primary">Topic views = {{data.ViewCount}}</h4>
            <p></p>
            <p><b class="text-secondary">Creation Date: </b>{{data.CreationDate}}</p>
            {% if data.LastEditDate != NULL %}
            <p><b class="text-secondary">Last time modified: </b>{{data.LastEditDate}}</p>
            {% endif %}
            <h1>{{data.Title}}</h1>
            <p class="lead">{{data.RemarksHtml}}</p>
            <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/topic/destroy/{{data.TopicID}}">Delete Topic</a>
            <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/topic/edit/{{data.TopicID}}">Edit Topic</a>
        </div>
        <div class="container p-5 my-3 bg-dark text-white">
            <div class="border border-primary p-5">
                {% if data.ExampleTitle != NULL %}
                <h3><b class="text-primary">Best rated example with : </b>{{data.ExampleScore}} likes</h3>
                <p><b class="text-secondary">Creation Date: </b>{{data.ExampleCreationDate}}</p>
                {% if data.ExampleLastEditDate != NULL %}
                <p><b class="text-secondary">Last time modified at: </b>{{data.ExampleLastEditDate}}</p>
                {% endif %}
                <h1>{{data.ExampleTitle}}</h1>
                <p>{{data.ExampleBodyHtml}}</p>
                <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/examples/index/{{data.TopicID}}">More examples</a>
                {% endif %}
                {% if data.ExampleTitle == NULL %}
                <h4 class="display-8 text-danger">No example exist</h4>
                <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/examples/create/{{data.TopicID}}">Creat example</a>
                {% endif %}
            </div>
        </div>
        {% endif %}
        {% if data == NULL %}
        <div class="container p-5 my-3 bg-dark">
            <h4 class="text-danger">Topic don`t exist</h4>
            <a role="button" class="btn btn-warning" href="{{constant('App\\App::INSTALL_FOLDER')}}/examples/create/{{data.TopicID}}">Creat topic</a>
        </div>
        {% endif %}


    </div>


{% endblock %}