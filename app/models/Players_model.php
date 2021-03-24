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


	public function tablePlayerData()
	{
		// $query = "SELECT * FROM players WHERE is_deleted = 0 AND team = $team AND position = $position AND name LIKE :keyword ORDER BY $order $sort";
		// $this->db->query($query);

		$keyword = $_POST['keyword'];
		$order = $_POST['order'];
		$sort = $_POST['sort'];
		$team = $_POST['team'];
		$position = $_POST['position'];
		
		if($team === 'team'){
			$whereTeam = "AND team = $team ";
		} else {
			$whereTeam = "AND team = :team ";
		}

		if($position === 'position'){
			$wherePosition = "AND position = $position ";
		} else {
			$wherePosition = "AND position = :position ";
		}
		
		$query = "SELECT * FROM players WHERE is_deleted = 0 $whereTeam $wherePosition AND name LIKE :keyword ORDER BY $order $sort";
		
		$this->db->query($query);		
		if($team !== 'team'){
			$this->db->bind('team', $team);
		}
		if($position !== 'position'){
			$this->db->bind('position', $position);
		}
		
		$this->db->bind('keyword', "%$keyword%");

		return $this->db->getAll();
	}


	public function teamAbbrev($team)
	{	
		switch ($team) {
			case "Brooklyn Nets" :
				$team = "Bkn";
				break;			
			case "Oklahoma City Thunder" :
				$team = "Okc";
				break;	
			case "Phoenix Suns" :
				$team = "Phx";
				break;	
			case "Portland Trail Blazers" :
				$team = "Por";
				break;	
			case str_word_count($team) === 2 :
				$team = substr($team, 0, 3);
				break;
			case str_word_count($team) === 3 :
				$words = explode(" ", $team);
				$acronym='';
				foreach($words as $word) $acronym .= $word[0];
				$team = $acronym;
				break;
			default :
				$team = "N/A";	
		}
		return strtoupper($team);
	}


	public function splitName($data)
	{
		foreach ($data as $key => $player) {
			$data[$key]['name'] = explode(" ", $player['name']);
			$data[$key]['name']['first'] = $data[$key]['name'][0];
			$data[$key]['name']['last'] = $data[$key]['name'][1];
		}
		return $data;
	}


	public function teamNameAbbr($data)
	{
		foreach($data as $key => $player){
			$data[$key]['team'] = $this->teamAbbrev($player['team']);
		}
		return $data;
	}


}