<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_daerah extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
		return $this->db->get('tbl_m_daerah')->result();
	}
        
        public function view2(){
		$this->db->select('tbl_kab.*, tbl_kec.*, tbl_kel.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_kel'); //dari tabel data_users
                $this->db->join('tbl_kab', 'tbl_kel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_kel.id_kec', 'left'); //menyatukan tabel users menggunakan left join
//                $this->db->group_by('tbl_kab.id_kab');
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
        public function view_kab(){
		return $this->db->get('tbl_kab')->result();
	}
        public function view_kec(){
		$this->db->select('tbl_kab.*, tbl_kec.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_kec'); //dari tabel data_users
                $this->db->join('tbl_kab', 'tbl_kec.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
        
	public function view_kab_by($id_kab){
                
		$this->db->where('id_kab', $id_kab);
		return $this->db->get('tbl_kab')->row();
	}
        
	public function validation_kab($mode){
		$this->load->library('form_validation');
		if($mode == "save")
		$this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
		$this->form_validation->set_rules('input_nama_kab', 'Nama Kabupaten', 'required|max_length[50]');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
	public function edit_kab($id_kab){
		$data = array(
			"id_kab" => $this->input->post('input_id_kab'),
			"nama_kab" => $this->input->post('input_nama_kab')
		);
		
		$this->db->where('id_kab', $id_kab);
		$this->db->update('tbl_kab', $data); // Untuk mengeksekusi perintah update data
	}
        
        public function delete_kab($id_kab){
		$this->db->where('id_kab', $id_kab);
		$this->db->delete('tbl_kab'); // Untuk mengeksekusi perintah delete data
	}
        
        
        //KECAMATAN
        public function view_kec_by($id_kec){
		$this->db->where('id_kec', $id_kec);
		return $this->db->get('tbl_kec')->row();
	}
        
	public function validation_kec($mode){
		$this->load->library('form_validation');
		if($mode == "save")
                $this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
                
                $this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
		$this->form_validation->set_rules('input_nama_kec', 'Nama Kecamatan', 'required|max_length[50]');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
	public function edit_kec($id_kec){
		$data = array(
			"nama_kec" => $this->input->post('input_nama_kec')
		);
		
		$this->db->where('id_kec', $id_kec);
		$this->db->update('tbl_kec', $data); // Untuk mengeksekusi perintah update data
	}
        
        public function delete_kec($id_kec){
		$this->db->where('id_kec', $id_kec);
		$this->db->delete('tbl_kec'); // Untuk mengeksekusi perintah delete data
	}
        
	//KELURAHAN
        public function view_kel_by($id_kel){
		$this->db->where('id_kel', $id_kel);
		return $this->db->get('tbl_kel')->row();
	}
        
	public function validation_kel($mode){
		$this->load->library('form_validation');
		if($mode == "save")
                $this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
                $this->form_validation->set_rules('input_id_kec', 'ID Kecamatan', 'required|max_length[10]');
                $this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
		$this->form_validation->set_rules('input_nama_kel', 'Nama kelamatan', 'required|max_length[50]');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
	public function edit_kel($id_kel){
		$data = array(
			"nama_kel" => $this->input->post('input_nama_kel')
		);
		
		$this->db->where('id_kel', $id_kel);
		$this->db->update('tbl_kel', $data); // Untuk mengeksekusi perintah update data
	}
        
        public function delete_kel($id_kel){
		$this->db->where('id_kel', $id_kel);
		$this->db->delete('tbl_kel'); // Untuk mengeksekusi perintah delete data
	}
        
	// Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($id_daerah){
		$this->db->where('id_daerah', $id_daerah);
		return $this->db->get('tbl_m_daerah')->row();
	}
        
	// Fungsi untuk validasi form tambah dan ubah
	public function validation2($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
		$this->form_validation->set_rules('input_id_kab', 'ID Kota/Kabupaten', 'required|max_length[10]');
		$this->form_validation->set_rules('input_nama_kab', 'Nama Kabupaten', 'required|max_length[50]');
//		$this->form_validation->set_rules('input_level_daerah', 'Level Daerah', 'max_length[15]');
		
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
        public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
		$this->form_validation->set_rules('input_id_daerah', 'ID Daerah', 'required|max_length[10]');
		$this->form_validation->set_rules('input_nama_daerah', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('input_level_daerah', 'Level Daerah', 'max_length[15]');
		
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
	
	// Fungsi untuk melakukan simpan data ke tabel siswa
	public function save(){
		$data = array(
			"id_daerah" => $this->input->post('input_id_daerah'),
			"nama_daerah" => $this->input->post('input_nama_daerah'),
			"level_daerah" => $this->input->post('input_level_daerah')
		);
		
		$this->db->insert('tbl_m_daerah', $data); // Untuk mengeksekusi perintah insert data
	}
        
        public function save2(){
        {$data = array(
			"id_kab" => $this->input->post('input_id_kab'),
			"nama_kab" => $this->input->post('input_nama_kab')
		);
        $this->db->insert('tbl_kab', $data);} // Untuk mengeksekusi perintah insert data
        
        {$data = array(
			"id_kab" => $this->input->post('input_id_kab'),
                        "id_kec" => $this->input->post('input_id_kec'),
			"nama_kec" => $this->input->post('input_nama_kec')
		);
        $this->db->insert('tbl_kec', $data);}
        
        {$data = array(
			"id_kab" => $this->input->post('input_id_kab'),
			"id_kec" => $this->input->post('input_id_kec'),
                        "id_kel" => $this->input->post('input_id_kel'),
			"nama_kel" => $this->input->post('input_nama_kel')
		);
        $this->db->insert('tbl_kel', $data);}
	}
        
   
	
	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete2($id_daerah){
		$this->db->where('id_daerah', $id_daerah);
		$this->db->delete('tbl_m_daerah'); // Untuk mengeksekusi perintah delete data
	}
	
	// Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function edit($id_daerah){
		$data = array(
			"id_daerah" => $this->input->post('input_id_daerah'),
			"nama_daerah" => $this->input->post('input_nama_daerah'),
			"level_daerah" => $this->input->post('input_level_daerah')
		);
		
		$this->db->where('id_daerah', $id_daerah);
		$this->db->update('tbl_m_daerah', $data); // Untuk mengeksekusi perintah update data
	}
	
	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id_daerah){
		$this->db->where('id_daerah', $id_daerah);
		$this->db->delete('tbl_m_daerah'); // Untuk mengeksekusi perintah delete data
	}
}
