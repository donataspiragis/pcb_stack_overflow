<?php
namespace App;
class Route {

    /**
     * @param Array ROUTE
     * @return routes for controllers
     */
    const ROUTE = [
        'front@index' => ['FrontPageController', 'index'],
        'front@create' => ['FrontPageController', 'create'],
        'front@store' => ['FrontPageController', 'store'],
        'front@edit' => ['FrontPageController', 'edit'],
        'front@update' => ['FrontPageController', 'update'],
        'front@destroy' => ['FrontPageController', 'destroy'],
        'examples@index' => ['ExamplesController', 'index'],
        'examples@create' => ['ExamplesController', 'create'],
        'examples@store' => ['ExamplesController', 'store'],
        'examples@edit' => ['ExamplesController', 'edit'],
        'examples@update' => ['ExamplesController', 'update'],
        'examples@destroy' => ['ExamplesController', 'destroy'],
        'topic@index' => ['TopicController', 'index'],
        'topic@create' => ['TopicController', 'create'],
        'topic@store' => ['TopicController', 'store'],
        'topic@edit' => ['TopicController', 'edit'],
        'topic@update' => ['TopicController', 'update'],
        'topic@destroy' => ['TopicController', 'destroy'],
        'nav@about' => ['MenuController', 'about'],
    ];

    /**
     * @param Array $url
     * @return url key
     */
    public static function getController($url){
        $url_key = $url[0].'@'.$url[1];
        if(!isset(self::ROUTE[$url_key])){
            return ['BaseController', 'render'];
        }

        return self::ROUTE[$url_key];

    }
}