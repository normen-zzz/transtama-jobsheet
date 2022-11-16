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
        $data['title'] = 'Jobsheet Approve';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Jobsheet Approve';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['total_users'] = $this->db->get('tb_user')->num_rows();
        $data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
        $data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
        $data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
        $data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
        $data['js'] = $this->cs->getJsApproveCs()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('cs/v_js_approve', $data);
    }
    public function add()
    {
        $breadcrumb_items = [];
        $data['subtitle'] = 'Add New MSR';
        $data['title'] = 'Add New MSR';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['service'] = $this->db->order_by('id_service', 'desc')->get('tbl_service')->result_array();
        $data['driver'] = $this->db->get_where('tb_user', ['id_role' => 5])->result_array();
        $data['marketing'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
        $this->backend->display('cs/v_js_add', $data);
    }
    public function edit($id)
    {
        $data['subtitle'] = 'Edit MSR';
        $data['title'] = 'Edit MSR';
        $data['service'] = $this->db->order_by('id_service', 'desc')->get('tbl_service')->result_array();
        $data['driver'] = $this->db->get_where('tb_user', ['id_role' => 5])->result_array();
        $data['marketing'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
        $data['msr'] = $this->db->get_where('tbl_msr', ['id_msr' => $id])->row_array();
        $this->backend->display('cs/v_js_edit', $data);
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
        $this->backend->display('cs/v_js_detail_mgr', $data);
    }
    public function addMsrAction()
    {
        $data = array(
            'tgl_pickup' => $this->input->post('tgl_pickup'),
            'no_stp' => $this->input->post('no_stp'),
            'customer' => $this->input->post('customer'),
            'alamat_customer' => $this->input->post('alamat_customer'),
            'no_telp' => $this->input->post('no_telp'),
            'consigne' => $this->input->post('consigne'),
            'destination' => $this->input->post('destination'),
            'service' => $this->input->post('service'),
            'comm' => $this->input->post('comm'),
            'petugas' => $this->input->post('petugas'),
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'colly' => $this->input->post('colly'),
            'berat_msr' => $this->input->post('berat_msr'),
            'berat_js' => $this->input->post('berat_js'),
            'freight_kg' => $this->input->post('freight_kg'),
            'sales' => $this->input->post('sales'),
            'keterangan' => $this->input->post('keterangan'),
            'kode' => $this->input->post('kode'),
            'status' => 0,
        );
        if ($this->db->insert('tbl_msr', $data)) {
            log_aktifitas('insert', 'tb_msr');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet');
        }
    }
    public function editMsrAction()
    {
        $data = array(
            'tgl_pickup' => $this->input->post('tgl_pickup'),
            'no_stp' => $this->input->post('no_stp'),
            'customer' => $this->input->post('customer'),
            'alamat_customer' => $this->input->post('alamat_customer'),
            'no_telp' => $this->input->post('no_telp'),
            'consigne' => $this->input->post('consigne'),
            'destination' => $this->input->post('destination'),
            'service' => $this->input->post('service'),
            'comm' => $this->input->post('comm'),
            'petugas' => $this->input->post('petugas'),
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'colly' => $this->input->post('colly'),
            'berat_msr' => $this->input->post('berat_msr'),
            'berat_js' => $this->input->post('berat_js'),
            'freight_kg' => $this->input->post('freight_kg'),
            'sales' => $this->input->post('sales'),
            'keterangan' => $this->input->post('keterangan'),
            'kode' => $this->input->post('kode'),
        );
        if ($this->db->update('tbl_msr', $data, ['id_msr' => $this->input->post('id_msr')])) {
            log_aktifitas('update', 'tb_msr');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet');
        }
    }

    public function addSalesCost()
    {
        $id_msr = $this->input->post('id_msr');
        $data = array(
            'packing' => $this->input->post('packing'),
            'others' => $this->input->post('others'),
            'surcharge' => $this->input->post('surcharge'),
            'insurance' => $this->input->post('insurance'),
            'disc' => $this->input->post('disc'),
            'cn' => $this->input->post('cn'),
            'id_msr' => $this->input->post('id_msr'),
        );
        if ($this->db->insert('tbl_sales', $data)) {
            log_aktifitas('insert', 'tb_sales');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $id_msr);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $id_msr);
        }
    }
    public function editSalesCost()
    {
        $id_msr = $this->input->post('id_msr');
        $id_sales = $this->input->post('id_sales');
        $data = array(
            'packing' => $this->input->post('packing'),
            'others' => $this->input->post('others'),
            'surcharge' => $this->input->post('surcharge'),
            'insurance' => $this->input->post('insurance'),
            'disc' => $this->input->post('disc'),
            'cn' => $this->input->post('cn'),
        );
        if ($this->db->update('tbl_sales', $data, ['id_sales' => $id_sales])) {
            log_aktifitas('update', 'tb_sales');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $id_msr);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $id_msr);
        }
    }
    public function addCapitalCost()
    {
        $shipment_id = $this->input->post('shipment_id');
        $data = array(
            'shipment_id' => $this->input->post('shipment_id'),
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
        );
        $insert = $this->db->insert('tbl_modal', $data);
        // var_dump($insert);
        // die;
        if ($insert) {
            log_aktifitas('insert', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
    }

    public function editCapitalCost()
    {
        $shipment_id = $this->input->post('shipment_id');
        $data = array(
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
        );
        $insert = $this->db->update('tbl_modal', $data, ['id_modal' => $this->input->post('id_modal')]);
        // var_dump($insert);
        // die;
        if ($insert) {
            log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
    }

    public function updateso()
    {
        $shipment_id = $this->input->post('id');
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

        if ($insert) {
            log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
    }

    public function prosesSo($id)
    {
        $data = array(
            'status_so' => 2,
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }
    public function approveSo($id)
    {
        $data = array(
            'status_so' => 3,
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
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
