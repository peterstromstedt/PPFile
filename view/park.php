
<fieldset>
   <legend>Park Vehicle</legend>
   <form action="." method="post">
      <input type="hidden" name="action" value="park">
      <label for="regNr">RegNr:</label>
      <input type="text" id="regNr" name="regNr" required>
      <label for="vtype">Vehicletype:</label>
      <input type="radio" id="vtype" name="vtype" value="Car" required>Car
      <input type="radio" id="vtype" name="vtype" value="MC">MC
      <br>
      <button>Submit</button>
   </form>
</fieldset>