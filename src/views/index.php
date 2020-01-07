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
                        <div class="row">
                            <div class="col">
                        <select name="tag" class="form-control">
                            <option value="default">Select Language</option>
                            <option value="java">Java</option>
                            <option value="python">Python</option>
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
                            <div class="col">
                        <input type="text" name = "search" placeholder="Search.." class="form-control">
                            </div>
                        <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>

                    <div class="front-form-header-question">
                        <div style="margin: auto 5px; font-weight: 500;">Cant find topic ? Select language and add: </div>
                        <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/create/ {{ form.vars.value.id}}" method="get">
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
<div class="container" style="margin-bottom: 25px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table" id="dtBasicExample">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Language</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Viewed</th>
                        <th scope="col">Check it</th>
                    </tr>
                    </thead>
                    <tbody>
                {% for data in data%}


                    <tr>
                        <th scope="row">{{loop.index}}</th>
                        <td>{{  data.TagName }}</td>
                        <td>{{  data.Title }}</td>
                        <td>  <div class="btn btn-success"> {{  data.ViewCount }}</div>  </td>
                        <td><a href="{{ constant('App\\App::INSTALL_FOLDER') }}/topic/index/{{ data.id }}" class="btn btn-outline-info">View</a></td>
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

