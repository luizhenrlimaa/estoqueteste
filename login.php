<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
session_start();

?>

<html>

<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/mbox-0.0.1.css"/>
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
      background: #708090;
    }

    body {
      background: #C0C0C0;
    }
  </style>
</head>

<body>
  <main>
    <center>
      <h5 class="indigo-text"><i class="fas fa-user" style="font-size: 4em; color: #000; "></i></h5>
      <div class="container">
        <div class="x" style="background: rgba(211,211,211); display: inline-block; padding: 32px 48px 0px 48px; border-radius: 4px;">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class="validate" id="email_login" type="email">
                <label for="email_login">Email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input id="senha_login" type="password">
                <label for="password">Senha</label>
              </div>
              <label style='float: right;'>
                <a href='login/esqueci_senha.php' style="color: #000; font-size: 13px;"><b>Esqueceu a senha?</b></a>
              </label>
            </div>
            <br>
            <center>

              <div class="row">
                <button id="login_usuario" class='col s12 btn btn-large waves-effect indigo' type="submit" name="action">Entrar</button>
              </div>
              <br>
              <a href="usuario/index.php" style="color: #fff; font-size: 1em; font-weight: 500;">Criar conta</a>
            </center>
          </form>
        </div>
      </div>
    </center>

  </main>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jquerymask.min.js"></script>
<script src="js/mbox-0.0.1.js"></script>

<script type="text/javascript">

  /*Para fazer o select aparecer*/
  window.onload=function(){
    $(document).ready(function() {
      $('select').material_select();
    });
  }
  $(document).ready(function(e) {

    $('#login_usuario').click(function(e) {
      e.preventDefault();

      var email_login = $('#email_login').val();
      var senha_login = $('#senha_login').val();

      if(email_login == "" || senha_login == ""){
        return mbox.alert('Preencha todos os campos!');
      } else {
        $.ajax({
          url: 'engine/controllers/login.php',
          data : {
            email_login : email_login,
            senha_login : senha_login
          },
          success: function(data){
            obj = JSON.parse(data);
            if(obj.res === 'true'){
              window.location = "index.php";
            } else if(obj.res === 'no_user_found') {
              return mbox.alert('Usuário não encontrado.');
            } else if(obj.res === 'wrong_password') {
              return mbox.alert('Senha Incorreta.');
            } else {
              return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
            }
          },
          async: false,
          type : 'POST'
        });
      }
    });
  });
</script>