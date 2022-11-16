<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobsheet extends CI_Controller
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
        $data['title'] = 'Enter Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Enter Jobsheet';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['total_users'] = $this->db->get('tb_user')->num_rows();
        $data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
        $data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
        $data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
        $data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
        $data['js'] = $this->cs->getJsApproveMgrCs()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('finance/v_js_approve', $data);
    }
    public function final()
    {
        $data['title'] = 'Jobsheet Final';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Jobsheet Final';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['total_users'] = $this->db->get('tb_user')->num_rows();
        $data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
        $data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
        $data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
        $data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
        $data['js'] = $this->cs->getJsApproveFinance()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('finance/v_js_final', $data);
    }

    public function detail($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        // $data['sales'] = $this->db->get_where('tbl_sales', ['id_msr' => $id])->result_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        // var_dump($data['modal']);
        // die;
        $this->backend->display('finance/v_js_detail_mgr', $data);
    }

    public function approveSo($id)
    {
        $data = array(
            'status_so' => 4,
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/jobsheet/');
        }
    }
    public function getData()
    {
        echo $this->cs->getJs();
    }
    public function messageAlert($type, $title)
    {
        $messageAlert = "
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})
			
			Toast.fire({
				icon: '$type',
				title: '$title'
			  })
			";
        return $messageAlert;
    }
}
