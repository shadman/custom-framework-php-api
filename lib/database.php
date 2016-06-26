<?php
namespace lib\DB;

class Database {

   public $host, $user, $password, $database, $connect, $test;

   public function __construct(){
   	$this->host = $GLOBALS['database']['host'];
   	$this->user = $GLOBALS['database']['user'];
   	$this->password = $GLOBALS['database']['password'];
   	$this->database = $GLOBALS['database']['database'];
      $this->connect();
   }

   public function connect(){
      $this->connect = mysqli_connect($this->host, $this->user, $this->password, $this->database);
      if (!$this->connect) {
         die("Could not connect: " . mysqli_connect_error() . "\n");
      }
   }

   public function query($query){
      return mysqli_query($this->connect, $query);
   }

   public function fetchObject($data){
      return mysqli_fetch_object($data);
   }

   public function escapeString($string=NULL){
      return mysqli_real_escape_string($dbc, $string);
   }

   public function error(){
      return mysqli_error($this->connect);
   }  

   public function close(){
      mysqli_close($this->connect);
   }  

   public function tableCreatedSuccess($table){
      return "Table `$table` created successfully.\n";
   }

   public function success(){
      return "Query executed successfully.\n";
   }
 
   public function errorOnMigration(){
      $resp = "Error creating table: " . $this->error() . "..\n";
      $resp .= "\n***Hint: Please drop your all tables and run migrations again ..\n\n";
      $resp .= "\n***IMPORTANT: If you drop your tables, your existing data will be lost ..\n\n";
      return $resp;
   }  

   public function errorOnSeeds(){
      $resp = "Error insertion table: " . $this->error() . "..\n";
      $resp .= "\n***Hint: Please truncate your tables manually then execute seeds file again or drop your tables and run migration and seeds file again ..\n\n";
      $resp .= "\n***IMPORTANT: If you drop your tables, your existing data will be lost ..\n\n";
      return $resp;
   }

   public function __destruct(){
      $this->close();
   }
   
}
