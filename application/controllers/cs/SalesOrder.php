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
		 $this->load->model('Sendwa', 'wa');
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

       
        $data['js'] = $this->cs->getJs()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('cs/v_js_masuk', $data);
    }
    public function revisiSo()
    {
        $data['title'] = 'List Request Revisi Sales Order';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Request Revisi Sales Order';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRevisiJs()->result_array();
        $this->backend->display('cs/v_js_revisi', $data);
    }

    public function revisiSoNeedApprove()
    {
        $data['title'] = 'List Request Revisi Sales Order (Need Approve)';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Request Revisi Sales Order (Need Approve)';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRevisiJs()->result_array();
        $this->backend->display('cs/v_js_revisi_need_approve', $data);
    }
    public function viewRevisiSo()
    {
        $data['title'] = 'List Revisi Sales Order';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Revisi Sales Order';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRevisiSoNew()->result_array();
        $this->backend->display('cs/v_js_revisi_so', $data);
    }

    public function viewRevisiSoNeedApprove()
    {
        $data['title'] = 'List Revisi Sales Order';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Revisi Sales Order';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRevisiSoNew()->result_array();
        $this->backend->display('cs/v_js_revisi_so_need_approve', $data);
    }
    public function detail($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $data['vendor_selected'] = $this->cs->getVendorByShipment($id)->result_array();
        $data['vendors'] = $this->db->order_by('id_vendor', 'DESC')->get('tbl_vendor')->result_array();
        // $data['agents'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor', ['type' => 1])->result_array();
        $data['vendor_lengkap'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor')->result_array();
        $this->backend->display('cs/v_js_detail', $data);
    }
	
	public function addCapitalCostCekResi()
    {
        $shipment_id = $this->input->post('shipment_id');
        $vendor = $this->input->post('vendor');

        $data = array(
            'shipment_id' => $this->input->post('shipment_id'),
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'specialrefund2' => $this->input->post('specialrefund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
            'others2' => $this->input->post('others2'),
            'note' => $this->input->post('note'),
            'id_vendor' => $vendor
        );
        $insert = $this->db->insert('tbl_modal', $data);
        if ($insert) {
            $data = array(
                'id_vendor' => $vendor,
                'shipment_id' => $this->input->post('shipment_id'),
                'status' => 0,
                'id_user' => $this->session->userdata('id_user')
            );

            $this->db->insert('tbl_invoice_ap', $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        }
    }

    public function addCapitalCost()
    {
        $shipment_id = $this->input->post('shipment_id');
        $vendor = $this->input->post('vendor');

        $data = array(
            'shipment_id' => $this->input->post('shipment_id'),
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'specialrefund2' => $this->input->post('specialrefund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
            'others2' => $this->input->post('others2'),
            'note' => $this->input->post('note'),
            'id_vendor' => $vendor
        );
        $insert = $this->db->insert('tbl_modal', $data);
        if ($insert) {
            $data = array(
                'id_vendor' => $vendor,
                'shipment_id' => $this->input->post('shipment_id'),
                'status' => 0,
                'id_user' => $this->session->userdata('id_user')
            );

            $this->db->insert('tbl_invoice_ap', $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }
	
	public function editCapitalCostCekResi()
    {
        $shipment_id = $this->input->post('shipment_id');
        $vendor = $this->input->post('vendor');
        $vendor_awal = $this->input->post('id_vendor_awal');
        $data = array(
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'specialrefund2' => $this->input->post('specialrefund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
            'others2' => $this->input->post('others2'),
            'note' => $this->input->post('note'),
            'id_vendor' => $vendor
        );
        $update = $this->db->update('tbl_modal', $data, ['id_modal' => $this->input->post('id_modal')]);
        if ($update) {
            $data = array(
                'id_vendor' => $vendor,
                'id_user' => $this->session->userdata('id_user')
            );

            $this->db->update('tbl_invoice_ap', $data, array('id_vendor' => $vendor_awal, 'shipment_id' => $shipment_id));



            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        }
    }

    public function editCapitalCost()
    {
        $shipment_id = $this->input->post('shipment_id');
        $vendor = $this->input->post('vendor');
        $vendor_awal = $this->input->post('id_vendor_awal');
        $data = array(
            'flight_msu2' => $this->input->post('flight_smu2'),
            'ra2' => $this->input->post('ra2'),
            'packing2' => $this->input->post('packing2'),
            'refund2' => $this->input->post('refund2'),
            'specialrefund2' => $this->input->post('specialrefund2'),
            'insurance2' => $this->input->post('insurance2'),
            'surcharge2' => $this->input->post('surcharge2'),
            'hand_cgk2' => $this->input->post('hand_cgk2'),
            'hand_pickup2' => $this->input->post('hand_pickup2'),
            'hd_daerah2' => $this->input->post('hd_daerah2'),
            'pph2' => $this->input->post('pph2'),
            'sdm2' => $this->input->post('sdm2'),
            'others2' => $this->input->post('others2'),
            'note' => $this->input->post('note'),
            'id_vendor' => $vendor
        );
        $update = $this->db->update('tbl_modal', $data, ['id_modal' => $this->input->post('id_modal')]);
        if ($update) {
            $data = array(
                'id_vendor' => $vendor,
                'id_user' => $this->session->userdata('id_user')
            );

            $this->db->update('tbl_invoice_ap', $data, array('id_vendor' => $vendor_awal, 'shipment_id' => $shipment_id));



            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }
	
	public function updateSoCekResi()
    {

        $id_do = $this->input->post('id_do');
        $total_weight = 0;
        if ($id_do == NULL) {
            $total_weight = $this->input->post('berat_js');
        } else {
            $weight = $this->input->post('weight');
            for ($i = 0; $i < sizeof($id_do); $i++) {
                $data = array(
                    'berat' => $weight[$i],
                );
                $this->db->update('tbl_no_do', $data, ['id_berat' => $id_do[$i]]);
                $total_weight += $weight[$i];
            }
        }

        $shipment_id = $this->input->post('id');
        $dataSebelum = $this->db->query('SELECT no_flight,no_smu,berat_js,weight,berat_msr FROM tbl_shp_order WHERE id = ' . $shipment_id . ' ')->row_array();
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
            'berat_msr' => $this->input->post('berat_msr'),
        );
        $dataHistoryFrom = [
            'shipment_id' => $shipment_id,
            'as' => 0,
            'no_flight' => $dataSebelum['no_flight'],
            'no_smu' => $dataSebelum['no_smu'],
            'berat_js' => $dataSebelum['berat_js'],
            'weight' => $dataSebelum['weight'],
            'berat_msr' => $dataSebelum['berat_msr'],
            'created_by' => $this->session->userdata('id_user')
        ];

        $insertHistoryFrom = $this->db->insert('history_beratjs', $dataHistoryFrom);
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);
        $dataHistoryTo = [
            'shipment_id' => $shipment_id,
            'as' => 1,
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
            'berat_msr' => $this->input->post('berat_msr'),
            'created_by' => $this->session->userdata('id_user')
        ];
        $insertHistoryTo = $this->db->insert('history_beratjs', $dataHistoryTo);


        if ($insert && $insertHistoryFrom && $insertHistoryTo) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        }
    }


   public function updateso()
    {

        $id_do = $this->input->post('id_do');
        $total_weight = 0;
        if ($id_do == NULL) {
            $total_weight = $this->input->post('berat_js');
        } else {
            $weight = $this->input->post('weight');
            for ($i = 0; $i < sizeof($id_do); $i++) {
                $data = array(
                    'berat' => $weight[$i],
                );
                $this->db->update('tbl_no_do', $data, ['id_berat' => $id_do[$i]]);
                $total_weight += $weight[$i];
            }
        }

        $shipment_id = $this->input->post('id');
        $dataSebelum = $this->db->query('SELECT no_flight,no_smu,berat_js,weight,berat_msr FROM tbl_shp_order WHERE id = ' . $shipment_id . ' ')->row_array();
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
            'berat_msr' => $this->input->post('berat_msr'),
        );




        $dataHistoryFrom = [
            'shipment_id' => $shipment_id,
            'as' => 0,
            'no_flight' => $dataSebelum['no_flight'],
            'no_smu' => $dataSebelum['no_smu'],
            'berat_js' => $dataSebelum['berat_js'],
            'weight' => $dataSebelum['weight'],
            'berat_msr' => $dataSebelum['berat_msr'],
            'created_by' => $this->session->userdata('id_user')
        ];

        $insertHistoryFrom = $this->db->insert('history_beratjs', $dataHistoryFrom);
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);
        $dataHistoryTo = [
            'shipment_id' => $shipment_id,
            'as' => 1,
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
            'berat_msr' => $this->input->post('berat_msr'),
            'created_by' => $this->session->userdata('id_user')
        ];
        $insertHistoryTo = $this->db->insert('history_beratjs', $dataHistoryTo);


        if ($insert && $insertHistoryFrom && $insertHistoryTo) {


            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }

    // public function updateso()
    // {

    //     $id_do = $this->input->post('id_do');
    //     if ($id_do == NULL) {
    //         $total_weight = $this->input->post('berat_js');
    //     } else {
    //         $total_weight = 0;
    //         $weight = $this->input->post('weight');
    //         for ($i = 0; $i < sizeof($id_do); $i++) {
    //             $data = array(
    //                 'berat' => $weight[$i],
    //             );
    //             $this->db->update('tbl_no_do', $data, ['id_berat' => $id_do[$i]]);
    //             $total_weight += $weight[$i];
    //         }
    //     }


    //     $shipment_id = $this->input->post('id');
    //     $data = array(
    //         'no_flight' => $this->input->post('no_flight'),
    //         'no_smu' => $this->input->post('no_smu'),
    //         'berat_js' => $total_weight,
    //         'berat_msr' => $this->input->post('berat_msr'),
    //     );
    //     $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

    //     if ($insert) {
    //         // log_aktifitas('update', 'tbl_shp_order');
    //         $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
    //         redirect('cs/salesOrder/detail/' . $shipment_id);
    //     } else {

    //         $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
    //         redirect('cs/salesOrder/detail/' . $shipment_id);
    //     }
    // }
	
	public function updateSalesCostCekResi()
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
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/Jobsheet/detailCekResi/' . $shipment_id);
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
        $date = date('Y-m-d');
        $deadline_mgr_js = date('Y-m-d', strtotime('+2 days', strtotime($date)));
        $sql = $this->db->query("SELECT max(jobsheet_id) as kode FROM tbl_shp_order")->row_array();
        $no = $sql['kode'];
        // $potong = substr($no, 11, 9);
        $potongJS = ltrim($no, 'JS-');
        
        $noUrut = $potongJS + 1;
        $kode  = "JS-$noUrut";
        // var_dump($kode);
        // die;
        $data = array(
            'status_so' => 2,
            'jobsheet_id' => $kode,
            'deadline_manager_cs' => $deadline_mgr_js,
            'create_js_at' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
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

    // get revisi SO
    public function requestAktivasi()
    {
        $data['title'] = 'Request Aktivasi SO';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Request Aktivasi SO';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRequestAktivasi()->result_array();

        $this->backend->display('cs/v_request_so', $data);
    }

    public function requestAktivasiNeedActivate()
    {
        $data['title'] = 'Request Aktivasi SO (Need Activate)';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Request Aktivasi SO (Need Activate)';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRequestAktivasi()->result_array();

        $this->backend->display('cs/v_request_so_need_activate', $data);
    }

    public function approveAktivasi($id_request, $id_so)
    {
        $date = date('Y-m-d');
        $deadline_sales = date('Y-m-d', strtotime('+1 days', strtotime($date)));
        $data = array(
            'status' => 1,
            'aktivasi_at' => date('Y-m-d H:i:s'),
            'is_atasan' => 0
        );
        $update = $this->db->update('tbl_aktivasi_so', $data, ['id_aktivasi' => $id_request]);
        if ($update) {
            $data = array(
                'deadline_sales_so' =>  $deadline_sales
            );
            $this->db->update('tbl_so', $data, ['id_so' => $id_so]);
            $so = $this->db->query("SELECT * FROM tbl_so WHERE id_so = $id_so")->row_array();
            $listSo = '\r\n' . $so['shipper'] . ' Tanggal Pickup: ' . $so['tgl_pickup'];
            $user = $this->db->query("SELECT nama_user,no_hp FROM tb_user WHERE id_user = " . $so['id_sales'] . " ")->row_array();
            $pesan = "Halo " . $user['nama_user'] . ", SO anda Telah diaktivasi, Berikut So yang terlampir $listSo";
            $this->wa->pickup('+' . $user['no_hp'], "$pesan");
            $this->wa->pickup('+6285697780467', "$pesan"); //nomor it norman
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/requestAktivasi/');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/requestAktivasi/');
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

    public function addRequestAktivasi()
    {
        $data = array(
            'shipment_id' => $this->input->post('shipment_id'),
            'reason' => $this->input->post('reason'),
            'request_by' => $this->session->userdata('nama_user'),
            'id_role' => $this->session->userdata('id_role'),
        );
        $insert = $this->db->insert('tbl_aktivasi_cs', $data);
        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Request Submitted</div>');
            redirect('cs/salesOrder/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Request Failed</div>');
            redirect('cs/salesOrder/');
        }
    }
	
	public function editVendorCekResi()
    {
        $shipment_id = $this->input->post('shipment_id');
        $data = array(
            'id_vendor' => $this->input->post('vendor'),
        );
        $insert = $this->db->update('tbl_invoice_ap', $data, ['id_invoice' => $this->input->post('id_invoice')]);
        // var_dump($insert);
        // die;
        if ($insert) {
            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detailCekResi/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detailCekResi/' . $shipment_id);
        }
    }

    public function editVendor()
    {
        $shipment_id = $this->input->post('shipment_id');
        $data = array(
            'id_vendor' => $this->input->post('vendor'),
        );
        $insert = $this->db->update('tbl_invoice_ap', $data, ['id_invoice' => $this->input->post('id_invoice')]);
        // var_dump($insert);
        // die;
        if ($insert) {
            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }

    public function deleteVendor($shipment_id, $id_vendor)
    {

        $delete = $this->db->delete('tbl_invoice_ap',  ['id_invoice' => $id_vendor]);
        // var_dump($delete);
        // die;
        if ($delete) {
            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        }
    }
}
