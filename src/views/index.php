{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Search Your Answer</h1></div>

                <div class="card-body">
                    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/front/store" method="post">
                        <div class="row">
                        <div class="col">
                        <select name="tag"  class="form-control">
                            <option value="default">Select Languege</option>
                            <option value="java">Java</option>
                            <option value="python">Python</option>
                            <option value="php">PHP</option>
                            <option value="c#">C#</option>
                            <option value="javascript">Javascript</option>
                            <option value="ruby">Ruby</option>
                        </select>
                        </div>
                            <div class="col">
                        <input type="text" name = "search" placeholder="Search.." class="form-control" >
                            </div>
                        <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>
                    <div class="front-form-header-question">
                        <div style="margin: auto 5px; font-weight: 500;">Cant find topic ? </div>
                        <div><button type="button" class="btn btn-info" style="margin: 15px 0 10px 0;">Add Topic</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-bottom: 25px;">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
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
                        <td> <em>{{  data.Title }} </em> </td>
                        <td><a href="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/index/{{ data.id }}" class="btn btn-outline-info">View</a></td>
                    </tr>




                {% endfor%}
                    </tbody>
                </table>
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <span class="btn btn-outline-danger" style="margin-right: 10px;">Total pages: {{ pag }}</span>
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

        </div>
    </div>
</div>

{% endblock %}
