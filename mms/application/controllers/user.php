<?php
	class User extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('user_model');
		}

		function index()
		{
			$this->load->view();
		}
		//
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

		function do_logout()
		{
			if($this->user_model->logout())
				echo '1';
			else 
				echo '0';
		}
	}