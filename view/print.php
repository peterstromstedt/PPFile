<?php
$parkedVehicles = $parking->parkedVehicles;
?>


<table>
   <thead>
      <tr>
         <th scope="col">Parkinglot</th>
         <th scope="col">VehicleType</th>
         <th scope="col">RegNr</th>
         <th scope="col">ArrivalTime</th>
      </tr>
   </thead>
   <tbody>


      <?php for($i=0;$i<count($parkedVehicles);$i++){  ?>
      <tr>
         <td><?= $parkedVehicles[$i]->getLotId(); ?></td>
         <td><?= $parkedVehicles[$i]->getVtype(); ?></td>
         <td><?= $parkedVehicles[$i]->getRegNr(); ?></td>
         <td><?= $parkedVehicles[$i]->getStartTime(); ?></td>
      </tr>
      
      
      <?php  }  ?>
   </tbody>
</table>