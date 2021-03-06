<?php	
	class Members extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','form'));
			$this->load->model('members_model');
		}

		//添加新成员
		function add_members()
		{
			$post = $this->input->post();
			$session = $this->session->all_userdata();
			if(!isset($session['userid']) OR ($session['groupid'] !=1))
			{
				$result['status'] = 0;
				$result['msg'] = '您不是管理员，无法进行操作';
			}
			else if(!$post['username'] OR !$post['password'] OR !$post['name'] OR !$post['groups'] OR !$post['sex'])
			{
				$result['status'] = 0;
				$result['msg'] = '请填写完整的成员信息';
			}
			else if(strlen(strval($post['phone'])) !=0 && !preg_match("/^1[3-5,8]{1}[0-9]{9}$/",$post['phone']))
			{
				$result['status'] = 0;
				$result['msg'] = '请输入正确的手机号';
			}
			else if($post['qq'] && strlen(strval($post['qq']))>11)
			{
				$result['status'] = 0;
				$result['msg'] = '请输入正确的qq号';
			}
			else if($result['newid'] = $this->members_model->add($post))
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

		//管理员获取所有成员信息
		function get_all_members()
		{
			$session = $this->load->all_userdata();
			if(isset($session['userid']) && $session['groupid']==1)
			{
				$res['data'] = $this->members_model->fetchAll();
				$res['status']=1;
				$res['msg'] = 'success';

			}
			else
			{
				$res['status'] = 0;
				$res['msg'] = '查询失败';
			}
			echo json_encode($res);
		}

		//获取单一个人信息
		function get_one()
		{
			$get = $this->input->get();
			if(!isset($get['userid']) OR !is_int($get['userid']))
			{
				$res['status'] = 0;
				$res['msg'] = '查询失败';
			}
			else
			{
				$res['data'] = $this->members_model->get_one($get['userid']);
				if($res['data'])
				{
					$res['status']=1;
					$res['msg'] = 'success';
				}
				else
				{
					$res['status'] = 0;
					$res['msg'] = '查询失败';
				}
			}
			echo json_encode($res);
		}


		
		//删除成员
		function delete_members()
		{
			$post = $this->input->post();
			$session = $this->session->all_userdata();
			if(!isset($session['userid']) OR ($session['groupid'] !=1))
			{
				$result['status'] = 0;
				$result['msg'] = '您不是管理员，无法进行操作';
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

		//更新成员信息
		function update_members()
		{
			$session = $this->session->all_userdata();
			$post = $this->input->post();
			if(isset($session['userid']) && ($session['userid']==$post['userid'] OR $session['groupid']==1))
			{	
				if(isset($post['password']) && $post['password']=='')
				{
					$res['status'] = 0;
					$res['msg'] ='密码不能为空';
				}
				else if($this->members_model->update($post))
				{
					$res['status'] = 1;
					$res['msg'] = '修改成功';
				}
				else 
				{
					$res['status'] = 0;
					$res['msg'] ='修改失败';
				}
			}
			else
			{
				$res['status'] = 0;
				$res['msg'] = '您无权进行此操作';
			}
			echo json_encode($res);
		}
		

		//后台处理上传头像
		function upload_avatar()
		{	

			$path = base_url().'/public/uploads';
			if(!file_exists($path))
			{
				 mkdir($path, 0777);
			}
			$config['upload_path'] =$path.'/';
			$config['allowed_types'] = 'png|gif|jpeg|jpg';
			$config['max_size'] = '100';
			$config['max_width'] ='1024';
			$config['max_height'] = '768';
			$config['encrypt_name'] = 'true';

			$this->load->library('upload',$config);

			if(!$this->upload->do_upload())
			{	
				$res['status'] = 0;
				$res['msg'] = array('error' => $this->upload->display_errors()); 
			}
			else
			{
				$data['avatar'] = $this->upload->data('file_name');
				$userid = $this->session->userdata('userid');
				if($this->members_model->update($data))
				{
					$res['status'] = 1;
					$res['msg'] = '上传成功';
				}
				else
				{
					$res['status'] = 0;
					$res['msg'] = '上传失败';
				}
			}
			echo json_encode($res);
		}
	}