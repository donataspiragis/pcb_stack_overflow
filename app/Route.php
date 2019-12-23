<?php
namespace App;
class Route {

    /**
     * @param Array ROUTE
     * @return routes for controllers
     */
    const ROUTE = [
        '' => ['FrontPageController', 'index'],
//        'front@index' => ['FrontPageController', 'index'],
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
        'statistics@index' => ['StatisticsController', 'index'],
    ];

    /**
     * @param Array $url
     * @return url key
     */
    public static function getController($url){
        if ($url[0] =='examples' && isset($url[1]) ) { //  tikrina ar "examples" turi 3 parametra ir ar jis yra skaicius(../examples/index/1), jeigu ne, grazina 404 error page;
            if (isset($url[2]) && is_numeric($url[2]) ) {
            $url_key = $url[0] . '@' . $url[1];
            }  else {
                return ['BaseController', 'error'];
            }
        } else if (isset($url[0]) && isset($url[1])) {
            $url_key = $url[0] . '@' . $url[1];
        } else if (isset($url[0])){
            $url_key = '';
        } else {
            return ['BaseController', 'error'];
        };
        return isset(self::ROUTE[$url_key]) ? self::ROUTE[$url_key] : ['BaseController', 'error'];;
    }
}
