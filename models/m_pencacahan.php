<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pencacahan extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
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
	
// Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($no_id){
		$this->db->where('tbl_sampel.no_id', $no_id);
                $this->db->select('tbl_sampel.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_m_survei.*, tbl_pencacahan2.*');
                $this->db->from('tbl_sampel');
                $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_sampel.id_kab', 'left');
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_sampel.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_sampel.id_kel', 'left');
                $this->db->join('tbl_m_survei', 'tbl_m_survei.id_survei=tbl_sampel.id_survei', 'left');
                $this->db->join('tbl_pencacahan2', 'tbl_pencacahan2.no_id=tbl_sampel.no_id', 'left');
               
                $data = $this->db->get(); //mengambil seluruh data
		return $data->row();
	} 
        
        public function view_sampel_kab($id_survei, $id_kab){
                $this->db->select('tbl_sampel.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_m_survei.*, tbl_pencacahan2.*');
                $this->db->from('tbl_sampel');
                $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_sampel.id_kab', 'left');
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_sampel.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_sampel.id_kel', 'left');
                $this->db->join('tbl_m_survei', 'tbl_m_survei.id_survei=tbl_sampel.id_survei', 'left');
                $this->db->join('tbl_pencacahan2', 'tbl_pencacahan2.no_id=tbl_sampel.no_id', 'left');
                $this->db->where('tbl_sampel.id_survei', $id_survei);
                $this->db->where('tbl_sampel.id_kab', $id_kab);
                
                if ($this->session->userdata('user_level')==4){
                    $this->db->where('tbl_pencacahan2.id_pcl', $this->session->userdata('user_id'));
                }
                
               
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function edit($no_id){
            $selesai = $this->input->post('selesai');
            if ($selesai == NULL) $selesai = 0;
		$data = array(
////			"ke_kab" => $this->input->post('tes'),
//                        "ke_kab" => implode(", ",$this->input->post('check_list1')),
//                        "ke_pml" => implode(", ",$this->input->post('check_list2')),
//                        "bagi_beban" => implode(", ",$this->input->post('check_list3')),
//                        "ke_pcl" => implode(", ",$this->input->post('check_list4')),
                        "metode" => $this->input->post('input_metode'),
                        
                        "tgl_wawancara" => $this->input->post('date3'),
                        "tgl_drop" => $this->input->post('date5'),
                        "tgl_ambil" => $this->input->post('date6'),
                        "status" => $selesai
		);
		
		$this->db->where('no_id', $no_id);
		$this->db->update('tbl_pencacahan2', $data); // Untuk mengeksekusi perintah update data
	}
        
        public function keterangan($id_survei){
                $this->db->select('tbl_sampelkab.*, tbl_kab.*, tbl_pdok.*, tbl_m_survei.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampelkab'); //dari tabel data_users
                $this->db->join('tbl_kab', 'tbl_sampelkab.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_pdok', 'tbl_sampelkab.no_urut=tbl_pdok.no_urut', 'left');
                $this->db->join('tbl_m_survei', 'tbl_sampelkab.id_survei=tbl_m_survei.id_survei', 'left');
		$this->db->where('tbl_pdok.id_survei', $id_survei);
		
                $data = $this->db->get();
                return $data->row();
	}
        
        public function view_for_pcl(){
//		return $this->db->get('tbl_sampel')->result(); // Tampilkan semua data yang ada di tabel siswa
                $this->db->select('tbl_pencacahan2.*, tbl_m_survei.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_kode_bidang.*, tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_pencacahan2'); //dari tabel data_users
                $this->db->join('tbl_m_survei  left join tbl_kode_bidang on tbl_m_survei.id_bidang=tbl_kode_bidang.id_bidang ', 'tbl_pencacahan2.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_pencacahan2.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kec', 'tbl_pencacahan2.id_kec=tbl_kec.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_pencacahan2.id_kel=tbl_kel.id_kel', 'left');
                $this->db->join('tbl_sampelkab', 'tbl_pencacahan2.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_pencacahan2.id_survei');
//                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                               
                if ($this->session->userdata('user_level')!= 4){
                $id_kab = $this->session->userdata('id_kab');
                $this->db->where('tbl_pencacahan2.id_kab', $id_kab);}
                
                $this->db->where('tbl_pencacahan2.id_pcl', $this->session->userdata('user_id'));
                
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
}
