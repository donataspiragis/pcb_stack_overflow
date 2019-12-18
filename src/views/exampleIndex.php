
{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
EXAMPLE PAGE CONTROLLER INDEX RUNNING TEST

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
    <a role="button" class="btn btn-warning" href="/examples/edit/{{element.id}}">Edit</a>
    </div>
{% endfor %}
    <a type="button" class="btn btn-success" href="/examples/create">Add new</a>
</div>
{% endblock %}