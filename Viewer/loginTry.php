<!DOCTYPE html>
<html>
    <head>
        <title>Tentativo Login</title>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <h3>Per poter navigare sul sito &egrave; necessario effettuare il login</h3>
        <form action="index.php?arg=login" method="POST">
            <label>Username</label>
            <input id="usr" value="" name="usr" type="text" required="required"/>
            <br>
            <label>Password</label>
            <input id="pwd" name="pwd" type="password" required="required"/>
            <br>
            <button type="login" name="login">Login</button>            
        </form>
    </body>
</html>