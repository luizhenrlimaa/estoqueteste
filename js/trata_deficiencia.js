// pega atributos dos inputs pelo ID
function getAttr(attr) {
	return document.getElementById(attr).value;
}

// limpa dados sobre qualquer tipo de deficiência do usuário
// na tela de edição do cadastro
function limpaDeficiencia(id) {
	var x = ['usuario_deficiencia_auditiva', 'usuario_deficiencia_fisica', 'usuario_deficiencia_visual', 'usuario_deficiencia_mental', 'usuario_deficiencia_multipla', 'usuario_deficiencia_tea', 'usuario_deficiencia_outras'];
	
	for(i = 0; i < x.length; i++){
		$.ajax({
			url: '../engine/controllers/'+x[i]+'.php',
			data: {
				fk_usuario : id,
				action: 'delete'
			},
			type: 'POST'
		});
	}
}

// trata a edição do cadastro para usuários com deficiência
function trataDeficiencia(tipo_deficiencia, id){
	if (tipo_deficiencia == 0) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_auditiva.php',
			data : {
				fk_usuario : id,
				comunica_atraves : getAttr("comunica_atraves"),
				grau_surdez_dir : getAttr("select_grau_surdez_dir"),
				grau_surdez_esq : getAttr("select_grau_surdez_esq"),
				usa_aparelho_dir : getAttr("usa_aparelho_dir"),
				usa_aparelho_esq : getAttr("usa_aparelho_esq"),
				implante_coclear_dir : getAttr("implante_coclear_dir"),
				implante_coclear_esq : getAttr("implante_coclear_esq"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 1) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_fisica.php',
			data : {
				fk_usuario : id,
				tipo_deficiencia_fisica : getAttr("tipo_deficiencia_fisica"),
				outro_tipo_def_fisica : getAttr("outro_tipo_def_fisica"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 2) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_visual.php',
			data : {
				fk_usuario : id,
				tipo_deficiencia_visual : getAttr("tipo_deficiencia_visual"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 3) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_mental.php',
			data : {
				fk_usuario : id,
				deficiencia_mental : getAttr("deficiencia_mental"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 4) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_multipla.php',
			data : {
				fk_usuario : id,
				deficiencia_multipla : getAttr("deficiencia_multipla"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 5) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_tea.php',
			data : {
				fk_usuario : id,
				deficiencia_tea : getAttr("deficiencia_tea"),
				action : 'create'
			},
			type : 'POST'
		});
	} else if (tipo_deficiencia == 6) {
		$.ajax({
			url : '../engine/controllers/usuario_deficiencia_outras.php',
			data : {
				fk_usuario : id,
				outro_tipo_necessidade : getAttr("outro_tipo_necessidade"),
				necessidade_especial_especifica : getAttr("necessidade_especial_especifica"),
				action : 'create'
			},
			type : 'POST'
		});
	}
}