<?php 

class Usuario{

	//Atributos d classe
	private $idusuario;
	private $desloguin;
	private $dessenha;
	private $dtcadastro;

	//GET's e SET's dos atributos
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDesloguin(){
		return $this->desloguin;
	}
	public function setDesloguin($value){
		$this->desloguin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){//seleciona o usuário através do seu ID
		$sql = new Sql();//carrega a classe SQL

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $id
		));//instancia o metodo select passado 3 parametros, são eles: $rawQuery, $params

		if (count($results)>0) {
			$this->setdata($results[0]);
		}
	}

	public static function getList(){//mostra uma lista de toos os usuários da tablea, ordenando pelo seu ID
		$sql = new Sql();

		return  $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario ");
	}

	public static function buscarUsuario($loguin){//mostra o usuário a partir da senha
		$sql = new Sql();

		return  $sql->select("SELECT * FROM tb_usuarios WHERE desloguin LIKE :BUSCA ORDER BY idusuario ", array(
				":BUSCA" => "%".$loguin."%"
		));
	}

	public function loguin($loguin, $password){//mostra o usuário a partir do loguin e senha
		$sql = new Sql();//carrega a classe SQL

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE desloguin = :LOGUIN AND dessenha = :SENHA", array(
			":LOGUIN" => $loguin,
			":SENHA" => $password
		));//instancia o metodo select passado 3 parametros, são eles: $rawQuery, $params

		if (count($results)>0) {
			$this->setdata($results[0]);

			
		}else{
			throw new Exception("Loguin ou Senha inválidos");
			
		}
	}

	public function setData($data){//metodo geral para não repetir
		$this->setIdusuario($data['idusuario']);
		$this->setDesloguin($data['desloguin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){//iserir um novo usuário e mostra
		$sql = new Sql();//carrega a classe SQL

		$results = $sql->select("CALL sp_usuarios_insert(:LOGUIN,:SENHA)", array(
			":LOGUIN" => $this->getDesloguin(),
			":SENHA" => $this->getDessenha()
		));
		if (count($results)>0) {
			$this->setdata($results[0]);

			
		}
	}

	public function __construct($login = "", $senha = ""){//consulta usuário através de loguin e senha
		$this -> setDesloguin($login);
		$this -> setDessenha($senha);
	}

	public function update($login,$senha){//alterar o usuário

		$this->setDesloguin($login);
		$this->setDessenha($senha);

		$sql = new Sql();//intancia a classe SQL

		$results = $sql->query("UPDATE tb_usuarios SET desloguin = :LOGUIN, dessenha = :SENHA WHERE idusuario = :ID", array(
			":LOGUIN" => $this->getDesloguin(),
			":SENHA" => $this->getDessenha(),
			":ID" => $this->getIdusuario()
		));
		
	}

	public function delete(){//Apaga um usuário a partir do seu ID

		$sql = new Sql();//intancia a classe SQL

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID ", array(':ID' =>  $this->getIdusuario()
		));

		$this->setData(0);
	}

	public function __toString(){//realiza apresentação da array solicitado do ID passado no Index para uma apresentação direta no echo

		return json_encode(array(
			"idusuario" => $this->getIdusuario(),
			"desloguin" => $this->getDesloguin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")//formata a data e hora para o estilo desejado
		));
	}

}

?>