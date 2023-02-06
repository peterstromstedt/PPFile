<?php

$regNr = filter_input(INPUT_POST,'regNr',FILTER_UNSAFE_RAW);

$action = filter_input(INPUT_POST,'action',FILTER_UNSAFE_RAW);


include('view/header.html');

if(isset($_POST['Park'])){
   include('view/park.php');
}
if(isset($_POST['Collect'])){
   include('view/park.php');
}
if(isset($_POST['Move'])){
   include('view/park.php');
}
if(isset($_POST['Find'])){
   include('view/park.php');
}

switch($action){
   case 'park':   
         $regNr = testInput($regNr);  
         parkVehicle(new Vehicle($regNr, $_POST['vtype']));
         break;
}



include('view/footer.html');


function parkVehicle($vehicle){
   $parkedVehicles[] = readParkedVehicles();
   if(!$parkedVehicles){
      for($i=0; $i<count($parkedVehicles);$i++){
         if($parkedVehicles[$i][0] == $vehicle->getRegNr()){
            echo 'The vehicle is already parked!';
            return;
         }
      }
      $vehicle->setLotId(findEmptyLot($parkedVehicles));
   } else {
      $vehicle->setLotId(1);
   }
   $parkedVehicles[] = $vehicle;
   //echo '<pre>'; print_r($vehicle); echo '</pre>';
   printToFile($parkedVehicles);
}

function printToFile($parkedVehicles){
   $handle = fopen('parking.csv', 'w');
   foreach($parkedVehicles as $vehicle){
      fputcsv($handle, $vehicle);
   }
   fclose($handle);
}

function findEmptyLot($parkedVehicles){
   $length = count($parkedVehicles);
   if($length == 10){
      echo "Parking full";
      return 0;
   }
   for($i=0; $i<$length;$i++){
      if(!$parkedVehicles[$i][2] == $i+1){
         return $i;
      }
   }
   return $length+1;
}


function readParkedVehicles(){
   $csvhandle = fopen('parking.csv', 'r');
   while (!feof($csvhandle)) {
      $parkedVehicles = fgetcsv($csvhandle, 100, ',');
   }
   fclose($csvhandle);
   return $parkedVehicles;
}

function testInput($data) {

   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$mylot = new Parkinglot;
$mylot->lots[] = new Vehicle('AAA111', 'Car');
$mylot->lots[] = new Vehicle('BBB111', 'Car');
$mylot->lots[] = new Vehicle('CCC111', 'Car');

echo '<pre>';
var_dump($mylot);
echo '</pre>';

$newmylot = serialize($mylot);

echo '<pre>';
var_dump($newmylot);
echo '</pre>';

$file = fopen("parking.csv", "w");
fwrite($file, $newmylot);
fclose($file);

$file2 = fopen("parking.csv", "r");
$file3 = fread($file2, 5000);
fclose($file2);

$newfilessss = unserialize($file3);

$file = fopen("parking.csv", "w");
fwrite($file, $newmylot);
fclose($file);

$file2 = fopen("parking.csv", "r");
$file3 = fread($file2, 5000);
fclose($file2);

$newfilessss = unserialize($file3);

echo '<pre>';
var_dump($newfilessss);
echo '</pre>';


class Parkinglot{
   public $lots = array();
}

class Vehicle{
   private $regNr;
   private $vType;
   private $lotId;
   private $startTime;

   function __construct($regNr, $vType, $lotId = 0)
   {
      $this->regNr = $regNr;
      $this->vType = $vType;
      $this->lotId = $lotId;
      $this->startTime = time();
   }
   public function getRegNr(){
      return $this->regNr;
   }
   public function setLotId($lotId){
      $this->lotId = $lotId;
   }
}

?>