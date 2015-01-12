<?php	
	class Members extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('members_model');
		}

		function add_members()
		{
			$post = $this->input->post();
			if(!$post['username'] OR !$post['password'] OR !$post['name'] OR !$post['groups'])
			{
				$result['status'] = 0;
				$result['msg'] = '请填写完整的成员信息';
			}
			else if(strlen(strval($post['phone'])) !=0 && !preg_match("/^1[3-5,8]{1}[0-9]{9}$/",$post['phone']))
			{
				$result['status'] = 0;
				$result['msg'] = '请输入正确的手机号';
			}
			else if($post['qq'] && !is_long($post['qq']) OR strlen(strval($post['qq']))>11)
			{
				$result['status'] = 0;
				$result['msg'] = '请输入正确的qq号';
			}
			else if($this->members_model->add($post))
			{
				$result['status'] = 1;
				$result['msg'] = '添加成员成功';
			}
			else
			{
				$result['status'] = 0;
				$result['msg'] = '添加成员失败';
			}
			echo json_encode($result);
		}

		function delete_members()
		{
			$post = $this->input->post();
			if(!is_int($post['userid']))
			{
				$result['status'] = 0;
				$result['msg'] = '删除失败';
			}
			else if($this->members_model->delete($post))
			{
				$result['status'] = 1;
				$result['msg'] = '删除成功';
			}
			else
			{
				$result['status'] = 0;
				$result['msg'] = '删除失败';
			}
			echo json_encode($result);
		}

	}