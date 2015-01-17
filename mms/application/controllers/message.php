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
			if($post['captchacode'] != $_SESSION['captchaCode'])
			{
				$res['status'] = 0;
				$res['msg'] = '验证码不正确';
			}
			else if($post['content']=='' OR strlen($post['content'])>100)
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

		//所有新留言数目
		function new_msg_num()
		{	
			$session = $this->session->all_userdata();
			if(isset($session['groups']) && $session['groupid']==1)
			{	
				$res['status'] = 1;
				$res['msg'] = '成功';
				$res['data'] = $this->message_model->count_new();
			}
			else
			{
				$res['status'] = 1;
				$res['msg'] = '失败';
			}
			echo json_encode($res);
		}

		//查看某用户所有留言
		function view_all_msg()
		{	
			$post= $this->input->post();
			if($post['userid']=='' OR !is_int($post['userid']))
			{
				$res['msg'] ='查看失败';
				$res['status'] = 0 ;
			}
			else if($res['data'] = $this->message_model->view_all($post))
			{
				$res['status'] = 1;	
				$res['msg'] = 'success';
			}
			else
			{
				$res['msg'] ='查xun失败';
				$res['status'] = 0 ;
			}
			echo json_encode($res);
		}


		//管理员查看所有留言
		function m_view_all()
		{	
			//检查权限
			$session = $this->session->all_userdata();

			if(isset($session['groupid']) && $session['groupid']==1)
			{
				$res['data'] = $this->message_model->view_all_m();
				$res['status'] = 1;
				$res['msg'] = 'success';
			}
			else
			{
				$res['status'] =0 ;
				$res['msg'] = '您无权进行此操作';
			}
			echo json_encode($res);
		} 

		//删除留言
		function delete_msg()
		{	
			/*$post = $this->input->post();
			$res = $this->message_model->d_msg($post);
			echo $res;*/
			$post = $this->input->post();
			$session = $this->session->all_userdata();
			if(!isset($session['userid']))
			{
				$res['status'] = 0;
				$res['msg'] = 'please login';
			}
			else if($session['userid'] != $post['userid'] && $session['groupid']!=1)
			{
				$res['status'] = 0;
				$res['msg'] = 'you have no power';
			}
			else if($this->message_model->d_msg($post))
			{
				$res['status'] = 1;
				$res['msg'] = '删除成功';
			}
			else
			{
				$res['status'] = 0;
				$res['msg'] = '删除失败';
			}
			echo json_encode($res);
		}

	/*	//查看对他人的留言
		function view_send()
		{
			echo json_encode($this->message_model->view_all_send());
		}*/
		//标记为已读
		function already_read()
		{	
			$session = $this->session->all_usedata();
			$post = $this->input->post();
			if(!isset($session['userid'])
			{
				$res['status'] = 0;
				$res['msg'] = '请先登陆';
			}
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
		//显示验证码
		function show_captcha()
		{
			$this->message_model->show_verify();
		}
	}