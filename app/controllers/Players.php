<?php

class Players extends Controller {
	public function index()
	{
		$data['title'] = 'List of Players';
		$data['players'] = $this->model('Players_model')->getPlayers();

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
			Flasher::setFlash('<strong>Success!</strong> - ' . $_POST['name'] . ' data has been added successfully.', 'success');
			header('Location:' . BASEURL . '/players');
			exit;
		} else {
			Flasher::setFlash('<strong>Error!</strong> - Failed to add new data', 'danger');
			header('Location:' . BASEURL . '/players');
			exit;
		}
	}
	

}