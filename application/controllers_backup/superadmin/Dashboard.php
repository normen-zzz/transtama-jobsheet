<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('backoffice');
		}
		$this->load->model('M_matakuliah', 'matakuliah');
		$this->load->model('ChatModel', 'chat');
		$this->load->model('M_log', 'logs');
		$this->load->model('M_KalenderAkademik', 'kalender');
		$this->load->library('breadcrumb');
		cek_role();
	}
	public function index()
	{
		$breadcrumb_items = [];
		$data['subtitle'] = 'Dashboard';
		$data['title'] = 'Dashboard';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['total_users'] = $this->db->get('tb_user')->num_rows();
		$data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
		$data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
		$data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
		$data['keseluruhan'] = $this->db->get_where('tb_invoice_keseluruhan', ['status' => 1])->num_rows();
		$data['paid'] = 1;
		$data['confirmed'] = 2;
		$data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
		$data['nunggak'] = 4;

		$this->backend->display('superadmin/index', $data);
	}
}
