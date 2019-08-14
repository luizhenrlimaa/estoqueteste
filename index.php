<      <?php
    $showerros = true;
    if($showerros) {
      ini_set("display_errors", $showerros);
      error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
    }

    session_start();
    if(empty($_SESSION)){
      ?>
      <script>
        document.location.href = 'login.php' ;
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
      <nav style="background:#2980b9 ;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a></li>
          </ul>
          <ul class="right hide-on-med-and-down getout">
            <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
          </ul>
          <ul class="right hide-on-med-and-down getout">
            
            <?php 
            require_once "engine/config.php";
            $valores = new Usuario();
            $teste = $valores->ReadAll();

            $nome = $teste['nome'];
            
            ?>
            <li><?php echo $nome; ?></li>
          </ul>
          <ul class=" right hide-on-med-and-down">
            <li><a href="usuario/editar.php"><i class="large material-icons">account_circle</i></a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <div class="container">
        <div class="row">
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Produto</span>
                <p>Consulte no sistema os produtos que você possui.</p>
              </div>
              <div class="card-action">
                <a href="produto/consultar_produto.php">Consultar</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Fornecedor</span>
                <p>Consulte no sistema os seus fornecedores.</p>
              </div>
              <div class="card-action">
                <a href="fornecedor/consulta_fornecedor.php">Consultar</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Gerar relatório</span>
                <p>Gere o relatório do estoque.</p>
              </div>
              <div class="card-action">
                <a href="relatorio/gerar.php">Gerar</a>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title">Preencher</span>
                <p>Procurar algo para preencher.</p>
              </div>
              <div class="card-action">
                <a href="#">Preencher</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </body>
    </html>


    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mbox-0.0.1.js"></script>

    <script>

     $('.getout').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: 'engine/controllers/logout.php',
        data: {},
        success: function(data) {
          if(data === 'kickme'){
            document.location.href = 'login.php';
          } else {
            return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
          }
        },
        type: 'POST'
      });
    });
  </script>