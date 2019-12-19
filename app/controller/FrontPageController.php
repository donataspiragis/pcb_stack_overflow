<?php

namespace App\Controller;
use App\Controller\BaseController;
require '../database/dbconnect.php';
class FrontPageController extends BaseController  {

    public function index(){
        $con = new \Connection();
        $data = $con->openConnection()->query('SELECT * from languages');
        $datatopic = $con->openConnection()->query("SELECT Title FROM topics WHERE title='java'");
        echo $this->render('index',  ['data' => $data, 'topics' => $datatopic]);
    }

}