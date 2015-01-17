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
			$this->load->model('message_model');

		}

	/*	function login()
		{
			$this->load->view('admin_login');
		}*/
		

		function index()
		{
			$session = $this->session->all_userdata();
			if(isset($session['userid']) && $session['groupid']==1)
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
			if(isset($session['userid']) && $session['groupid']==1)
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

		function admin_msg()
		{
			$session = $this->session->all_userdata();
			if(isset($session['userid']) && $session['groupid']==1)
			{
				$data['session'] = $session;
				$data['msgs'] = $this->message_model->view_all_m();
				//$data['new_num'] = $this->message_model->count_new();
				$this->load->view('admin_msg',$data);
			}
			else
			{
				$this->load->view('admin_login');
			}
		}


	
		function do_login()
		{
			$post = $this->input->post();	
		
			if($post['username']=='' OR $post['password']=='')
			{
				$res['msg'] = '请输入完整的用户名和密码';
			
			}
			else if($this->admin_model->login($post))
			{	
				header('LOCATION:index');	
			}
			else
			{
				
				$res['msg'] ='登陆失败';
			}
			echo $res['msg'];
		}

		function do_logout()
		{
			if($this->user_model->logout())
			{
				header('LOCATION:index');	
			}
			else 
			{
				$res['status'] = 0;
				$res['msg'] = '注销失败';
			}
			echo json_encode($res);
		}
	}