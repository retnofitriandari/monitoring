<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pdokumen2 extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
//		return $this->db->get('tbl_pdok')->result();
                $this->db->select('tbl_pdok.*, tbl_m_survei.*, tbl_kode_bidang.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_m_survei'); //dari tabel data_users
                $this->db->join('tbl_pdok', 'tbl_pdok.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kode_bidang', 'tbl_kode_bidang.id_bidang=tbl_m_survei.id_bidang', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->group_by('tbl_pdok.id_survei');
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_kab($id_survei){
//		return $this->db->get('tbl_pdok')->result();
                $this->db->select('tbl_sampelkab.*, tbl_kab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampelkab'); //dari tabel data_users
                $this->db->join('tbl_kab', 'tbl_sampelkab.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->where('id_survei', $id_survei);
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        // Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($no_urut){
                $this->db->select('tbl_sampelkab.*, tbl_kab.*, tbl_pdok.*, tbl_m_survei.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampelkab'); //dari tabel data_users
                $this->db->join('tbl_kab', 'tbl_sampelkab.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_pdok', 'tbl_sampelkab.no_urut=tbl_pdok.no_urut', 'left');
                $this->db->join('tbl_m_survei', 'tbl_sampelkab.id_survei=tbl_m_survei.id_survei', 'left');
		$this->db->where('tbl_pdok.no_urut', $no_urut);
		
                $data = $this->db->get();
                return $data->row();
	}
        


                
        public function edit($no_urut){
            $ke_kab = $this->input->post('check_list1');
            if ($ke_kab == NULL) $ke_kab = 0;
            $ke_pml = $this->input->post('check_list2');
            if ($ke_pml == NULL) $ke_pml = 0;
            $bagi_beban = $this->input->post('check_list3');
            if ($bagi_beban == NULL) $bagi_beban = 0;
            $ke_pcl = $this->input->post('check_list4');
            if ($ke_pcl == NULL) $ke_pcl = 0;
            $diterima_dr_pcl = $this->input->post('check_list5');
            if ($diterima_dr_pcl == NULL) $diterima_dr_pcl = 0;
//            $kumpul_ke_kab = $this->input->post('check_list6');
//            if ($kumpul_ke_kab == NULL) $kumpul_ke_kab = 0;
            $terima_semua = $this->input->post('check_list7');
            if ($terima_semua == NULL) $terima_semua = 0;
            $p_entri = $this->input->post('check_list8');
            if ($p_entri == NULL) $p_entri = 0;
             
		$data = array(
//			"ke_kab" => $this->input->post('tes'),
                        "ke_kab" => $ke_kab,
                        "ke_pml" => $ke_pml,
                        "bagi_beban" => $bagi_beban,
                        "ke_pcl" => $ke_pcl,
                        "diterima_dr_pcl" => $diterima_dr_pcl, 
//                        "kumpul_ke_kab" => $kumpul_ke_kab,
                        "terima_semua" => $terima_semua,
                        "p_entri" => $p_entri,
                        "dok_terisi" => $this->input->post('input_terisi'),
                        "dok_tdk_terisi" => $this->input->post('input_tdk_terisi'),
			"dok_sebagian" => $this->input->post('input_sebagian'),
                        "metode" => $this->input->post('radiostep')
		);
		
		$this->db->where('no_urut', $no_urut);
		$this->db->update('tbl_pdok', $data); // Untuk mengeksekusi perintah update data
	}
        
        public function edit2($id_survei){
		$data = array(
////			"ke_kab" => $this->input->post('tes'),
//                        "ke_kab" => implode(", ",$this->input->post('check_list1')),
//                        "ke_pml" => implode(", ",$this->input->post('check_list2')),
//                        "bagi_beban" => implode(", ",$this->input->post('check_list3')),
//                        "ke_pcl" => implode(", ",$this->input->post('check_list4'))
                        "diterima_dr_pcl" => implode(", ",$this->input->post('check_list5')), 
                        "kumpul_ke_kab" => implode(", ",$this->input->post('check_list6')),
                        "terima_semua" => implode(", ",$this->input->post('check_list7')),
                        "p_entri" => implode(", ",$this->input->post('check_list8')),
                        "dok_terisi" => $this->input->post('input_terisi'),
                        "dok_tdk_terisi" => $this->input->post('input_tdk_terisi'),
			"dok_sebagian" => $this->input->post('input_sebagian')
		);
		
		$this->db->where('id_survei', $id_survei);
		$this->db->update('tbl_pdok', $data); // Untuk mengeksekusi perintah update data
	}
        
        
        
        
}
