<?php

namespace App\Controller;
use App\App;
use DataBase\Connection;
use DateTime;
use mysql_xdevapi\Collection;
use PDO;


class ExamplesController extends BaseController
{
    public function index($docTopicId) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE DocTopicId = $docTopicId AND `Archived` IS NULL");
        echo $this->render('exampleIndex', ['data' => $raw]);
    }
    public function create($docTopicId) {
        echo $this->render('exampleCreate', ['data'=>$docTopicId]);
    }
    public function store($docTopicId) {
        $time = (new DateTime())->format('Y-m-d H:i:s');
        $data = ['Title'=>$_POST['Title'], 'BodyHtml'=>$_POST['BodyHtml'], 'CreationDate'=>$time, 'DocTopicId'=>$docTopicId, 'Score'=>0];
        $sql = "INSERT INTO examples  (Title, BodyHtml, CreationDate, DocTopicID, Score) VALUES (:Title, :BodyHtml, :CreationDate, :DocTopicId, :Score)";
        (new Connection)->storeData($sql, $data);
        header("Location: ". App::INSTALL_FOLDER."/examples/index/$docTopicId");
        exit();
    }
    public function edit($id) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE id = $id");
        echo $this->render('exampleEdit', ['data' => $raw]);

    }
    public function update($id) {
        $time = (new DateTime())->format('Y-m-d H:i:s');
        $data = ['Title'=>$_POST['Title'], 'BodyHtml'=>$_POST['BodyHtml'], 'LastEditDate'=>$time, 'id'=>$id];

        $sql = "UPDATE examples SET Title=:Title, BodyHtml=:BodyHtml, LastEditDate=:LastEditDate WHERE id=:id";
        (new Connection)->updateData($sql, $data);
        header("Location: ". App::INSTALL_FOLDER."/examples/edit/$id");
        exit();
    }
    public function destroy($id) {
        $time = (new DateTime())->format('Y-m-d H:i:s');
        $data = ['Archived'=>true, 'LastEditDate'=>$time, 'id'=>$id];
        $sql = "UPDATE examples SET Archived=:Archived, LastEditDate=:LastEditDate WHERE id=:id";
        (new Connection)->updateData($sql, $data);
        $docTopicId = ((new Connection)->getData("SELECT DocTopicId FROM examples WHERE id = $id"))[0]['DocTopicId'];
        header("Location: ". App::INSTALL_FOLDER."/examples/index/$docTopicId");
        exit();
    }
}