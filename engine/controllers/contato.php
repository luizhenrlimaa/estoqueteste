<?php session_start();

require_once "../config.php";

$id= $_POST['id'];
$nome = $_POST['nome'];
$assunto = $_POST['assunto'];
$sobrenome = $_POST['sobrenome'];
$area = $_POST['area'];
$action = $_POST['action'];

$Item = new Contato();
$Item->SetValues($id, $nome, $assunto, $sobrenome, $area);

switch($action){
	case 'create':

	$res = $Item->Create();
	$res = json_decode($res);

	if($res->{'result'} === NULL){
		$result['res'] = "true";
	}else{
		$result['res'] = "false";
	}

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

}
?>