<?php
    echo "Inserisci una nuova canzone";
    echo "<br><label>Titolo canzone</label>
          <input type='text' name='title' id='title' required=required'/></br>
          <label>Artista</label>";
    while($row=$artist->fetch_row())
        echo "<option value='$row[1]'>$row[0]</option>";
    echo "</select><input"
    
?>

                        
