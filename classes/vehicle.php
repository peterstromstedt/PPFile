<?php
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
   public function getLotId(){
      return $this->lotId;
   }
   public function setLotId($lotId){
      $this->lotId = $lotId;
   }
   public function getRegNr(){
      return $this->regNr;
   }
   public function getVtype(){
      return $this->vType;
   }
   public function getStartTime(){
      return date('Y-m-d H:i',$this->startTime);
   }


}