<?php

require_once "../config.php";

$id= $_POST['id'];
$nome= $_POST['nome'];
$cpf= $_POST['cpf'];
$sobrenome= $_POST['sobrenome']; 
$senha= $_POST['senha'];
$email= $_POST['email'];
$action = $_POST['action'];

$Item = new Usuario();
$Item->SetValues($id, $nome, $cpf, $sobrenome, password_hash($senha, PASSWORD_DEFAULT),  $email);

switch($action){
	case 'create':

	$res = $Item->Create();
	$res = json_decode($res);

	if($res->{'result'} === NULL){
		$result['res'] = "true";
	}else{
		$result['res'] = "false";
	}

	// $result['id_usuario'] = $res->{'lastId'};
	$result['id'] = $res->{'lastId'};

	echo json_encode($result);
	break;

	case 'update':
	$res = $Item->Update();

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'delete':

	$res = $Item->Delete();
	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;


	case 'verificaCPF':
	$Usuario = new Usuario();
	$Usuario = $Usuario->ReadAll();
	foreach ($Usuario as $user) {if ($user['cpf'] == $cpf) {$res = 'true'; break; } }
	echo $res;
	break;

	case 'esqueci_senha':
	$Usuario = new Usuario();
	$Usuario = $Usuario->ReadAll();

	foreach ($Usuario as $user) {
		if ($user['email'] == $email && $user['cpf'] == $cpf) {
			$res = 'true';
			break;
		}
	}

	echo $res;
	break;

	case 'updateSenha':
	$res = $Item->UpdateSenha($email);

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'verificaEmail':
	$Usuario = new Usuario();
	$Usuario = $Usuario->ReadAll();


	foreach ($Usuario as $user) {if ($user['email'] == $email) {$res = 'true'; break; } }

	echo $res;
	break;

	case 'cripto':
	$Usuario = new Usuario();
	$Usuario = $Usuario->Read($_POST['id']);
	$senha_temp = $Usuario['senha'];

	if (password_verify($senha, $senha_temp)) {
		$res = "true";
	} else {
		$res = "false";
	}
	echo $res;

	break;

	case 'buscar_cpf':
	$Usuario = new Usuario();
	$Usuario = $Usuario->Read_cpf($cpf);
	if (!$Usuario) {
		$res['res'] = 'false';
	} else {
		$res['res'] = 'true';
		$res['id'] = $Usuario['id'];
		$res['nome'] = $Usuario['nome'];
	}
	echo json_encode($res);
	break;
}
?>