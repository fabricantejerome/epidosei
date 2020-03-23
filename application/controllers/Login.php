<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// $this->load->model('user_model');
		$this->load->helper('form');
		$this->twig->addGlobal('session', $this->session);
	}

	public function index()
	{
		$this->twig->display('login');
	}
	
	public function template()
	{
		$this->twig->display('partials/template');
	}
    
}