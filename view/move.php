<?php
$parkedVehicles = $parking->parkedVehicles;
$emptylots = $parking->getEmptyLots();
?>

<fieldset>
<legend>Move Vehicle</legend>
   <form method="post">
      <input type="hidden" name="action" value="move">
      <label for="regNr">RegNr:</label>
      <select name="regNr" id="regNr">
         <?php for ($i=0;$i<count($parkedVehicles);$i++){?>
         <option value="<?= $parkedVehicles[$i]->getRegNr() ?>"><?= $parkedVehicles[$i]->getRegNr() ?></option>
         <?php } ?>
      </select>
      <label for="emptyLot">EmptyLot</label>
      <select name="emptyLot" id="emptyLot">
         <?php for($i=0;$i<count($emptylots);$i++){?>
         <option value="<?=$emptylots[$i] ?>"><?= $emptylots[$i]?></option>  
         <?php } ?>
      </select>
      <button>Submit</button>
   </form>

</fieldset>