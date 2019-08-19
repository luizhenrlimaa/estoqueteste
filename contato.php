<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}

session_start();
    // Inicia a sessão

if(empty($_SESSION)){
  ?>
  <script>
    document.location.href = '/login.php' ;
  </script>
  <?php
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
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" type="text/css" href="css/mbox-0.0.1.css"/>
</head>
<body>    

  <nav style="background:#708090 ;">
    <div class="nav-wrapper">
      <ul class="hide-on-med-and-down">
        <li><a href="index.php" class="brand-logo"><i class="material-icons">cloud</i>REALIZAR CONTATO</a></li>
      </ul>
      <ul class="right hide-on-med-and-down getout">
        <li><a href="engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
      </ul>
      <ul class=" right hide-on-med-and-down">
        <li><a href="usuario/editar.php"><i class="large material-icons">account_circle</i></a>
        </ul>
      </div>
    </nav>

    <?php 
    require_once "engine/config.php";

    $valores = new Contato();
    $valores = $valores->ReadAll();

    foreach ($valores as $valor) {
      $id = $valor['id'];
      $nome = $valor['nome'];
      $assunto = $valor['assunto'];
      $sobrenome = $valor['sobrenome'];
      $area = $valor['area'];
    }

    ?>

    <center>
      <h5 class="indigo-text"><i class="fas fa-user" style="font-size: 4em; color: #000; "></i></h5>
      <div class="container">
        <div class="x" style="background: rgba(211,211,211); display: inline-block; padding: 32px 48px 40px 48px; border-radius: 4px;">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
            <div class="input-field col m6 s6">
              <input id="nome" type="text" class="validate">
              <label class="active" for="nome">Nome*</label>
            </div>
            <div class="input-field col m6 s6">
              <input id="assunto" type="text" class="validate">
              <label class="active" for="assunto">Assunto*</label>
            </div>
            <div class="input-field col m6 s6">
              <input id="sobrenome" type="text" class="validate">
              <label class="active" for="sobrenome">Sobrenome*</label>
            </div>
            <div class="input-field col m6 s6">
             <textarea id="area" class="materialize-textarea"></textarea>
             <label class="active" for="area">Inserir texto*</label>
           </div>
           <div class="modal-footer">
            <p class="center"><button id="registrar_contato" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">ENVIAR<i class="fa fa-arrow-right"></i></button></p>
          </div>
        </div>
      </form>
    </div>

  </form>
</div>

</body>
</html>


<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script src="js/mbox-0.0.1.js"></script>

<script>

  $(document).ready(function(){

    $('.det').click(function(e) {
      var id = $(this).attr('id');
      window.location = "#";
    });

    $('.getout').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: 'engine/controllers/logout.php',
        data: {},
        success: function(data) {
          if(data === 'kickme'){
            document.location.href = 'login.php';
          } else {
            alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
          }
        },
        type: 'POST'
      });
    });

    $('#registrar_contato').click(function(e) {
      e.preventDefault();
      var nome = $('#nome').val();
      var assunto = $('#assunto').val();
      var sobrenome = $('#sobrenome').val();
      var area = $('#area').val();

      if(nome == "" || assunto == "" || sobrenome == ""|| area ==""){
        return mbox.alert('Preencha todos os campos que possuem *');
      }else {
        $.ajax({
          url: 'engine/controllers/contato.php',
          data : {
            nome: nome,
            assunto: assunto,
            sobrenome : sobrenome,
            area: area,

            action: 'create'
          },
          success: function(data){
            obj = JSON.parse(data);
            if(obj.res === 'true'){
              Materialize.toast("Contato enviado com Sucesso!", 1500, "rounded", function(){
               
                window.location = "contato/consultar_contato.php"                    
              });
            }
          },
          async: false,
          type : 'POST'
        });
      }
    });

  });
</script>