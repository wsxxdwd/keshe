<?php
	class User extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('user_model');
			$this->load->model('members_model');
			$this->load->model('message_model');
			$this->load->database();
		}
		//默认加载
		function index()
		{	
			/*$session = $this->session->all_userdata();

			if(isset($session['userid']))
			{
				$data['session'] = $session;
				$this->load->view('index',$data);
			}
			else if(isset($_COOKIE['userid']) && $this->user_model->getsession())
			{
				$data['session'] = $this->session->all_userdata();
				$this->load->view('index',$data);
			}
			else
			{*/	$r = 'userid,name,sex,avatar,groups,status';
				$data['row'] = $this->members_model->fetchAll($r);
				$this->load->view('user_info',$data);
			
			/*}*/

		}

		function detail_info($keyid=1)
		{	
			if(!is_int($keyid))
			{
				$keyid = 1;
			} 
			$session = $this->session->all_userdata()	;
			if(isset($session['userid']) && $keyid == $session['userid'])
			{
				$data['session'] = $session;
				$data['row'] = $this->members_model->get_one($keyid);
				$data['msg'] = $this->message_model->view_all($session);
				$this->load->view('profile',$data);
			}
			else
			{	
				$data['flag'] = '0';
				$data['row'] = $this->members_model->get_one($keyid);
				$this->load->view('profile',$data);
			}
		}

		//登录
		function login()
		{	
			$session = $this->session->all_userdata();
			if(isset($session['userid']))
			{
				header('LOCATION:index');
			}
			else
			{
				$this->load->view('login');
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
		//注销
		//
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