<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pegawai extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
            if ($this->session->userdata('user_level')!=1){
            $this->db->where('id_kab', $this->session->userdata('id_kab'));}
            return $this->db->get('tbl_daftar_pegawai')->result();
	}
	
	// Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($user_id){
		$this->db->where('user_id', $user_id);
		return $this->db->get('tbl_daftar_pegawai')->row();
	}
	
	// Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
		$this->form_validation->set_rules('input_user_id', 'ID pegawai', 'required|numeric|max_length[11]');
		$this->form_validation->set_rules('input_user_nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('input_user_username', 'Username', 'required|max_length[15]');
		$this->form_validation->set_rules('input_user_password', 'Password', 'required|max_length[15]');
		$this->form_validation->set_rules('input_user_level', 'level user', 'required');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
	
	// Fungsi untuk melakukan simpan data ke tabel siswa
	public function save(){
		$data = array(
			"user_id" => $this->input->post('input_user_id'),
			"user_nama" => $this->input->post('input_user_nama'),
			"user_username" => $this->input->post('input_user_username'),
			"user_password" => md5($this->input->post('input_user_password')),
			"user_level" => $this->input->post('input_user_level')
                        );
		
		$this->db->insert('tbl_daftar_pegawai', $data); // Untuk mengeksekusi perintah insert data
	}
	
	// Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function edit($user_id){
		$data = array(
			"user_id" => $this->input->post('input_user_id'),
			"user_nama" => $this->input->post('input_user_nama'),
			"user_username" => $this->input->post('input_user_username'),
			"user_password" => md5($this->input->post('input_user_password')),
			"user_level" => $this->input->post('input_user_level')
		);
		
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_daftar_pegawai', $data); // Untuk mengeksekusi perintah update data
	}
	
	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->delete('tbl_daftar_pegawai'); // Untuk mengeksekusi perintah delete data
	}
}
