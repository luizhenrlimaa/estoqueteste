<?php
require_once "../engine/config.php";

if(empty($_GET['token'])){
// if($_GET['token'] == "" || $_GET['token'] == null){
// if(0 > 1){
  ?>
  <script>
    document.location.href = 'index.php';
  </script>
  <?php
} else {

  $Redef = new Redefinicao_senha();
  $Redef = $Redef->ReadToken($_GET['token']);

  $teste = $Redef['codigo'];

  if ($Redef['codigo'] != $_GET['token']) {
    ?>
    <script>
     document.location.href = 'index.php';
   </script>
   <?php
 } else {
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "shortcut icon" type = "image/x-icon" href = "../img/favicon.ico"/>
    <title>PROACE/DASA :: Cadastro</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.css">
    <link href="../css/somesystem.css" rel="stylesheet">
    <link href="../css/mbox-0.0.1.css" rel="stylesheet">
  </head>

  <body>
    <div class="container row">
     <h2 class="center title_responsivo">Redefinição de Senha</h2>

     <div class="col m4"></div>
     <div class="input-field col m4 s12">
      <input type="password" id="nova_senha" name="nova_senha" placeholder=" " required>
      <label >Nova senha *</label>
    </div>

    <div class="col m12"></div>

    <div class="col m4"></div>
    <div class="input-field col m4 s12">
      <input disabled type="password" id="conf_nova_senha" name="conf_nova_senha" placeholder=" " required>
      <label >Confirmação da nova senha *</label>
    </div>

    <div class="col m12">
      <div class="center">
        <button type="submit" disabled name="recuperar_senha" id="redefinir_senha" class="waves-effect waves-light btn green darken-3">Redefinir Senha <i class="fa fa-arrow-right"></i></button>
      </div>
    </div>
  </div>

  <script src="../js/jquery.js"></script>
  <script src="../js/materialize.min.js"></script>
  <script src="../js/mbox-0.0.1.js"></script>
</body>
</html>

<script>
  $("#nova_senha").change(function(){ //função que desabilida um campo
    var nova_senha = $('#nova_senha').val();

    if (nova_senha == "" || nova_senha == null) {
      $('#conf_nova_senha').attr('disabled',true);
      document.getElementById('conf_nova_senha').value = "";
    } else {
      $('#conf_nova_senha').removeAttr('disabled');
    }
  });

  $("#conf_nova_senha").change(function(){ //função que desabilida um campo
    var nova_senha = $('#nova_senha').val();
    var conf_nova_senha = $('#conf_nova_senha').val();

    if (conf_nova_senha == "" || conf_nova_senha == null) {
      $('#redefinir_senha').attr('disabled',true);
    } else {
      if (conf_nova_senha == nova_senha) {
        $('#redefinir_senha').removeAttr('disabled');
      } else {
        $('#redefinir_senha').attr('disabled',true);
        document.getElementById('conf_nova_senha').value = "";
        mbox.alert("As senhas não coincidem! Tente novamente.");
      }
    }
  });

  $('#redefinir_senha').click(function(e) { //função que redefine a senha
    e.preventDefault();

    var email = "<?php echo $Redef['email_usuario']; ?>";
    var nova_senha = $('#nova_senha').val();

    if (nova_senha.length < 6) {
      document.getElementById("nova_senha").value = "";
      return mbox.alert("A senha deve conter no mínimo 6 caracteres");
    }

    $.ajax({
      url: '../engine/controllers/redefinicao_senha.php',
      data : {
        email_usuario : email,

        action : 'delete'
      },
      type : 'POST'
    });

    $.ajax({
      url: '../engine/controllers/usuario_dasa.php',
      data : {
        email : email,
        senha : nova_senha,

        action : 'updateSenha'
      },
      type : 'POST'
    });

    $.ajax({
      url: '../engine/controllers/usuario.php',
      data : {
        email : email,
        senha : nova_senha,

        action : 'updateSenha'
      },
      success : function(data){
        if (data == 'true') {
          mbox.alert("Senha redefinida com sucesso! Você será redirecionado para a tela de login.", function(){
            window.location = 'index.php';
          });
        } else {
          mbox.alert("Erro de conexão com o servidor ao redefinir senha! Tente novamente em alguns minutos.");
        }
      },
      type : 'POST'
    });
  });
</script>
<?php
}
}
?>