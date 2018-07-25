<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pdokumen extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
//		return $this->db->get('tbl_pdok')->result();
                $this->db->select('tbl_pdok.*, tbl_m_survei.*, tbl_kode_bidang.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_m_survei'); //dari tabel data_users
                $this->db->join('tbl_pdok', 'tbl_pdok.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kode_bidang', 'tbl_kode_bidang.id_bidang=tbl_m_survei.id_bidang', 'left'); //menyatukan tabel users menggunakan left join
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
	
        public function view_by($id_survei){
		$this->db->where('id_survei', $id_survei);
		return $this->db->get('tbl_pdok')->row();
	}
        
        public function save(){
		$data = array(
                        "ke_kab" => $this->input->post('input_id_survei'),
			"ke_pml" => $this->input->post('input_nama_survei'),
                        "bagi_beban" => $this->input->post('input_bagi_beban'),
			"ke_pcl" => $this->input->post('input_id_bidang')
//                        "diterima_dr_pcl" => $this->input->post('input_id_survei'),
//			"kumpul_ke_kab" => $this->input->post('input_nama_survei'),
//			"jumlah_dok" => $this->input->post('input_id_bidang'),
//                        "metode" => $this->input->post('input_id_survei'),
//			"p_entri" => $this->input->post('input_nama_survei'),
//			"file_kirim" => $this->input->post('input_id_bidang'),
//                        "dok_kirim" => $this->input->post('input_id_survei'),
//			"status" => $this->input->post('input_nama_survei')
		);
		$this->db->insert('tbl_pdok', $data); // Untuk mengeksekusi perintah insert data
	}
        

        
        
}
