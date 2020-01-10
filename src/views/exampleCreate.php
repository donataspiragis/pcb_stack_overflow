
{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <h2>Create new example for: {{data[0].Title}}</h2>
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/examples/store/{{data[0].id}}" method="post">
<!--        <input type="hidden" name="s" value="3487">-->
        <div class="form-group">
            <label for="titleInput1">Example title</label>
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