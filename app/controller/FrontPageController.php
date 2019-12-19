<?php
namespace App\Controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\Controller\BaseController;
//require '../database/dbconnect.php';
class FrontPageController extends BaseController  {

   public function index(){

        return $this->render('index', ['data'=>'']);
    }
    public function store(){
        $request = Request::createFromGlobals();
        $tag = $request->request->get('tag');
        $title = $request->request->get('search');
        if($tag !='default') {
            if($title != ''){
                $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
                $typeoftag = $typeoftag[0]['id'];
                $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag AND LOCATE('".$title."', Title) > 0");
                return $this->render('index', ['data' => $raw]);
            }
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            return $this->render('index', ['data' => $raw]);
        }else {
            if($title != ''){
                $bytitle = $this->getData("SELECT * FROM topics WHERE  LOCATE('".$title."', Title) > 0");
                return $this->render('index', ['data' => $bytitle]);
            }
            return $this->render('index', ['data' => '']);
        }


    }

}
