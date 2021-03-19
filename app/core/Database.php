<?php

class Database {
	private $host = DB_HOST,
			$user = DB_USER,
			$pass = DB_PASS,
			$db_name = DB_NAME;

	private $dbh,
			$statement;
	

	// database handler
	// connect ke database dengan driver PDO	
	public function __construct()
	{
		// data source name
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

		//untuk mengoptimasi koneksi ke database
		$option = [
			// membuat koneksi ke database terjaga
			PDO::ATTR_PERSISTENT => true,
			// untuk mode error tampilkan exception
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];


		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
		} catch (PDOException $e) {
			die($e->getMessage());		
		}

	}
		

	// untuk menjalankan query insert, update, delete
	public function query($query){
		$this->statement = $this->dbh->prepare($query);
	}

	// binding datanya
	public function bind($param, $value, $type = null)
	{
		if( is_null($type) ) {
			switch( true ){
				case is_int($value) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;	
			}	
		}

		$this->statement->bindValue($param, $value, $type);
	}
	
	public function execute()
	{
		$this->statement->execute();
	}

	public function getAll()
	{
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getOne()
	{
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_ASSOC);
	}


	public function dataCount()
	{
			return $this->statement->rowCount();
	}
}