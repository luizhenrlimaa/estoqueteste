    <?php
    $showerros = true;
    if($showerros) {
      ini_set("display_errors", $showerros);
      error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Estoque</title>

      <!-- CSS  -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="../css/style_registro.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
</head>

<body>
  <div class="container row">
   <h4 class="center title_responsivo">Esqueci minha senha</h4>
   <a class="waves-effect waves-light btn" href="../login.php"><i class="fa fa-arrow-left"></i> Voltar</a>

   <br><br><br>

   <div class="col m4"></div>
   <div class="input-field col m4 s12">
    <input type="text"  id="cpf_user" onkeyup="somenteNumeros(this);" name="cpf" required placeholder="000.000.000.00">
    <label >CPF *</label>
  </div>

  <div class="col m12"></div>

  <div class="col m4"></div>
  <div class="input-field col m4 s12">
    <input disabled type="email" id="email_user" name="email" required class="validate" placeholder="usuario@exemplo.com">
    <label >e-mail *</label>
  </div>

  <div class="col m12">
    <div class="center">
      <button type="submit" disabled name="recuperar_senha" id="recuperar_senha" class="waves-effect waves-light btn medium-small darken-3">Recuperar Senha <i class="fa fa-arrow-right"></i></button>
    </div>
  </div>
</div>

<script src="../js/jquery.js"></script>
<script src="../js/jquerymask.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/vanilla-masker.js"></script>
</body>
</html>

<script>
  $("#cpf_user").change(function(){
    var cpf = $('#cpf_user').val();

    $.ajax({
      url : '../engine/controllers/usuario.php',
      data : {
        cpf : cpf,

        action : 'verificaCPF'
      },
      success : function(data){
        if (data == "") {
          mbox.alert("CPF não cadastrado na base dados! Tente novamente.");
          $('#email_user').attr('disabled',true);
          $('#recuperar_senha').attr('disabled',true);
          document.getElementById('cpf_user').value = "";
          document.getElementById('email_user').value = "";
        } else {
          $('#email_user').removeAttr('disabled');
        }
      },
      type : 'POST'
    });
  });

  $("#email_user").change(function(){
    var cpf = $('#cpf_user').val();
    var email = $('#email_user').val();
    $.ajax({
      url : '../engine/controllers/usuario.php',
      data : {
        cpf : cpf,
        email : email,

        action : 'esqueci_senha'
      },
      success : function(data){
        if (data == "") {
          mbox.alert("Dados não correspondem ou não foram encontrados na base de dados! Tente novamente.");
          document.getElementById("email_user").value = "";
          $('#recuperar_senha').attr('disabled',true);
        } else {
          if(email != "" && cpf != ""){
            $('#recuperar_senha').removeAttr('disabled');
          }
        }
      },
      type : 'POST'
    });
  });

  function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
  }

  VMasker(document.querySelector("#cpf_user")).maskPattern("999.999.999.99");

  $('#recuperar_senha').click(function(e) {
    e.preventDefault();

    var cpf = $('#cpf_user').val();
    var email = $('#email_user').val();
    var data = "<?php echo date('y-m-d'); ?>";
    var parts = data.split('-');
    var d1 = parts[0];
    var d2 = parts[1];
    var d3 = parts[2];
    var c0 = $('#cpf_user').val().replace(/\./g, '');
    var c1 = c0.slice(0, 3);
    var c2 = c0.slice(3, 6);
    var c3 = c0.slice(6, 9);
    var c4 = c0.slice(9, 11);
    var cod = c4+d1+Math.floor(Math.random()*99999 + 10000)+c2+d2+Math.floor(Math.random()*90000 + 10000)+c3+d3+Math.floor(Math.random()*95555 + 10000)+c1;

    if (cpf == "" || cpf == null || email == "" || email == null) {
      return mbox.alert("Preencha todos os campos corretamente!");
    } else {
      $.ajax({
        url: '../src/esqueci-senha.php',
        data : {
          email : email,
          id : id
        },
        type : 'POST'
      });

      $.ajax({
        url: '../engine/controllers/redefinicao_senha.php',
        data : {
          codigo : id,
          cpf_usuario : cpf,
          email_usuario : email,

          action : 'create'
        },
        success : function(data){
          if (data == 'true') {
            mbox.alert("Obrigado! Verifique "+email+" para obter um link para redefinir sua senha.", function(){
              window.location = 'index.php';
            });
          }
        },
        type : 'POST'
      });
    }
  });
</script>

