<?php
    echo "<p>Registrazione nuovo utente</p>
          <form id='form' action='index.php?arg=register' method='POST'
          <label>Username</label><input type='text' id='username' name='username' required='required'/><br>
          <label>Password</label><input type='password' id='password' name='password' required='required'/><br>
          <label>Conferma Password</label><input type='password' id='confpwd' name='confpwd' required='required'/><br>
          <button type='submit' id='conferma' name='conferma' disabled>Conferma</button>
          </form> <div id='allert'></div>";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script tupe="text/javascript">
$("#confpwd").keyup(function(){
    var confpwd=$("#confpwd").val();
    var pwd=$("#password").val()
    if(pwd!=confpdw){
        $.get("Viewer/unvalid.hmtl",function(data){
            $("#allert").html(data);
        })
        $("#conferma").prop("disabled",true);
    }
    else if(pwd!="" && confpwd!=""){
        $.get("Viewer/valid.html", function(data){
            $("#allert").html(data);
        })
        $("#conferma").prop("disabled",false);
    }
    else
        $.("#allert").html("");
});

