<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_daftarsurvei extends CI_Model {
	// Fungsi untuk menampilkan semua data siswa
	public function view(){
//		return $this->db->get('tbl_m_survei')->result();
                $this->db->select('tbl_kode_bidang.*, tbl_m_survei.*'); //mengambil semua data dari tabel data_users dan users
                $this->db->from('tbl_m_survei'); //dari tabel data_users
                $this->db->join('tbl_kode_bidang', 'tbl_kode_bidang.id_bidang=tbl_m_survei.id_bidang', 'left'); //menyatukan tabel users menggunakan left join
                
                $data = $this->db->get(); //mengambil seluruh data
                return $data->result(); //mengembalikan data
	}
	
	// Fungsi untuk menampilkan data siswa berdasarkan NIS nya
	public function view_by($id_survei){
		$this->db->where('id_survei', $id_survei);
		return $this->db->get('tbl_m_survei')->row();
	}
	
	// Fungsi untuk validasi form tambah dan ubah
	public function validation($mode){
		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
		
		// Tambahkan if apakah $mode save atau update
		// Karena ketika update, NIS tidak harus divalidasi
		// Jadi NIS di validasi hanya ketika menambah data siswa saja
		if($mode == "save")
		$this->form_validation->set_rules('input_id_survei', 'ID Survei', 'required|max_length[11]');
		$this->form_validation->set_rules('input_nama_survei', 'Nama Survei', 'required|max_length[200]');
		$this->form_validation->set_rules('input_id_bidang', 'ID Bidang', 'required|max_length[15]');
		$this->form_validation->set_rules('input_tahun', 'Tahun', 'required|numeric|max_length[4]');
		$this->form_validation->set_rules('input_jumlah_sampel', 'Jumlah Sampel', 'required|numeric');
                $this->form_validation->set_rules('date1', 'Tanggal Pengiriman', 'required');
                $this->form_validation->set_rules('date2', 'Tanggal Pengiriman', 'required');
                $this->form_validation->set_rules('date3', 'Tanggal Pencacahan', 'required');
                $this->form_validation->set_rules('date4', 'Tanggal Pencacahan', 'required');
                $this->form_validation->set_rules('date5', 'Tanggal Pengumpulan', 'required');
                $this->form_validation->set_rules('date6', 'Tanggal Pengumpulan', 'required');
                
			
		if($this->form_validation->run()) // Jika validasi benar
			return TRUE; // Maka kembalikan hasilnya dengan TRUE
		else // Jika ada data yang tidak sesuai validasi
			return FALSE; // Maka kembalikan hasilnya dengan FALSE
	}
	
	// Fungsi untuk melakukan simpan data ke tabel siswa

	public function save(){
		$data = array(
			"id_survei" => $this->input->post('input_id_survei'),
			"nama_sur" => $this->input->post('input_nama_survei'),
			"id_bidang" => $this->input->post('input_id_bidang'),
			"tahun_survei" => $this->input->post('input_tahun'),
			"jumlah_sampel" => $this->input->post('input_jumlah_sampel'),
                        "tgl_awal_kirim_dok1" => $this->input->post('date1'),
                        "tgl_akhir_kirim_dok1" => $this->input->post('date2'),
                        "tgl_awal_cacah" => $this->input->post('date3'),
                        "tgl_akhir_cacah" => $this->input->post('date4'),
                        "tgl_awal_kirim_dok2" => $this->input->post('date5'),
                        "tgl_akhir_kirim_dok2" => $this->input->post('date6')
		);
		
		$this->db->insert('tbl_m_survei', $data); // Untuk mengeksekusi perintah insert data
	}
	
	// Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function edit($id_survei){
		$data = array(
			"id_survei" => $this->input->post('input_id_survei'),
			"nama_sur" => $this->input->post('input_nama_survei'),
			"id_bidang" => $this->input->post('input_id_bidang'),
			"tahun_survei" => $this->input->post('input_tahun'),
			"jumlah_sampel" => $this->input->post('input_jumlah_sampel'),
                        "tgl_awal_kirim_dok1" => $this->input->post('date1'),
                        "tgl_akhir_kirim_dok1" => $this->input->post('date2'),
                        "tgl_awal_cacah" => $this->input->post('date3'),
                        "tgl_akhir_cacah" => $this->input->post('date4'),
                        "tgl_awal_kirim_dok2" => $this->input->post('date5'),
                        "tgl_akhir_kirim_dok2" => $this->input->post('date6')
                        
		);
		
		$this->db->where('id_survei', $id_survei);
		$this->db->update('tbl_m_survei', $data); // Untuk mengeksekusi perintah update data
	}
	
	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id_survei){
		$this->db->where('id_survei', $id_survei);
		$this->db->delete('tbl_m_survei'); // Untuk mengeksekusi perintah delete data
	}
        
        function getAllGroups(){
            $query = $this->db->query('SELECT id_bidang, klasifikasi_bidang FROM tbl_kode_bidang');
            return $query->result();
        }
        
        public function daerah_sampel(){
            $kab1 = $this->input->post('kab1');
            if ($ke_kab == NULL) $ke_kab = 0;
            $kab2 = $this->input->post('kab2');
            if ($ke_pml == NULL) $ke_pml = 0;
            $kab3 = $this->input->post('kab3');
            if ($bagi_beban == NULL) $bagi_beban = 0;
            $kab4 = $this->input->post('kab4');
            if ($ke_pcl == NULL) $ke_pcl = 0;
            $kab5 = $this->input->post('kab5');
            if ($diterima_dr_pcl == NULL) $diterima_dr_pcl = 0;
            $kab6 = $this->input->post('kab6');
            if ($terima_semua == NULL) $terima_semua = 0;
            
            $data = array(
                   array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab1
                   ),
                   array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab2
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab3
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab4
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab5
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab6
                   )
                );

$this->db->insert_batch('tbl_sampelkab', $data); 
		         
	}
        
        public function edit_daerah_sampel($id_survei){
            $kab1 = $this->input->post('kab1');
            if ($kab1 == NULL) $kab1 = 0;
            $kab2 = $this->input->post('kab2');
            if ($kab2 == NULL) $kab2 = 0;
            $kab3 = $this->input->post('kab3');
            if ($kab3 == NULL) $kab3 = 0;
            $kab4 = $this->input->post('kab4');
            if ($kab4 == NULL) $kab4 = 0;
            $kab5 = $this->input->post('kab5');
            if ($kab5 == NULL) $kab5 = 0;
            $kab6 = $this->input->post('kab6');
            if ($kab6 == NULL) $kab6 = 0;
            
            $data = array(
                   array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab1
                   ),
                   array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab2
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab3
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab4
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab5
                   ),
                array(
                      'id_survei' =>  $this->input->post('input_id_survei'),
                      'id_kab' => $kab6
                   )
                );
$this->db->where('id_survei', $id_survei);
$this->db->update_batch('tbl_sampelkab', $data); 
		         
	}
}
