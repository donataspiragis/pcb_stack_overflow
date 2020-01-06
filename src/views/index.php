{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}

                <div class="card-body">
                    <form action="/PCB/public/front/store" method="post">
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
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Language</th>
                        <th scope="col">Title</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                {% for data in data|slice(0, 10)  %}


                    <tr>
                        <th scope="row">{{loop.index}}</th>
                        <td>{{  data.TagName }}</td>
                        <td>{{  data.Title }}</td>
                        <td><a href="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/index/{{ data.id }}">View</a></td>
                    </tr>




                {% endfor%}
                    </tbody>
                </table>
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <span class="page-link">Total {{ pag }}</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#tab=4" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    {% if pag > 1 %}
                    {% for i in 2..pag  %}
                    <li class="page-item"><a class="page-link" href="#">{{ i }}</a></li>
                    {% endfor %}
                    {% endif %}
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <button type="button" class="btn btn-primary">Create</button>
        </div>
    </div>
</div>

<a href="#addTopic">Add Topic</a>

{% endblock %}
