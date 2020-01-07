<?php

namespace App\Controller;
use App\App;
use DataBase\Connection;
use PDO;

class TopicController extends BaseController {


    public function index($DocTagId) {
        //takes required data for topic from db
        $rawTopic = (new Connection)->getData("SELECT Title, RemarksHtml, CreationDate, LastEditDate, ViewCount FROM topics WHERE id = $DocTagId AND Archived IS NULL");
        //takes the best score example
        $sqlGetTopic="SELECT Title, BodyHtml, CreationDate, LastEditDate, Score FROM examples WHERE DocTopicId = $DocTagId AND Archived IS NULL ORDER BY Score desc LIMIT 1 ";
        $rawExample = (new Connection)->getData($sqlGetTopic);
        //checks if rawTopic with selected id exists
        if(!empty($rawTopic)){
            $topicData=[];
            $topicData["Title"]=$rawTopic[0]["Title"];
            $topicData["RemarksHtml"]=$rawTopic[0]["RemarksHtml"];
            $topicData["CreationDate"]=$rawTopic[0]["CreationDate"];
            $topicData["LastEditDate"]=$rawTopic[0]["LastEditDate"];
            $ViewCount=$rawTopic[0]["ViewCount"]+1;
            $topicData["ViewCount"]=$ViewCount;
            $sql="UPDATE topics SET ViewCount=$ViewCount WHERE id=$DocTagId";
            $conn = (new Connection)->openConnection();
            $stmt =$conn->prepare($sql);
            $stmt->execute();
            $conn = null;
            $topicData["TopicID"]=$DocTagId;
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
//            var_dump($topicData);
            echo $this->render('topicIndex', ['data' => $topicData]);
        }
        else{
            //here should be 404 Error page call
            echo $this->render('topicIndex', ['data' => NULL]);
        }
    }

     public function create($data) {

        $data = (integer) $data;
        var_dump($data);
//         echo $this->render('topicCreat', ['data' =>$data ]);
     }
     public function store($languageID) {
         $time = date("Y-m-d H:i:s");
         $sql = "INSERT INTO topics (Title, RemarksHtml, CreationDate, DocTagID, ViewCount, Archived) VALUES ('$_POST[Title]', '$_POST[RemarksHtml]', '$time', $languageID, 0, NULL)";
         $conn = (new Connection)->openConnection();
         $stmt =$conn->prepare($sql);
         $stmt->execute();
         $conn = null;
         $sql2="SELECT id FROM topics ORDER BY id desc LIMIT 1";
         $id= (new Connection)->getData($sql2)[0]["id"];
         header("Location: ". App::INSTALL_FOLDER."/topic/index/$id");
         exit();
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
        $time = date("Y-m-d H:i:s");
         $sql = "UPDATE topics SET Title='$_POST[Title]', RemarksHtml='$_POST[RemarksHtml]', LastEditDate='$time' WHERE id=$DocTagId";
         $conn = (new Connection)->openConnection();
         $stmt =$conn->prepare($sql);
         $stmt->execute();
         $conn = null;
        header("Location: ". App::INSTALL_FOLDER."/topic/index/$DocTagId");
        exit();
     }

    public function destroy($docTagId) {
        $sql="UPDATE topics SET Archived=0 WHERE id=$docTagId";
        $conn = (new Connection)->openConnection();
        $stmt =$conn->prepare($sql);
        $stmt->execute();
        $conn = null;
        header("Location: ". App::INSTALL_FOLDER);
        exit();
    }

}