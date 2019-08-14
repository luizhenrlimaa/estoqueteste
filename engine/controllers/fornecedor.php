<?php

require_once "../config.php";

$id= $_POST['id'];
$nome= $_POST['nome'];
$cnpj= $_POST['cnpj'];
$email= $_POST['email'];
$ie= $_POST['ie'];

$action = $_POST['action'];

$Item = new Fornecedor();
$Item->SetValues($id, $nome, $cnpj, $email, $ie);

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