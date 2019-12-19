
{% extends 'layout.php' %}
{% block title %}Example create{% endblock %}
{% block body %}
<div class="container">
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/store/{{data}}" method="post">
        <div class="form-group">
            <label for="titleInput1">Title</label>
            <input type="text" name="Title" class="form-control" id="titleInput1">
        </div>
        <div class="form-group">
            <label for="Textarea1">Example textarea</label>
            <textarea class="form-control" id="Textarea1" rows="10" name="BodyHtml"></textarea>
        </div>
        <input type="submit" class="btn btn-warning"></input>
    </form>
</div>
{% endblock %}