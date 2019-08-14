<?php

require_once "../config.php";

$id= $_POST['id'];
$nome= addslashes($_POST['nome']);
$quantidade= $_POST['quantidade'];
$tipo= $_POST['tipo'];
$valor= $_POST['valor'];  
$fk_usuario= $_POST['fk_usuario']; 
$fk_fornecedor= $_POST['fk_fornecedor']; 
$fk_cfop= $_POST['cfop'];

$action = $_POST['action'];

$Item = new Produto();
$Item->SetValues($id, $nome, $quantidade, $tipo, $valor, $fk_usuario, $fk_fornecedor, $fk_cfop);

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

	case 'update_fornecedor':
	$res = $Item->Update_fornecedor();

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