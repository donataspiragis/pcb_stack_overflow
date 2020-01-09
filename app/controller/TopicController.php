<?php

namespace App\Controller;
use App\App;
use DataBase\Connection;
use PDO;

class TopicController extends BaseController {


    public function index($DocTagId) {
        $sqlGetTopic="SELECT Title, RemarksHtml, CreationDate, LastEditDate, ViewCount FROM topics WHERE id = $DocTagId AND Archived IS NULL";
        $rawTopic = (new Connection)->getData($sqlGetTopic);
        $sqlGetTExample="SELECT Title, BodyHtml, CreationDate, LastEditDate, Score FROM examples WHERE DocTopicId = $DocTagId AND Archived IS NULL ORDER BY Score desc LIMIT 1 ";
        $rawExample = (new Connection)->getData($sqlGetTExample);
        $sqlGetExamplesNumber="SELECT COUNT(Archived is NULL) AS examplesNumber FROM examples WHERE DocTopicId = $DocTagId";
        $examplesNumber=(new Connection)->getData($sqlGetExamplesNumber);
        //checks if rawTopic with selected id exists
        if(!empty($rawTopic)){
            $topicData=[];
            $topicData["Title"]=$rawTopic[0]["Title"];
            $topicData["RemarksHtml"]=$rawTopic[0]["RemarksHtml"];
            $topicData["CreationDate"]=$rawTopic[0]["CreationDate"];
            $topicData["LastEditDate"]=$rawTopic[0]["LastEditDate"];
            $ViewCount=$rawTopic[0]["ViewCount"]+1;
            $topicData["ViewCount"]=$ViewCount;
            $data = ['ViewCount' => $ViewCount, 'id'=>$DocTagId];
            $sql = "UPDATE topics SET ViewCount=:ViewCount WHERE id=:id";
            (new Connection)->updateData($sql, $data);
            $topicData["TopicID"]=$DocTagId;
            $topicData["ExamplesNumber"]=$examplesNumber[0]["examplesNumber"];
            //checks if example not archived or exists at all
            if($rawExample!=NULL){
                $topicData["ExampleTitle"]=$rawExample[0]["Title"];
                $topicData["ExampleBodyHtml"]=str_replace("<code>",'<code class="text-success">',$rawExample[0]["BodyHtml"]);
                $topicData["ExampleCreationDate"]=$rawExample[0]["CreationDate"];
                $topicData["ExampleLastEditDate"]=$rawExample[0]["LastEditDate"];
                $topicData["ExampleScore"]=$rawExample[0]["Score"];
            }
            else{
                //change to take another example
                $topicData["ExampleTitle"]=NULL;
            }
            echo $this->render('topicIndex', ['data' => $topicData]);
        }
        else{
            // 404 Error page call
            echo $this->render('error404');
        }
    }

     public function create($id) {
         $sql="SELECT * FROM `languages` GROUP BY Title";
         echo $this->render('topicCreat', ['data' =>$id]);
     }

     public function store($id) {
        var_dump($_POST);
        $title=strlen($_POST["Title"]);
        $topic=strlen($_POST["RemarksHtml"]);
        if($title!=0 && $topic !=0 && $id>0){
            $time = BaseController::Carbonated();
            $data = ['Title'=>$_POST['Title'], 'RemarksHtml'=>$_POST['RemarksHtml'], 'CreationDate'=>$time, 'DocTagId'=>$id, 'ViewCount'=>0, 'Archived'=>NULL];
            $sql = "INSERT INTO topics (Title, RemarksHtml, CreationDate, DocTagId, ViewCount, Archived) VALUES (:Title, :RemarksHtml, :CreationDate, :DocTagId, :ViewCount, :Archived)";
            (new Connection)->storeData($sql, $data);
         $sql2="SELECT id FROM topics ORDER BY id desc LIMIT 1";
         $id= (new Connection)->getData($sql2)[0]["id"];
         header("Location: ". App::INSTALL_FOLDER."/topic/index/$id");
         exit();
        }
        else{
            echo '<script>function goBack() {window.history.go(-1);}goBack() </script>';
        }
     }

    public function edit($DocTagId) {
        $sql="SELECT id, Title, RemarksHtml, CreationDate, LastEditDate, ViewCount FROM topics WHERE id = $DocTagId AND Archived IS NULL";
        $rawTopic = (new Connection)->getData($sql);
        if(!empty($rawTopic)) {
            $topicData = [];
            $topicData["TopicID"]=$rawTopic[0]["id"];
            $topicData["Title"] = $rawTopic[0]["Title"];
            $topicData["RemarksHtml"] = $rawTopic[0]["RemarksHtml"];
            echo $this->render('topicEdit', ['data' => $topicData]);
        }
    }

     public function update($DocTagId) {
         $title=strlen($_POST["Title"]);
         $topic=strlen($_POST["RemarksHtml"]);
         if($title!=0 && $topic !=0) {
             $time = BaseController::Carbonated();
             $data = ['Title' => $_POST['Title'], 'RemarksHtml' => $_POST['RemarksHtml'], 'LastEditDate' => $time, 'id' => $DocTagId];
             $sql = "UPDATE topics SET Title=:Title, RemarksHtml=:RemarksHtml, LastEditDate=:LastEditDate WHERE id=:id";
             (new Connection)->updateData($sql, $data);
             header("Location: " . App::INSTALL_FOLDER . "/topic/index/$DocTagId");
             exit();
         }
         else{
             echo '<script>function goBack() {window.history.go(-1);}goBack() </script>';
         }
     }

    public function destroy($docTagId) {
        $data = ['Archived' => 0, 'id'=>$docTagId];
        $sql = "UPDATE topics SET Archived=:Archived WHERE id=:id";
        (new Connection)->updateData($sql, $data);
        header("Location: ". App::INSTALL_FOLDER);
        exit();
    }

}