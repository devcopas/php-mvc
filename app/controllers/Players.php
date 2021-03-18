<?php

class Players extends Controller {
	public function index(){
		$data['title'] = 'List of Players';
		$data['players'] = $this->model('Players_model')->getAllPlayers();

		$this->view('templates/header', $data);
		$this->view('players/index', $data);
		$this->view('templates/footer');
	}

}