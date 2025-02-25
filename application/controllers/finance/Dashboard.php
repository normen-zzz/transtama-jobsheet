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
		$this->load->model('ApModel', 'ap');
		cek_role();
	}
	public function index()
	{
		$breadcrumb_items = [];
		$data['subtitle'] = 'Dashboard';
		// $data['sub_header_page'] = 'exist';
		$this->breadcrumb->add_item($breadcrumb_items);
		$data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['so'] = $this->cs->getAll()->num_rows();
		$data['js'] = $this->cs->getJsApproveFinance()->num_rows();
		$data['proforma'] = $this->cs->getProformaInvoice()->num_rows();
		$data['invoice'] = $this->cs->getProformaInvoiceFinal()->num_rows();
		$data['invoice_paid'] = $this->cs->getProformaInvoicePaid()->num_rows();
		// 
		$data['title'] = 'Dashboard';

		$id_atasan = $this->session->userdata('id_atasan');
		if ($id_atasan == NULL || $id_atasan == 0) {
			$data['po'] = $this->ap->getApByCategoryStatusFinance(1)->num_rows();
			$data['ca'] = $this->ap->getApByCategoryStatusFinance(2)->num_rows();
			$data['car'] = $this->ap->getApByCategoryStatusFinance(3)->num_rows();
			$data['re'] = $this->ap->getApByCategoryStatusFinance(4)->num_rows();
			$data['po_ex'] = $this->cs->getTotalApVendorFinanceApprove()->num_rows();
			$this->backend->display('finance/index_atasan', $data);
		} else {
			$data['po'] = $this->ap->getApByCategoryStatusSm(1)->num_rows();
			$data['ca'] = $this->ap->getApByCategoryStatusSm(2)->num_rows();
			$data['car'] = $this->ap->getApByCategoryStatusSm(3)->num_rows();
			$data['re'] = $this->ap->getApByCategoryStatusSm(4)->num_rows();
			$data['po_ex'] = $this->cs->getTotalApVendorIn()->num_rows();
			$this->backend->display('finance/index', $data);
		}
	}
}
