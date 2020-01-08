<?php
namespace App\Controller;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

//require '../database/dbconnect.php';
class FrontPageController extends BaseController  {
    public function index($page = 1){
        $drop = $this->languageDropdown(105);
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
                return $this->render('index', ['data' => $raw, 'dropdownList'=>$drop]);
            }
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            $raw = self::getTag($raw);
            return $this->render('index', ['data' => $raw, 'dropdownList'=>$drop]);
        }else {
            if($title != ''){
                $raw = $this->getData("SELECT * FROM topics WHERE  LOCATE('".$title."', RemarksHtml) > 0");
                $raw = self::getTag($raw);
                return $this->render('index', ['data' => $raw, 'dropdownList'=>$drop]);
            }
            return $this->render('index', ['data' => '', 'dropdownList'=>$drop]);
        }
        return $this->render('index', ['data' => '', 'dropdownList'=>$drop]);
    }
    public function update($param) {
//        die();
        $param = ltrim($param, 'z?tag=');

        header("Location: ". App::INSTALL_FOLDER."/topic/create/". $param);
        exit();
    }
    private function languageDropdown($limit = 1) {
        $top= $this->getData("SELECT DocTagId, COUNT(*) AS suma FROM topics GROUP BY DocTagId ORDER BY `suma` DESC LIMIT $limit");
        $str=[];
        foreach($top as $t) {
            $str[]=$t['DocTagId'];
        }
        $str=implode(",",$str);
        $top= $this->getData("SELECT id, Title, Tag FROM `languages` WHERE id in ($str)");
        return $top;
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

