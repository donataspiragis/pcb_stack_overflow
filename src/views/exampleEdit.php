
{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
EXAMPLE PAGE CONTROLLER EDIT RUNNING TEST

<div class="container">
    <form>
        <div class="form-group">
            <label for="titleInput1">Title</label>
            <input type="text" class="form-control" id="titleInput1" value="{{data[0].Title}}">
        </div>
        <div class="form-group">
            <label for="Textarea1">Example textarea</label>
            <textarea class="form-control" id="Textarea1" rows="10">{{data[0].BodyHtml}}</textarea>
        </div>
    </form>
    <p>Posted on: {{data[0].CreationDate}}</p>
    {% if data[0].LastEditDate != NULL %}
    <p>Last time modified at: {{data[0].LastEditDate}}</p>
    {% endif %}
    <a role="button" class="btn btn-warning" href="/examples/update/">Save</a>
        <button type="button" class="btn btn-danger">Delete this example</button>
</div>
{% endblock %}