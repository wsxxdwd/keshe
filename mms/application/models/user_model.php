<?php
	class User_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		//登录
		function login($post)
		{
			$arr['username'] = $post['username'];
			$arr['password'] = md5($post['password']);
			$query = $this->db->get_where('user',$arr);
			
			if($row = $query->row_array())
			{
				$data['userid'] = $row['userid'];
				$data['name'] = $row['name'];
				$data['groupid'] = $row['groups'];
				$this->session->set_userdata($data);
			
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		//注销登录
		function logout()
		{
			$data = array('userid'=>'','name'=>'','groupid'=>'');
	
			$this->session->unset_userdata($data);
			return TRUE;
		}
	

	}