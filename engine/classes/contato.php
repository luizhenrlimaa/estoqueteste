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
		$sql = "SELECT * FROM contato";

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
