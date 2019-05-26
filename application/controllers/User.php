<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$action = '';


		if($this->uri->segment(2))
		{
			$action = $this->uri->segment(2);
		}

		
		switch ($action) 
		{
			case 'create':
				if($this->session->has_userdata('email'))
				{
					redirect(base_url('user/home'));
				}
				$this->data['title'] = 'Signup Page';
			break;

			case 'home':
				if(!$this->session->has_userdata('email'))
				{
					redirect(base_url());
				}
				$this->data['title'] = 'Home Page';
				$this->data['header'] = $this->load->view('tpl/header_after_login.php', $this->data, true);
			break;

			case 'logout':
				if(!$this->session->has_userdata('email'))
				{
					redirect(base_url());
				}
			break;

			default:
				if($this->session->has_userdata('email'))
				{
					redirect(base_url('user/home'));
				}
				$this->data['title'] = 'Signin Page';
				$this->data['header'] = $this->load->view('tpl/header.php', $this->data, true);
		}

		$this->data['footer'] = $this->load->view('tpl/footer.php', '', true);
	}


	public function index()
	{
		$this->load->view('users/login', $this->data);
	}

	public function home()
	{
		$this->data['fullname'] = ucwords($this->session->userdata('first_name')." ". $this->session->userdata('last_name'));
		$this->data['oauth_provider'] = $this->session->userdata('oauth_provider');
		$this->data['email'] = $this->session->userdata('email');

		$this->load->view('users/home', $this->data);
	}

	public function logout()
	{
		$arr_keys = array('first_name', 'last_name', 'email', 'u_id', 'oauth_provider');
		$this->dfd->unsetSessiondata($arr_keys);

		redirect(base_url());
	}
}