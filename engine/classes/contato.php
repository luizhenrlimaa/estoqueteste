<?php
class Contato{
	private $id;
	private $nome;
	private $assunto;
	private $sobrenome;
	private $area;

		//setters
	public function SetValues($id, $nome, $assunto, $sobrenome, $area){
		$this->id = $id;
		$this->nome = $nome;
		$this->assunto = $assunto;
		$this->sobrenome = $sobrenome;
		$this->area = $area;
	}

	public function Create(){
		$sql = "
		INSERT INTO contato
		(
		id,
		nome,
		assunto,
		sobrenome,
		area
		)
		VALUES
		(
		'$this->id',
		'$this->nome',
		'$this->assunto',
		'$this->sobrenome',
		'$this->area'
		);
		";

		$DB = new DB();
		$DB->open();
			// $result = $DB->query($sql);
			// $DB->close();
			// return $result;
		$result['result'] = $DB->query($sql);
		$result['lastId'] = $DB->lastId();
		$DB->close();
		return json_encode($result);
	}

		public function Pesq($id, $pesq, $tipo) {
		$sql = "
		SELECT * FROM contato AS t2
		WHERE $tipo LIKE '%$pesq%'
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

	public function Read($id) {
		$sql = "
		SELECT * FROM contato WHERE id  = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data[0];
	}



	public function ReadAll(){
		$sql = "SELECT *FROM contato";
		
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



	public function ReadAll_FK($id) {
		$sql = "
		SELECT *
		FROM
		contato
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

	public function ReadSelect(){
		$sql = "SELECT * FROM contato
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


	public function Update(){
		$sql = "
		UPDATE contato SET
		nome = '$this->nome',
		assunto = '$this->assunto',
		sobrenome = '$this->sobrenome',
		area = '$this->area'
		
		WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	public function ReadAll_Paginacao($inicio, $registros) {
		$sql = "
		SELECT * FROM contato LIMIT $inicio, $registros
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data;
	}

		public function Delete(){
		$sql = "
		DELETE FROM contato	WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}


	function __construct(){
		$this->id;
		$this->nome;
		$this->assunto;
		$this->sobrenome;
		$this->area;
		
	}

	function __destruct(){
		$this->id;
		$this->nome;
		$this->assunto;
		$this->sobrenome;
		$this->area;
		
	}
};
?>
