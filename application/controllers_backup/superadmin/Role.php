<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('dsitbacksystem');
		}

		$this->load->library('breadcrumb');
		cek_role();
	}

	public function index()
	{
		$breadcrumb_items = [
			'Role Manajemen' => 'superadmin/role',
		];
		$data['subtitle'] = 'Manajemen';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

		$data['title'] = 'Role';
		$data['role'] = $this->db->get('tb_role')->result_array();
		$this->backend->display('superadmin/v_role', $data);
	}

	public function addRole()
	{
		$data = array(
			'nama_role' => $this->input->post('nama_role')
		);

		if ($this->db->insert('tb_role', $data)) {
			log_aktifitas('insert', 'tb_role');
			$dataflash = array(
				'title' => 'Data Role',
				'text' => 'Data Role Berhasil ditambahkan',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
		}

		redirect('superadmin/role');
	}

	public function delete($id)
	{
		$where = array('id_role' => $id);
		$delete = $this->db->delete('tb_role', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_role');
			$dataflash = array(
				'title' => 'Data Role',
				'text' => 'Data Role Berhasil dihapus',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/role');
		} else {
			$dataflash = array(
				'title' => 'Data Role',
				'text' => 'Data Role Gagal di update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/role');
		}
	}
	public function edit()
	{
		$where = array('id_role' => $this->input->post('id_role'));
		$data = array(
			'nama_role' => $this->input->post('nama_role')
		);
		$update = $this->db->update('tb_role', $data, $where);
		if ($update) {
			log_aktifitas('update', 'tb_role');
			$dataflash = array(
				'title' => 'Data Role',
				'text' => 'Data Role Berhasil di Update',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/role');
		} else {
			$dataflash = array(
				'title' => 'Data Role',
				'text' => 'Data Role Gagal di Update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/role');
		}
	}
}
