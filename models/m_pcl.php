<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pcl extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
		return $this->db->get('tbl_daftar_pcl')->result();
	}
	
	// Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($id_pcl){
		$this->db->where('id_pcl', $id_pcl);
		return $this->db->get('tbl_daftar_pcl')->row();
	}
	
	// Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
		$this->form_validation->set_rules('input_id_pcl', 'ID PCL', 'required|numeric|max_length[11]');
		$this->form_validation->set_rules('input_nama_pcl', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('input_username_pcl', 'Username', 'required|max_length[15]');
		$this->form_validation->set_rules('input_password_pcl', 'Password', 'required|max_length[15]');
		$this->form_validation->set_rules('input_id_peg', 'ID Pegawai', 'required');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
	
	// Fungsi untuk melakukan simpan data ke tabel siswa
	public function save(){
		$data = array(
			"id_pcl" => $this->input->post('input_id_pcl'),
			"nama_pcl" => $this->input->post('input_nama_pcl'),
			"username_pcl" => $this->input->post('input_username_pcl'),
			"password_pcl" => md5($this->input->post('input_password_pcl')),
			"id_peg" => $this->input->post('input_id_peg')
		);
		
		$this->db->insert('tbl_daftar_pcl', $data); // Untuk mengeksekusi perintah insert data
	}
	
	// Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function edit($id_pcl){
		$data = array(
			"nama_pcl" => $this->input->post('input_nama_pcl'),
			"username_pcl" => $this->input->post('input_username_pcl'),
			"password_pcl" => md5($this->input->post('input_user_password')),
			"id_peg" => $this->input->post('input_id_peg')
		);
		
		$this->db->where('id_pcl', $id_pcl);
		$this->db->update('tbl_daftar_pcl', $data); // Untuk mengeksekusi perintah update data
	}
	
	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id_pcl){
		$this->db->where('id_pcl', $id_pcl);
		$this->db->delete('tbl_daftar_pcl'); // Untuk mengeksekusi perintah delete data
	}
}
