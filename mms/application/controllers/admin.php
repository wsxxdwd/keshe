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

	/*	function login()
		{
			$this->load->view('admin_login');
		}*/
		

		function index()
		{
			$session = $this->session->all_userdata();
			if(isset($session['userid']) && $session['groups']==1)
			{
				$data['session'] = $session;
				$data['mem_num'] = count($this->members_model->fetchAll());
				$data['new_num'] = $this->message_model->count_new();
				$this->load->view('admin_index',$data);
			}
			else
			{
				$this->load->view('admin_login');
			}
		}

		function admin_info()
		{
			$session = $this->session->all_userdata();
			if(isset($session['userid']) && $session['groups']==1)
			{
				$data['session'] = $session;
				$data['mem'] = $this->members_model->fetchAll();
				//$data['new_num'] = $this->message_model->count_new();
				$this->load->view('admin_info',$data);
			}
			else
			{
				$this->load->view('admin_login');
			}

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
				$this->index();			
			}
			else
			{
				
				$res['msg'] ='登陆失败';
				$this->load->view('admin_login',$res);
			}
		
		}
	}