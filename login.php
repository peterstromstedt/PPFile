<?php
session_start();

require('functions.php');
if (isset($_POST["user"]) && !isset($_SESSION["user"])) {
  
   $user = testInput($_POST["user"]);
   $pw = testInput($_POST['password']);
   
   $userArr = array($user,$pw);
   
   $csvhandle = fopen('login.csv', 'r');
  
   while (! feof($csvhandle)) {
      
      $temp = fgetcsv($csvhandle, 1000, ',');

      if(!empty($temp)){
         if($temp === $userArr){
            $_SESSION["user"] = $_POST["user"];
            fclose($csvhandle);
            header('location:index.php');
            break;
         }
      }
      else
      {
         fclose($csvhandle);        
         header('location:index.php');         
      }
   } 
}

