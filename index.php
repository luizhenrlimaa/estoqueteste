   

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Estoque</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="css/mbox-0.0.1.css"/>

	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}

		main {
			flex: 1 0 auto;
			background:  #708090;
		}

		body {
			background:  	#C0C0C0;
		}
	</style>


</head>

<body>
	<main>
		<center>
			<h5 class="indigo-text"><i class="fas fa-user" style="font-size: 15em; color: #000; "></i></h5>
			<div class="container">
				<div class="x" style="background: rgba(211,211,211); display: inline-block; padding: 30px 50px 20px 35px; ">
					<div class="row">
						<form class="col s12 m12">
							<div class="row">


								<div class="input-field col s12 m12 ">                  
									<input id="nome_registro" type="text" class="validate">
									<label for="nome_registro" label class="active">Nome*</label>
								</div>

								<div class="input-field col s12  m12 ">
									<input id="sobrenome_registro" type="text" class="validate">
									<label for="sobrenome_registro" label class="active">Sobrenome*</label>
								</div>

								<div class="input-field col s12  m12 ">
									<input id="cpf_registro" type="text" class="validate">
									<label for="cpf_registro" label class="active">CPF*</label>
								</div>

								<!--<div class="input-field col s12  m12 ">
									<input id="senha_registro" type="password" class="validate">
									<label for="senha_registro" label class="active">Senha*</label>
								</div>
							-->
							<div class="input-field col s12  m12 ">
								<input id="email_registro" type="email" class="validate">
								<label for="email_registro" label class="active">E-mail*</label>
							</div>

						</div>

						<div class="modal-footer">
							<center><button id="registrar_usuario" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar <i class="fa fa-arrow-right"></i></button></center>
						</div>

					</form>
				</center>
			</div> 
		</div>
	</main>
</body>
</html>


<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jquerymask.min.js"></script>
<script src="js/mbox-0.0.1.js"></script>

<script>




	/*Joga tudo no banco de dados*/
	$('#registrar_usuario').click(function(e) {
		e.preventDefault();

		var nome_registro = $('#nome_registro').val();
		var cpf_registro = $('#cpf_registro').val();
		var email_registro = $('#email_registro').val();
		var senha_registro = $('#senha_registro').val();
		var sobrenome_registro = $('#sobrenome_registro').val();


		if(nome_registro == "" || cpf_registro == "" || email_registro == ""|| sobrenome_registro == ""){
			return mbox.alert('Preencha todos os campos que possuem *');
		}/*else if(senha_registro.length < 6){
			return mbox.alert('Cadastre uma senha com mais de 6 digitos!');
		} */else {
			$.ajax({
				url: 'engine/controllers/usuario.php',
				data : {
					nome: nome_registro,
					cpf : cpf_registro,
					email : email_registro,
					senha : senha_registro,
					sobrenome: sobrenome_registro,


					action: 'create'
				}, alert("teste")
				success: function(data){
					obj = JSON.parse(data);
					if(obj.res === 'true'){
						Materialize.toast("Cadastro Realizado com Sucesso!", 1500, "rounded", function(){
							window.location = "../login.php"                    
						});
					}
				},
				async: false,
				type : 'POST'
			});
		}
	});  

</script>


//ajshdjash