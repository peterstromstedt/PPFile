<?php

require('classes/parkinglot.php');
require('functions.php');

// if user is not logged in
if (!isset($_SESSION["user"])) {
   header("Location: view/loginform.php");
   exit();
 }


$regNr = filter_input(INPUT_POST,'regNr',FILTER_UNSAFE_RAW);
$action = filter_input(INPUT_POST,'action',FILTER_UNSAFE_RAW);
$parking = new Parkinglot();

include('view/header.html');

// so we can access who is logged in
session_start();
?> <h2><?="welcome " . $_SESSION['user'];?></h2><?php

// Selects input form
if(isset($_POST['Park'])){
   include('view/park.php');
}
if(isset($_POST['Collect'])){
   include('view/collect.php');
}
if(isset($_POST['Move'])){
   include('view/move.php');
}
if(isset($_POST['Find'])){
   include('view/find.php');
}
if(isset($_POST['Print'])){
   include('view/print.php');
}

if (isset($_POST["Logout"])) {
   session_destroy();
   unset($_SESSION);
 }


// Handles input from hidden formaction above
switch($action){
   
   case 'park':   
         $regNr = testInput($regNr);

         $parking->parkVehicle(new Vehicle($regNr,$_POST['vtype']));
         writeToParkingFile($parking);
         break;

   case 'find':
         $regNr = testInput($regNr);
         $vehicle = $parking->findVehicle($regNr);
         if(!$vehicle == null){
            echo "Your {$vehicle->getVtype()} is parked at {$vehicle->getLotId()}";
         } else {
            echo 'Is not parked!';
         }
         break;

   case 'move':
         $parking->moveVehicle($_POST['regNr'], $_POST['emptyLot']);
         writeToParkingFile($parking);
         break;

   case 'collect':
         $parking->collectVehicle($_POST['regNr']);
         writeToParkingFile($parking);
         break; 
}

include('view/footer.html');



?>