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
        <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>CONSULTAR REGISTROS DE CONTATO</a></li>
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
      <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
      <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../contato.php" style="color: black; background: #27ae60;"><i class="fas fa-plus"></i> Adicionar</a>
    </div>


    <?php
    require_once "../engine/config.php";

    $item_por_pag = 10;

    $x = new Contato();
    $ContatoNum = 0;
    $x = $x->ReadAll();
    foreach($x as $xx){
      $ContatoNum += 1;
    }
    $pagina = intval($_GET['pagina']);
    $num_paginas = ceil($ContatoNum/$item_por_pag);

    $item = 0;
    for($a = 0; $a<$pagina; $a++){
      $item = $item+$item_por_pag;
    }

    $Contato = new Contato();
    $Contato = $Contato->ReadAll_Paginacao($item, $item_por_pag);
    ?>


    <div class="container-fluid" style="min-height: 100vh;">
      <div class="row">
        <br>

        <form class="col s12">
          <div class="col m7 s12"></div>
          <div class="input-field col m2 s4">
            <select onchange="pro()" id="tipo" name="tipo">
              <option value="0">Nome</option>
              <option value="1">Assunto</option>
              <option value="2">Sobrenome</option>
              <option value="3">Texto</option>

            </select> 
          </div>
          <div class="input-field col m2 s5" id="nome">
            <input placeholder="Nome" id="nome_123" name="nome" type="text">
          </div>

          <div class="input-field col m2 s5 hide" id="assunto">
            <input placeholder="Assunto" id="assunto_123" name="assunto" type="text">
          </div>

          <div class="input-field col m2 s5 hide" id="sobrenome">
            <input placeholder="Sobrenome" id="sobrenome_123" name="sobrenome" type="text">
          </div>

          <div class="input-field col m2 s5 hide" id="area">
            <input placeholder="Texto" id="area_123" name="area" type="text">
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
      if(empty($Contato)){
        echo '<h4 class="center"> Nenhum dado encontrado! </h4>';
      }else{
        ?>
        <table class="responsive-table centered">
          <thead style="background: #708090; color: #fff;">
            <tr>
              <th>Nome</th>
              <th>Assunto</th>
              <th>Sobrenome</th>
              <th>Texto</th>
              <th>Apagar<th>

              </tr>
            </thead>
            <tbody>
              <?php 

              foreach($Contato as $val) {

                $id = $val['id'];
                $nome = $val['nome'];
                $assunto = $val['assunto'];
                $sobrenome = $val['sobrenome'];
                $area = $val['area'];
                ?>

                <tr class="detalhes_usuario">
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $nome;?></td>
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $assunto;?></td>
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $sobrenome;?></td>
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $area;?></td>
                  <td class="apagar" id="<?php echo $val['id']; ?>"><i class="fa fa-trash fa-lg"></i> </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          <ul class="pagination">
            <li><a href="consultar_contato.php?pagina=0"><i class="material-icons">chevron_left</i></a></li>

            <?php
            $lim_links = 5;
            $inicio = ((($pagina - $lim_links) >= 0) ? $pagina - $lim_links : 0);
            $fim = ((($pagina+$lim_links) < $num_paginas) ? $pagina+$lim_links : $num_paginas-1);

            if($pagina > $lim_links){echo "<li style='text-transform: uppercase;font-weight: 700; color: #222; font-size: 1.2em;'>. . .</li>";}

            if($num_paginas > 0 && $pagina <= $num_paginas){
              for($i = $inicio; $i <= $fim; $i++){

                if($i == $pagina){ ?>
                  <li><a style="text-transform: uppercase;font-weight: 700; background: #3574B9; color: white;" 
                    href="consultar_contato.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                  <?php }else { ?>
                    <li><a style="text-transform: uppercase;font-weight: 700; color: #3574B9;" href="consultar_contato.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                    <?php 
                  }
                } if($pagina < $num_paginas-$lim_links-1){echo "<li style='text-transform: uppercase;font-weight: 700; color: #222; font-size: 1.2em;'>. . .</li>";}
              }
              ?>
              <li class="waves-effect"><a href="consultar_contato.php?pagina=<?php echo $num_paginas-1 ?>"><i class="material-icons">chevron_right</i></a></li>
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

        function pro(){
          var tipo = $('#tipo').val();
          if(tipo == 0){
            $("#nome").removeClass("hide");
            $("#assunto").addClass("hide");
            $("#sobrenome").addClass("hide");
            $('#area').addClass("hide");
          }else if(tipo == 1){
            $("#nome").addClass("hide");
            $("#assunto").removeClass("hide");
            $("#sobrenome").addClass("hide");
            $('#area').addClass("hide");
          }else if(tipo == 2){
            $("#nome").addClass("hide");
            $("#assunto").addClass("hide");
            $("#sobrenome").removeClass("hide");
            $('#area').addClass("hide");
          } else if(tipo == 3){
            $("#nome").addClass("hide");
            $("#assunto").addClass("hide");
            $("#sobrenome").addClass("hide");
            $('#area').removeClass("hide");
          }

        };






        $(document).ready(function(){


          $('.det').click(function(e) {
            var id = $(this).attr('id');
            window.location = "edita_contato.php?id="+id;
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
            var apagar = confirm('Deseja realmente excluir este registro?');
            if (apagar){
              var id = $(this).attr('id');
              $.ajax({
                url: '../engine/controllers/contato.php',
                data: {
                  fk_fornecedor : id,
                  action: 'update_fornecedor'
                },
                //garante que seja executado na sequencia
                async: false,
                type: 'POST'
              });
              $.ajax({
                url: '../engine/controllers/contato.php',
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


          $('#pesquisar').click(function(e) {
            e.preventDefault();
            var tipo = $('#tipo').val();
            if (tipo == 0){
              var pesq = $('#nome_123').val();

              if(pesq == ""){
                return toastr.error('Preencha o campo de pesquisa!');
              }else{
                window.location = "consultar_contato_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }
            }else if(tipo == 1){
              var pesq = $('#assunto_123').val();
              window.location = "consultar_contato_resultado.php?pesq="+pesq+"&tipo="+tipo;
            }else if(tipo == 2){
              var pesq = $('#sobrenome_123').val();
              window.location = "consultar_contato_resultado.php?pesq="+pesq+"&tipo="+tipo;
            }else if(tipo==3){
              var pesq = $('#area_123').val();
              window.location = "consultar_contato_resultado.php?pesq="+pesq+"&tipo="+tipo;
            }


          });


        });
      </script>