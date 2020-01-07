
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
{% for topic in topics %}
    <div class="container">
        <p style="display: inline-block; width: 50px; color: red;">{{topic.ViewCount}}</p>
        <p style="display: inline-block; font-weight: bolder;">{{topic.Title}}</p>
        <p style="display: inline-block; margin-left: 5px; color: green;">{{topic.Language}}</p>
    </div>
{% endfor %}
</div>
{% endblock %}