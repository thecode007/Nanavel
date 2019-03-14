<?php

class Connection {
	
	static $connection = " ";
	private function __construct() {
		$jsonString = file_get_contents("app".DIRECTORY_SEPARATOR."database".DIRECTORY_SEPARATOR."config.json");
		$config = json_decode($jsonString,true);

		if ( !$config["host"] || !$config["port"] || !$config["database"] || !$config["user"] || !$config["password"] ) {

			die("{ 
				   'code':1,
					'message':'config error',
					'description':Please fill all configurations
		
				  }");
		}
		
		$this->stream = mysqli_connect($config["host"].":".$config["port"],$config["user"], $config["password"], $config["database"] );
		
		if (!$this->stream) {
		
			die("{ 
				   'code':2,
				   'message':'Error: Unable to connect to MySQL,
				   'description':".mysqli_connect_errno()."
				  }");
		}

	}

	public static function getInstance() {
           if( self::$connection ) {
			   $connection = new Connection();
		   }
		   return $connection;
	}

	function __destruct(){
	}
}


