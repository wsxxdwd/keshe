<?php
	class Message extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('message_model');
		}

		function send_message()
		{
			$post = $this->input->post();
			if($post['content']=='' OR strlen($post['content'])>100)
			{
				$res['status'] =0;
				$res['msg'] = '请输入合适的留言内容';
			}
			else if($this->message_model->send($post))
			{
				$res['status'] = 1;
				$res['msg'] = '留言成功';
			}
			else
			{
					$res['status'] = 0;
					$res['msg'] = '留言失败';
			}
			return json_encode($res);
		}

		//新留言数目
		function new_msg_num()
		{
			echo  json_encode($this->message_model->count_new());
		}

		//查看用户所有留言
		function view_all_msg()
		{	
			echo json_encode($this->message_model->view_all()) ;
		}


		//管理员查看所有留言
		function m_view_all()
		{	
			//检查权限
			$power = $this->session->userdata('groupid');
			if($power==1)
			{
				$res = $this->message_model->view_all_m();
			}
			else
			{
				$res['status'] =0 ;
				$res['msg'] = '您无权进行此操作';
			}
			return json_encode($res);
		} 

		//删除留言
		function delete_msg()
		{
			$post = $this->input->post();
			if($this->message_model->d_msg($post))
			{
				$res['status'] = 1;
				$res['msg'] = '删除成功';
			}
			else
			{
				$res['status'] = 0;
				$res['msg'] = '删除失败';
			}
			return json_encode($res);
		}

		//查看对他人的留言
		function view_send()
		{
			echo json_encode($this->message_model->view_all_send());
		}
		//标记为已读
		function already_read()
		{
			$post = $this->input->post();
			if($this->message_model->a_r($post))
			{
				$res['status'] = 1;
				$res['msg'] = '标记成功';
			}
			else
			{
				$res['status'] = 0;
				$res['msg'] = '标记失败';
			}
			return json_encode($res);
		}
	}