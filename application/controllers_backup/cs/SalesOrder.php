<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder extends CI_Controller
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
        $data['title'] = 'Sales Order';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Sales Order';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['total_users'] = $this->db->get('tb_user')->num_rows();
        $data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
        $data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
        $data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
        $data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
        $data['js'] = $this->cs->getJs()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('cs/v_js_masuk', $data);
    }
    public function revisiSo()
    {
        $data['title'] = 'List Revisi Sales Order';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Revisi Sales Order';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['total_users'] = $this->db->get('tb_user')->num_rows();
        $data['total_dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->num_rows();
        $data['total_mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5])->num_rows();
        $data['total_nonaktif'] = $this->db->get_where('tb_user', ['status' => 0])->num_rows();
        $data['activity'] = $this->db->order_by('id_log', 'desc')->get('tb_log_login')->result_array();
        $data['js'] = $this->cs->getRevisiJs()->result_array();
        $this->backend->display('cs/v_js_revisi', $data);
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
        $this->backend->display('cs/v_js_detail', $data);
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
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
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
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }

    public function updateso()
    {
        $shipment_id = $this->input->post('id');
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $this->input->post('berat_js'),
            'berat_msr' => $this->input->post('berat_msr'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }
    public function approve($id_request)
    {
        $data = array(
            'status' => 1,
        );
        $insert = $this->db->update('tbl_request_revisi', $data, ['id_request' => $id_request]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/revisiSo/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/revisiSo/');
        }
    }
    public function decline($id_request)
    {
        // decline cs
        $data = array(
            'status' => 4,
        );
        $insert = $this->db->update('tbl_request_revisi', $data, ['id_request' => $id_request]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/revisiSo/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/revisiSo/');
        }
    }


    public function prosesSo($id)
    {
        $sql = $this->db->query("SELECT max(jobsheet_id) as kode FROM tbl_shp_order")->row_array();
        $no = $sql['kode'];
        // $potong = substr($no, 11, 9);
        $potong = substr($no, 3);
        $noUrut = $potong + 1;
        $kode =  sprintf("%09s", $noUrut);
        $kode  = "JS-$kode";
        // var_dump($kode);
        // die;
        $data = array(
            'status_so' => 2,
            'jobsheet_id' => $kode
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            log_aktifitas('update', 'tbl_shp_order');
            $data = array(
                'shipment_id' => $id,
                'approve_cs' => $this->session->userdata('id_user'),
            );
            $this->db->insert('tbl_approve_so_cs', $data);
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
