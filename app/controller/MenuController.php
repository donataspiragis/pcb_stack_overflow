<?php

namespace App\Controller;
use DataBase\Connection;
use PDO;


class MenuController extends BaseController
{

    public function about() {
        echo $this->render('about', []);
    }

}

