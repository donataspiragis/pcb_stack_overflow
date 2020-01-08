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
    public function index(){
        $request = Request::createFromGlobals();
        $drop = $this->languageDropdown(105);
        $tag = $request->query->get('tag');
        $title = $request->query->get('search');
        $locate = '';
        $new = explode( ' ', $title ) ;
        if($tag !='default' && $tag != '') {
            $typeoftag = $this->getData("SELECT id FROM languages WHERE Tag = '" . $tag . "'");
            $typeoftag = $typeoftag[0]['id'];
        }
    
        foreach($new as $value){
            $locate .= " AND LOCATE('".$value."', RemarksHtml) > 0";
        }
        if($tag !='default' && $tag !='') {
            if($title != ''){
                $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag $locate");
                $raw = self::getTag($raw);
                return $this->render('index', ['data' => $raw, 'dropdownList'=>$drop]);
            }
            $raw = $this->getData("SELECT * FROM topics WHERE DocTagId = $typeoftag");
            $raw = self::getTag($raw);
            return $this->render('index', ['data' => $raw, 'dropdownList'=>$drop]);
        }else {
            if($title != ''){
                $locate = substr($locate,4);
                $raw = $this->getData("SELECT * FROM topics WHERE  $locate");
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

