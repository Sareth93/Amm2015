<?php
    echo "<p>Nuovo Preferito</p>";
    echo "<div clas='error'></div>";
    echo "<form action='index.php?arg=addFavorite' method='POST'>
          <label>Nome Utente</label>
          <select name='user'>";
           while (($row=$user->fetch_row())!=NULL)
                   echo "<option value='{$row[0]}'>$row[0]</option>";
    echo "</select><br>
          <label>Titolo canzone</label>
          <select name='song'>";
           while (($row=$song->fetch_row())!=NULL)
                   echo "<option valute='{$row[1]}'>$row[1]</option>";
    echo "</select> <br>
          <input type='submit' valute='Conferma'>";                                          
?>
