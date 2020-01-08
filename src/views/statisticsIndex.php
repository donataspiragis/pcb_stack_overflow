
{% extends 'layout.php' %}
{% block title %}Statistics{% endblock %}
{% block body %}

<div id="stat-form-container" class="container">
    <form method="POST">
        {% for btn in btns %}
            <button type="submit" class="btn {{btn.class}}" name="action" value="{{btn.value}}">{{btn.text}}</button>
        {% endfor %}
    </form>
</div>

<div id="stat-results-container" class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ViewCount</th>
                <th scope="col">Topic</th>
                <th scope="col">Language</th>
            </tr>
        </thead>
        <tbody>
            {% for index, topic in topics %}
                <tr>
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ topic.ViewCount }}</td>
                    <td><a href="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/index/{{topic.DocTagId}}">{{ topic.Title }}</a></td>
                    <td>{{ topic.Language }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endblock %}

