<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->load->helper(['form', 'url']);
		$this->twig->addGlobal('session', $this->session);
		$this->twig->addGlobal('uri', $this->uri);
	}

	public function index()
	{
		$this->twig->display('login');
	}

	public function authenticate()
	{
		$data = array_map('trim', $this->input->post());

		$data = array(
			'username' => $data['username'],
			'password' => md5($data['password'])
		);

		$user = $this->user_model->read($data);

		if ($user)
		{
			$this->session->set_userdata($user_data);
			redirect(base_url('login/template'));
		}
		else {
			$this->session->set_flashdata('message', "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Either your username or password is incorrect</div>");
			redirect(base_url('login/index'));
		}
	}

	public function register()
	{
		$this->twig->display('register');
	}
	
	public function template()
	{
		$this->twig->display('partials/template');
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url('login'));
	}
}