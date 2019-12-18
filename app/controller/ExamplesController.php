<?php

namespace App\Controller;
use DataBase\Connection;
use PDO;


class ExamplesController extends BaseController
{

    public function index($docTopicId) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE DocTopicId = $docTopicId");
        echo $this->render('exampleIndex', ['data' => $raw]);
    }
    public function create() {
        echo $this->render('exampleCreate', []);
    }
    public function store() {
        return;
    }
    public function edit($id) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE id = $id");
        echo $this->render('exampleEdit', ['data' => $raw]);
    }
    public function update($data) {
        var_dump($data);
    }
    public function destroy() {
        return;
    }
}

