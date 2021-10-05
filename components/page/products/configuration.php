<?php
   // define database related variables
   $database = 'dbshop';
   $host = 'localhost';
   $user = 'root';
   $pass = '';

   // try to connect to database
   $db = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

   if(!$db){

      echo "Error in database connection";
   }
?>