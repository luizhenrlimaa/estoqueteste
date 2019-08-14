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
            width: 200px;
          }
        }
        .detalhes_usuario:hover .det{
          background:rgba(211,211,211);
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
      <nav style="background:#708090;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>CONSULTAR PRODUTO</a></li>
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
          <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
          <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="inserir_produto.php" style="color: black; background: #27ae60;"><i class="fas fa-plus"></i> Adicionar</a>
        </div>
        
        <?php
        require_once "../engine/config.php";

        $item_por_pag = 10;

        $x = new Produto();
        $ProdutoNum = 0;
        $x = $x->ReadAll();
        foreach($x as $xx){
          $ProdutoNum += 1;
        }
        $pagina = intval($_GET['pagina']);
        $num_paginas = ceil($ProdutoNum/$item_por_pag);

        $item = 0;
        for($a = 0; $a<$pagina; $a++){
          $item = $item+$item_por_pag;
        }

        $Produto = new Produto();
        $Produto = $Produto->ReadAll_Paginacao($item, $item_por_pag);

        ?>

        <div class="container-fluid" style="min-height: 100vh;">
          <div class="row">
            <br>

            <form class="col s12">
              <div class="col m7 s12"></div>
              <div class="input-field col m2 s4">
                <select id="tipo" name="tipo">
                  <option value="0">Nome</option>
                  <option value="1">Quantidade</option>
                  <option value="2">Tipo</option>
                  <option value="3">Valor</option>
                  <option value="4">Fornecedor</option>
                  <option value="5">CFOP</option>
                </select> 
              </div>
              <div class="input-field col m2 s5" id="solici_aberto">
                <input placeholder="Pesquisar por..." id="pesq_nome" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m2 s5 hide" id="tipo_select">
                <select id="tipo_pesq" name="tipo_pesq">
                  <option value="0">Caixa</option>
                  <option value="1">Unidade</option>
                  <option value="2">Outros</option>
                </select>
              </div>

              <div class="input-field col m2 s5 hide" id="fornecedor_select">
                <select id="fornecedor_pesq" name="fornecedor_pesq">
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
              </div>

              <div class="input-field col m1 s1">
                <a class="waves-effect waves-light btn" style="background: #2980b9;" id="pesquisar"><i class="fa fa-search"></i></a>
              </div>
            </form>
          </div>
          <?php
          if(empty($Produto)){
            echo '<h4 class="center"> Nenhum dado encontrado! </h4>';
          }else{
            ?>
            <table class="responsive-table centered">
              <thead style="background: #2980b9; color: #fff;">
                <tr>
                  <th>Nome</th>
                  <th>Quantidade</th>
                  <th>Tipo</th>
                  <th>Valor R$</th>
                  <th>Fornecedor</th>
                  <th>CFOP</th>
                  <th>Apagar</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                foreach($Produto as $val) {

                  $id = $val['id'];
                  $nome_produto = $val['nome'];
                  $quantidade = $val['quantidade'];
                  $custo = $val['valor'];
                  $cfop = $val['cfop'];

                  switch ($val['tipo']) {
                    case '0': $tipo_produto = "Caixa"; break;
                    case '1': $tipo_produto = "Unidade"; break;
                    case '2': $tipo_produto = "Outros"; break;
                  }

                  $valor = new Fornecedor();
                  $valor = $valor->Read($val['fk_fornecedor']);
                  $Fornecedor = $valor['nome'];
                  ?>

                  <tr class="detalhes_usuario">
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $nome_produto;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $quantidade;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $tipo_produto;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>">R$ <?php echo $custo;?>,00</td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $Fornecedor; ?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $cfop; ?></td>
                    <td class="apagar" id="<?php echo $val['id']; ?>"><i class="fa fa-trash fa-lg"></i> </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
            <ul class="pagination">
              <li><a href="consultar_produto.php?pagina=0"><i class="material-icons">chevron_left</i></a></li>

              <?php
              $lim_links = 5;
              $inicio = ((($pagina - $lim_links) >= 0) ? $pagina - $lim_links : 0);
              $fim = ((($pagina+$lim_links) < $num_paginas) ? $pagina+$lim_links : $num_paginas-1);

              if($pagina > $lim_links){echo "<li style='text-transform: uppercase;font-weight: 700; color: #222; font-size: 1.2em;'>. . .</li>";}

              if($num_paginas > 0 && $pagina <= $num_paginas){
                for($i = $inicio; $i <= $fim; $i++){

                  if($i == $pagina){ ?>
                    <li><a style="text-transform: uppercase;font-weight: 700; background: #3574B9; color: white;" 
                      href="consultar_produto.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                    <?php }else { ?>
                      <li><a style="text-transform: uppercase;font-weight: 700; color: #3574B9;" href="consultar_produto.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                      <?php 
                    }
                  } if($pagina < $num_paginas-$lim_links-1){echo "<li style='text-transform: uppercase;font-weight: 700; color: #222; font-size: 1.2em;'>. . .</li>";}
                }
                ?>
                <li class="waves-effect"><a href="consultar_produto.php?pagina=<?php echo $num_paginas-1 ?>"><i class="material-icons">chevron_right</i></a></li>
              </ul>
            <?php } ?>
          </div>

          <script src="../js/jquery.js"></script>
          <script src="../js/materialize.js"></script>
          <script src="../js/mbox-0.0.1.js"></script>
          <script src="../js/drop_materialize.js"></script>

        </body>
        </html>

        <script>
          $(document).ready(function(){


            $('.det').click(function(e) {
              var id = $(this).attr('id');
              window.location = "edita_produto.php?id="+id;
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

            $(".apagar").click( function(event) {
              var apagar = mbox.confirm('Deseja realmente excluir este registro?');
              if (apagar){
                var id = $(this).attr('id');
                $.ajax({
                  url: '../engine/controllers/produto.php',
                  data: {
                    id : id,
                    action: 'delete'
                  },
                  success: function(data) {
                    if(data === 'true'){
                      Materialize.toast("Solicitação excluida.", 3000, "rounded", function(){
                        location.reload();
                      });
                    }
                  },
                  async: false,
                  type: 'POST'
                });      
              }else{
               event.preventDefault();
             } 
           });

            $("#tipo").change(function(){
              var tipo = $('#tipo').val();

              if(tipo == 0){
                $("#solici_aberto").removeClass("hide");
                $("#tipo_select").addClass("hide");
                $("#fornecedor_select").addClass("hide");
              }else if(tipo == 1){
                $("#solici_aberto").removeClass("hide");
                $("#tipo_select").addClass("hide");
                $("#fornecedor_select").addClass("hide");
              }else if(tipo == 2){
                $("#solici_aberto").addClass("hide");
                $("#tipo_select").removeClass("hide");
                $("#fornecedor_select").addClass("hide");
              }else if(tipo == 3){
                $("#solici_aberto").removeClass("hide");
                $("#tipo_select").addClass("hide");
                $("#fornecedor_select").addClass("hide");
              }else if (tipo == 4){
                $("#solici_aberto").addClass("hide");
                $("#tipo_select").addClass("hide");
                $("#fornecedor_select").removeClass("hide");
              }else if (tipo == 5){
                $("#solici_aberto").addClass("hide");
                $("#tipo_select").addClass("hide");
                $("#fornecedor_select").removeClass("hide");
              }
            });


            $('#pesquisar').click(function(e) {
              e.preventDefault();
              var tipo = $('#tipo').val();
              if (tipo == 0){
                var pesq = $('#pesq_nome').val();
                if(pesq == ""){
                  return toastr.error('Preencha o campo de pesquisa!');
                }else{
                  window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
                }
              }else if(tipo == 1){
                var pesq = $('#pesq_nome').val();
                window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo == 2){
                var pesq = $('#tipo_pesq').val();
                window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo==3){
                var pesq = $('#pesq_nome').val();
                window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo == 4){
                var pesq = $('#fornecedor_pesq').val();
                window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo == 5){
                var pesq = $('#fornecedor_pesq').val();
                window.location = "consultar_produto_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }

            });

          });
        </script>