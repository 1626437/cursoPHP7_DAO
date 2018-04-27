<?php

class Sql extends PDO{
	
	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:dbname=dpphp7;host=localhost","root","");
	}

	private function setParam($statement, $key, $value){

		$statement->bindParam($key, $value);
	}

	private function setParams($statement, $parameters = array()){


		foreach ($parameters as $key => $value) {
			$this->setParam($statement,$key, $value);
		}
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()){

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}
}
?>