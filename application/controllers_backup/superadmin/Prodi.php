<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('login');
		}
		$this->load->model('ProdiModel');
		$this->load->library('breadcrumb');
		cek_role();
	}

	public function index()
	{
		$breadcrumb_items = [
			'Prodi' => 'superadmin/prodi',
		];
		$data['subtitle'] = 'Manajemen';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

		$data['title'] = 'Program  Studi';
		$data['prodi'] = $this->ProdiModel->getProdi()->result_array();
		$data['fakultas'] = $this->db->get('tb_fakultas')->result_array();
		$this->backend->display('superadmin/v_prodi', $data);
	}

	public function addProdi()
	{
		$data = array(
			'nama_prodi' => $this->input->post('nama_prodi'),
			'kode_prodi' => $this->input->post('kode_prodi'),
			'status' => $this->input->post('status'),
			'id_fakultas' => $this->input->post('id_fakultas'),
			'id_jenjang_didik' => $this->input->post('id_jenjang_didik'),
		);

		if ($this->db->insert('tb_jurusan', $data)) {
			log_aktifitas('insert', 'tb_jurusan');
			$dataflash = array(
				'title' => 'Data Prodi',
				'text' => 'Data Prodi Berhasil ditambahkan',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
		}

		redirect('superadmin/prodi');
	}

	public function delete($id)
	{
		$where = array('id_prodi' => $id);
		$delete = $this->db->delete('tb_jurusan', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_jurusan');
			$dataflash = array(
				'title' => 'Data Prodi',
				'text' => 'Data Prodi Berhasil dihapus',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/prodi');
		} else {
			$dataflash = array(
				'title' => 'Data Prodi',
				'text' => 'Data Prodi Gagal di update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/prodi');
		}
	}
	public function edit()
	{
		$where = array('id_prodi' => $this->input->post('id_prodi'));
		$data = array(
			'nama_prodi' => $this->input->post('nama_prodi'),
			'kode_prodi' => $this->input->post('kode_prodi'),
			'status' => $this->input->post('status'),
			'id_fakultas' => $this->input->post('id_fakultas'),
			'id_jenjang_didik' => $this->input->post('id_jenjang_didik'),
		);
		$update = $this->db->update('tb_jurusan', $data, $where);
		if ($update) {
			log_aktifitas('update', 'tb_jurusan');
			$dataflash = array(
				'title' => 'Data Prodi',
				'text' => 'Data Prodi Berhasil di Update',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/prodi');
		} else {
			$dataflash = array(
				'title' => 'Data Prodi',
				'text' => 'Data Prodi Gagal di Update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/prodi');
		}
	}
}
