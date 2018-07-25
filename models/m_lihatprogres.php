<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_lihatprogres extends CI_Model {

        public function view($id_survei){
                $this->db->select('tbl_sampel.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_m_survei.*, tbl_pencacahan2.*');
                $this->db->from('tbl_sampel');
                $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_sampel.id_kab', 'left');
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_sampel.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_sampel.id_kel', 'left');
                $this->db->join('tbl_m_survei', 'tbl_m_survei.id_survei=tbl_sampel.id_survei', 'left');
                $this->db->join('tbl_pencacahan2', 'tbl_pencacahan2.no_id=tbl_sampel.no_id', 'left');
                
               
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_jumlahkab($id_survei){
         $this->db->select('*, COUNT(tbl_sampelkab.id_kab) as totalkab');
         $this->db->from('tbl_sampelkab');
         $this->db->group_by('id_survei');         
         $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
         $this->db->where('id_survei', $id_survei);
         
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
                
	}
        
        public function view_lihat_dok($no_urut){
		$this->db->where('no_urut', $no_urut);
		return $this->db->get('tbl_pdok')->row();
	}
        
        public function view_per_pcl($id_survei){
         $this->db->select('*, COUNT(tbl_pencacahan2.id_pcl) as total, COUNT(status) as tercacah, tbl_daftar_pegawai.*');
         $this->db->from('tbl_pencacahan2');
         $this->db->group_by('tbl_pencacahan2.id_pcl'); 
         $this->db->order_by('tbl_pencacahan2.id_pcl', 'asc'); 
         $this->db->join('tbl_daftar_pegawai', 'tbl_daftar_pegawai.user_id=tbl_pencacahan2.id_pcl', 'left');
         $this->db->where('tbl_pencacahan2.id_pcl is not null', NULL, FALSE);
         $this->db->where('id_survei', $id_survei);

         if ($this->session->userdata('user_level')!='1'){
             $this->db->where('tbl_pencacahan2.id_kab', $this->session->userdata('id_kab'));
         }
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
         public function view_per_kab($id_survei){
         $this->db->select('*, COUNT(tbl_pencacahan2.id_kab) as total, COUNT(status) as tercacah, tbl_kab.*');
         $this->db->from('tbl_pencacahan2');
         $this->db->group_by('tbl_pencacahan2.id_kab'); 
         $this->db->order_by('tbl_pencacahan2.id_kab', 'asc'); 
         $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_pencacahan2.id_kab', 'left');
         $this->db->where('tbl_pencacahan2.id_kab is not null', NULL, FALSE);
         $this->db->where('id_survei', $id_survei);
         
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_per_kec($id_survei){
         $this->db->select('*, COUNT(tbl_pencacahan2.id_kec) as total, COUNT(status) as tercacah, tbl_kec.*,tbl_kab.*');
         $this->db->from('tbl_pencacahan2');
         $this->db->group_by('tbl_pencacahan2.id_kec'); 
//         $this->db->order_by('id_kec', 'asc'); 
         $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_pencacahan2.id_kec', 'left');
         $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_pencacahan2.id_kab', 'left');
         $this->db->where('tbl_pencacahan2.id_kec is not null', NULL, FALSE);
         $this->db->where('id_survei', $id_survei);
         
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_per_kec_perkab($id_survei, $id_kab){
         $this->db->select('*, COUNT(tbl_pencacahan2.id_kec) as total, COUNT(status) as tercacah, tbl_kec.*');
         $this->db->from('tbl_pencacahan2');
         $this->db->group_by('tbl_pencacahan2.id_kec'); 
//         $this->db->order_by('id_kec', 'asc'); 
         $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_pencacahan2.id_kec', 'left');
         $this->db->where('tbl_pencacahan2.id_kec is not null', NULL, FALSE);
         $this->db->where('id_survei', $id_survei);
         $this->db->where('tbl_pencacahan2.id_kab', $id_kab);
         
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_per_kel_perkec($id_survei, $id_kec){
         $this->db->select('*, COUNT(tbl_pencacahan2.id_kel) as total, COUNT(status) as tercacah, tbl_kel.*');
         $this->db->from('tbl_pencacahan2');
         $this->db->group_by('tbl_pencacahan2.id_kel'); 
//         $this->db->order_by('id_kec', 'asc'); 
         $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_pencacahan2.id_kel', 'left');
         $this->db->where('tbl_pencacahan2.id_kel is not null', NULL, FALSE);
         $this->db->where('id_survei', $id_survei);
         $this->db->where('tbl_pencacahan2.id_kec', $id_kec);
         
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
       
	
        public function view_by($id_survei){
		$this->db->where('id_survei', $id_survei);
		return $this->db->get('tbl_pencacahan2')->row();
	}
              
        public function view_byy($id_survei){
                $this->db->select('tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_m_survei.*, tbl_pencacahan2.*, tbl_daftar_pegawai.*, tbl_sampel.*');
                $this->db->from('tbl_pencacahan2');
                $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_pencacahan2.id_kab', 'left');
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_pencacahan2.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_pencacahan2.id_kel', 'left');
                $this->db->join('tbl_m_survei', 'tbl_m_survei.id_survei=tbl_pencacahan2.id_survei', 'left');
                $this->db->join('tbl_daftar_pegawai', 'tbl_daftar_pegawai.user_id=tbl_pencacahan2.id_pcl', 'left');
                $this->db->join('tbl_sampel', 'tbl_sampel.no_id=tbl_pencacahan2.no_id', 'left');
                $this->db->where('tbl_pencacahan2.id_survei', $id_survei);
                if ($this->session->userdata('user_level')!=1  ){
                        if ($this->session->userdata('user_level')==4){
                            $this->db->where('tbl_pencacahan2.id_pcl', $this->session->userdata('user_id'));}
                    else{
                        $this->db->where('tbl_pencacahan2.id_kab', $this->session->userdata('id_kab'));}
                }
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
            
	}
        
        public function keterangan_sur($id_survei){
		$this->db->where('id_survei', $id_survei);
		return $this->db->get('tbl_m_survei')->row();
	}
        
        public function keterangan_kab( $id_kab){
                $this->db->where('id_kab', $id_kab);
		return $this->db->get('tbl_kab')->row();
	}
        
        public function keterangan_kab_menu(){
                $this->db->where('id_kab', $this->session->userdata('id_kab'));
		return $this->db->get('tbl_kab')->row();
	}
        
        public function keterangan_kec( $id_kec){
                $this->db->where('id_kec', $id_kec);
		return $this->db->get('tbl_kec')->row();
	}
        
        public function get_persentase($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ?) dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ?) total on true', array($id_survei, $id_survei));
                
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data
            
	}
        
        public function get_persentase_kab_admin($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, $this->session->userdata('id_kab'), $id_survei, $this->session->userdata('id_kab')));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kab_pcl($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_pcl=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_pcl=?) '
                        . 'total on true', array($id_survei, $this->session->userdata('user_id'), $id_survei, $this->session->userdata('user_id')));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kab($id_survei, $id_kab){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei,$id_kab, $id_survei,$id_kab));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kec($id_survei, $id_kec){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kec=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kec=?) '
                        . 'total on true', array($id_survei,$id_kec, $id_survei,$id_kec));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_nourut($id_survei){
                $this->db->select('tbl_sampelkab.*, tbl_pdok.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampelkab'); //dari tabel data_users
                $this->db->join('tbl_pdok', 'tbl_sampelkab.no_urut=tbl_pdok.no_urut', 'left');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                $id_kab = $this->session->userdata('id_kab');
                $this->db->where('tbl_sampelkab.id_kab', $id_kab);
                $this->db->where('tbl_sampelkab.id_survei', $id_survei);
//                $this->db->where('tbl_pdok.no_urut', $no_urut);
                $data = $this->db->get();
                return $data->row();
	}
        
        public function get_jumlah_sampel($id_survei){
            if ($this->session->userdata('user_level')!=1){
                if ($this->session->userdata('user_level')==4){
                    $query = $this->db->query('SELECT count(id_pcl) as sampelkab from tbl_pencacahan2 where id_survei = ? and id_pcl = ?', array($id_survei, $this->session->userdata('user_id')));
                    }else{
                    $query = $this->db->query('SELECT count(id_kab) as sampelkab from tbl_pencacahan2 where id_survei = ? and id_kab = ?', array($id_survei, $this->session->userdata('id_kab')));}
                }else{ 
                $query = $this->db->query('SELECT count(id_kab) as sampelkab from tbl_pencacahan2 where id_survei = ?', $id_survei);
            }
                
             $result = $query->first_row('array'); //mengambil seluruh data
             return $result; //mengembalikan data
	}
        
        public function get_sampel_tercacah($id_survei){
            if ($this->session->userdata('user_level')!=1){
                if ($this->session->userdata('user_level')==4){
                $query = $this->db->query('SELECT count(id_pcl) as sampeltercacah from tbl_pencacahan2 where id_survei = ? and id_pcl = ? and status = 1', array($id_survei, $this->session->userdata('user_id')));    
                }else{
                $query = $this->db->query('SELECT count(id_kab) as sampeltercacah from tbl_pencacahan2 where id_survei = ? and id_kab = ? and status = 1', array($id_survei, $this->session->userdata('id_kab')));}
            } else{ 
                $query = $this->db->query('SELECT count(id_kab) as sampeltercacah from tbl_pencacahan2 where id_survei = ? and status = 1', $id_survei);
            }
                
             $result = $query->first_row('array'); //mengambil seluruh data
             return $result; //mengembalikan data
	}
        
        public function get_persentase_kab_selatan($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 71, $id_survei, 71));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kab_timur($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 72, $id_survei, 72));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kab_pusat($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 73, $id_survei, 73));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        public function get_persentase_kab_barat($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 74, $id_survei, 74));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        public function get_persentase_kab_utara($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 75, $id_survei, 75));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        public function get_persentase_kab_seribu($id_survei){
                $query = $this->db->query('SELECT dicacah.count / total.count as progress '
                        . 'from (select count(id_survei) as count from tbl_pencacahan2 where status = 1 and id_survei = ? and  id_kab=?) '
                        . 'dicacah left join (select count(id_survei) as count from tbl_pencacahan2 where id_survei = ? and  id_kab=?) '
                        . 'total on true', array($id_survei, 01, $id_survei, 01));
                $result = $query->first_row('array'); //mengambil seluruh data
                return $result; //mengembalikan data    
	}
        
        
       }
