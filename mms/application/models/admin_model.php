<?php
    class Admin_Model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
        }

        function login($post)
        {
            $arr['username'] = $post['username'];
            $arr['password'] = md5($post['password']);
            $arr['groups'] = 1;
            $query = $this->db->get_where('user',$arr);
            
            if($row = $query->row_array())
            {
                $data['userid'] = $row['userid'];
                $data['name'] = $row['name'];
                $data['groupid'] = $row['groups'];
                $this->session->set_userdata($data);
                /*if($post['autoflag'])
                {
                    setcookie('userid',$data['userid'],time()+7*24*3600,'/');
                    setcookie('name',$data['name'],time()+7*24*3600,'/');
                    setcookie('security',$row['security'],time()+7*24*3600,'/');
                }*/
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }


    }   