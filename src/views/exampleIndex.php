
{% extends 'layout.php' %}
{% block title %}{{element.Title}}{% endblock %}
{% block body %}
<div class="container">
{% for element in data %}
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h4 class="display-8 text-danger">Example score = {{element.Score}}</h4>
            <h1 class="display-4">{{element.Title}}</h1>
            <p class="lead">{{element.BodyHtml}}</p>
        </div>
    <p>Posted on: {{element.CreationDate}}</p>
        {% if element.LastEditDate != NULL %}
        <p>Last time modified at: {{element.LastEditDate}}</p>
        {% endif %}
    <a role="button" class="btn btn-warning" href="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/edit/{{element.id}}">Edit</a>
    </div>
{% endfor %}
    <a type="button" class="btn btn-success" href="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/create/{{data[0].DocTopicId}}">Add new</a>
</div>
{% endblock %}