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
      <nav style="background:#708090;">
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
              <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="consulta_fornecedor.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>

            <form class="col s12">
              <div class="col m7 s12"></div>
              <div class="input-field col m2 s4">
                <select onchange="teste()" id="tipo" name="tipo">
                  <option value="0">Nome</option>
                  <option value="1">CNPJ</option>
                  <option value="2">E-mail</option>
                  <option value="3">I.E</option>
                </select> 
              </div>
              
              <div class="input-field col m2 s5 " id="nome">
                <input placeholder="Nome" id="nome_123" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m2 s5 hide" id="cnpj">
                <input placeholder="CNPJ" id="cnpj_123" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m2 s5 hide" id="email">
                <input placeholder="E-mail" id="email_123" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m2 s5 hide" id="ie">
                <input placeholder="Inscrição Estadual" id="ie_123" name="pesq_nome" type="text">
              </div>



              <div class="input-field col m1 s1">
                <a class="waves-effect waves-light btn" style="background: #2980b9;" id="pesquisar"><i class="fa fa-search"></i></a>
              </div>
            </form>
          </div>

          <?php
          require_once "../engine/config.php";
          $pesq = $_GET['pesq'];
          $tipo = $_GET['tipo'];

          if($tipo == 0){
            $tipo = 't2.nome';
          }else if($tipo == 1){
            $tipo = 't2.cnpj';
          }else if($tipo == 2){
            $tipo = 't2.email';
          }else if($tipo == 3){
            $tipo = 't2.ie';}

            $info = new Fornecedor();
            $info = $info->Pesq($_SESSION['id'], $pesq, $tipo);

            if(empty($info)){
              echo '<center><h4>Nenhum dado encontrado!</h4></center>';
            }else{
              ?>

              <table class="responsive-table centered">
                <thead style="background: #708090; color: #fff;">
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
                  foreach($info as $val) {
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
                  <?php } } ?>
                </tbody>
              </table>
            </div>

          </body>
          </html>

          <script src="../js/jquery.js"></script>
          <script src="../js/materialize.js"></script>
          <script src="../js/mbox-0.0.1.js"></script>]
          <script src="../js/drop_materialize.js"></script>

          <script type="text/javascript">

           function teste(){
            var tipo = $('#tipo').val();
            if(tipo == 0){
              $("#nome").removeClass("hide");
              $("#cnpj").addClass("hide");
              $("#email").addClass("hide");
              $('#ie').addClass("hide");
            }else if(tipo == 1){
              $("#nome").addClass("hide");
              $("#cnpj").removeClass("hide");
              $("#email").addClass("hide");
              $('#ie').addClass("hide");
            }else if(tipo == 2){
              $("#nome").addClass("hide");
              $("#cnpj").addClass("hide");
              $("#email").removeClass("hide");
              $('#ie').addClass("hide");
            } else if(tipo == 3){
              $("#nome").addClass("hide");
              $("#cnpj").addClass("hide");
              $("#email").addClass("hide");
              $('#ie').removeClass("hide");
            }

          };


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
              var apagar = confirm('Deseja realmente excluir este registro?');
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


            
            $('#pesquisar').click(function(e) {
              e.preventDefault();
              var tipo = $('#tipo').val();
              if (tipo == 0){
                var pesq = $('#nome_123').val();
                if(pesq == ""){
                  return toastr.error('Preencha o campo de pesquisa!');
                }else{
                  window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
                }
              }else if(tipo == 1){
                var pesq = $('#cnpj_123').val();
                window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo == 2){
                var pesq = $('#email_123').val();
                window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }else if(tipo == 3){
                var pesq = $('#ie_123').val();
                window.location = "consulta_fornecedor_resultado.php?pesq="+pesq+"&tipo="+tipo;
              }
            });          

          });
        </script>