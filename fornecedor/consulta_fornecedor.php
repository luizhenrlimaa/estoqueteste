    <?php
    $showerros = true;
    if($showerros) {
      ini_set("display_errors", $showerros);
      error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
    }

    session_start();

    if(empty($_SESSION)){
      ?>
      <script>
        document.location.href = '../login.php' ;
      </script>
      <?php
    }
    ?>

    <!DOCTYPE html>
    <html>
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
      <nav style="background:#708090 ;">
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

        <div class="container-fluid" style="min-height: 100vh;">
          <div class="row">
            <br>
            <div class="col m12 s12">
              <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
              <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="inserir_fornecedor.php" style="color: black; background: #27ae60;"><i class="fas fa-plus"></i> Adicionar</a>
            </div>

            <form class="col s12">
              <div class="col m7 s12"></div>
              <div class="input-field col m2 s4">
                <select id="tipo" name="tipo">
                  <option value="0">Nome</option>
                  <option value="1">CNPJ</option>
                  <option value="2">E-mail</option>
                  <option value="3">I.E.</option>

                </select> 
              </div>

              <div class="input-field col m2 s5" id="solici_aberto">
                <input placeholder="Pesquisar por..." id="pesq_nome" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m1 s1">
                <a class="waves-effect waves-light btn" style="background: #2980b9;" id="pesquisar"><i class="fa fa-search"></i></a>
              </div>
            </form>
          </div>
          <table class="responsive-table centered">
            <thead style="background: #2980b9; color: #fff;">
              <tr>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>E-mail</th>
                 <th>I.E.</th>
                <th>Apagar</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              require_once "../engine/config.php";
              $valores = new Fornecedor();
              $valor = $valores->ReadAll();

              foreach($valor as $val) {

                $id = $val['id'];
                $nome = $val['nome'];
                $cnpj = $val['cnpj'];
                $email = $val['email'];
                $ie = $val['ie'];
                
                ?>
                <tr class="detalhes_usuario">
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $nome;?></td>
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $cnpj;?></td>
                  <td class="det" id="<?php echo $val['id']; ?>"><?php echo $email;?></td>
                   <td class="det" id="<?php echo $val['id']; ?>"><?php echo $ie;?></td>
                  <td class="apagar" id="<?php echo $val['id']; ?>"><i class="fa fa-trash fa-lg"></i> </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </body>
      </html>

      <script src="../js/jquery.js"></script>
      <script src="../js/materialize.js"></script>
      <script src="../js/mbox-0.0.1.js"></script>
      <script src="../js/drop_materialize.js"></script>

      <script>
        $(document).ready(function(){


          $('.det').click(function(e) {
            var id = $(this).attr('id');
            window.location = "#";
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
                  alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
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
                url: '../engine/controllers/produto.php',
                data: {
                  fk_fornecedor : id,
                  action: 'update_fornecedor'
                },
                //garante que seja executado na sequencia
                async: false,
                type: 'POST'
              });
              $.ajax({
                url: '../engine/controllers/fornecedor.php',
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
              }else if(tipo == 1){
                $("#solici_aberto").removeClass("hide");
              }else if(tipo == 2){
                $("#solici_aberto").romoveClass("hide");
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
                window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }
            }else if(tipo == 1){
              var pesq = $('#pesq_nome').val();
              window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
            }else if(tipo == 2){
              var pesq = $('#pesq_nome').val();
              window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
            }
          });          

        });
      </script>