<?php

namespace App\Controller;
use DataBase\Connection;
use PDO;

class TopicController extends BaseController {


    public function index($docTagId) {
        //takes required data for topic from db
        $rawTopic = (new Connection)->getData("SELECT id, Title, RemarksHtml, CreationDate, LastEditDate, ViewCount FROM topics WHERE id = $docTagId AND Archived IS NULL OR Archived=0");
        //takes the best score example
        $rawExample = (new Connection)->getData("SELECT Title, BodyHtml, CreationDate, LastEditDate, MAX(Score) FROM examples WHERE DocTopicId = $docTagId AND Archived IS NULL OR Archived=0");
        if(!empty($rawTopic)){
            $topicData=[];
            $topicData["Title"]=$rawTopic[0]["Title"];
            $topicData["RemarksHtml"]=$rawTopic[0]["RemarksHtml"];
            $topicData["CreationDate"]=$rawTopic[0]["CreationDate"];
            $topicData["LastEditDate"]=$rawTopic[0]["LastEditDate"];
            $topicData["ViewCount"]=$rawTopic[0]["ViewCount"];
            $topicData["TopicID"]=$rawTopic[0]["id"];
            //checks if example not archived or exists at all
            if($rawExample!=NULL){
                $topicData["ExampleTitle"]=$rawExample[0]["Title"];
                $topicData["ExampleBodyHtml"]=$rawExample[0]["BodyHtml"];
                $topicData["ExampleCreationDate"]=$rawExample[0]["CreationDate"];
                $topicData["ExampleLastEditDate"]=$rawExample[0]["LastEditDate"];
                $topicData["ExampleScore"]=$rawExample[0]["MAX(Score)"];

            }
            else{
                //change to take another example
                $topicData["ExampleTitle"]=NULL;
            }
            echo $this->render('topicIndex', ['data' => $topicData]);
        }
        else{
            //here should be 404 Eror page call
            echo $this->render('topicIndex', ['data' => NULL]);
        }

    }

    // public function create() {
    //     echo $this->render('exampleCreate', []);
    // }
    // public function store() {
    //     return;
    // }
    public function edit() {
        echo 'Edit Under construction';
    }
    // public function update($data) {
    //     var_dump($data);
    // }
    public function destroy() {
        echo 'Delete Under construction';
    }

}