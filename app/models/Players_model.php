<?php

class Players_model {	
	// database handler
	// connect ke database dengan driver PDO
	private $dbh, $statement;

	public function __construct()
	{
		// data source name
		$dsn = 'mysql:host=localhost;dbname=phpmvc';

		try {
			$this->dbh = new PDO($dsn, "root", "admin");
		} catch (PDOException $e) {
			die($e->getMessage());		
		}
	}


	public function getAllPlayers(){
		$this->statement = $this->dbh->prepare('SELECT * from players');
		$this->statement->execute();
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}

}