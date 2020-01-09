{% extends 'layout.php' %}
{% block title %}Topic Creat{% endblock %}
{% block body %}
<div class="container p-5 my-3 bg-dark text-white">
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/store/{{data}}" method="post">
        <div>
            <label for="topicTitle">Topic title:</label>
            <textarea class="form-control" id="topicTitle" rows="1" name="Title"></textarea>
        </div>
        <div>
            <label for="topicInfo">Topic:</label>
            <textarea class="form-control" id="topicInfo" rows="10" name="RemarksHtml"></textarea>
        </div>
        <input type="submit" class="btn btn-warning"></input>
        <a href="{{ constant('App\\App::INSTALL_FOLDER') }}" class="btn btn-warning" >Cancel</a>
    </form>
</div>
{% endblock %}