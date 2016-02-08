<?php

/* Class Name = DB
 * Variabel Input : query, result, connect, numRec
 * Variabel Input Type : Protected
 * Created By : Ovan Cop
 * Class Desc : Kumpulan fungsi database (db helper)
 */

require_once __DIR__ . "/../../config/config.php";

class mysql_db extends config {

     protected $query;
     protected $result;
     protected $connect;
     protected $numRec;
     protected $url_rewrite;
     protected $path;

     public function __construct() {

          $this->connect = $this->open_connection();
     }

     public function query($data) {
 //echo "$data<br/>";
          $this->query = mysqli_query($this->connect,$data) or $this->error();
 
          return $this->query;
     }

     public function fetch_object($data) {
          $this->result = $data;
          return mysqli_fetch_object($this->result);
     }

     public function _fetch_object($data, $param) {
          $this->result = $this->query($data) or $this->error();
          if ($this->num_rows($this->result)) {
               if ($param == true) {
                    while ($data = $this->fetch_object($this->result)) {
                         $dataArray[] = $data;
                    }
               } else {
                    $data = $this->fetch_object($this->result);
                    $dataArray[] = $data;
               }


               return $dataArray;
          }
     }

     public function _fetch_array($data, $param) {
            $this->result = $this->query($data) or $this->error();
          
          $row = $this->num_rows($this->result);

          if ($row) {

               if ($param == true) {
                    while ($data = $this->fetch_array($this->result)) {
                         $dataArray[] = $data;
                    }
               } else {
                    $data = $this->fetch_array($this->result);
                    $dataArray = $data;
               }


               return $dataArray;
          }
     }

     public function fetch_array($data) {
          $this->result = $data;
          return mysqli_fetch_array($this->result);
     }
      
     public function fetch_assoc($data) {
          $this->result = $data;
          return mysqli_fetch_assoc($this->result);
     }

     public function fetch_field($data) {
          $this->result = $data;

          return mysqli_fetch_field($this->result);
     }

     public function num_rows($data) {
          if ($data != '') {
               $this->numRec = mysqli_num_rows($data);
               if ($this->numRec)
                    return $this->numRec;
               else
                    return false;
          }
     }

     public function insert_id($data) {
          return mysqli_insert_id($this->connect);
     }

     public function close_connection() {
          return mysqli_close($this->connect);
     }

     public function error() {
          switch ($this->debug) {
               case 1:
                    $message = die(mysqli_error($this->connect));
                    break;
               case 2:
                    $message = die("Ada Kesalahan Query");
               default:
                    $message = "";
                    break;
          }

          return $message;
     }

     public function clear_var($data) {
          return $$data = '';
     }
public function get_auto_increment($tablename){
    
    $next_increment = 0;
    $qShowStatus = "SHOW TABLE STATUS LIKE '$tablename'";
    $qShowStatusResult = $this->query($qShowStatus);
    $row = $this->fetch_assoc($qShowStatusResult);
    $next_increment = $row['Auto_increment'];

    return $next_increment;
}
}

?>
