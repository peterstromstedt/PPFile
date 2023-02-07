<?php
$parkedVehicles = $parking->parkedVehicles;
?>

<fieldset>
<legend>Collect Vehicle</legend>
   <form method="post">
      <input type="hidden" name="action" value="collect">
      <label for="regNr">RegNr:</label>
      <select name="regNr" id="regNr">
         <?php for ($i=0;$i<count($parkedVehicles);$i++){?>
         <option value="<?= $parkedVehicles[$i]->getRegNr() ?>"><?= $parkedVehicles[$i]->getRegNr() ?></option>
         <?php } ?>
      </select>

      <button>Submit</button>
   </form>

</fieldset>