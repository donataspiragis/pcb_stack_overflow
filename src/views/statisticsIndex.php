
{% extends 'layout.php' %}
{% block title %}Statistics{% endblock %}
{% block body %}

<div class="container">
{% for element in data %}
        <div class="container">
            <p style="display: inline-block; width: 50px; color: red;">{{element.ViewCount}}</p>
            <p style="display: inline-block; font-weight: bolder;">{{element.Title}}</p>
            <p style="display: inline-block; margin-left: 5px; color: green;">{{element.Language}}</p>
        </div>
{% endfor %}
</div>
{% endblock %}