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
        $data['title'] = 'Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Jobsheet';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['js'] = $this->cs->getAllAdmin()->result_array();
        $this->backend->display('superadmin/v_js_approve_manager', $data);
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
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        // var_dump($data['modal']);
        // die;
        $this->backend->display('superadmin/v_js_detail_mgr', $data);
    }
    public function detailRevisi($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        $data['request'] = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
        $data['request_revisi'] = $this->db->get_where('tbl_request_revisi', ['shipment_id' => $id])->row_array();
        $data['so_lama'] = $this->db->get_where('tbl_revisi_so_lama', ['shipment_id' => $id])->row_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $this->backend->display('cs/v_detail_revisi', $data);
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
            // log_aktifitas('insert', 'tb_msr');
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
            // log_aktifitas('update', 'tb_msr');
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
            // log_aktifitas('insert', 'tb_sales');
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
            // log_aktifitas('update', 'tb_sales');
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
            'others2' => $this->input->post('others2'),
            'note_mgr_cs' => $this->input->post('note_mgr_cs'),
        );
        $insert = $this->db->insert('tbl_modal', $data);
        // var_dump($insert);
        // die;
        if ($insert) {
            // log_aktifitas('insert', 'tb_modal');
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
            'others2' => $this->input->post('others2'),
            'note_mgr_cs' => $this->input->post('note_mgr_cs'),
        );
        $insert = $this->db->update('tbl_modal', $data, ['id_modal' => $this->input->post('id_modal')]);
        // var_dump($insert);
        // die;
        if ($insert) {
            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
    }
    public function updateSalesCost()
    {
        $shipment_id = $this->input->post('id');
        $data = array(
            'freight_kg' => $this->input->post('freight_kg'),
            'special_freight' => $this->input->post('special_freight'),
            'packing' => $this->input->post('packing'),
            'others' => $this->input->post('others'),
            'surcharge' => $this->input->post('surcharge'),
            'insurance' => $this->input->post('insurance'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('superadmin/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('superadmin/jobsheet/detail/' . $shipment_id);
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
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('superadmin/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('superadmin/jobsheet/detail/' . $shipment_id);
        }
    }

    public function prosesSo($id)
    {
        $data = array(
            'status_so' => 2,
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);
        if ($insert) {
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
            $data = array(
                'approve_mgr_cs' => $this->session->userdata('id_user'),
                'approve_mgr_cs_date' => date('Y-m-d H:i:s')
            );
            $this->db->update('tbl_approve_so_cs', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }
    public function approveRevisiCs($id)
    {
        $data = array(
            'status_revisi' => 1,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'shipment_id' => $id,
                'id_user_cs' => $this->session->userdata('id_user')
            );
            $this->db->insert('tbl_approve_revisi_so', $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/viewRevisiSo');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/viewRevisiSo');
        }
    }
    public function approveRevisiMgrCs($id)
    {
        $data = array(
            'status_revisi' => 2,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_mgr' => $this->session->userdata('id_user'),
                'tgl_approve_mgr_cs' => date('Y-m-d H:i:s'),
                'status_approve_cs' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/viewRevisiSo');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/viewRevisiSo');
        }
    }
    public function declineRevisiMgrCs()
    {
        $id = $this->input->post('id');
        // var_dump($id);
        // die;
        $data = array(
            'status_revisi' => 5,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_mgr' => $this->session->userdata('id_user'),
                'tgl_approve_mgr_cs' => date('Y-m-d H:i:s'),
                'note_mgr_cs' => $this->input->post('note_mgr'),
                'status_approve_cs' => 0
                // 0 = decline
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }
    public function declineRevisiCs($id)
    {
        $data = array(
            'status_revisi' => 4,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'shipment_id' => $id,
                'id_user_cs' => $this->session->userdata('id_user')
            );
            $this->db->insert('tbl_approve_revisi_so', $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }

    public function cetakSo($id, $id_so)
    {
        $where = array('id' => $id);
        $data['order'] = $this->db->get_where('tbl_shp_order', $where)->row_array();
        $where2 = array('code' => $data['order']['service_type']);
        $data['service'] = $this->db->get_where('tb_service_type', $where2)->row_array();
        $data['sales'] = $this->cs->getNamaSales($id_so)->row_array();
        $data['manager_sales'] = $this->cs->getNamaManagerSales($id_so)->row_array();
        $data['tgl_approve_mgr_sales'] = $this->db->select('created_at_manager')->get_where('tbl_approve_so', ['id_so' => $id_so])->row_array();
        $data['approve'] = $this->cs->getApproveSo($id)->row_array();
        // var_dump($data['tgl_approve_mgr_sales']);
        // die;

        $this->load->view('cs/v_cetak_so', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A5", 'landscape');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        // return $this->dompdf->output();
        $output = $this->dompdf->output();
        ob_end_clean();
        // file_put_contents('uploads/barcode' . '/' . "$shipment_id.pdf", $output);
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
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
