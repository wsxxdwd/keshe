<?php 	
	class Members_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}

		function add($post)
		{	
			$post['password'] = md5($post['password']);
			if($this->db->insert('user',$post))
			{
				return TRUE;
			}
			else return FALSE;
		}

		function delete($post)
		{	
			if($this->db->delete('user',$post))
			{
				return TRUE;
			}
			else return FALSE;
		}

		function update($post)
		{	
			if($post['password'])
				$post['password'] = md5($post['password']);
			if($this->db->update('user',$post,array('userid'=>$post['userid'])))
			{
				return TURE;
			}
			else return FALSE;
		}
	}