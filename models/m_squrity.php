<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_squrity extends CI_Model {
	
	public function getsqurity(){
            $usernmae = $this->session->userdata('user_username');
            if(empty($usernmae)){
                $this->session->sess_destroy();
                redirect('login');
            }
	}
	
}
