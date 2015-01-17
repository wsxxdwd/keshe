<?php 	
	class Members_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}

		//添加成员
		function add($post)
		{	
			$post['password'] = md5($post['password']);
			$post['security'] = md5(time().$post['username'].mt_rand(10001,99999));
			if($this->db->insert('user',$post))
			{
				return $this->db->insert_id();
			}
			else return FALSE;
		}

		//删除成员
		function delete($post)
		{	
			if($this->db->delete('user',$post))
			{
				return TRUE;
			}
			else return FALSE;
		}

		//更新成员信息
		function update($post)
		{	
			if($post['password'])
				$post['password'] = md5($post['password']);
			if(!$post['userid'])
			{
				return FALSE;
			}
			else if($this->db->update('user',$post,array('userid'=>$post['userid'])))
			{
				return TURE;
			}
			else return FALSE;
		}

		//获取所有成员
		function fetchAll($r='*')
		{	
			
			$this->db->select($r);
			$query = $this->db->get('user');
			if($row = $query->result_array())
			{
				return $row;
			} 
			else return FALSE;
		}
		//获取某个成员信息
		function get_one($userid)
		{	
			$query = $this->db->get_where('user',array('userid'=>$userid));
			if($row = $query->row_array())
			{
				return $row;
			}
			else return FALSE;
		}


		//搜索一个成员
		function fetchOne($post)
		{	
			$this->db->like('name',$post['name'],'both');
			$qurey = $this->db->get('user');
			if($row = $query->result_array())
			{
				return $row;
			}
			else
				return FALSE; 	
		}
	}