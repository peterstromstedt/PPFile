<?php
require('classes/vehicle.php');

class Parkinglot{
   private $capacity;
   public $parkedVehicles = array();

   function __construct($filename = 'parking.csv', $capacity = 10){
      $filedata = $this->readParkingFile($filename);
      if(!empty($filedata->parkedVehicles)){
         $this->capacity = $filedata->capacity;
         $this->parkedVehicles = $filedata->parkedVehicles;
      } else {
         $this->capacity = $capacity;
      }
   }
   public function parkVehicle($vehicle){
      if($this->findVehicle($vehicle->getRegNr()) == null){
         $emptylot = $this->getEmptyLots();
         $vehicle->setLotId($emptylot[0]);
         $this->parkedVehicles[] = $vehicle;
         echo 'Your vehicle is parked!';
      } else {
         echo 'Your vehicle is already parked!';
      }

   }

   public function findVehicle($regNr){
      for($i=0;$i<count($this->parkedVehicles);$i++){
         if($this->parkedVehicles[$i]->getRegNr() == $regNr){
            return $this->parkedVehicles[$i];
         }
      }
      return null;
   }

   public function moveVehicle($regNr, $newlot){
      for($i=0;$i<count($this->parkedVehicles);$i++){
         if($this->parkedVehicles[$i]->getRegNr() == $regNr){
            $this->parkedVehicles[$i]->setLotId($newlot);
            echo 'Your vehicle is moved';
         }
      }
   }

   public function collectVehicle($regNr){
      for($i=0;$i<count($this->parkedVehicles);$i++){
         if($this->parkedVehicles[$i]->getRegNr() == $regNr){
            unset($this->parkedVehicles[$i]);
            echo 'Your vehicle is collected';
            return true;
         }
      }
   }

   public function getEmptyLots(){
      //$emptylots = array(1,2,3,4,5,6,7,8,9,10);
      $emptylots = array();
      for($i=1;$i<=$this->capacity;$i++){
         $emptylots[] += $i;
      }

      for($i=0;$i<count($this->parkedVehicles);$i++){
         $lotId = $this->parkedVehicles[$i]->getLotId();
         $index = $lotId - 1;
         unset($emptylots[$index]);       
      }
      return $emptylots = array_values($emptylots);
   }

   private function readParkingFile($filename){
      $file2 = fopen($filename, "r");
      $file3 = fread($file2, 5000);
      fclose($file2);
      $newfilessss = unserialize($file3);
      //echo '<pre>'; var_dump($newfilessss); echo '</pre>';
      return $newfilessss;
   }

   static function compareObj($vehicle1, $vehicle2)
   {
      return $vehicle1->getLotId() <=> $vehicle2->getLotId();
   }
} 