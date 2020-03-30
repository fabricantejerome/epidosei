<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->load->helper(['form', 'url']);
		$this->twig->addGlobal('session', $this->session);
		$this->twig->addGlobal('uri', $this->uri);
    }
    
    public function handle_register()
	{
		$upload = $this->do_upload();

		if (count($upload) > 1) {
			$data = array_map('trim', $this->input->post());

			$user = array(
				'firstname'   => $data['firstname'],
				'surname'     => $data['surname'],
				'mi'          => $data['mi'],
				'birthdate'   => $data['birthdate'],
				'address'     => $data['address'],
				'contact'     => $data['contact'],
				'beneficiary' => $data['beneficiary'],
				'username'    => $data['username'],
				'password'    => md5($data['password']),
				'email'       => $data['email'],
				'file_name'   => $upload['file_name'],
				'file_type'   => $upload['file_type'],
				'file_path'   => $upload['file_path']
			);

			$user_id = $this->user_model->add($user);

			$this->session->set_flashdata('message', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Account has been created!</div>");
		}
		else {
			$this->session->set_flashdata('message', "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>There are some error on your information.</div>");
		}

		redirect('/login/register');
	}

	public function do_upload()
	{
		$config['upload_path']          = './resources/images/uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		return $this->upload->do_upload('thumbnail') ? $this->upload->data() : $this->upload->display_errors();
	}

}