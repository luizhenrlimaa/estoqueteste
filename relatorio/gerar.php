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
      <style type="text/css">
        @media screen and (min-width: 600px) {
          #tipo_tabela{
            width: 400px;
          }
        }
        .detalhes_usuario:hover .det{
          background: rgba(0, 169, 161, 0.3);
        }
        .apagar:hover{
          cursor:pointer;
          color: #fff;
          background-color: rgba(187, 36, 52, 0.9);
        }
      </style>
    </head>

    <body>  
      <nav style="background:#708090 ;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>GERAR RELATÓRIO</a></li>
          </ul>
          <ul class="right hide-on-med-and-down getout">
            <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
          </ul>
          <ul class=" right hide-on-med-and-down">
            <li><a href="../usuario/editar.php"><i class="large material-icons">account_circle</i></a>
            </ul>
          </div>
        </nav>
        <br>
        <div class="col m12 s12">
          <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white; margin: .5em;"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>

        <center><h5 style="font-weight: 600;">GASTOS</h5></center>
        <br>
        <div class="container">

          <table class="responsive-table centered">
            <thead style="background: #708090; color: #fff;">
              <tr>
                <th>VALOR</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              require_once "../engine/config.php";

              $valores = new Produto();
              $valores = $valores->ReadAll($_SESSION['id']);

              //Faço um foreach e pega apenas os valores do banco e incremento
              foreach ($valores as $valores) {
                $valor = $valores['valor'];
                $soma += $valor;
              }
              ?>
              <tr class="detalhes_usuario">
                <td class="det"><?php echo 'R$ ',$soma,',00'; ?></td>
              </tr> 
            </tbody>
          </table>
          <br><br>
          <div class="col m12 s12">
            <center><a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../pdf/exemploPdf.php" style="color: black; background: #f06595; margin: .5em;"><i class="fas fa-file-pdf"></i> PDF</a></center>
          </div>
        </div>

      </body>
      </html>

      <script src="../js/jquery.js"></script>
      <script src="../js/materialize.js"></script>
      <script src="../js/jquerymask.min.js"></script>

      <script>

        /*Para fazer o select aparecer*/
        window.onload=function(){
          $(document).ready(function() {
            $('select').material_select();
          });
        }

        $('.getout').click(function(e) {
          e.preventDefault();

          $.ajax({
            url: '../engine/controllers/logout.php',
            data: {},
            success: function(data) {
              if(data === 'kickme'){
                document.location.href = '../login.php';
              } else {
                alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
              }
            },
            type: 'POST'
          });
        });

      </script>
