<?php
  require_once "app".DIRECTORY_SEPARATOR."database".DIRECTORY_SEPARATOR."Connection.php";
  class Model {
      function __construct(){
      }

      static function getColumnNames() {
        $connection = Connection::getInstance();
        $result = mysqli_query($connection->stream,"SELECT `COLUMN_NAME` 
          FROM `INFORMATION_SCHEMA`.`COLUMNS` 
          WHERE `TABLE_SCHEMA`='sakila' 
          AND `TABLE_NAME`='".get_called_class ()."'");
        $columns = array();
        while($row = mysqli_fetch_assoc($result)) {
          array_push($columns, $row["COLUMN_NAME"]);
        }
        return $columns;
      }

      static function findAllByModelName($name) {
        $connection = Connection::getInstance();
        $result = mysqli_query($connection->stream,"SELECT * FROM ".$name);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
           while($row = mysqli_fetch_assoc($result)) {
                 $data[] = $row;
            }
        }
         return json_encode($data);
      }


      static function find($id) {
        $code =self::getColumnNames()[0];
        $connection = Connection::getInstance();
        $result = mysqli_query($connection->stream,"SELECT * FROM ".get_called_class ()." where ".$code."=".$id);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
           while($row = mysqli_fetch_assoc($result)) {
                 $data[] = $row;
            }
        }
        return json_encode($data);
      }


      static function all() {
        $connection = Connection::getInstance();
      	$result = mysqli_query($connection->stream,"SELECT * FROM ".get_called_class ());
        $data = array();
      	if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                  $data[] = $row;
          }
        }
        return json_encode($data);
      }


      static function where() {

      }

      function save() {

        $connection = Connection::getInstance();

        try{
        $objectArray = (array)$this;
        $columns="";
        $values="";
        $columnCounter = count($objectArray);
        $valueCounter = $columnCounter;

        //extracting columns/////////////////////////
        foreach( array_keys($objectArray) as $key ) {
          $columns = $columns . $key;
          if( $columnCounter != 1 ) {
            $columns = $columns.",";
          }
          $columnCounter = $columnCounter - 1;
        }

        //extract values
        foreach( $objectArray as $value ) {
          if( is_numeric($value) ) {
            $values = $values . $value;
          }
          else{
            $values = $values . "'".$value."'";
          }
          if( $valueCounter != 1 ) {
            $values = $values.",";
          }
          $valueCounter = $valueCounter - 1;
        }
        //////////////////////Ending Of extraction////////////////////////////////////

        $result = mysqli_query($connection->stream,"insert into ".get_called_class ()." (".$columns.") values (".$values.")");
        if( $result ) {
          return "
          { 
            'code':4,
            'message':'Success save operation',
            'description':'A new ".get_called_class ()." Successfully Saved'
          }";
        }
        else {
          return "
          { 
            'code':5,
            'message':'Failed save operation',
            'description':'A  ".get_called_class ()." Failed to be Saved'
          }";
        }
        }
        catch ( Excption $e ){
          return "{ 
            'code':6,
            'message':'Failed save operation',
            'description':'".$e->getMessage()."'
             }";
      }
      }

      function update() {

        $connection = Connection::getInstance();
        try {
          $objectArray = (array)$this;
          $valueCounter = count($objectArray);
          $data = "";
          $idCondition = "";
          //extracting columns/////////////////////////
          foreach( array_keys($objectArray) as $key ) {
            $value = $objectArray[$key];
            if( !$data ) {
              $idCondition .= $key . "=" . $value;
              $data = " ";
              $valueCounter -= 1;
              continue;
             }
            
             if ( !is_numeric( $value ) ) {
              $value = "'" . $value . "'";
             }
            $data = $data.$key . "=" . $value;
            if( $valueCounter != 1) {
              $data .=",";
            }
            $valueCounter -= 1;
     
          }
          $result = mysqli_query($connection->stream,"update ". get_called_class () . " set " . $data . " where " . $idCondition);
          if( $result ) {
            return "
            { 
              'code':7,
              'message':'Success Update operation',
              'description':'A  ".get_called_class ()." Successfully Updated'
            }";
          }
          else {
            return "
            { 
              'code':8,
              'message':'Failed Update operation',
              'description':'A  ".get_called_class ()." Failed to be Updated'
            }";
          }
          } catch(Excption $e ) {
            return "
            { 
              'code':8,
              'message':'Failed Update operation',
              'description':'A  ".get_called_class ()." Failed to be Updated'
            }";
        }       
      }
      

      function delete() {
        $connection = Connection::getInstance();
        $modelArray = (array)$this;
        $id = reset($modelArray);
        if( !is_numeric($id) ) {
          $id = "'".$id."'";
        }
    
        $result = mysqli_query($connection->stream,"delete from " . get_called_class () . " where ".self::getColumnNames()[0]."=".$id."");

        echo "delete from " . get_called_class () . " where ".self::getColumnNames()[0]."=".$id."";

        if( $result ) {
          return "
          { 
            'code':7,
            'message':'Success delete operation',
            'description':'A  ".get_called_class ()." Successfully Deleted'
          }";
        }
        else {
          return "
          { 
            'code':8,
            'message':'Failed delete operation',
            'description':'A  ".get_called_class ()." Failed to be deleted'
          }";
        }
      }

      function __destruct() {
        
      }

  }
