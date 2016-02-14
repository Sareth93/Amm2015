<?php
    echo "<p>Aggiungi ai preferiti</p>";
    echo "<div clas='error'></div>";
    echo "<form action='index.php?arg=addFavorite' method='POST'>
          <label>Utente</label><select name='username'>";
    while(($row=$users->fetch_row()!=NULL))
        echo "<option value='{$row[0]}'>$row[0]</option>";
    echo "</select><br>";
    echo "<label>Titolo canzone</label>
          <select name='song'>";
           while (($row=$songs->fetch_row())!=NULL)
                echo "<option valute='{$row[0]}'>$row[0]</option>";
    echo "</select> <br>
          <input type='submit' value='Conferma'>";                                          
?>
