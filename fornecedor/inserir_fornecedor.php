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
        document.location.href = '../login.php' ;
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
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="../css/mbox-0.0.1.css"/>
    </head>

    <body>  
      <nav style="background:#2980b9 ;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a></li>
          </ul>
          <ul class="right hide-on-med-and-down getout">
            <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
          </ul>
          <ul class=" right hide-on-med-and-down">
            <li><a href="usuario/editar.php"><i class="large material-icons">account_circle</i></a>
            </ul>
          </div>
        </nav>
        <br>
        <div class="col m12 s12">
          <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="consulta_fornecedor.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>

        <center><h5 style="font-weight: 600;">Registro de fornecedor</h5></center>
        <br>
        <div class="container">
          <div class="row">
            <form class="col s12">
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="nome_registro" name="nome" type="text">
                  <label>Nome Completo*</label>
                </div>

                <div class="input-field col m6 s12">
                  <input id="cnpj_registro" name="cnpj" type="text" required placeholder="000.000.000.00">
                  <label>CNPJ*</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="email_registro" name="email" type="email">
                  <label>E-mail*</label>
                </div>
                 <div class="input-field col m6 s12">
                  <input id="ie_registro" name="ie" type="text">
                  <label>Inscrição Estadual*</label>
                </div>
              </div>

              <div class="modal-footer">
                <center><button id="registrar_usuario" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar<i class="fa fa-arrow-right"></i></button></center>
              </div>
            </form>
          </div>
        </div>

      </body>
      </html>

      <script src="../js/jquery.js"></script>
      <script src="../js/materialize.js"></script>
      <script src="../js/jquerymask.min.js"></script>
      <script src="../js/mbox-0.0.1.js"></script>

      <script>

        /*Para fazer o select aparecer*/
        window.onload=function(){
          $(document).ready(function() {
            $('select').material_select();
          });
        }

        $('#cnpj_registro').mask('999.999.999-99');
        $('#ie_registro').mask('999.999.999/9999');


        /*Joga tudo no banco de dados*/
        $('#registrar_usuario').click(function(e) {
          e.preventDefault();

          var nome_registro = $('#nome_registro').val();
          var cnpj_registro = $('#cnpj_registro').val();
          var email_registro = $('#email_registro').val();
          var ie_registro = $('#ie_registro').val();

          if(nome_registro === "" || cnpj_registro === "" || email_registro === "" || ie_registro === ""){
            return mbox.alert('Preencha todos os campos com *');
          } else {
            $.ajax({
              url: '../engine/controllers/fornecedor.php',
              data : {
                nome: nome_registro,
                cnpj : cnpj_registro,
                email : email_registro,
                ie: ie_registro,

                action: 'create'
              },
              success: function(data){
                obj = JSON.parse(data);
                if(obj.res === 'true'){
                  Materialize.toast("Cadastro Realizado com Sucesso!", 1500, "rounded", function(){
                    window.location = "consulta_fornecedor.php"
                  });
                }
              },
              async: false,
              type : 'POST'
            });
          }
        });  
        
        $('.getout').click(function(e) {
          e.preventDefault();

          $.ajax({
            url: '../engine/controllers/logout.php',
            data: {},
            success: function(data) {
              if(data === 'kickme'){
                document.location.href = '../login.php';
              } else {
                return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
              }
            },
            type: 'POST'
          });
        });

      </script>
