<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	
	public function getlogin($u, $p){
            $pwd = md5($p);
            $this->db->where('user_username', $u);
            $this->db->where('user_password', $pwd);
            $query = $this->db->get('tbl_daftar_pegawai');
            if($query->num_rows()>0){
                foreach ($query -> result() as $row){
                    $sess =array('user_username' => $row->user_username,
                                'user_nama' => $row->user_nama,
                                'user_level' => $row->user_level,
                                'id_kab' => $row->id_kab,
                                'user_id' => $row->user_id);
                    $this->session->set_userdata($sess);
                    
                    redirect('home');
                    
                }
            }
            else{
                $this->session->set_flashdata('info', 'maaf username atau password salah');
                redirect('login');
            }
	}
	
}
