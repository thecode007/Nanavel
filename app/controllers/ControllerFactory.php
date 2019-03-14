<?php
  
  class ControllerFactory {

    static function getController($name) {
        require_once 'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$name.'.php';
        return new $name();
    }
  }