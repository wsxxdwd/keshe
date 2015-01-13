<?php 	
	class Message_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->loda->library('session');
		}
		//发送留言
		function send($post)
		{
			$data['s_id'] = $this->session->userdata('userid');
			$data['m_id'] = $post['m_id'];
			$data['content'] = $post['content'];
			$data['new'] = 1 ;
			if($this->db->insert('message',$data))
			{
				return TRUE;
			}
			else 
				return FALSE;
		}
		//查看新留言
		function count_new()
		{
			$data['m_id'] = $this->session->userdata['userid'];
			$data['new'] = 1;
			$this->db->from('message');
			$this->db->where($data);
			return $this->db->count_all_results();	
		}
		//查看某用户的所有留言
		function view_all($power)
		{	
			$data['m_id'] = $this->session->userdata['userid'];
			$this->db->from('message');
			$this->db->where($data);
			$this->db->order_by('time','DESC');
			$res = $this->db->get();
			return $res->result_array();
		}
		//查看所有留言表留言
		function view_all_m()
		{	
			$this->db->order_by('time','DESC');
			$res = $this->db->get('message');
			return $res->result_array();
		}

		function d_msg($post)
		{
			$data['msgid'] = $post['msgid'];
			if($this->db->delete('message',$data))
				return TRUE;
			else
				return FALSE;
		}

		//查看自己对他人的留言
		function view_all_send()
		{
			$data['s_id'] = $this->sesssion->userdata['userid'];
			$this->db->from('message');
			$this->db->where($data);
			$this->db->order_by('time','DESC');

			$res = $this->db->get();
			return $res->result_array();
		}

		//标记为已读
		function a_r($post)
		{
			$data['msgid'] = $post['msgid'];

			if($this->db->update('message',array('new'=>0),$data))
			{
				return TRUE;
			}
			return FALSE;
		}
	}