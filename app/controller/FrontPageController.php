<?php
namespace App\Controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

//require '../database/dbconnect.php';
class FrontPageController extends BaseController  {

    public function index($page = 1){
        $request = Request::createFromGlobals();
        $tag = $request->query->get('tag');
        $title = $request->query->get('search');
        $page = $request->query->get('page');
        if($tag !='default' && $tag !='') {
            if($title != ''){
                $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
                $typeoftag = $typeoftag[0]['id'];
                $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag AND LOCATE('".$title."', RemarksHtml) > 0 OR LOCATE('".$title."', Title) > 0");
                $raw = self::getTag($raw);
                return $this->render('index', ['data' => $raw]);
            }
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            $raw = self::getTag($raw);
            return $this->render('index', ['data' => $raw]);
        }else {
            if($title != ''){
                $raw = $this->getData("SELECT * FROM topics WHERE  LOCATE('".$title."', RemarksHtml) > 0");
                $raw = self::getTag($raw);
                return $this->render('index', ['data' => $raw]);
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



}

