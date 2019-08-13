// Pega atributos dos inputs pelo ID
function getAttr(attr) {
	return document.getElementById(attr).value;
}

// Verifica se o email já existe na base de dados
function verificaEmail(email){
	if(!validateEmail(email)){
		document.getElementById('email').value = "";
		return mbox.alert('Endereço de email inválido! Digite novamente.');
	}
	$.ajax({
		url : '../engine/controllers/usuario.php',
		data : {
			email : email,
			action : 'verificaEmail'
		},
		success : function(data){
			if (data == 'true') {
				mbox.alert("Email já cadastrado no sistema! Tente novamente.");
				document.getElementById("email").value = "";
			}
		},
		type : 'POST'
	});
}

// Verifica se o CPF digitado já existe na base de dados
function verificaCPF(cpf){
	$.ajax({
		url : '../engine/controllers/usuario.php',
		data : {
			cpf : cpf,
			action : 'verificaCPF'
		},
		success : function(data){
			if (data == 'true') {
				mbox.alert("CPF já cadastrado no sistema!<br>Para obter ajuda, entre em contato pelo e-mail <strong> sistema.dasa@ufvjm.edu.br</strong>");
				document.getElementById("cpf").value = "";
			}
		},
		type : 'POST'
	});
}

// Verifica se a senha digitada possui 6 ou mais dígitos
function verificaSenha(senha){
	if (senha.length < 6) {
		document.getElementById("senha").value = "";
		return mbox.alert("A senha deve conter no mínimo 6 caracteres");
	}
}