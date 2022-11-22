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
        $data['vendors'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor', ['type' => 0])->result_array();
        $data['agents'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor', ['type' => 1])->result_array();
        $data['vendor_lengkap'] = $this->db->order_by('id_vendor', 'DESC')->get_where('tbl_vendor')->result_array();
        $this->backend->display('cs/v_js_detail', $data);
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
        );
        $insert = $this->db->insert('tbl_modal', $data);
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
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
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
        );
        $insert = $this->db->update('tbl_modal', $data, ['id_modal' => $this->input->post('id_modal')]);
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
            // log_aktifitas('update', 'tb_modal');
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/salesOrder/detail/' . $shipment_id);
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
        $data = array(
            'no_flight' => $this->input->post('no_flight'),
            'no_smu' => $this->input->post('no_smu'),
            'berat_js' => $total_weight,
            'weight' => $total_weight,
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
        $deadline_mgr_js = date('Y-m-d', strtotime('+1 days', strtotime($date)));
        $sql = $this->db->query("SELECT max(jobsheet_id) as kode FROM tbl_shp_order")->row_array();
        $no = $sql['kode'];
        // $potong = substr($no, 11, 9);
        $potongJS = ltrim($no, 'JS-');
        $potong = ltrim($potongJS, '0');
        $noUrut = $potong + 1;
        $kode  = "JS-$noUrut";
        // var_dump($kode);
        // die;
        $data = array(
            'status_so' => 2,
            'jobsheet_id' => $kode,
            'deadline_manager_cs' => $deadline_mgr_js
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
