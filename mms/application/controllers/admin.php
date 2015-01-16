<?php 
	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('admin_model');
			$this->load->model('user_model');
			$this->load->model('members_model');

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
			/*$res = $this->user_model->login($post);
			echo $res;*/
			if($post['username']=='' OR $post['password']=='')
			{
				$res['msg'] = '请输入完整的用户名和密码';
				$this->load->view('admin_login',$res);
			}
			else if($this->admin_model->login($post))
			{
				$data['session'] = $this->session->all_userdata();
				$this->load->view('admin_index',$data);
			}
			else
			{
				
				$res['msg'] ='登陆失败';
				$this->load->view('admin_login',$res);
			}
		}
	}