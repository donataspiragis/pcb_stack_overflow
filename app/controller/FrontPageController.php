<?php
namespace App\Controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\Controller\BaseController;
use DataBase\Connection;
use PDO;
use Symfony\Component\HttpFoundation\Request;
class FrontPageController extends BaseController  {

    public function index(){

        return $this->render('frontpage/index', ['data'=>'']);
    }
    public function store(){
        $request = Request::createFromGlobals();
        $tag = $request->request->get('tag');
        $title = $request->request->get('search');
        if($tag !='default') {
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            return $this->render('frontpage/index', ['data' => $raw]);
        }else {
            if($title != ''){
                $bytitle = $this->getData("SELECT * FROM topics WHERE  LOCATE('".$title."', Title) > 0");
                return $this->render('frontpage/index', ['data' => $bytitle]);
            }
            return $this->render('frontpage/index', ['data' => '']);
        }


    }

}