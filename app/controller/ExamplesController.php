<?php

namespace App\Controller;
use App\App;
use DataBase\Connection;
use DateTime;

class ExamplesController extends BaseController
{
    public function index($docTopicId) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE DocTopicId = $docTopicId AND `Archived` IS NULL");
        echo $this->render('exampleIndex', ['data' => $raw]);
    }
    public function create($docTopicId) {
        $raw = (new Connection)->getData("SELECT Title, id FROM topics WHERE id = $docTopicId AND `Archived` IS NULL");
        if (!empty($raw)) {
            echo $this->render('exampleCreate', ['data' => $raw]);
        } else{
            echo $this->render('error404', ['data' => $raw]);
        }
    }
    public function store($docTopicId) {
        $time = BaseController::Carbonated();
        $data = ['Title'=>$_POST['Title'], 'BodyHtml'=>$_POST['BodyHtml'], 'CreationDate'=>$time, 'DocTopicId'=>$docTopicId, 'Score'=>0];
        $sql = "INSERT INTO examples  (Title, BodyHtml, CreationDate, DocTopicID, Score) VALUES (:Title, :BodyHtml, :CreationDate, :DocTopicId, :Score)";
        (new Connection)->storeData($sql, $data);
        header("Location: ". App::INSTALL_FOLDER."/examples/index/$docTopicId");
        exit();
    }
    public function edit($id) {
        $raw = (new Connection)->getData("SELECT * FROM examples WHERE id = $id");
//        var_dump($raw);
        if (!empty($raw)) {
        $DocTopicId =$raw[0]['DocTopicId'];
        $title = (new Connection)->getData("SELECT Title FROM topics WHERE id = $DocTopicId AND `Archived` IS NULL");
        $title = $title[0]['Title'];
        echo $this->render('exampleEdit', ['data' => $raw, 'title'=>$title]);
        } else {
            echo $this->render('error404', ['data' => $raw]);
        }
    }
    public function update($id) {
        $time = BaseController::Carbonated();
        $data = ['Title'=>$_POST['Title'], 'BodyHtml'=>$_POST['BodyHtml'], 'LastEditDate'=>$time, 'id'=>$id];

preg_match_all('/<script>(.*?)<\/script>/s', $data['BodyHtml'], $scripts);
        foreach($scripts[1] as $values){
           
            $neaw = '<code> <script>'.$values.'</script> </code>';
            $values = '<script>'.$values.'</script>';
            $data['BodyHtml'] = str_replace($values, $neaw, $data['BodyHtml']);
        }
	preg_match_all('/<code>(.*?)<\/code>/s', $data['BodyHtml'], $matches);
        foreach($matches[1] as $value){
            $new = htmlspecialchars($value);
            $data['BodyHtml'] = str_replace($value, $new, $data['BodyHtml']);
        }
        
        $sql = "UPDATE examples SET Title=:Title, BodyHtml=:BodyHtml, LastEditDate=:LastEditDate WHERE id=:id";
        (new Connection)->updateData($sql, $data);
        header("Location: ". App::INSTALL_FOLDER."/examples/index/".$_POST['DocTopicId']);
        exit();
    }
    public function destroy($id) {
        $time = BaseController::Carbonated();
        $data = ['Archived'=>true, 'LastEditDate'=>$time, 'id'=>$id];
        $sql = "UPDATE examples SET Archived=:Archived, LastEditDate=:LastEditDate WHERE id=:id";
        (new Connection)->updateData($sql, $data);
        $docTopicId = ((new Connection)->getData("SELECT DocTopicId FROM examples WHERE id = $id"))[0]['DocTopicId'];
        header("Location: ". App::INSTALL_FOLDER."/examples/index/$docTopicId");
        exit();
    }
}
