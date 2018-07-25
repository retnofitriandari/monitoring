<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model {
        
        public function __construct(){
        parent::__construct();
                
        }
    
    
	public function view_selatan(){
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*,   tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei' , 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                $this->db->where('tbl_sampelkab.id_kab', 71);
                $this->db->order_by('tbl_sampelkab.no_urut', 'desc');
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
	
        public function view_timur(){
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*,   tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei' , 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                $this->db->where('tbl_sampelkab.id_kab', 72);
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
	
        public function view_pusat(){
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*,   tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei' , 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                $this->db->where('tbl_sampelkab.id_kab', 73);
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_barat(){
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*,   tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei' , 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                $this->db->where('tbl_sampelkab.id_kab', 74);
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_utara(){
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*,   tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei' , 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
//                $this->db->where('tbl_sampelkab.id_kab', 75);
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
}
