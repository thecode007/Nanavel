<?php
  class Controller {

    function __construct() {
      $this->modelClass = explode("Controller",get_called_class())[0];
      require_once 'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$this->modelClass.'.php';
      $this->model = new $this->modelClass();
    }

    public function showAll() {
      return $this->model::all(); 
    }

    public function show($id) {
      return $this->model::find($id); 
    }

    public function store($data) {
      foreach( array_keys($data) as $key ) {
        $this->model->$key = $data[$key];
      }
      return $this->model->save();
    }

    public function update($data) {
      foreach( array_keys($data) as $key ) {
        $this->model->$key = $data[$key];
      }
      return $this->model->update();
    } 


    public function delete($data) {
      foreach( array_keys($data) as $key ) {
        $this->model->$key = $data[$key];
      }
      return $this->model->delete();
    }

  }
