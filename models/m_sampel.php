<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_sampel extends CI_Model {
	public function view(){
//		return $this->db->get('tbl_sampel')->result(); // Tampilkan semua data yang ada di tabel siswa
                $this->db->select('tbl_sampel.*, tbl_m_survei.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_kode_bidang.*, tbl_sampelkab.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_m_survei  left join tbl_kode_bidang on tbl_m_survei.id_bidang=tbl_kode_bidang.id_bidang ', 'tbl_sampel.id_survei=tbl_m_survei.id_survei', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kab', 'tbl_sampel.id_kab=tbl_kab.id_kab', 'left'); //menyatukan tabel users menggunakan left join
                $this->db->join('tbl_kec', 'tbl_sampel.id_kec=tbl_kec.id_kec', 'left');
                $this->db->join('tbl_kel', 'tbl_sampel.id_kel=tbl_kel.id_kel', 'left');
                $this->db->join('tbl_sampelkab', 'tbl_sampel.id_survei=tbl_sampelkab.id_survei', 'left');
                $this->db->group_by('tbl_sampel.id_survei');
                $this->db->where('tbl_sampelkab.id_kab != ',0,FALSE);
                               
                $id_kab = $this->session->userdata('id_kab');
                if ($id_kab != null){ 
                $this->db->where('tbl_sampelkab.id_kab', $id_kab);}
                
                
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
		$this->db->insert_batch('tbl_sampel', $data);
	}
        
        public function view_byy($id_survei){
                $this->db->select('tbl_sampel.*, tbl_pencacahan2.*, tbl_daftar_pegawai.*, tbl_kab.*, tbl_kec.*, tbl_kel.*, tbl_m_survei.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_pencacahan2'); //dari tabel data_users
                $this->db->join('tbl_sampel', 'tbl_sampel.no_id=tbl_pencacahan2.no_id', 'left'); //menyatukan tabel users menggunakan left join                
                $this->db->join('tbl_daftar_pegawai', 'tbl_daftar_pegawai.user_id=tbl_pencacahan2.id_pcl', 'left');
                $this->db->join('tbl_m_survei', 'tbl_m_survei.id_survei=tbl_pencacahan2.id_survei', 'left');
                $this->db->join('tbl_kec', 'tbl_kec.id_kec=tbl_pencacahan2.id_kec', 'left');
                $this->db->join('tbl_kab', 'tbl_kab.id_kab=tbl_pencacahan2.id_kab', 'left');
                $this->db->join('tbl_kel', 'tbl_kel.id_kel=tbl_pencacahan2.id_kel', 'left');
                $this->db->where('tbl_sampel.id_survei', $id_survei);
                $id_kab = $this->session->userdata('id_kab');
                if($id_kab != null){
                $this->db->where('tbl_sampel.id_kab', $id_kab);}
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
            
	}
        
        
        // Fungsi untuk menampilkan data 
	public function view_by($no_id){
            $this->db->select('tbl_sampel.*, tbl_pencacahan2.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_sampel'); //dari tabel data_users
                $this->db->join('tbl_pencacahan2', 'tbl_sampel.no_id=tbl_pencacahan2.no_id', 'left'); //menyatukan tabel users menggunakan left join                
                $this->db->where('tbl_sampel.no_id', $no_id);

		return $this->db->get()->row();
	}
        
        // Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, no id tidak harus divalidasi
		// Jadi no id di validasi hanya ketika menambah data  saja
		if($mode == "save")
	
		$this->form_validation->set_rules('input_id_pcl', 'ID PCL', 'required|numeric|max_length[15]');
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
        
        // Fungsi untuk melakukan simpan data ke tabel 
	public function save(){
		$data = array(
			"no_id" => $this->input->post('input_no_id'),
			"id_survei" => $this->input->post('input_id_survei'),
                        "id_kab" => $this->input->post('input_id_kab'),
                        "id_kec" => $this->input->post('input_id_kec'),
                        "id_kel" => $this->input->post('input_id_kel'),
			"kip" => $this->input->post('input_kip'),
			"nama_per" => $this->input->post('input_nama_per'),
                        "alamat_per" => $this->input->post('input_alamat_per'),
                        "notelp_per" => $this->input->post('input_notelp_per'),
			"id_pcl" => $this->input->post('input_id_pcl')
		);
		
		$this->db->insert('tbl_sampel', $data); // Untuk mengeksekusi perintah insert data
	}
        
        // Fungsi untuk melakukan ubah data siswa berdasarkan no id
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
        
        function getAllGroups(){
            
            if ($this->session->userdata('user_level')!='1'){
                $query = $this->db->query('SELECT user_id, user_nama FROM tbl_daftar_pegawai '
                . 'where user_level = 4 and id_kab = ?', array($this->session->userdata('id_kab')));}
            else{
                $query = $this->db->query('SELECT user_id, user_nama FROM tbl_daftar_pegawai '
                . 'where user_level = 4' );
            }
            return $query->result();
        }
        
        public function keterangan_sur($id_survei){
		$this->db->where('id_survei', $id_survei);
		return $this->db->get('tbl_m_survei')->row();
	}
}
