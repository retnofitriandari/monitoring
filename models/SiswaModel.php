<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SiswaModel extends CI_Model {
	public function view(){
//		return $this->db->get('tbl_daftar_sampel')->result(); // Tampilkan semua data yang ada di tabel siswa
                $this->db->select('tbl_daftar_sampel.*, tbl_m_survei.*, tbl_m_daerah.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_daftar_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei', 'tbl_daftar_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_m_daerah', 'tbl_daftar_sampel.id_daerah=tbl_m_daerah.id_daerah', 'left'); //menyatukan tabel users menggunakan left join
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('tbl_daftar_sampel', $data);
	}
        
        public function view_byy($id_survei){
                $this->db->select('tbl_daftar_sampel.*, tbl_pencacahan2.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_daftar_sampel'); //dari tabel data_users
                $this->db->join('tbl_pencacahan2', 'tbl_daftar_sampel.no_id=tbl_pencacahan2.no_id', 'left'); //menyatukan tabel users menggunakan left join                
                $this->db->where('tbl_daftar_sampel.id_survei', $id_survei);
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
            
	}
        
        
        // Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($no_id){
		$this->db->where('no_id', $no_id);
		return $this->db->get('tbl_daftar_sampel')->row();
	}
        
        // Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
	
		$this->form_validation->set_rules('input_id_pcl', 'ID PCL', 'required|numeric|max_length[15]');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
        // Fungsi untuk melakukan simpan data ke tabel siswa
	public function save(){
		$data = array(
			"no_id" => $this->input->post('input_no_id'),
			"id_survei" => $this->input->post('input_id_survei'),
                        "id_daerah" => $this->input->post('input_id_daerah'),
			"kip" => $this->input->post('input_kip'),
			"nama_per" => $this->input->post('input_nama_per'),
                        "alamat_per" => $this->input->post('input_alamat_per'),
                        "notelp_per" => $this->input->post('input_notelp_per'),
			"id_pcl" => $this->input->post('input_id_pcl')
		);
		
		$this->db->insert('tbl_daftar_sampel', $data); // Untuk mengeksekusi perintah insert data
	}
        
        // Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function edit($no_id){
		$data = array(
			//"nama_pcl" => $this->input->post('input_nama_pcl'),
			//"username_pcl" => $this->input->post('input_username_pcl'),
			//"password_pcl" => $this->input->post('input_password_pcl'),
			"id_pcl" => $this->input->post('input_id_pcl')
		);
		
		$this->db->where('no_id', $no_id);
		$this->db->update('tbl_pencacahan2', $data); // Untuk mengeksekusi perintah update data
	}
}
