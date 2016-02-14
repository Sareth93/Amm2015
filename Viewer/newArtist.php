<?php
    echo "<p>Inserimento nuovo artista</p>";
    echo "<fomr id='form' action='index.php?arg=addArtist2' method='POST'>
          <label>Nome Artista</label><input type='text' name='artistName' required='required'/>
          <br><button type='submit' id='conferma' name='conferma'>Conferma</button>
          </form>";
?> 
