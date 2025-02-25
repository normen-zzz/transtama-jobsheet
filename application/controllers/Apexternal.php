<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apexternal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sendwa', 'wa');
        $this->load->library('breadcrumb');
        $this->load->library('upload');
        $this->load->model('M_Datatables');
        $this->load->model('CsModel', 'cs');
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }

    public function cs($unique_invoice, $id_vendor)
    {
        $data['title'] = "Detail Invoice AP";
        $breadcrumb_items = [];
        $data['subtitle'] = "Detail Invoice AP";
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice2($unique_invoice, $id_vendor)->result_array();
        $data['total_invoice'] = $this->cs->getApByNoInvoice2($unique_invoice, $id_vendor)->num_rows();
        $this->load->view('apexternal_cs', $data);
    }

    public function approveCs($unique_invoice, $id_vendor)
    {
        $ap = $this->db->get_where('tbl_invoice_ap_final', array('unique_invoice' => $unique_invoice))->row_array();
        $user = $this->db->get_where('tb_user', array('id_user' => $ap['id_user']))->row_array();
        $where = array('unique_invoice' => $unique_invoice);
        $data = array(
            'no_pengeluaran' => $unique_invoice,
            'approve_by_atasan' => $this->session->userdata('id_user'),
            'created_atasan' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->insert('tbl_approve_pengeluaran_external', $data);
        if ($insert) {
            $this->db->update('tbl_invoice_ap_final', ['status' => 1], $where);
            $no_po = $ap['no_po'];
            $nama = $user['nama_user'];
            $purpose = $ap['purpose'];
            $date = date('d F Y', strtotime($ap['created_at']));
            $link = "https://jobsheet.transtama.com/Apexternal/sm/$unique_invoice/$id_vendor";
            $pesan = "Hallo, ada pengajuan Ap External No. *$no_po* Oleh *$nama*  Dengan Tujuan *$purpose* Tanggal *$date*. Silahkan Approve Melalu Link Berikut : $link . Terima Kasih";

            //NO PAK SAM
            $this->wa->pickup('+6281808008082', "$pesan");

            //NO Norman
            $this->wa->pickup('+6285697780467', "$pesan");
            redirect('Apexternal/cs/' . $unique_invoice . '/' . $id_vendor);
        } else {

            redirect('Apexternal/cs/' . $unique_invoice . '/' . $id_vendor);
        }
    }

    public function sm($unique_invoice, $id_vendor)
    {
        $data['title'] = "Detail Invoice AP";
        $breadcrumb_items = [];
        $data['subtitle'] = "Detail Invoice AP";
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice2($unique_invoice, $id_vendor)->result_array();
        $data['total_invoice'] = $this->cs->getApByNoInvoice2($unique_invoice, $id_vendor)->num_rows();
        $this->load->view('apexternal_sm', $data);
        // $this->backend->display('apexternal_sm', $data);
    }

    public function approveSm($unique_invoice, $id_vendor)
    {
        $where = array('unique_invoice' => $unique_invoice);
        $data = array(
            'approve_by_sm' => $this->session->userdata('id_user'),
            'created_sm' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->update('tbl_approve_pengeluaran_external', $data, ['no_pengeluaran' => $unique_invoice]);
        if ($insert) {
            $this->db->update('tbl_invoice_ap_final', ['status' => 2], $where);

            redirect('Apexternal/sm/' . $unique_invoice . '/' . $id_vendor);
        } else {
            redirect('Apexternal/sm/' . $unique_invoice . '/' . $id_vendor);
        }
    }
}
