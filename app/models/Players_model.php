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
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE is_deleted=0');
		return $this->db->getAll();
	}


	public function getPlayersDetail($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id AND is_deleted=0');
		$this->db->bind('id', $id);
		return $this->db->getOne();
	}


	public function addPlayerData($data)
	{
		$query = "INSERT INTO players VALUES (:id, :name, :team, :position, :height, :weight, :is_deleted)";

		$this->db->query($query);
		$this->db->bind('id', null);
		$this->db->bind('name', $data['name']);
		$this->db->bind('team', $data['team']);
		$this->db->bind('position', $data['position']);
		$this->db->bind('height', $data['height']);
		$this->db->bind('weight', $data['weight']);
		$this->db->bind('is_deleted', 0);
		
		$this->db->execute();
		return $this->db->dataCount();
	}


	public function softDelete($id)
	{
		$query = "UPDATE players SET is_deleted=:is_deleted WHERE id=:id";

		$this->db->query($query);
		$this->db->bind('is_deleted', 1);
		$this->db->bind('id', $id);

		$this->db->execute();
		return $this->db->dataCount();
	}


	public function editPlayerData($data, $id)
	{
		$query = "UPDATE players SET 
					name = :name,
					team = :team,
					position = :position,
					height = :height,
					weight = :weight,
					is_deleted = :is_deleted
				  WHERE id = :id";

		$this->db->query($query);
		$this->db->bind('name', $data['name']);
		$this->db->bind('team', $data['team']);
		$this->db->bind('position', $data['position']);
		$this->db->bind('height', $data['height']);
		$this->db->bind('weight', $data['weight']);
		$this->db->bind('is_deleted', 0);
		$this->db->bind('id', $id);
		
		$this->db->execute();
		return $this->db->dataCount();
	}
}