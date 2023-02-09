<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

<?php

require('functions.php');

if($_POST['password'] != $_POST['password_confirmation'])
{
  exit(header('location: view/signupform.php'));  
}

if(isset($_POST['user']))
{
  $user = testInput($_POST["user"]);

  $csvhandle = fopen('login.csv', 'r');
  while(! feof($csvhandle))
  {
    $temp = fgetcsv($csvhandle, 1000, ',');

    if(!empty($temp))
    {
      if(in_array($user, $temp))
      {
        ?> 
        <h2>user already exists!</h2>
        <button><a href="view/loginform.php">return to login</a></button>
        <button><a href="view/signupform.php">return to signup</a></button> 
        <?php
        fclose($csvhandle);
        break;
      }
    }
  }
}

elseif(isset($_POST['user']) && isset($_POST['password']) === isset($_POST['password_confirmation']))
{
  
  $user = testInput($_POST["user"]);
  $pw = testInput($_POST['password']);

  //password_hash($pw, PASSWORD_DEFAULT);

  $userArr = array($user,$pw);
   
  $csvhandle = fopen('login.csv', 'a');

  fputcsv($csvhandle, $userArr);

  fclose($csvhandle);  

  header('location: index.php');
}

?>

   