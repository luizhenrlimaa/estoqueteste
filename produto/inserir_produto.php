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
      <style type="text/css">
        @media screen and (min-width: 600px) {
          #tipo_tabela{
            width: 400px;
          }
        }
        .detalhes_usuario:hover .det{
          background: rgba(0, 169, 161, 0.3);
          cursor: pointer;
        }
        .apagar:hover{
          cursor:pointer;
          color: #fff;
          background-color: rgba(187, 36, 52, 0.9);
        }
      </style>
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
          <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="consultar_produto.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>

        <center><h5 style="font-weight: 600;">Registro de produto</h5></center>
        <br>

        <div class="container">
          <div class="row">
            <form class="col s12">
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="nome_produto" name="nome_produto" type="text">
                  <label>Nome Produto*</label>
                </div>
                <div class="input-field col m6 s12">
                  <select name="tipo_produto" id="tipo_produto">
                    <option value="" desabled selected>Selecione...</option>
                    <option value="0">Caixa</option>
                    <option value="1">Unidade</option>
                    <option value="2">Outros</option>
                  </select>
                  <label>Tipo Produto*</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col m6 s12">
                  <input id="quantidade_produto" name="quantidade_produto" type="text">
                  <label>Quantidade*</label>
                </div>

                <div class="input-field col m6 s12">
                  <input id="valor_produto" name="valor_produto" type="text">
                  <label>Valor R$*</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col m6 s12">
                  <select name="fornecedor" id="fornecedor">
                    <?php
                    require_once "../engine/config.php";
                    $info = new Fornecedor();
                    $info = $info->ReadSelect();
                    ?>
                    <option value="" desabled selected>Selecione...</option>
                    <?php 
                    foreach ($info as $todos){ ?>

                      <option value="<?php echo $todos['id'];?>"><?php echo $todos['nome'];?></option>';
                      
                    <?php }
                    ?>
                  </select>
                  <label>Fornecedor*</label>
                </div>
                 <div class="input-field col m6 s12">
                  <input id="cfop_produto" name="cfop_produto" type="text">
                  <label>CFOP*</label>
                </div>
              </div>
              <div class="modal-footer">
                <p class="center"><button id="registrar_produto" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar<i class="fa fa-arrow-right"></i></button></p>
              </div>
            </form>
          </div>
        </div>

      </body>

      <script src="../js/jquery.js"></script>
      <script src="../js/materialize.js"></script>
      <script src="../js/mbox-0.0.1.js"></script>

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
                return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
              }
            },
            type: 'POST'
          });
        });
        
        $('#registrar_produto').click(function(e) {
          e.preventDefault();

          var nome_produto = $('#nome_produto').val();
          var quantidade_produto = $('#quantidade_produto').val();
          var tipo_produto = $('#tipo_produto').val();
          var id_usuario = '<?php echo $_SESSION['id'];?>';
          var fornecedor = $('#fornecedor').val();
          var valor_produto = $('#valor_produto').val();
          var cfop_produto = $('#cfop_produto').val();


          if(nome_produto == "" || quantidade_produto == "" || tipo_produto == ""|| fornecedor=="" || valor_produto=="" || cfop_produto==""){
            return mbox.alert('Preencha todos os campos que possuem *');
          }else {
            $.ajax({
              url: '../engine/controllers/produto.php',
              data : {
                fk_usuario : id_usuario,
                nome: nome_produto,
                quantidade : quantidade_produto,
                tipo: tipo_produto,
                valor: valor_produto,
                fk_fornecedor: fornecedor,
                cfop: cfop_produto,

                action: 'create'
              },
              success: function(data){
                obj = JSON.parse(data);
                if(obj.res === 'true'){
                  Materialize.toast("Cadastro Realizado com Sucesso!", 1500, "rounded", function(){
                    window.location = "consultar_produto.php"                    
                  });
                }
              },
              async: false,
              type : 'POST'
            });
          }
        });
      </script>
