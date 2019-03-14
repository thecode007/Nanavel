<?php
  require_once 'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Customer.php';
  require_once 'app'.DIRECTORY_SEPARATOR.'Util'.DIRECTORY_SEPARATOR.'Request.php';
  header("Content-type:text/json");

  Request::get("/customers","CustomerController@showAll");

  Request::get("/customers/{id}","CustomerController@show");

  Request::post("/customers","CustomerController@store");

  Request::put("/customers","CustomerController@update");

  Request::delete("/customers/{id}","CustomerController@delete");

  Request::get("/films","FilmController@showAll");
  
  Request::get("/films/{id}","FilmController@show");