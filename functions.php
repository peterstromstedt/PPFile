<?php
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

