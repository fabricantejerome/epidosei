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

	public function register()
	{
		$this->twig->display('register');
	}
	
	public function template()
	{
		$this->twig->display('partials/template');
	}

	public function signup()
	{
		echo '<pre>';
		print_r($this->input->post());
	}
    
}