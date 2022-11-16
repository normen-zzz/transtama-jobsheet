<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survei extends CI_Controller
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
			'Survei Perkuliahan' => 'superadmin/Survei',
		];
		$data['subtitle'] = 'Master Data';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['title'] = 'Master Soal';
		$data['survei'] = $this->db->get('tbl_soal_survei')->result_array();
		$this->backend->display('superadmin/v_soal_survei', $data);
	}
	public function add()
	{
		$breadcrumb_items = [
			'Survei Perkuliahan' => 'superadmin/Survei',
		];
		$data['subtitle'] = 'Tambah Soal Survei';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['title'] = 'Master Soal';
		$data['survei'] = $this->db->get('tbl_soal_survei')->result_array();
		$this->backend->display('superadmin/v_tambah_soal_survei', $data);
	}

	public function addFakultas()
	{
		$data = array(
			'nama_fakultas' => $this->input->post('nama_fakultas'),
			'initial' => $this->input->post('initial'),
			'id_dekan' => $this->input->post('id_dekan'),
		);

		if ($this->db->insert('tb_fakultas', $data)) {
			log_aktifitas('insert', 'tb_fakultas');
			$dataflash = array(
				'title' => 'Data Fakultas',
				'text' => 'Data Fakultas Berhasil ditambahkan',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);

			$this->session->set_flashdata('message', $dataflash);
		}

		redirect('superadmin/fakultas');
	}

	public function delete($id)
	{
		$where = array('id_fakultas' => $id);
		$delete = $this->db->delete('tb_fakultas', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_fakultas');
			$dataflash = array(
				'title' => 'Data Fakultas',
				'text' => 'Data Fakultas Berhasil dihapus',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/fakultas');
		} else {
			$dataflash = array(
				'title' => 'Data Fakultas',
				'text' => 'Data Fakultas Gagal di update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/fakultas');
		}
	}
	public function edit()
	{
		$where = array('id_fakultas' => $this->input->post('id_fakultas'));
		$data = array(
			'nama_fakultas' => $this->input->post('nama_fakultas'),
			'initial' => $this->input->post('initial'),
			'id_dekan' => $this->input->post('id_dekan'),
		);
		$update = $this->db->update('tb_fakultas', $data, $where);
		if ($update) {
			log_aktifitas('update', 'tb_fakultas');
			$dataflash = array(
				'title' => 'Data Fakultas',
				'text' => 'Data Fakultas Berhasil di Update',
				'type' => 'success',
				'icon'  => 'success',
				'confirmButtonColor' => '#0095cc',
				'confirmButtonText' => 'Oke',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/fakultas');
		} else {
			$dataflash = array(
				'title' => 'Data Fakultas',
				'text' => 'Data Fakultas Gagal di Update',
				'type' => 'error',
				'icon'  => 'error',
				'confirmButtonColor' => '#ff562f',
				'confirmButtonText' => 'Close',
			);
			$this->session->set_flashdata('message', $dataflash);
			redirect('superadmin/fakultas');
		}
	}
}
