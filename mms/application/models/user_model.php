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
				if($post['autoflag'])
				{
					setcookie('userid',$data['userid'],time()+7*24*3600,'/');
					setcookie('name',$data['name'],time()+7*24*3600,'/');
					setcookie('security',$row['security'],time()+7*24*3600,'/');
				}
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
			setcookie('userid','',time()-7*24*3600,'/');
			setcookie('name','',time()-7*24*3600,'/');
			setcookie('security','',time()-7*24*3500,'/');
			$this->session->unset_userdata($data);
			return TRUE;
		}
		//自动登录获取session
		function getsession()
		{
			$data['userid'] = $_COOKIE['userid'];
			$data['name'] = $_COOKIE['name'];
			$data['security'] = $_COOKIE['security'];
			$query = $this->db->get_where('user',$data);
			if($row = $query->row_array())
			{	
				$data['groupid'] = $row['groups'];
				$this->session->set_userdata($data);
				return TRUE;
			}
			return FALSE;
		}
	}