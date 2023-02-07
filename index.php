<?php
require('classes/parkinglot.php');


$regNr = filter_input(INPUT_POST,'regNr',FILTER_UNSAFE_RAW);
$action = filter_input(INPUT_POST,'action',FILTER_UNSAFE_RAW);
$parking = new Parkinglot();

include('view/header.html');

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


function writeToParkingFile($parking){
   usort($parking->parkedVehicles, [Parkinglot::class, "compareObj"]);
   $parking = serialize($parking);
   $file = fopen("parking.csv", "w");
   fwrite($file, $parking);
   fclose($file);
}

function testInput($data) {

   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>