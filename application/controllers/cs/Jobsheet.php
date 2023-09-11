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
        $this->load->model('Sendwa', 'wa');
        cek_role();
    }
    public function index()
    {
        $data['title'] = 'Jobsheet Approve PIC';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Jobsheet Approve PIC';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['js'] = $this->cs->getJsApproveCs()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('cs/v_js_approve', $data);
    }
    public function approveMgrFinance()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Jobsheet Approve Manager';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Jobsheet Approve Manager';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['js'] = $this->cs->getJsApproveMgrFinance()->result_array();

            $this->backend->display('cs/v_js_approve_mgrfinance', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['title'] = 'Jobsheet Approve Manager';
                $breadcrumb_items = [];
                $data['shipment_id'] = $shipment_id;
                $data['invoice'] = $cek_data;
                $data['subtitle'] = 'Jobsheet Approve Manager';

                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['js'] = $this->cs->getJsApproveMgrFinance()->result_array();

                $this->backend->display('cs/v_js_approve_mgrfinance', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'DO Number Not Found'));
                redirect('cs/jobsheet/final');
            }
        }
    }

    public function approveInvoice()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Jobsheet Approve Manager';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Jobsheet Approve Manager';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['js'] = $this->cs->getJsApproveInvoice()->result_array();

            $this->backend->display('cs/v_js_approve_mgrfinance', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['title'] = 'Jobsheet Approve Manager';
                $breadcrumb_items = [];
                $data['shipment_id'] = $shipment_id;
                $data['invoice'] = $cek_data;
                $data['subtitle'] = 'Jobsheet Approve Manager';

                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['js'] = $this->cs->getJsApproveInvoice()->result_array();

                $this->backend->display('cs/v_js_approve_mgrfinance', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'DO Number Not Found'));
                redirect('cs/jobsheet/final');
            }
        }
    }

    public function final()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Jobsheet Approve Manager';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Jobsheet Approve Manager';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['js'] = $this->cs->getJsApproveMgrCs()->result_array();

            $this->backend->display('cs/v_js_approve_manager', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['title'] = 'Jobsheet Approve Manager';
                $breadcrumb_items = [];
                $data['shipment_id'] = $shipment_id;
                $data['invoice'] = $cek_data;
                $data['subtitle'] = 'Jobsheet Approve Manager';

                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['js'] = $this->cs->getJsApproveMgrCs()->result_array();

                $this->backend->display('cs/v_js_approve_manager', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'DO Number Not Found'));
                redirect('cs/jobsheet/final');
            }
        }
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
        $data['vendors'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor', ['type' => 0])->result_array();
        $data['agents'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor', ['type' => 1])->result_array();
        $data['vendor_selected'] = $this->cs->getVendorByShipment($id)->result_array();
        $data['vendor_lengkap'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor')->result_array();
        $this->backend->display('cs/v_js_detail_mgr', $data);
    }
    public function cekResi()
    {
        if ($this->input->post('shipment_id') == NULL) {
            $data['title'] = 'CEK RESI';
            $data['resi'] = NULL;
            $data['shipment'] = NULL;
            $this->backend->display('cs/v_cek_resi', $data);
        } else {
            $resi = $this->db->query("SELECT shipper,consigne,tgl_pickup,tgl_diterima,status_so,id FROM tbl_shp_order WHERE shipment_id = ".$this->input->post('shipment_id')." ")->row_array();
            $poExternal = $this->db->query("SELECT no_po,id_vendor,unique_invoice FROM tbl_invoice_ap_final WHERE shipment_id = ".$resi['id']." ");
            $data['title'] = 'CEK RESI';
            $data['resi'] = $this->input->post('shipment_id');
            // $data['shipment'] = $this->db->get_where('tbl_shp_order', array('shipment_id' => $this->input->post('shipment_id')))->row_array();
            $data['shipment'] = $resi;
            $data['invoice'] = $this->db->query("SELECT status,no_invoice FROM tbl_invoice WHERE shipment_id = ".$resi['id']." ")->row_array();
            if ($poExternal->num_rows() != NULL) {
                $data['Po'] = $poExternal->row_array();
            }

            $this->backend->display('cs/v_cek_resi', $data);
        }
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
        $vendor = $this->input->post('vendor');
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
            for ($i = 0; $i < sizeof($vendor); $i++) {
                if ($vendor[$i] == 0) {
                } else {
                    $cek_shipment_id = $this->db->get_where('tbl_invoice_ap', ['shipment_id' => $this->input->post('shipment_id'), 'id_vendor' => $vendor[$i]])->row_array();
                    $data = array(
                        'id_vendor' => $vendor[$i],
                        'shipment_id' => $this->input->post('shipment_id'),
                        'status' => 0,
                        'id_user' => $this->session->userdata('id_user')
                    );
                    if ($cek_shipment_id) {
                        break;
                    } else {
                        $this->db->insert('tbl_invoice_ap', $data);
                    }
                }
            }
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
            'packing' => $this->input->post('packing'),
            'others' => $this->input->post('others'),
            'surcharge' => $this->input->post('surcharge'),
            'insurance' => $this->input->post('insurance'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

        if ($insert) {
            // log_aktifitas('update', 'tbl_shp_order');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
    }


    public function updateso()
    {
        $id_do = $this->input->post('id_do');
        if ($id_do == NULL) {
            $total_weight = $this->input->post('berat_js');
        } else {
            $total_weight = 0;
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
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
            'berat_msr' => $this->input->post('berat_msr'),
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $this->input->post('id')]);

        if ($insert) {
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
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }
    public function approveSo($id)
    {
        $date = date('Y-m-d');
        $deadline_finance = date('Y-m-d', strtotime('+2 days', strtotime($date)));
        $data = array(
            'status_so' => 3,
            'deadline_finance' => $deadline_finance
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

        $approveRevisiSo = $this->db->query("SELECT shipment_id FROM tbl_approve_revisi_so WHERE shipment_id = $id");

        if ($approveRevisiSo == NULL) {
            $data = array(
                'shipment_id' => $id,
                'id_user_cs' => $this->session->userdata('id_user')
            );
            $this->db->insert('tbl_approve_revisi_so', $data);
        }

        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_mgr' => $this->session->userdata('id_user'),
                'tgl_approve_mgr_cs' => date('Y-m-d H:i:s'),
                'status_approve_cs' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);

            $link = "https://jobsheet.transtama.com/approval/detailRevisiGm/$id";
            $pesan = "Hallo, Mohon Untuk dicek dan di Approve Pengajuan Revisi SO Melalu Link Berikut : $link";
            //no mba Vema dan Norman
            $this->wa->pickup('+628111910711', "$pesan");
            $this->wa->pickup('+6285697780467', "$pesan");


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
            $this->db->update('tbl_request_revisi', array('status' => 4), ['shipment_id' => $id]);
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
            $this->db->update('tbl_request_revisi', array('status' => 4), ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/');
        }
    }
    public function approveRevisiGm($id)
    {
        $data = array(
            'status_revisi' => 7,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $get_new_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
            $get_old_so = $this->db->get_where('tbl_shp_order', ['id' => $id])->row_array();
            $data = array(
                'freight_kg' => $get_new_so['freight_baru'],
                'packing' => $get_new_so['packing_baru'],
                'special_freight' => $get_new_so['special_freight_baru'],
                'others' => $get_new_so['others_baru'],
                'surcharge' => $get_new_so['surcharge_baru'],
                'insurance' => $get_new_so['insurance_baru'],
                'disc' => $get_new_so['disc_baru'],
                'cn' => $get_new_so['cn_baru'],
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $id]);
            $data = array(
                'freight_lama' => $get_old_so['freight_kg'],
                'packing_lama' => $get_old_so['packing'],
                'special_freight_lama' => $get_old_so['special_freight'],
                'others_lama' => $get_old_so['others'],
                'surcharge_lama' => $get_old_so['surcharge'],
                'insurance_lama' => $get_old_so['insurance'],
                'disc_lama' => $get_old_so['disc'],
                'cn_lama' => $get_old_so['cn'],
                'shipment_id' => $id,
            );
            $this->db->insert('tbl_revisi_so_lama', $data);
            $data = array(
                'id_sm' => $this->session->userdata('id_user'),
                'tgl_approve_sm' => date('Y-m-d H:i:s'),
                'status_approve_sm' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detailRevisi/' . $id);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detailRevisi/' . $id);
        }
    }
    public function declineRevisiSm($id)
    {
        $data = array(
            'status_revisi' => 8,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);


        if ($update) {
            $data = array(
                'id_sm' => $this->session->userdata('id_user'),
                'tgl_approve_sm' => date('Y-m-d H:i:s'),
                'status_approve_sm' => 0
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $this->db->update('tbl_request_revisi', array('status' => 4), ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/detailRevisi/' . $id);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detailRevisi/' . $id);
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

    public function addRequestAktivasi()
    {
        $data = array(
            'shipment_id' => $this->input->post('shipment_id'),
            'reason' => $this->input->post('reason'),
            'request_by' => $this->session->userdata('nama_user'),
            'is_atasan' => 1,
            'id_role' => $this->session->userdata('id_role'),
        );
        $insert = $this->db->insert('tbl_aktivasi_cs', $data);
        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Request Submitted</div>');
            redirect('cs/jobsheet/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Request Failed</div>');
            redirect('cs/jobsheet/');
        }
    }
    // get revisi JS
    public function requestAktivasi()
    {
        $data['title'] = 'Request Aktivasi Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Request Aktivasi Jobsheet';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRequestAktivasiJs()->result_array();
        $this->backend->display('cs/v_request_js', $data);
    }

    // get revisi JS Need Activate
    public function requestAktivasiNeedActivate()
    {
        $data['title'] = 'Request Aktivasi Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Request Aktivasi Jobsheet';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRequestAktivasiJs()->result_array();
        $this->backend->display('cs/v_request_js_need_activate', $data);
    }

    public function approveAktivasi($id_request, $shipment_id, $is_atasan, $id_role)
    {
        $date = date('Y-m-d');
        $deadline = date('Y-m-d', strtotime('+1 days', strtotime($date)));
        $is_atasan = decrypt_url($is_atasan);
        // kalo dia pic js
        // kalo dia finance
        if ($id_role == 6) {
            $data_deadline = array(
                'deadline_finance' =>  $deadline
            );
        } else {
            if ($is_atasan == 0) {
                $data_deadline = array(
                    'deadline_pic_js' =>  $deadline
                );
            } else {
                $data_deadline = array(
                    'deadline_manager_cs' =>  $deadline
                );
            }
        }
        $data = array(
            'status' => 1,
            'aktivasi_at' => date('Y-m-d H:i:s'),
        );
        $update = $this->db->update('tbl_aktivasi_cs', $data, ['id_aktivasi' => $id_request]);
        if ($update) {
            $this->db->update('tbl_shp_order', $data_deadline, ['id' => $shipment_id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/jobsheet/requestAktivasi/');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/requestAktivasi/');
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
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
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
            redirect('cs/jobsheet/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/jobsheet/detail/' . $shipment_id);
        }
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
