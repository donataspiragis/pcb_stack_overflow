{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}

FRONT PAGE CONTROLLER INDEX RUNNING TEST
<form>
    <select name="tag">
        <option value="java">Java</option>
        <option value="php">PHP</option>
        <option value="c#">C#</option>
        <option value="javascript">Javascript</option>
    </select>
    <input type="text" placeholder="Search..">
    <button type="submit">Search</button>
</form>



<a href="#addTopic">Add Topic</a>

{% endblock %}