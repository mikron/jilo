<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 14:33
 */
class route {

    static function start() {
        // контроллер и действие по умолчанию
        $controller_name = 'Login';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // Array ( [0] => [1] => jilogit [2] => jilo [3] => )
        if ( !empty($routes[3])
            && $routes[3] !== 'index'
            && $routes[3] !== 'index.php') {
            $controller_name = $routes[3];
        }

        // Action name
        if ( !empty($routes[4]) ) {
            $action_name = $routes[4];
        }

        // Add prefixes
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // Find files
        $model_file = strtolower($model_name).'.php';
        $model_path = "model/".$model_file;
        if(file_exists($model_path)) {
            include "model/".$model_file;
        }

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "controller/".$controller_file;
        if(file_exists($controller_path)) {
            include "controller/".$controller_file;
        } else {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    static function getDatabaseFile($file) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/' . $file)) {
            return $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/' . $file;
        } else {
            Route::ErrorPage404();
        }
    }

    static function redirect($resource, $action) {
        if ( !isset($action) ) {
            $action = 'index';
        }
        header('Location:' . self::getHost() . $resource . '/' . $action);
    }

    static function getHost() {
        return 'http://'.$_SERVER['HTTP_HOST'].'/jilogit/jilo/';
    }

    function ErrorPage404() {
        $host = self::getHost();
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}