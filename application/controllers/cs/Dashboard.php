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
		$this->load->library('breadcrumb');
		$this->load->model('M_Datatables');
		$this->load->model('CsModel', 'cs');
		cek_role();
	}
	public function index()
	{
		$breadcrumb_items = [];
		$data['subtitle'] = 'Dashboard';
		// $data['sub_header_page'] = 'exist';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['so'] = $this->cs->getJs()->num_rows();
		$data['js'] = $this->cs->getJsApproveCs()->num_rows();
		$data['title'] = 'Dashboard';
		$this->backend->display('cs/index', $data);
	}
}
