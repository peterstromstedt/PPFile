<?php

require('functions.php');

if($_POST['password'] != $_POST['password_confirmation'])
{
  exit(header('location: view/signupform.php'));  
}


if(isset($_POST['user']) && isset($_POST['password']) === isset($_POST['password_confirmation']))
{
  
  $user = testInput($_POST["user"]);
  $pw = testInput($_POST['password']);

  password_hash($pw, PASSWORD_DEFAULT);

  $userArr = array($user,$pw);
   
  $csvhandle = fopen('login.csv', 'a');

  fputcsv($csvhandle, $userArr);

  fclose($csvhandle);  

  header('location: index.php');
}