{% extends 'layout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Search Your Answer</h1></div>

                <div class="card-body">
                    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}" method="get">
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

                    <div class="front-form-header-question">
                        <div style="margin: auto 5px; font-weight: 500;">Cant find topic ? Select language and add: </div>
                        <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/create" method="get">
                            <div class="row">
                                <div class="col">
                                    <select name="tag"  class="form-control" style="margin-top: 13px;">
                                        <option value="default">Select Language</option>
                                        <option value="5">Java</option>
                                        <option value="11">Python</option>
                                        <option value="php">PHP</option>
                                        <option value="c#">C#</option>
                                        <option value="c++">C++</option>
                                        <option value=".net">NET</option>
                                        <option value="javascript">Javascript</option>
                                        <option value="ruby">Ruby</option>
                                        <option value="android">Android</option>
                                        <option value="swift">Swift</option>
                                        <option value="node.js">Node</option>
                                        <option value="html">HTML</option>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info" style="margin: 15px 0 10px 0;">Add Topic</button>
                            </div>
                        </form>

                    </div>
                </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table" id="dtBasicExample">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Language</th>
                        <th scope="col">Title</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                {% for data in data%}


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
            <div ><ul id="pagination" class="pagination"> </ul> </div>
        </div>
    </div>
</div>



{% endblock %}

