<?php

namespace App\Controller;
use App\Controller\BaseController;
class FrontPageController extends BaseController  {
    public function index(){
        echo $this->render('index', []);
    }
}