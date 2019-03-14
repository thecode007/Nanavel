<?php
  class Request {

    static function post($uri,$controllerInjection) {

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['REQUEST_URI'] == $uri) {
        preg_match_all('/(.+)@(.+)/',$controllerInjection,$injections);
        require_once 'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'ControllerFactory.php';
        $controller = ControllerFactory::getController($injections[1][0]);
        $call = $injections[2][0];
        $data = (array)json_decode(file_get_contents("php://input"));
        echo $controller->$call($data);
      }
      
    }

    static function get($uri,$controllerInjection) {
      if ( $_SERVER['REQUEST_METHOD'] == "GET" && count($_GET) == 0 ) {
        preg_match_all('/\/?([a-zA-Z0-9]+)\/?/',$_SERVER['REQUEST_URI'],$matches);
        $args="";
        if ( count($matches[1]) == 2) {
          $uri = str_replace('{id}',$matches[1][1],$uri);
          $args = $matches[1][1];
        }
        if ($_SERVER['REQUEST_URI'] == $uri ) {
          preg_match_all('/(.+)@(.+)/',$controllerInjection,$injections);
          require_once 'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'ControllerFactory.php';
          $controller = ControllerFactory::getController($injections[1][0]);
          $call = $injections[2][0];
          echo $controller->$call($args);
        }
      }
    }

    
    static function put($uri,$controllerInjection) {

      if ($_SERVER['REQUEST_METHOD'] == "PUT" && $_SERVER['REQUEST_URI'] == $uri) {
        preg_match_all('/(.+)@(.+)/',$controllerInjection,$injections);
        require_once 'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'ControllerFactory.php';
        $controller = ControllerFactory::getController($injections[1][0]);
        $call = $injections[2][0];
        $data = (array)json_decode(file_get_contents("php://input"));
        echo $controller->$call($data);
      }
      
    }

    static function delete($uri,$controllerInjection) {
    if ( $_SERVER['REQUEST_METHOD'] == "DELETE" ) {
      preg_match_all('/\/?([a-zA-Z0-9]+)\/?/',$_SERVER['REQUEST_URI'],$matches);
        $args="";
        if ( count($matches[1]) == 2) {
          $uri = str_replace('{id}',$matches[1][1],$uri);
          $args = $matches[1][1];
        }
      if ($_SERVER['REQUEST_URI'] == $uri) {
        preg_match_all('/(.+)@(.+)/',$controllerInjection,$injections);
        require_once 'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.'ControllerFactory.php';
        $controller = ControllerFactory::getController($injections[1][0]);
        $call = $injections[2][0];
        $data = (array)json_decode(file_get_contents("php://input"));
        echo $controller->$call($data);
      }
    }
      
    }
     
  }