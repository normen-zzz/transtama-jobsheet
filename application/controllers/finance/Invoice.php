<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backoffice');
        }
        $this->load->library('breadcrumb');
        $this->load->library('upload');
        $this->load->model('M_Datatables');
        $this->load->model('CsModel', 'cs');
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        cek_role();
    }
    public function index()
    {
        $data['title'] = 'Proforma Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Proforma Invoice';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['proforma'] = $this->cs->getProformaInvoice()->result_array();
        $this->backend->display('finance/v_proforma_invoice', $data);
    }
    public function final()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Invoice';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Invoice';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['proforma'] = $this->cs->getProformaInvoiceFinal()->result_array();
            $this->backend->display('finance/v_invoice', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
                $data['title'] = 'Invoice';
                $data['shipment_id'] = $shipment_id;
                $breadcrumb_items = [];
                $data['subtitle'] = 'Invoice';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['proforma'] = $this->cs->getProformaInvoiceFinal()->result_array();
                $this->backend->display('finance/v_invoice', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
                redirect('finance/invoice/final');
            }
        }
    }
    public function invoicePaid()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Invoice';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Invoice';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['proforma'] = $this->cs->getInvoicePaid(null, null)->result_array();
            $this->backend->display('finance/v_invoice_paid', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
                $data['title'] = 'Invoice';
                $data['shipment_id'] = $shipment_id;
                $breadcrumb_items = [];
                $data['subtitle'] = 'Invoice';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['proforma'] = $this->cs->getInvoicePaid(null, null)->result_array();
                $this->backend->display('finance/v_invoice_paid', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
                redirect('finance/invoice/invoicePaid');
            }
        }
    }
    public function soa()
    {
        $data['title'] = 'SOA';
        $breadcrumb_items = [];
        $data['subtitle'] = 'SOA';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['proforma'] = $this->cs->getSoa()->result_array();
        $this->backend->display('finance/v_soa', $data);
    }
    public function edit($id_invoice, $no_invoice)
    {

        $data['title'] = 'Edit Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Edit Invoice';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['due_date'] = $this->db->get_where('tbl_invoice', ['no_invoice' => $no_invoice])->row_array();
        $data['shipper'] = $this->db->get_where('tbl_shp_order', ['id' => $id_invoice])->row_array();
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
        $data['moda'] = $this->db->get('tbl_moda')->result_array();
        $data['js'] = $this->cs->getJsApproveFinance()->result_array();

        $this->backend->display('finance/v_edit_invoice', $data);
    }
    public function editInvoice($id_invoice, $no_invoice)
    {

        $data['title'] = 'Edit Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Edit Invoice';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['due_date'] = $this->db->get_where('tbl_invoice', ['no_invoice' => $no_invoice])->row_array();
        $data['shipper'] = $this->db->get_where('tbl_shp_order', ['id' => $id_invoice])->row_array();
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
        $data['moda'] = $this->db->get('tbl_moda')->result_array();
        $data['js'] = $this->cs->getJsApproveFinance()->result_array();

        $this->backend->display('finance/v_edit_invoice_final', $data);
    }
    public function detailInvoice($id_invoice, $no_invoice)
    {

        $data['title'] = 'Detail Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Detail Invoice';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['due_date'] = $this->db->get_where('tbl_invoice', ['no_invoice' => $no_invoice])->row_array();
        $data['shipper'] = $this->db->get_where('tbl_shp_order', ['id' => $id_invoice])->row_array();
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
        $data['js'] = $this->cs->getJsApproveFinance()->result_array();

        $this->backend->display('finance/v_detail_invoice', $data);
    }
    public function paid()
    {
        $data = array(
            'payment_date' => $this->input->post('payment_date'),
            'payment_time' => $this->input->post('payment_time'),
            'status' => 2
        );
        // var_dump($data);
        // $config['upload_path'] = './uploads/berkas/';
        // $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['encrypt_name'] = TRUE;
        // $this->upload->initialize($config);

        // $folderUpload = "./uploads/bukti_bayar/";
        // $files = $_FILES;
        // $files = $_FILES;
        // $jumlahFile = count($files['ktp']['name']);
        // // var_dump($jumlahFile);
        // // die;

        // if (!empty($_FILES['ktp']['name'][0])) {
        //     $listNamaBaru = array();
        //     for ($i = 0; $i < $jumlahFile; $i++) {
        //         $namaFile = $files['ktp']['name'][$i];
        //         $lokasiTmp = $files['ktp']['tmp_name'][$i];

        //         # kita tambahkan uniqid() agar nama gambar bersifat unik
        //         $namaBaru = uniqid() . '-' . $namaFile;

        //         array_push($listNamaBaru, $namaBaru);
        //         $lokasiBaru = "{$folderUpload}/{$namaBaru}";
        //         $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);
        //     }
        //     $namaBaru = implode("+", $listNamaBaru);
        //     $ktp = array('bukti_bayar' => $namaBaru);
        //     $data = array_merge($data, $ktp);
        // } else {
        //     $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Upload Proof of Paymant'));
        //     redirect('finance/invoice/final');
        // }
        // // var_dump($data);
        // // die;
        $update = $this->db->update('tbl_invoice', $data, ['no_invoice' => $this->input->post('no_invoice')]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
            redirect('finance/invoice/final');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/final');
        }
    }
    // public function paid()
    // {
    //     $data = array(
    //         'payment_date' => $this->input->post('payment_date'),
    //         'payment_time' => $this->input->post('payment_time'),
    //         'status' => 2
    //     );
    //     // var_dump($data);
    //     $config['upload_path'] = './uploads/berkas/';
    //     $config['allowed_types'] = 'jpg|png|jpeg';
    //     $config['encrypt_name'] = TRUE;
    //     $this->upload->initialize($config);

    //     $folderUpload = "./uploads/bukti_bayar/";
    //     $files = $_FILES;
    //     $files = $_FILES;
    //     $jumlahFile = count($files['ktp']['name']);
    //     // var_dump($jumlahFile);
    //     // die;

    //     if (!empty($_FILES['ktp']['name'][0])) {
    //         $listNamaBaru = array();
    //         for ($i = 0; $i < $jumlahFile; $i++) {
    //             $namaFile = $files['ktp']['name'][$i];
    //             $lokasiTmp = $files['ktp']['tmp_name'][$i];

    //             # kita tambahkan uniqid() agar nama gambar bersifat unik
    //             $namaBaru = uniqid() . '-' . $namaFile;

    //             array_push($listNamaBaru, $namaBaru);
    //             $lokasiBaru = "{$folderUpload}/{$namaBaru}";
    //             $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);
    //         }
    //         $namaBaru = implode("+", $listNamaBaru);
    //         $ktp = array('bukti_bayar' => $namaBaru);
    //         $data = array_merge($data, $ktp);
    //     } else {
    //         $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Upload Proof of Paymant'));
    //         redirect('finance/invoice/final');
    //     }
    //     // var_dump($data);
    //     // die;
    //     $update = $this->db->update('tbl_invoice', $data, ['no_invoice' => $this->input->post('no_invoice')]);
    //     if ($update) {
    //         $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
    //         redirect('finance/invoice/final');
    //     } else {
    //         $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Upload Proof of Payent'));
    //         redirect('finance/invoice/final');
    //     }
    // }

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


    public function deleteInvoice($id_invoice, $no_invoice, $shipment_id)
    {
        $delete = $this->db->delete('tbl_invoice',  ['id_invoice' => $id_invoice]);
        if ($delete) {
            $data = array(
                'status_so' => 4
                // 'pu_moda' => $pu_muda[$i]
            );
            $this->db->update('tbl_shp_order', $data, ['shipment_id' => $shipment_id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        }
    }
    public function deleteInvoiceFinal($id_invoice, $no_invoice, $shipment_id)
    {
        $delete = $this->db->delete('tbl_invoice',  ['id_invoice' => $id_invoice]);
        if ($delete) {
            $data = array(
                'status_so' => 4
                // 'pu_moda' => $pu_muda[$i]
            );
            $this->db->update('tbl_shp_order', $data, ['shipment_id' => $shipment_id]);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
        }
    }
    public function approve($no_invoice, $id_invoice, $total_amount)
    {
        $update = $this->db->update('tbl_invoice',  ['status' => 1, 'total_invoice' => decrypt_url($total_amount)], ['no_invoice' => $no_invoice]);
        if ($update) {
            $data = array(
                'no_invoice' => $no_invoice,
                'id_user' => $this->session->userdata('id_user')
            );
            $this->db->insert('tbl_approve_invoice', $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/final');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/final');
        }
    }
    public function cekShipmentId()
    {
        $shipment_id = $this->input->post('shipment_id');
        $cek_data = $this->db->get_where('tbl_shp_order',  ['shipment_id' => $shipment_id])->row_array();
        if ($cek_data) {
            $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
            $this->backend->display('finance/v_invoice', $data);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
            redirect('finance/invoice/final');
        }
    }

    public function proceseditInvoice()
    {
        $no_invoice = $this->input->post('no_invoice');
        $terbilang = $this->input->post('terbilang');
        // $pu_muda = $this->input->post('pu_muda');
        $is_reimbursment = $this->input->post('is_reimbursment');
        $is_special = $this->input->post('is_special');
        $is_packing = $this->input->post('is_packing');
        $is_insurance = $this->input->post('is_insurance');
        $id_invoice = $this->input->post('id_invoice');
        $due_date = $this->input->post('due_date');
        $total_invoice = $this->input->post('total_invoice');
        $invoice = $this->input->post('invoice');
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');
        $is_ppn = $this->input->post('is_ppn');
        $is_pph = $this->input->post('is_pph');
        $is_others = $this->input->post('is_others');
        $is_remarks = $this->input->post('is_remarks');
        $no_telp = $this->input->post('no_telp');
        $print_do = $this->input->post('print_do');
        $pic = $this->input->post('pic');
        $address = $this->input->post('address');
        $shipper = $this->input->post('shipper');
        $shipment_id =  $this->input->post('shipment_id');
        $note_cs = $this->input->post('note_cs');
        $so_note = $this->input->post('so_note');
        // KALO DIA ADA PPN DAN PPH
        if ($is_ppn != 1) {
            $ppn = 0;
        } else {
            $ppn =  0.011 * $invoice;
        }
        if ($is_pph != 1) {
            $pph = 0;
        } else {
            $pph = 0.02 * $invoice;
        }

        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $data = array(
                'note_cs' => $note_cs[$i],
                'so_note' => $so_note[$i],
                // 'pu_moda' => $pu_muda[$i],
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);
        }

        $data = array(
            'due_date' => $due_date,
            'pic' => $pic,
            'terbilang' => $terbilang,
            'no_telp' => $no_telp,
            'address' => $address,
            'print_do' => $print_do,
            'customer' => $shipper,
            'is_reimbursment' => $is_reimbursment,
            'is_special' => $is_special,
            'is_packing' => $is_packing,
            'is_others' => $is_others,
            'is_insurance' => $is_insurance,
            'total_invoice' => $total_invoice,
            'invoice' => $invoice,
            'ppn' => $ppn,
            'pph' => $pph,
            'is_ppn' => $is_ppn,
            'is_pph' => $is_pph,
            'is_remarks' => $is_remarks,
        );
        $update = $this->db->update('tbl_invoice', $data, ['no_invoice' => $no_invoice]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        }
    }
    public function proceseditInvoiceFinal()
    {
        $no_invoice = $this->input->post('no_invoice');
        $terbilang = $this->input->post('terbilang');
        // $pu_muda = $this->input->post('pu_muda');
        $is_reimbursment = $this->input->post('is_reimbursment');
        $is_special = $this->input->post('is_special');
        $is_packing = $this->input->post('is_packing');
        $is_insurance = $this->input->post('is_insurance');
        $is_revisi = $this->input->post('is_revisi');
        $id_invoice = $this->input->post('id_invoice');
        $is_others = $this->input->post('is_others');
        $due_date = $this->input->post('due_date');
        $total_invoice = $this->input->post('total_invoice');
        $invoice = $this->input->post('invoice');
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');
        $is_ppn = $this->input->post('is_ppn');
        $is_pph = $this->input->post('is_pph');
        $is_remarks = $this->input->post('is_remarks');
        $no_telp = $this->input->post('no_telp');
        $print_do = $this->input->post('print_do');
        $pic = $this->input->post('pic');
        $address = $this->input->post('address');
        $shipper = $this->input->post('shipper');
        $shipment_id =  $this->input->post('shipment_id');
        $note_cs = $this->input->post('note_cs');
        $so_note = $this->input->post('so_note');
        // KALO DIA ADA PPN DAN PPH
        if ($is_ppn != 1) {
            $ppn = 0;
        } else {
            $ppn =  0.011 * $invoice;
        }
        if ($is_pph != 1) {
            $pph = 0;
        } else {
            $pph = 0.02 * $invoice;
        }
        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $data = array(
                'note_cs' => $note_cs[$i],
                'so_note' => $so_note[$i],
                // 'pu_moda' => $pu_muda[$i],
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);
        }
        $data = array(
            'due_date' => $due_date,
            'pic' => $pic,
            'terbilang' => $terbilang,
            'no_telp' => $no_telp,
            'address' => $address,
            'print_do' => $print_do,
            'customer' => $shipper,
            'is_reimbursment' => $is_reimbursment,
            'is_special' => $is_special,
            'is_packing' => $is_packing,
            'is_others' => $is_others,
            'is_insurance' => $is_insurance,
            'is_revisi' => $is_revisi,
            'total_invoice' => $total_invoice,
            'invoice' => $invoice,
            'ppn' => $ppn,
            'pph' => $pph,
            'is_ppn' => $is_ppn,
            'is_pph' => $is_pph,
            'is_remarks' => $is_remarks,
        );
        $update = $this->db->update('tbl_invoice', $data, ['no_invoice' => $no_invoice]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
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
    public function addShipment()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $due_date = $this->input->post('due_date');
        $pic = $this->input->post('pic');
        $no_invoice = $this->input->post('no_invoice');
        $id_invoice = $this->input->post('id_invoice');

        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $exis_invoice = $this->db->get_where('tbl_invoice', ['shipment_id' => $shipment_id[$i]])->row_array();
            // kalo sudah ada invoice
            if ($exis_invoice) {
                break;
            } else {
                $data = array(
                    'shipment_id' => $shipment_id[$i],
                    'no_invoice' => $no_invoice,
                    'date' => date('Y-m-d'),
                    'due_date' => $due_date,
                    'pic' => $pic,
                    'status' => 0,
                    'id_user' => $this->session->userdata('id_user'),
                    'customer' => $this->input->post('customer'),
                    'customer_pickup' => $this->input->post('customer_pickup'),
                    'address' => $this->input->post('address'),
                    'pic' => $this->input->post('pic'),
                    'terbilang' => $this->input->post('terbilang'),
                    'is_pph' => $this->input->post('is_pph'),
                    'is_ppn' => $this->input->post('is_ppn'),
                    'print_do' => $this->input->post('print_do'),
                    'is_reimbursment' => $this->input->post('is_reimbursment'),
                    'is_packing' => $this->input->post('is_packing'),
                    'is_special' => $this->input->post('is_special'),
                    'no_telp' => $this->input->post('no_telp'),
                    'update_by' => $this->session->userdata('id_user'),
                );
                $insert = $this->db->insert('tbl_invoice', $data);
                $data = array(
                    'status_so' => 5
                    // 'pu_moda' => $pu_muda[$i]
                );
                $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);
            }
        }
        if ($insert) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Duplicate Shipment ID'));
            redirect('finance/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        }
    }
    public function addShipmentFinal()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $due_date = $this->input->post('due_date');
        $pic = $this->input->post('pic');
        $no_invoice = $this->input->post('no_invoice');
        $id_invoice = $this->input->post('id_invoice');

        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $exis_invoice = $this->db->get_where('tbl_invoice', ['shipment_id' => $shipment_id[$i]])->row_array();
            // kalo sudah ada invoice
            if ($exis_invoice) {
                break;
            } else {
                $data = array(
                    'shipment_id' => $shipment_id[$i],
                    'no_invoice' => $no_invoice,
                    'date' => date('Y-m-d'),
                    'due_date' => $due_date,
                    'pic' => $pic,
                    'status' => 1,
                    'customer' => $this->input->post('customer'),
                    'customer_pickup' => $this->input->post('customer_pickup'),
                    'address' => $this->input->post('address'),
                    'pic' => $this->input->post('pic'),
                    'terbilang' => $this->input->post('terbilang'),
                    'is_pph' => $this->input->post('is_pph'),
                    'is_ppn' => $this->input->post('is_ppn'),
                    'print_do' => $this->input->post('print_do'),
                    'is_reimbursment' => $this->input->post('is_reimbursment'),
                    'is_packing' => $this->input->post('is_packing'),
                    'is_special' => $this->input->post('is_special'),
                    'no_telp' => $this->input->post('no_telp'),
                    'update_by' => $this->session->userdata('id_user'),
                );
                $insert = $this->db->insert('tbl_invoice', $data);
                $data = array(
                    'status_so' => 5
                    // 'pu_moda' => $pu_muda[$i]
                );
                $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);
            }
        }
        if ($insert) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/invoice/editInvoice/' . $id_invoice . '/' . $no_invoice);
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
    public function ExportSoa()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-soa.xls");
        $data['title'] = "SOA";
        $data['proforma'] = $this->cs->getSoa()->result_array();
        $this->load->view('finance/export_soa', $data);
    }
    public function printProforma($no_invoice)
    {
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['info'] = $this->cs->getInvoice($no_invoice)->row_array();

        $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
        // kalo dia ada reimbursment
        if ($data['info']['is_reimbursment'] == 1) {
            $data['reimbursment'] = $this->cs->getInvoiceReimbursment($no_invoice)->row_array();
            $this->load->view('superadmin/v_cetak_invoice_reimbursment', $data);
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->set_paper("legal", 'potrait');
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            // $sekarang = date("d:F:Y:h:m:s");
            $this->dompdf->stream("Invoice$no_invoice.pdf", array('Attachment' => 0));
        } else {
            $this->load->view('superadmin/v_cetak_invoice', $data);
            $html = $this->output->get_output();
            $this->load->library('dompdf_gen');
            $this->dompdf->set_paper("legal", 'potrait');
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            // $sekarang = date("d:F:Y:h:m:s");
            $this->dompdf->stream("Invoice$no_invoice.pdf", array('Attachment' => 0));
        }
    }
    public function printProformaFull($no_invoice)
    {
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['info'] = $this->cs->getInvoice($no_invoice)->row_array();
        $get_alamat_customer = $this->db->get_where('tb_customer', ['nama_pt' => $data['info']['shipper']])->row_array();

        $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
        $this->load->view('superadmin/v_cetak_invoice_full', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("legal", 'potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        // $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Invoice$no_invoice.pdf", array('Attachment' => 0));
    }

    public function printProformaExcell($no_invoice)
    {
        $spreadsheet = new Spreadsheet();
        $invoice = $this->cs->getInvoice($no_invoice)->result_array();
        $total_invoice = $this->cs->getInvoice($no_invoice)->num_rows();
        $info = $this->cs->getInvoice($no_invoice)->row_array();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', '')->mergeCells('A1:A3')->getColumnDimension('A')->setWidth(150, 'pt');
        $sheet->setCellValue('B1', 'Customer')->getColumnDimension('B')->setWidth(80, 'pt');
        $sheet->setCellValue('B2', 'Address')->getColumnDimension('B');
        $sheet->setCellValue('B3', 'No. Telp')->getColumnDimension('B');
        $sheet->setCellValue('C1', $info['customer'])->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C2', $info['address'])->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C3', $info['no_telp'])->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('A4', 'INVOICE')->mergeCells('A4:E4')->getStyle('A4')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('A4', 'INVOICE')->mergeCells('A4:E4')->getStyle('A4')->getFont()->setBold(true);

        $sheet->setCellValue('A5', 'PT. TRANSTAMA LOGISTICS EXPRESS')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('A6', 'JL. PENJERNIHAN II NO. III B')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('A7', 'JAKARTA PUSAT 10210')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('A8', 'PHONE : (021) 57852609 (HUNTING)')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('A9', 'FAX : (021) 57852608')->getColumnDimension('A')
            ->setAutoSize(true);

        $sheet->setCellValue('B5', 'INVOICE No')->getColumnDimension('B')
            ->setAutoSize(true);
        $sheet->setCellValue('B6', 'DATE')->getColumnDimension('B')
            ->setAutoSize(true);
        $sheet->setCellValue('B7', 'DUE DATE')->getColumnDimension('B')
            ->setAutoSize(true);
        $sheet->setCellValue('B8', '')->getColumnDimension('B')
            ->setAutoSize(true);
        $sheet->setCellValue('B9', 'PIC')->getColumnDimension('B')
            ->setAutoSize(true);

        $sheet->setCellValue('C5',   $info['no_invoice'])->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C6', tanggal_invoice2($info['date']))->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C7',  tanggal_invoice2($info['due_date']))->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C8', '')->getColumnDimension('C')
            ->setAutoSize(true);
        $sheet->setCellValue('C9', $info['pic'])->getColumnDimension('C')
            ->setAutoSize(true);

        // data
        $sheet->setCellValue('A12', 'AWB')->getStyle('A12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('B12', 'No DO')->getStyle('B12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('C12', 'Date')->getStyle('C12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('D12', 'DEST')->getStyle('D12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('E12', 'SERVICE')->getStyle('E12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('F12', 'COLLIE')->getStyle('F12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('G12', 'WEIGHT')->getStyle('G12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('H12', 'RATE')->getStyle('H12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('I12', 'OTHERS')->getStyle('I12')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('J12', 'TOTAL AMOUNT')->getColumnDimension('J')->setAutoSize(true);

        $no = 1;
        $x = 13;
        $total_koli = 0;
        $total_weight = 0;
        $total_special_weight = 0;
        $total_amount = 0;

        foreach ($invoice as $inv) {
            $get_do = $this->db->get_where('tbl_no_do', ['shipment_id' => $inv['shipment_id']]);
            $data_do = $get_do->result_array();
            $total_do = $get_do->num_rows();


            $no = 1;
            $service =  $inv['service_name'];
            if ($service == 'Charter Service') {
                $packing = $inv['packing'];
                $total_sales = ($inv['freight_kg'] + $packing +  $inv['special_freight'] +  $inv['others'] + $inv['surcharge'] + $inv['insurance']);
            } else {
                $disc = $inv['disc'];
                // kalo gada disc
                if ($disc == 0) {
                    $freight  = $inv['berat_js'] * $inv['freight_kg'];
                    $special_freight  = $inv['berat_msr'] * $inv['special_freight'];
                } else {
                    $freight_discount = $inv['freight_kg'] * $disc;
                    $special_freight_discount = $inv['special_freight'] * $disc;
                    $freight = $freight_discount * $inv['berat_js'];
                    $special_freight  = $special_freight_discount * $inv['berat_msr'];
                }
                $packing = $inv['packing'];
                $total_sales = ($freight + $packing + $special_freight +  $inv['others'] + $inv['surcharge'] + $inv['insurance']);
            }
            $m =  $total_do;
            $m = $m + $x;
            if ($inv['service_name'] == 'Charter Service') {
                $service = $inv['service_name'] . '-' . $inv['pu_moda'];
            } else {
                $service =  $inv['service_name'];;
            }


            if ($service == 'Charter Service') {
                $rate = $inv['special_freight'];
            } else {
                $rate =  $inv['freight_kg'];
            }

            if ($total_do == 0) {
                if ($inv['no_so'] != NULL && $inv['no_stp'] != NULL) {
                    $no_do = $inv['note_cs'] . '<br>/' . $inv['no_so'] . '/' . $inv['no_stp'];
                } else {
                    $no_do = $inv['note_cs'];
                }
                $sheet->setCellValue('A' . $x, $inv['shipment_id'])->getColumnDimension('A')
                    ->setAutoSize(true);
                $sheet->setCellValue('B' . $x, $no_do)->getColumnDimension('B')
                    ->setAutoSize(true);
                $sheet->setCellValue('C' . $x,  tanggal_invoice($inv['tgl_pickup']))->getColumnDimension('C')
                    ->setAutoSize(true);
                $sheet->setCellValue('D' . $x, $inv['tree_consignee'])->getColumnDimension('D')
                    ->setAutoSize(true);
                $sheet->setCellValue('E' . $x, $service)->getColumnDimension('E')
                    ->setAutoSize(true);

                $sheet->setCellValue('F' . $x, $inv['koli'])->getColumnDimension('F')
                    ->setAutoSize(true);
                $sheet->setCellValue('G' . $x,  $inv['berat_js'])->getColumnDimension('G')
                    ->setAutoSize(true);
                if ($rate != 0) {
                    $sheet->getStyle("H" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                    $sheet->setCellValue('H' . $x, $rate)->getColumnDimension('H')
                        ->setAutoSize(true);
                } else {
                    $sheet->setCellValue('H' . $x, $rate)->getColumnDimension('H')
                        ->setAutoSize(true);
                }
                $sheet->setCellValue('I' . $x, rupiah($inv['others']))->getColumnDimension('I')
                    ->setAutoSize(true);
                if ($total_sales != 0) {
                    $sheet->getStyle("J" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                    $sheet->setCellValue('J' . $x, $total_sales)->getColumnDimension('J')
                        ->setAutoSize(true);
                } else {
                    $sheet->setCellValue('J' . $x, $rate)->getColumnDimension('J')
                        ->setAutoSize(true);
                }
                $total_koli = $total_koli + $inv['koli'];
            } else {

                $rowspan = 'A' . $x . ':A' . $m;

                foreach ($data_do as $d) {
                    $sheet->setCellValue('A' . $x, $inv['shipment_id'])->getColumnDimension('A')
                        ->setAutoSize(true);

                    $sheet->setCellValue('B' . $x, $d['no_do'])->getColumnDimension('B')
                        ->setAutoSize(true);

                    $sheet->setCellValue('C' . $x, tanggal_invoice($inv['tgl_pickup']))->getColumnDimension('C')
                        ->setAutoSize(true);
                    $sheet->setCellValue('D' . $x, $inv['tree_consignee'])->getColumnDimension('D')
                        ->setAutoSize(true);
                    $sheet->setCellValue('E' . $x, $service)->getColumnDimension('E')
                        ->setAutoSize(true);
                    $sheet->setCellValue('F' . $x, $d['koli'])->getColumnDimension('F')
                        ->setAutoSize(true);
                    $sheet->setCellValue('G' . $x,  $d['berat'])->getColumnDimension('G')
                        ->setAutoSize(true);

                    if ($rate != 0) {
                        $sheet->getStyle("H" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                        $sheet->setCellValue('H' . $x, $rate)->getColumnDimension('H')
                            ->setAutoSize(true);
                    } else {
                        $sheet->setCellValue('H' . $x, $rate)->getColumnDimension('H')
                            ->setAutoSize(true);
                    }
                    $sheet->setCellValue('I' . $x, rupiah($inv['others']))->getColumnDimension('I')
                        ->setAutoSize(true);
                    if ($total_sales != 0) {
                        $sheet->getStyle("J" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                        $sheet->setCellValue('J' . $x, $total_sales)->getColumnDimension('J')
                            ->setAutoSize(true);
                    } else {
                        $sheet->setCellValue('J' . $x, $rate)->getColumnDimension('J')
                            ->setAutoSize(true);
                    }
                    $total_koli = $total_koli + $d['koli'];
                }
            }
            $total_weight = $total_weight + $inv['berat_js'];
            $total_special_weight = $total_special_weight + $inv['berat_msr'];
            $total_amount = $total_amount + $total_sales;
            $x++;
            $no++;
        }
        $rowspan = $x;
        if ($info['print_do'] == 1) {
            $rowspan = 'A' . $rowspan . ':E' . $rowspan;
            $sheet->setCellValue('A' . $x, 'TOTAL ' . $total_invoice . ' AWB')->mergeCells($rowspan)->getStyle('A' . $x)->getAlignment()->setHorizontal('center');
        } else {
            $rowspan = 'A' . $rowspan . ':D' . $rowspan;
            $sheet->setCellValue('A' . $x, 'TOTAL ' . $total_invoice . ' AWB')->mergeCells($rowspan)->getStyle('A' . $x)->getAlignment()->setHorizontal('center');
        }
        $sheet->setCellValue('F' . $x, $total_koli);
        $sheet->setCellValue('G' . $x, $total_weight);
        $sheet->setCellValue('H' . $x, 'SUB TOTAL');
        $sheet->setCellValue('I' . $x, rupiah($total_amount));

        // ppn
        $ppn = $x + 1;
        if ($info['print_do'] == 1) {
            $rowspan = 'A' . $ppn . ':H' . $ppn;
            $sheet->setCellValue('A' . $ppn, 'PPN 1,1 %')->mergeCells($rowspan)->getStyle('A' . $ppn)->getAlignment()->setHorizontal('right');
        } else {
            $rowspan = 'A' . $ppn . ':G' . $ppn;
            $sheet->setCellValue('A' . $ppn, 'PPN 1,1 %')->mergeCells($rowspan)->getStyle('A' . $ppn)->getAlignment()->setHorizontal('right');
        }

        $ppn_total =  $total_amount * 0.011;
        $sheet->setCellValue('I' . $ppn, rupiah($ppn_total));

        // ppn
        $total = $x + 2;
        if ($info['print_do'] == 1) {
            $rowspan = 'A' . $total . ':H' . $total;
            $sheet->setCellValue('A' . $total, 'TOTAL')->mergeCells($rowspan)->getStyle('A' . $total)->getAlignment()->setHorizontal('right');
        } else {
            $rowspan = 'A' . $total . ':G' . $total;
            $sheet->setCellValue('A' . $total, 'TOTAL')->mergeCells($rowspan)->getStyle('A' . $total)->getAlignment()->setHorizontal('right');
        }

        $total_amount = $total_amount + $ppn_total;
        $sheet->setCellValue('I' . $total, rupiah($total_amount));

        // said

        $said = $total + 2;
        $said_word = $said + 1;
        $say = "#" . $info['terbilang'] . "#";
        $sheet->setCellValue('A' . $said, 'SAID :')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('A' . $said_word,   $say)->getColumnDimension('A')
            ->setAutoSize(true);

        // footer

        $said_word = $said_word + 2;
        $sheet->setCellValue('A' . $said_word, 'Please remit payment to our account with Full Amount:')->getColumnDimension('A')
            ->setAutoSize(true);

        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, 'PT. TRANSTAMA LOGISTICS EXPRESS')->getColumnDimension('A')
            ->setAutoSize(true);
        $sheet->setCellValue('B' . $said_word, 'Jakarta, ' . bulan_indo($info['date']))->getColumnDimension('B')
            ->setAutoSize(true);

        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, 'Bank Details: ')->getColumnDimension('A')
            ->setAutoSize(true);

        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, '-BANK CENTRAL ASIA (BCA)')->getColumnDimension('A')
            ->setAutoSize(true);
        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, 'Cab. Wisma GKBI, Jakarta')->getColumnDimension('A')
            ->setAutoSize(true);
        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, 'A/C No : 006 306 7374 (IDR)')->getColumnDimension('A')
            ->setAutoSize(true);
        $said_word = $said_word + 1;
        $sheet->setCellValue('B' . $said_word, 'FINANCE')->getColumnDimension('A')
            ->setAutoSize(true);
        $said_word = $said_word + 1;
        $sheet->setCellValue('A' . $said_word, '* INTEREST CHARGEST AT 10 % PER MONTH WILL BE LEVIED ON OVERDUE INVOICES')->getColumnDimension('A')
            ->setAutoSize(true);

        $filename = "export-invoice-$no_invoice";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    // public function printProformaExcell($no_invoice)
    // {
    //     $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
    //     $data['info'] = $this->cs->getInvoice($no_invoice)->row_array();
    //     if ($data['info']['is_reimbursment'] == 1) {
    //         $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
    //         header("Content-type: application/octet-stream");
    //         header("Content-Disposition: attachment;Filename=export-invoice.xls");
    //         $this->load->view('finance/v_cetak_invoice_excell_reimbursment', $data);
    //     } else {
    //         $data['total_invoice'] = $this->cs->getInvoice($no_invoice)->num_rows();
    //         header("Content-type: application/octet-stream");
    //         header("Content-Disposition: attachment;Filename=export-invoice.xls");
    //         $this->load->view('finance/v_cetak_invoice_excell', $data);
    //     }
    // }


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
