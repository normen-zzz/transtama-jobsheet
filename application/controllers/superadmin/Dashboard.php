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
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		cek_role();
	}
	public function index()
	{
		$breadcrumb_items = [];
		$data['subtitle'] = 'Dashboard';
		// $data['sub_header_page'] = 'exist';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['so'] = $this->cs->getJsApproveMgrCs()->num_rows();
		$data['js'] = $this->cs->getJsApproveFinance()->num_rows();
		$data['proforma'] = $this->cs->getProformaInvoice()->num_rows();
		$data['invoice'] = $this->cs->getProformaInvoiceFinal()->num_rows();
		$data['invoice_paid'] = $this->cs->getProformaInvoicePaid()->num_rows();
		$data['title'] = 'Dashboard';
		$this->backend->display('superadmin/index', $data);
	}
}
