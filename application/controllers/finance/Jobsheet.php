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
        $data['title'] = 'Enter Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Enter Jobsheet';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $customer = $this->input->post('customer');

        if ($customer == NULL) {
            $data['customer'] = $customer;
            $data['customers'] = $this->db->get('tb_customer')->result_array();
            $data['js'] = $this->cs->getAll()->result_array();
            $this->backend->display('finance/v_js_approve', $data);
        } else {
            $data['customer'] = $customer;
            $data['customers'] = $this->db->get('tb_customer')->result_array();
            $data['js'] = $this->cs->getAll($customer)->result_array();
            $this->backend->display('finance/v_js_approve', $data);
        }
    }
    public function final()
    {
        $data['title'] = 'Jobsheet Final';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Jobsheet Final';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getJsApproveFinance()->result_array();
        // var_dump($data['js']);
        // die;
        $this->backend->display('finance/v_js_final', $data);
    }
    public function viewRevisiSo()
    {
        $data['title'] = 'List Revisi Jobsheet';
        $breadcrumb_items = [];
        $data['subtitle'] = 'List Revisi Jobsheet';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['js'] = $this->cs->getRevisiSoNew()->result_array();
        $this->backend->display('finance/v_js_revisi_so', $data);
    }

    public function detail($id, $id_so)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        // $data['sales'] = $this->db->get_where('tbl_sales', ['id_msr' => $id])->result_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $data['approve_managerial'] = $this->db->get_where('tbl_approve_so_cs', ['shipment_id' => $id])->row_array();
        $data['approve_manager_sales'] = $this->db->get_where('tbl_approve_so', ['id_so' => $id_so])->row_array();
        // var_dump($data['modal']);
        // die;
        $this->backend->display('finance/v_js_detail_mgr', $data);
    }
    public function detailRevisi($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        $data['request'] = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
        $data['request_revisi'] = $this->db->get_where('tbl_request_revisi', ['shipment_id' => $id])->row_array();
        $data['so_lama'] = $this->db->get_where('tbl_revisi_so_lama', ['shipment_id' => $id])->row_array();
        // var_dump($data['so_lama']);
        // die;
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $this->backend->display('finance/v_detail_revisi', $data);
    }
    public function approveRevisiGm($id)
    {
        $data = array(
            'status_revisi' => 3,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_gm' => $this->session->userdata('id_user'),
                'tgl_approve_gm' => date('Y-m-d H:i:s'),
                'status_approve_gm' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $link = "https://jobsheet.transtama.com/approval/detailRevisiSm/$id";
            $pesan = "Hallo, Mohon Untuk dicek dan di Approve Pengajuan Revisi SO Melalu Link Berikut : $link";
            // no sam
            // $this->wa->pickup('+628111910711', "$pesan");
            $this->wa->pickup('+6281808008082', "$pesan");
            // No Norman
            $this->wa->pickup('+6285697780467', "$pesan");



            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/jobsheet/final');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/jobsheet/final');
        }
    }
    public function declineRevisiGm($id)
    {
        $data = array(
            'status_revisi' => 6,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_gm' => $this->session->userdata('id_user'),
                'tgl_approve_gm' => date('Y-m-d H:i:s'),
                'status_approve_gm' => 0
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/jobsheet/final');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/jobsheet/final');
        }
    }

    public function approveSo($id)
    {
        $data = array(
            'status_so' => 4,
        );
        $insert = $this->db->update('tbl_shp_order', $data, ['id' => $id]);

        if ($insert) {
            $data = array(
                'approve_finance' => $this->session->userdata('id_user'),
                'created_at_finance' => date('Y-m-d H:i:s')
            );
            $this->db->update('tbl_approve_so_cs', $data, ['shipment_id' => $id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/jobsheet/');
        } else {

            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/jobsheet/');
        }
    }
    public function Exportexcel($id)
    {
        $detail = $this->db->get_where('tbl_shp_order', ['id' => $id])->row_array();
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-invoice-$detail[shipment_id].xls");
        $data['title'] = "Invoice";
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();

        $this->load->view('finance/export_invoice', $data);
    }
    public function downloadByCustomer($customer = NULL)
    {
        $customer = str_replace('%20', ' ', $customer);
        // var_dump($customer);
        // die;
        if ($customer == NULL) {
            $data['msrs'] = $this->cs->getAll()->result_array();
        } else {
            $data['msrs'] = $this->cs->getAll($customer)->result_array();
        }
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-invoice-$customer.xls");
        $data['title'] = "Invoice";

        $this->load->view('finance/export_invoice_customer', $data);
    }
    public function cekResi()
    {
        if ($this->input->post('shipment_id') == NULL) {
            $data['title'] = 'CEK RESI';
            $data['resi'] = NULL;
            $data['shipment'] = NULL;
            $this->backend->display('finance/v_cek_resi', $data);
        } else {
            $data['title'] = 'CEK RESI';
            $data['resi'] = $this->input->post('shipment_id');
            $data['shipment'] = $this->db->get_where('tbl_shp_order', array('shipment_id' => $this->input->post('shipment_id')))->row_array();
            $this->backend->display('finance/v_cek_resi', $data);
        }
    }
    public function createInvoice()
    {
        $shipment_id =  $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Select Minimun 1 Shipment'));
            redirect('finance/jobsheet/final');
        }
        $data['shipper'] = $this->db->get_where('tbl_shp_order', ['id' => $shipment_id[0]])->row_array();
        // var_dump($data['shipper']);
        // die;
        $data['title'] = 'Create Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Create Invoice';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['shipment_id'] = $shipment_id;
        $this->backend->display('finance/v_create_invoice', $data);
    }
    public function cekInvoice()
    {
        $query = $this->db->query('SELECT no_invoice FROM tbl_no_invoice WHERE id_nomor_invoice = (SELECT MAX(id_nomor_invoice) FROM tbl_no_invoice)')->row_array();
        var_dump($query['no_invoice']);
    }
    public function procesCreateInvoice()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $due_date = $this->input->post('due_date');
        $customer_pickup = $this->input->post('customer_pickup');
        // $pu_muda = $this->input->post('pu_muda');
        $total_invoice = $this->input->post('total_invoice');
        $is_ppn = $this->input->post('is_ppn');
        $is_pph = $this->input->post('is_pph');
        $is_reimbursment = $this->input->post('is_reimbursment');
        $is_special = $this->input->post('is_special');
        $is_insurance = $this->input->post('is_insurance');
        $is_others = $this->input->post('is_others');
        $is_packing = $this->input->post('is_packing');
        $is_remarks = $this->input->post('is_remarks');
        $invoice = $this->input->post('invoice');
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');
        $pic = $this->input->post('pic');
        $terbilang = $this->input->post('terbilang');
        $note_cs = $this->input->post('note_cs');
        $so_note = $this->input->post('so_note');
        $cek_no_invoice = $this->db->query('SELECT no_invoice FROM tbl_no_invoice WHERE id_nomor_invoice = (SELECT MAX(id_nomor_invoice) FROM tbl_no_invoice)')->row_array();
        $date = date('Y-m-d');
        $tahun = date("y");
        $bulan = date("m");
        $tgl = date("d");
        $no_invoice = '';
        // 000010122
        if ($cek_no_invoice['no_invoice'] == NULL) {
            $no_invoice = "$bulan$tahun";
            $no_invoice = '1' . $no_invoice;
        } else {
            $no_invoice = "$bulan$tahun";
            // $potongNolInvoice = ltrim($cek_no_invoice['no_invoice'], '0');
            $potongDateInvoice = substr($cek_no_invoice['no_invoice'], 0, -4);
            $no = $potongDateInvoice + 1;
            $no_invoice  = "$no$no_invoice";
        }
        // KALO DIA ADA PPN DAN PPH
        if ($is_ppn != 1) {
            $ppn = 0;
        }
        if ($is_pph != 1) {
            $pph = 0;
        }

        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $data = array(
                'shipment_id' => $shipment_id[$i],
                'no_invoice' => $no_invoice,
                'date' => date('Y-m-d'),
                'due_date' => $due_date,
                'pic' => $pic,
                'is_ppn' => $is_ppn,
                'is_pph' => $is_pph,
                'is_reimbursment' => $is_reimbursment,
                'is_special' => $is_special,
                'is_insurance' => $is_insurance,
                'is_packing' => $is_packing,
                'is_others' => $is_others,
                'is_remarks' => $is_remarks,
                'customer_pickup' => $customer_pickup,
                'terbilang' => $terbilang,
                'customer' => $this->input->post('shipper'),
                'address' => $this->input->post('address'),
                'print_do' => $this->input->post('print_do'),
                'no_telp' => $this->input->post('no_telp'),
                'status' => 0,
                'total_invoice' => $total_invoice,
                'invoice' => $invoice,
                'ppn' => $ppn,
                'pph' => $pph,
                'id_user' => $this->session->userdata('id_user')
            );
            $insert = $this->db->insert('tbl_invoice', $data);
            $data = array(
                'no_invoice' => $no_invoice,
            );
            $this->db->insert('tbl_no_invoice', $data);
            if ($is_reimbursment == 1) {
                $cek_no_invoice = $this->db->query('SELECT no_invoice FROM tbl_no_invoice WHERE id_nomor_invoice = (SELECT MAX(id_nomor_invoice) FROM tbl_no_invoice)')->row_array();
                $date = date('Y-m-d');
                $tahun = date("y");
                $bulan = date("m");
                $tgl = date("d");
                $no_invoice_reimbursment = '';
                // 000010122
                if ($cek_no_invoice['no_invoice'] == NULL) {
                    $no_invoice_reimbursment = "$bulan$tahun";
                    $no_invoice_reimbursment = '00001' . $no_invoice_reimbursment;
                } else {
                    $no_invoice_reimbursment = "$bulan$tahun";
                    $potong = substr($cek_no_invoice['no_invoice'], 0, 5);
                    $no = $potong + 1;
                    $kode =  sprintf("%05s", $no);
                    $no_invoice_reimbursment  = "$kode$no_invoice_reimbursment";
                }
                $data = array(
                    'shipment_id' => $shipment_id[$i],
                    'no_invoice' => $no_invoice,
                    'no_invoice_reimbursment' => $no_invoice_reimbursment,
                    'date' => date('Y-m-d'),
                    'due_date' => $due_date,
                    'pic' => $pic,
                    'is_ppn' => $is_ppn,
                    'is_pph' => $is_pph,
                    'is_reimbursment' => $is_reimbursment,
                    'customer_pickup' => $customer_pickup,
                    'terbilang' => $terbilang,
                    'customer' => $this->input->post('shipper'),
                    'address' => $this->input->post('address'),
                    'print_do' => $this->input->post('print_do'),
                    'no_telp' => $this->input->post('no_telp'),
                    'status' => 0,
                    'total_invoice' => $total_invoice,
                    'invoice' => $invoice,
                    'ppn' => $ppn,
                    'pph' => $pph,
                    'id_user' => $this->session->userdata('id_user')
                );
                $insert = $this->db->insert('tbl_invoice_reimbursment', $data);
                $data = array(
                    'no_invoice' => $no_invoice_reimbursment,
                );
                $this->db->insert('tbl_no_invoice', $data);
            }

            $data = array(
                'note_cs' => $note_cs[$i],
                'so_note' => $so_note[$i],
                'status_so' => 5
                // 'pu_moda' => $pu_muda[$i]
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);
        }
        if ($insert) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Create Invoice'));
            redirect('finance/invoice');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice');
        }
    }
    public function download()
    {
        $shipment_id =  $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Select Minimun 1 Shipment'));
            redirect('finance/jobsheet/');
        }
        $detail = $this->db->get_where('tbl_shp_order', ['id' => $shipment_id[0]])->row_array();
        // var_dump($detail);
        // die;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-invoice-$detail[shipper].xls");
        $data['title'] = "Invoice";
        $data['shipment_id'] = $shipment_id;

        $this->load->view('finance/export_invoice_all', $data);
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
