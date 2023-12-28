<?php
  class Config{

  	  public static function getConnection(){
          $conn = new mysqli("localhost","root","","sajilo_courier");
          return $conn;
  	  }	  
  }
?>