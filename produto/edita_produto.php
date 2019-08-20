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
      <nav style="background: #708090; color: #fff;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>EDITAR</a></li>
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

        <center><h5 style="font-weight: 600;">Editar Dados do Produto</h5></center>
        <br>

        <div class="container">
         <?php require_once "../engine/config.php";

         $id = $_GET['id'];
         $valores = new Produto();
         $valores = $valores->Read($id);

         $nome = $valores['nome'];
         $quantidade = $valores['quantidade'];
         $custo = $valores['valor'];
         $fk = $valores['fk_fornecedor'];
         $cfop = $cfop['cfop'];

         switch ($valores['tipo']) {
          case '0': $tipo = "Caixa"; break;
          case '1': $tipo = "Unidade"; break;
          case '2': $tipo = "Outros"; break;
        }

        ?>

        <br><br>
        <div class="row">
          <div class="input-field col m6 s12">
            <input type="text" id="nome" name="nome" value="<?php echo $nome;?>">
            <label >Nome</label>
          </div>
          <div class="input-field col m6 s12">
           <input type="text" id="quantidade" name="quantidade" value="<?php echo $quantidade;?>">
           <label >Quantidade</label>
         </div>
       </div>

       <div class="row">
         <div class="input-field col m6 s12">
          <select name="tipo" id="tipo">
            <option value="" desabled selected><?php echo $tipo;?></option>
            <option value="0">Caixa</option>
            <option value="1">Unidade</option>
            <option value="2">Outros</option>
          </select>
          <label>Tipo</label>
        </div>
        <div class="input-field col m6 s12">
         <input type="text" id="valor_produto" name="valor_produto" value="<?php echo $custo;?>">
         <label >Valor R$</label>
       </div>
     </div>

     <div class="row">
      <div class="input-field col m6 s12">
        <select name="fornecedor" id="fornecedor">
          <?php
          require_once "../engine/config.php";
          $info = new Fornecedor();
          $info = $info->ReadSelect();

          $info = new Fornecedor();
          $info = $info->ReadAll();
          ?>
          <option value="" desabled selected>Selecione...</option>
          <?php
          foreach ($info as $todos){ 
            ?>

            <option value="<?php echo $todos['id'];?>" <?php if($todos['id'] == $fk){echo 'selected';} ?>><?php echo  $todos['nome'];?></option>';

          <?php }
          ?>
        </select>
        <label>Fornecedor</label>

      </div>

      <div class="input-field col m6 s12">
            <input type="text" id="cfop" name="cfop" value="<?php echo $cfop;?>">
            <label >CFOP</label>
          </div>
    </div>
    <br>
    <div class="input-field col m12 s12">
      <p class="center"><a class="waves-effect waves-light btn green darken-3" id="Salvar"><i class="fa fa-pencil"></i> Salvar Alterações </a></p>
    </div> 
  </div>
</body>
</html>

<script src="../js/jquery.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/mbox-0.0.1.js"></script>


<script type="text/javascript">

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

  $('#Salvar').click(function(e) {
    e.preventDefault();
    var id = '<?php echo  $_GET['id'];?>';
    var nome = $('#nome').val();
    var quantidade = $('#quantidade').val();
    var tipo = $('#tipo').val();
    var fornecedor = $('#fornecedor').val();
    var valor_produto = $('#valor_produto').val();
    var cfop = $('#cfop').val();

    switch (tipo) {
      case 'Caixa': tipo = 0;
      case 'Unidade': tipo = 1;
      case 'Outros': tipo = 2;
    }

    if (nome === "" && quantidade === "" && tipo === ""&& valor_produto ===""&& fornecedor=== "" && cfop=== ""){
      var $toastContent = $('<span>Preencha pelo menos um campo!</span>');
      Materialize.toast($toastContent, 4000, 'rounded');
      return;
    }else{
      $.ajax({
        url: '../engine/controllers/produto.php',
        data: {
          id : id,
          nome : nome,
          quantidade : quantidade,
          tipo : tipo,
          valor: valor_produto,
          fk_fornecedor: fornecedor,
          cfop: cfop,

          action: 'update'
        },
        success: function(data) {
          if(data === 'true'){
            Materialize.toast("Dados Atualizados.", 3000, "rounded", function(){
              window.location.href = "consultar_produto.php";
            });
          }else{
            var $toastContent = $('<span>Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.</span>');
            Materialize.toast($toastContent, 5000, 'rounded');
          }
        },

        type: 'POST'
      });
    };
  });
</script>