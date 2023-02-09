<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

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
   }

   fclose($csvhandle);  
   session_destroy();
   unset($_SESSION);      
   ?>
   <h2>login failed!</h2>
   <button><a href="view/loginform.php">return to login</a></button>
   <button><a href="view/signupform.php">go to signup</a></button>
   <?php
}

