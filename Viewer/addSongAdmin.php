<?php
    echo "Inserisci una nuova canzone";
    echo "<br><label>Titolo canzone</label>
          <input type='text' name='title' id='title' required=required'/></br>
          <label>Artista</label><select name='artistName'>";
    while($row=$artists->fetch_row())
        echo "<option value='$row[0]'>$row[0]</option>";
    echo "</select><input type='submit' id='confirm' name='confirm' value='Add song'/><br>";    
?>