<?php session_start();

	require_once "../config.php";

	$email = addslashes($_POST['email_login']);
	$senha = addslashes($_POST['senha_login']);
	$res;

	$Usuario = new Usuario();
	$Usuario = $Usuario->Read_email($email);


	if ($Usuario === NULL) {
		$res = 'no_user_found';
		session_destroy();
	} else {
		$verificaEmail = strcmp($email,$Usuario['email']);
		if ($verificaEmail === 0) {
			$verificaSenha = password_verify($senha,$Usuario['senha']);
			if ($verificaSenha) {
				$_SESSION['id'] = $Usuario['id'];
				$_SESSION['nome'] = $Usuario['nome'];

				$res = 'true';
			}
			else {
				$res = 'wrong_password';
				session_destroy();
			}
		} else {
			$res = 'wrong_user_found';
			session_destroy();
		}
	}

	$result['res'] = $res;
	$result['id'] = $_SESSION['id'];

	echo json_encode($result);
?>

