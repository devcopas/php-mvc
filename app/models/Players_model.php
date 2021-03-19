<?php

class Players_model {	
	private $table = 'players',
			$db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getPlayers()
	{
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->getAlls();
	}

	public function getPlayersDetail($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id', $id);
		return $this->db->getOne();
	}

}