<!DOCTYPE html>

<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <title>Song List</title>
    </head>
    <body>
        <?php
            echo "Elenco Canzoni: ";
            echo "<table align='center'";
            echo "<tr><th>Titolo</th><th>Artista</th></tr>";
            while($row=$songs->fetch_row())
                    echo"<tr><td>$row[0]</td><td>$row[2]</td> </tr>";
            echo"</table>";
        ?>
    </body>
</html>