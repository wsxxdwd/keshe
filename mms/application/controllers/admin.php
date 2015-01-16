<?php 
	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent:__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('user_model');
			$this->load->model('members_model');
			$this->load->database();
		}

		function login()
		{
			$this->load->view('admin_login');
		}
	}