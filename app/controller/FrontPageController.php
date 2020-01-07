<?php
namespace App\Controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

//require '../database/dbconnect.php';
class FrontPageController extends BaseController  {

    public function index($tagName, $titleName){
        
        $tag = $tagName;
        $title = $titleName;
        if($tag !='default') {
            if($title != ''){
                $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
                $typeoftag = $typeoftag[0]['id'];
                $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag AND LOCATE('".$title."', RemarksHtml) > 0");
                $raw = self::getTag($raw);
                $pagination = self::getPaginationNumber($raw);
                return $this->render('index', ['data' => $raw,'pag' => $pagination]);
            }
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            $raw = self::getTag($raw);
            $pagination = self::getPaginationNumber($raw);
            return $this->render('index', ['data' => $raw,'pag' => $pagination]);
        }else {
            if($title != ''){
                $bytitle = $this->getData("SELECT * FROM topics WHERE  LOCATE('".$title."', RemarksHtml) > 0");
                $bytitle = self::getTag($bytitle);
                $pagination = self::getPaginationNumber($bytitle);
                return $this->render('index', ['data' => $bytitle,'pag' => $pagination]);
            }
            return $this->render('index', ['data' => '',]);
        }
        return $this->render('index', ['data' => '',]);
    }


    private function getTag($data){
        foreach($data as $key=>$value){
            $typetag = $this->getData("SELECT Tag FROM languages WHERE id = '" . $value['DocTagId'] . "'");
            $typetag = $typetag[0]['Tag'];
            $data[$key]['TagName'] = $typetag;
        }
        return $data;

    }
    private function getPaginationNumber($data){
        $pagination = count($data);
        if($pagination != 0){
            if(strlen($pagination) > 1){
                if($pagination % 10 > 0){
                    return (($pagination - $pagination % 10) / 10) + 1;
                }else {
                    return (($pagination - $pagination % 10) / 10);
                }
            }else return 0;
        } else return 0;

    }


}
