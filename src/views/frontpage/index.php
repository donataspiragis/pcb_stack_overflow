{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Search Your Answer</h1></div>

                <div class="card-body">
                    <form action="/CBProject/public/front/store" method="post">
                        <select name="tag">
                            <option value="default">Select Languege</option>
                            <option value="java">Java</option>
                            <option value="python">Python</option>
                            <option value="php">PHP</option>
                            <option value="c#">C#</option>
                            <option value="javascript">Javascript</option>
                            <option value="ruby">Ruby</option>
                        </select>
                        <input type="text" name = "search" placeholder="Search..">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                {% for data in data|slice(0, 10)  %}
                <p>
                    <a href="/CBProject/public/front/index/{{  data.id }}">{{  data.Title }}</a>

                </p>
                {% endfor%}

            </div>
        </div>
    </div>
</div>


{% endblock %}