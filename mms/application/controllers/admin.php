<?php 
	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('user_model');
			$this->load->model('members_model');
			$this->load->database();
		}

		function login()
		{
			$this->load->view('admin_login');
		}
		
		/*
		*传入post参数 1 username
		*参数2 password
		*参数3 autoflag 自动登录
		*/
		function do_login()
		{
			$post = $this->input->post();	

			if($post['username']=='' OR $post['password']=='')
			{
				$res['status'] = 0;
				$res['msg'] = '请输入完整的用户名和密码';
			}
			else if($this->user_model->login($post))
			{
				$res['status'] = 1;
				$res['msg'] = '登陆成功';
			}
			else
			{
				$res['status'] = 0;
				$res['msg'] ='登陆失败';
			}
			echo json_encode($res);
		}
	}