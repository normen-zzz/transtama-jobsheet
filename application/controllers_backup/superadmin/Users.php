<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('dsitbacksystem');
		}
		$this->load->model('UserModel');
		$this->load->library('breadcrumb');
		cek_role();
	}

	public function index()
	{
		$breadcrumb_items = [
			'Users' => 'superadmin/users',
		];
		$data['subtitle'] = 'Manajemen';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['title'] = 'Users';
		$id_jurusan = $this->session->userdata('id_jurusan');
		$data['roles'] = $this->db->get('tb_role')->result_array();
		$data['fakultas'] = $this->db->get('tb_fakultas')->result_array();
		$data['jurusan'] = $this->db->get('tb_jurusan')->result_array();
		if ($id_jurusan != 0) {
			# code...
			$data['users'] = $this->UserModel->getUser($id_jurusan)->result_array();
		} else {
			$data['users'] = $this->UserModel->getUser(0)->result_array();
		}
		$this->backend->display('superadmin/v_users', $data);
	}
	public function addUser()
	{
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'id_role' => $this->input->post('id_role'),
			'id_fakultas' => $this->input->post('id_fakultas'),
			'id_prodi' => $this->input->post('id_prodi'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'status' => 1,

		);
		//set id column value as UUID
		// $this->db->set('id_user', 'UUID()', FALSE);

		//insert all together
		if ($this->db->insert('tb_user', $data)) {
			log_aktifitas('insert', 'tb_user');
			$dataflash = array(
				'title' => 'Data User',
				'text' => 'Data user Berhasil ditambahkan',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);

			$this->session->set_flashdata('message', $dataflash);
		}

		redirect('superadmin/users');
	}

	public function delete($id)
	{
		$where = array('id_user' => $id);
		$delete = $this->db->delete('tb_user', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_user');
			$dataflash = array(
				'title' => 'Data User',
				'text' => 'Data User Berhasil dihapus',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/users');
		} else {
			$dataflash = array(
				'title' => 'Data User',
				'text' => 'Data User Gagal di update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/users');
		}
	}
	public function editUser()
	{
		$where = array('id_user' => $this->input->post('id_user'));
		$paswword = $this->input->post('password');
		if ($paswword) {
			$data = array(
				'nama_user' => $this->input->post('nama_user'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'id_role' => $this->input->post('id_role'),
				'id_fakultas' => $this->input->post('id_fakultas'),
				'id_prodi' => $this->input->post('id_prodi'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'status' => $this->input->post('status')

			);
		} else {
			$data = array(
				'nama_user' => $this->input->post('nama_user'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'id_role' => $this->input->post('id_role'),
				'id_fakultas' => $this->input->post('id_fakultas'),
				'id_prodi' => $this->input->post('id_prodi'),
				'status' => $this->input->post('status')

			);
		}
		$update = $this->db->update('tb_user', $data, $where);
		if ($update) {
			log_aktifitas('update', 'tb_user');
			$dataflash = array(
				'title' => 'Data User',
				'text' => 'Data User Berhasil di update',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/users');
		} else {
			$dataflash = array(
				'title' => 'Data Profile',
				'text' => 'Data Profile Gagal di update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/users');
		}
	}

	public function Exportpdf($start = null, $end = null)
	{
		$id_jurusan = $this->session->userdata('id_prodi');
		if ($start != null && $end != null) {
			$data['title'] = "Data User dari $start sampai $end ";
			$data['users'] = $this->UserModel->getUser($id_jurusan, $start, $end)->result_array();
		} else {
			$data['title'] = "Export User";
			$data['users'] = $this->UserModel->getUser($id_jurusan)->result_array();
		}
		// $data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

		$this->load->view('superadmin/v_export_user_pdf', $data);
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->set_paper("A4");
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$sekarang = date("d:F:Y:h:m:s");
		$this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
	}

	public function Exportexcel($start = null, $end = null)
	{
		$id_jurusan = $this->session->userdata('id_prodi');
		if ($start != null && $end != null) {
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment;Filename=export-users-$start-$end.xls");
			$data['title'] = "Laporan Produk dari $start sampai $end ";
			$data['users'] = $this->UserModel->getUser($id_jurusan, $start, $end)->result_array();
		} else {
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment;Filename=export-users.xls");
			$data['title'] = "Laporan Produk Keseluruhan ";
			$data['users'] = $this->UserModel->getUser($id_jurusan)->result_array();
		}
		$data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

		$this->load->view('superadmin/v_export_user_excel', $data);
		// $html = $this->output->get_output();
		// $this->load->library('dompdf_gen');
		// $this->dompdf->set_paper("A4");
		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// $sekarang = date("d:F:Y:h:m:s");
		// $this->dompdf->stream("Cetak" . $sekarang . ".xls", array('Attachment' => 0));
	}
}
