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
		return $this->db->getAll();
	}

	public function getPlayersDetail($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id', $id);
		return $this->db->getOne();
	}

	public function addPlayerData($data)
	{
		var_dump($data['name']);
		var_dump($data['position']);
		$query = "INSERT INTO players VALUES (:id, :name, :team, :position, :height, :weight)";
		$this->db->query($query);
		$this->db->bind('id', null);
		$this->db->bind('name', $data['name']);
		$this->db->bind('team', $data['team']);
		$this->db->bind('position', $data['position']);
		$this->db->bind('height', $data['height']);
		$this->db->bind('weight', $data['weight']);
		
		$this->db->execute();
		return $this->db->dataCount();
	}

}