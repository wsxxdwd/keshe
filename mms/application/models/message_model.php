<?php 	
	session_start();

	class Message_Model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		//发送留言
		function send($post)
		{
			//$data['s_id'] = $this->session->userdata('userid');

			$data['s_ip'] = $this->session->userdata('ip_address');
			$data['s_email'] = $post['s_email'];
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
			//$data['m_id'] = $this->session->userdata['userid'];
			$data['new'] = 1;
			$this->db->from('message');
			$this->db->where($data);
			return $this->db->count_all_results();	
		}
		//查看某用户的所有留言
		function view_all($post)
		{	
			$data['m_id'] = $post['userid'];
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
			if(!$post['msgid'] OR !is_int($post['msgid']))
			{
				return FALSE;
			}
			else
			{	
				$this->db->where('msg',$post['msgid']);
				if($this->db->delete('message'))
					return TRUE;
				else
					return FALSE;
			}																				
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


		function show_verify()
		{	
			$conf['name'] = 'captchaCode';
			$this->load->library('captcha',$conf);
			$this->captcha->show();
		}
	}