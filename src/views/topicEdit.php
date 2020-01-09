{% extends 'layout.php' %}
{% block title %}Topic Edit{% endblock %}
{% block body %}
<div class="container p-5 my-3 bg-dark text-white">
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/update/{{data.TopicID}}" method="post">
        <div>
            <label for="topicTitle">Topic title:</label>
            <input class="form-control" id="topicTitle" type="text" name="Title" value="{{data.Title}}">
        </div>
        <div>
            <label for="topicInfo">Topic:</label>
            <textarea class="form-control" id="topicInfo" rows="10" name="RemarksHtml">{{data.RemarksHtml}}</textarea>
        </div>
        <input type="submit" class="btn btn-warning"></input>
    </form>
</div>
{% endblock %}