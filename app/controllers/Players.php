<?php

class Players extends Controller {
	public function index()
	{
		$data['title']     = 'List of Players';
		$data['players']   = $this->model('Players_model')->getPlayers();
		$data['positions'] = [
			'Center',
			'Forward',
			'Guard'
		];
		$data['teams']     = [
			'Atlanta Hawks',
			'Brooklyn Nets',
			'Boston Celtics',
			'Charlotte Hornets',
			'Chicago Bulls',
			'Cleveland Cavaliers',
			'Dallas Mavericks',
			'Denver Nuggets',
			'Detroit Pistons',
			'Golden State Warriors',
			'Houston Rockets',
			'Indiana Pacers',
			'Los Angeles Clippers',
			'Los Angeles Lakers',
			'Memphis Grizzlies',
			'Miami Heat',
			'Milwaukee Bucks',
			'Minnesota Timberwolves',
			'New Orleans Pelicans',
			'New York Knicks',
			'Oklahoma City Thunder',
			'Orlando Magic',
			'Philadelphia 76ers',
			'Phoenix Suns',
			'Portland Trail Blazers',
			'Sacramento Kings',
			'San Antonio Spurs',
			'Toronto Raptors',
			'Utah Jazz',
			'Washington Wizards'
							];

		foreach($data['players'] as $key => $player){		
			switch ($player['team']){
				case "Atlanta Hawks" :
					$data['players'][$key]['team'] = "ATL";
					break;
				case "Brooklyn Nets" :
					$data['players'][$key]['team'] = "BKN";
					break;
				case "Boston Celtics" :
					$data['players'][$key]['team'] = "BOS";
					break;
				case "Charlotte Hornets" :
					$data['players'][$key]['team'] = "CHA";
					break;
				case "Chicago Bulls" :
					$data['players'][$key]['team'] = "CHI";
					break;
				case "Cleveland Cavaliers" :
					$data['players'][$key]['team'] = "CLE";
					break;
				case "Dallas Mavericks" :
					$data['players'][$key]['team'] = "DAL";
					break;
				case "Denver Nuggets" :
					$data['players'][$key]['team'] = "DEN";
					break;
				case "Detroit Pistons" :
					$data['players'][$key]['team'] = "DET";
					break;
				case "Golden State Warriors" :
					$data['players'][$key]['team'] = "GSW";
					break;
				case "Houston Rockets" :
					$data['players'][$key]['team'] = "HOU";
					break;	
				case "Indiana Pacers" :
					$data['players'][$key]['team'] = "IND";
					break;	
				case "Los Angeles Clippers" :
					$data['players'][$key]['team'] = "LAC";
					break;	
				case "Los Angeles Lakers" :
					$data['players'][$key]['team'] = "LAL";
					break;	
				case "Memphis Grizzlies" :
					$data['players'][$key]['team'] = "MEM";
					break;	
				case "Miami Heat" :
					$data['players'][$key]['team'] = "MIA";
					break;	
				case "Milwaukee Bucks" :
					$data['players'][$key]['team'] = "MIL";
					break;	
				case "Minnesota Timberwolves" :
					$data['players'][$key]['team'] = "MIN";
					break;	
				case "New Orleans Pelicans" :
					$data['players'][$key]['team'] = "NOP";
					break;	
				case "New York Knicks" :
					$data['players'][$key]['team'] = "NYK";
					break;	
				case "Oklahoma City Thunder" :
					$data['players'][$key]['team'] = "OKC";
					break;	
				case "Orlando Magic" :
					$data['players'][$key]['team'] = "ORL";
					break;	
				case "Philadelphia 76ers" :
					$data['players'][$key]['team'] = "PHI";
					break;	
				case "Phoenix Suns" :
					$data['players'][$key]['team'] = "PHX";
					break;	
				case "Portland Trail Blazers" :
					$data['players'][$key]['team'] = "POR";
					break;	
				case "Sacramento Kings" :
					$data['players'][$key]['team'] = "SAC";
					break;	
				case "San Antonio Spurs" :
					$data['players'][$key]['team'] = "SAS";
					break;	
				case "Toronto Raptors" :
					$data['players'][$key]['team'] = "TOR";
					break;	
				case "Utah Jazz" :
					$data['players'][$key]['team'] = "UTA";
					break;	
				case "Washington Wizards" :
					$data['players'][$key]['team'] = "WAS";
					break;	
				default :
					$data['players'][$key]['team'] = "N/A";	
				}
		}

		$this->view('templates/header', $data);
		$this->view('players/index', $data);
		$this->view('templates/footer');
	}


	public function detail($id)
	{
		$data['player'] = $this->model('Players_model')->getPlayersDetail($id);
		$data['title'] = 'Player Bio | '. $data['player']['name'] ;

		$this->view('templates/header', $data);
		$this->view('players/detail', $data);
		$this->view('templates/footer');
	}

	
	public function add()
	{
		if($this->model('Players_model')->addPlayerData($_POST) > 0) {
			Flasher::setFlash('<strong>Success!</strong> - ' . $_POST['name'] . ' data has been <strong>added</strong> successfully.', 'success');
			header('Location:' . BASEURL . '/players');
			exit;
		} else {
			Flasher::setFlash('<strong>Error!</strong> - Failed to add new data', 'danger');
			header('Location:' . BASEURL . '/players');
			exit;
		}
	}


	public function delete($id)
	{
		$data['player'] = $this->model('Players_model')->getPlayersDetail($id);
		
		if( $data['player'] > 0 ){
			if( $this->model('Players_model')->softDelete($id) > 0 ) {
				Flasher::setFlash('<strong>Success!</strong> - "' . $data['player']['name'] . '" has been <strong>removed</strong> successfully.', 'success');
				header('Location:' . BASEURL . '/players');
				exit;
			} else {
				Flasher::setFlash('<strong>Error!</strong> - Failed to remove ' . $data['player']['name'], 'danger');
				header('Location:' . BASEURL . '/players');
				exit;
			}
		}

	}


	public function getdata()
	{	
		$playerData = $this->model('Players_model')->getPlayersDetail($_POST['id']);
		$dataJson = json_encode($playerData);
		echo $dataJson;
	}
	

	public function edit($id)
	{
		if($this->model('Players_model')->editPlayerData($_POST, $id) > 0) {
			Flasher::setFlash('<strong>Success!</strong> - "' . $_POST['name'] . '" data has been <strong>changed</strong> successfully.', 'success');
			header('Location:' . BASEURL . '/players');
			exit;
		} else {
			Flasher::setFlash('<strong>Error!</strong> - Failed to change data', 'danger');
			header('Location:' . BASEURL . '/players');
			exit;
		}
	}
}