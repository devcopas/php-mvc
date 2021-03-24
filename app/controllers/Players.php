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

		$data['players'] = $this->model('Players_model')->teamNameAbbr($data['players']);

		$data['players'] = $this->model('Players_model')->splitName($data['players']);

		
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


	public function table()
	{
		$data['players']=$this->model('Players_model')->tablePlayerData();

		$data['players']=$this->model('Players_model')->splitName($data['players']);

		$data['players'] = $this->model('Players_model')->teamNameAbbr($data['players']);
		

		$this->view('players/table', $data);
	}


}