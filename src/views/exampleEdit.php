
{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <h2>Edit example</h2>
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/update/{{data[0].id}}" method="post">
        <div class="form-group">
            <label for="titleInput1">Title</label>
            <input type="text" name="Title" class="form-control" id="titleInput1" value="{{data[0].Title}}">
        </div>
        <div class="form-group">
            <label for="Textarea1">Example textarea</label>
            <textarea class="form-control" id="Textarea1" rows="10" name="BodyHtml">{{data[0].BodyHtml}}</textarea>
        </div>
    <input type="submit" class="btn btn-warning"></input>
    </form>
    <p>Posted on: {{data[0].CreationDate}}</p>
    {% if data[0].LastEditDate != NULL %}
    <p>Last time modified at: {{data[0].LastEditDate}}</p>
    {% endif %}
        <a type="button" class="btn btn-danger" href="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/destroy/{{data[0].id}}">Delete this example</a>
</div>
{% endblock %}