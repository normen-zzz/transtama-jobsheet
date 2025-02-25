<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('backoffice');
		}
		$this->load->model('UserModel');
		$this->load->model('Sendwa', 'wa');
		function hp($nohp) {
			// kadang ada penulisan no hp 0811 239 345
			$nohp = str_replace(" ","",$nohp);
			// kadang ada penulisan no hp (0274) 778787
			$nohp = str_replace("(","",$nohp);
			// kadang ada penulisan no hp (0274) 778787
			$nohp = str_replace(")","",$nohp);
			// kadang ada penulisan no hp 0811.239.345
			$nohp = str_replace(".","",$nohp);
		
			// cek apakah no hp mengandung karakter + dan 0-9
			if(!preg_match('/[^0-9]/',trim($nohp))){
				// cek apakah no hp karakter 1-3 adalah +62
				if(substr(trim($nohp), 0, 2)=='62'){
					$hp = substr_replace($nohp,'0',0,2);
				}
				// cek apakah no hp karakter 1 adalah 0
				elseif(substr(trim($nohp), 0, 1)=='0'){
					$hp = '62'.substr(trim($nohp), 1);
				}
			}
			return $hp;
		}
	}
	public function index()
	{
		$x['title'] = 'Profile';
		$x['subtitle'] = 'Profile';
		$idSession = $this->session->userdata('id_user');
		$id = $this->uri->segment(4);
		$data = $this->UserModel->getProfile($idSession);
		$row = $data->row_array();
		$x['id_user'] = $row['id_user'];
		$x['username'] = $row['username'];
		$x['email'] = $row['email'];
		$x['nama_user'] = $row['nama_user'];
		if ($row['no_hp'] != NULL) {
			$x['no_hp'] = hp($row['no_hp']);
		} else{
			$x['no_hp'] = $row['no_hp'];
		}
		$this->backend->display('v_profile', $x);
	}

	public function editProfile()
	{
		$idSession = $this->session->userdata('id_user');
		$idfromPost = $this->input->post('id_user');
		$where = array('id_user' => $idSession);

		$paswword = $this->input->post('password');
		if ($paswword) {
			$data = array(
				// 'id_user' => $this->session->userdata('id_user'),
				'nama_user' => $this->input->post('nama_user'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'no_hp' => hp($this->input->post('no_hp')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

			);
			// var_dump($data);
			// die;
		} else {
			$data = array(
				// 'id_user' => $this->session->userdata('id_user'),
				'nama_user' => $this->input->post('nama_user'),
				'username' => $this->input->post('username'),
				'no_hp' => hp($this->input->post('no_hp')),
				'email' => $this->input->post('email'),

			);
		}
		$update = $this->db->update('tb_user', $data, $where);
		$nama = $this->input->post('nama_user');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$no_hp =  $this->input->post('no_hp');
		$pesan = "Data Anda Di Profil Tesla Smartwork Berhasil Diubah <br> Nama: $nama <br> Username: $username <br> Email: $email <br> No Telp: $no_hp <br> Password : $paswword <br>";
		$pesanadmin = "Data Profil Tesla Smartwork Berhasil Diubah <br> Nama: $nama <br> Username: $username <br> Email: $email <br> No Telp: $no_hp <br> Password : $paswword";
		if ($update) {
			$this->wa->pickup(hp($this->input->post('no_hp')), $pesan);
			$this->wa->pickup('6285697780467', $pesanadmin);
			$this->session->set_flashdata('message', 'Diedit');
			redirect('profile');
		} else {
			$this->session->set_flashdata('message', 'Diedit');
			redirect('profile');
		}
	}
}
