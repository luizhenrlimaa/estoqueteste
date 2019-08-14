<?php
class Produto{
	private $id;
	private $nome;
	private $quantidade;
	private $tipo;
	private $valor;
	private $fk_usuario;
	private $fk_fornecedor;
	private $cfop;

		//setters
	public function SetValues($id, $nome, $quantidade, $tipo, $valor, $fk_usuario, $fk_fornecedor, $cfop){
		$this->id = $id;
		$this->nome = $nome;
		$this->quantidade = $quantidade;
		$this->tipo = $tipo;
		$this->valor = $valor;
		$this->fk_usuario = $fk_usuario;
		$this->fk_fornecedor = $fk_fornecedor;
		$this->cfop = $cfop;
	}

	public function Create(){
		$sql = "
		INSERT INTO produto
		(
		id,
		nome,
		quantidade,
		tipo,
		valor,
		fk_usuario,
		fk_fornecedor,
		cfop
		)
		VALUES
		(
		'$this->id',
		'$this->nome',
		'$this->quantidade',
		'$this->tipo',
		'$this->valor',
		'$this->fk_usuario',
		'$this->fk_fornecedor',
		'$this->cfop'
		);
		";

		$DB = new DB();
		$DB->open();
		$result = $DB->query($sql);
		$DB->close();
		return json_encode($result);
	}
	public function Update(){
		$sql = "
		UPDATE produto SET

		nome = '$this->nome',
		quantidade = '$this->quantidade',
		tipo = '$this->tipo', 
		valor = '$this->valor',
		fk_fornecedor = '$this->fk_fornecedor',
		cfop = '$this->cfop'
		WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	public function Update_fornecedor(){
		$sql = "
		UPDATE produto SET
		fk_fornecedor = ''
		WHERE fk_fornecedor = '$this->fk_fornecedor'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	public function ReadAll_Paginacao($inicio, $registros) {
		$sql = "
		SELECT * FROM produto LIMIT $inicio, $registros
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data;
	}

	public function Read_fk($id) {
		$sql = "
		SELECT * FROM produto WHERE fk_usuario  = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data[0];
	}

	public function ReadAll_FK($id) {
		$sql = "
		SELECT *
		FROM
		produto
		where fk_usuario = '$id' 
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}
		else{

			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;	
				}
			}
		}
		$DB->close();
		return $realData; 
	}

	public function Read_Nome_Fornecedor($id) {
		$sql = "
		SELECT f.nome FROM produto p INNER JOIN fornecedor f
		ON f.id = p.fk_fornecedor WHERE p.id = '$id_produto';
		";			

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}
		else{

			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;	
				}
			}
		}
		$DB->close();
		return $realData; 
	}

	public function Read($id){
		$sql = "
		SELECT *
		FROM
		produto AS t1
		WHERE
		t1.id = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$DB->close();
		return $Data[0];
	}

	public function ReadAll(){
		$sql = "SELECT * FROM produto";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}
		else{
			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;
				}
			}
		}
		$DB->close();
		return $realData;
	}

	public function ReadSUM($id) {
		$sql = "
		SELECT SUM(valor) 
		FROM produto
		where fk_usuario = '$id' 
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}
		else{

			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;	
				}
			}
		}
		$DB->close();
		return $realData; 
	}

	public function Pesq($id, $pesq, $tipo) {
		$sql = "
		SELECT * FROM produto AS t2
		WHERE $tipo LIKE '%$pesq%' AND fk_usuario = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}else{
			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;
				}
			}
		}
		$DB->close();
		return $realData;
	}

	public function Pesq_pag($id, $inicio, $registros, $tipo, $pesq) {
		$sql = "
		SELECT * FROM produto AS t2
		WHERE $tipo LIKE '%$pesq%' AND fk_usuario = '$id'
		LIMIT $inicio, $registros;
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data;
	}

	public function Delete(){
		$sql = "DELETE FROM produto	WHERE id = '$this->id'";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	function __construct(){
		$this->id;
		$this->nome;
		$this->quantidade;
		$this->tipo;
		$this->valor;
		$this->fk_usuario;
		$this->fk_fornecedor;
		$this->cfop;
	}

	function __destruct(){
		$this->id;
		$this->nome;
		$this->quantidade;
		$this->tipo;
		$this->valor;
		$this->fk_usuario;
		$this->fk_fornecedor;
		$this->cfop;
	}
};
?>