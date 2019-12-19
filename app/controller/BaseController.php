<?php
namespace App\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController{


    public function render($templateName, array $parameters = array())
    {
        $templateName = !empty($templateName) ? $templateName : 'error404';

        $twig = new Environment(new FilesystemLoader('../src/views'), array(
            'autoescape' => false,
        ));

        echo $twig->render($templateName.'.php', $parameters);
    }


}



