<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApExternal extends CI_Controller
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
        $data['title'] = 'VENDOR/AGENT';
        $breadcrumb_items = [];
        $data['subtitle'] = 'VENDOR/AGENT';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendors'] = $this->db->order_by('id_vendor', 'DESC')->get('tbl_vendor')->result_array();
        $this->backend->display('cs/v_ap_external', $data);
    }

    public function created()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'PO AGENT/VENDOR';
            $breadcrumb_items = [];
            $data['subtitle'] = 'PO AGENT/VENDOR';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['proforma'] = $this->cs->getApVendor()->result_array();

            $this->backend->display('cs/v_invoice_ap', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
                $data['title'] = 'PO AGENT/VENDOR';
                $data['shipment_id'] = $shipment_id;
                $breadcrumb_items = [];
                $data['subtitle'] = 'PO AGENT/VENDOR';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['proforma'] = $this->cs->getApVendor()->result_array();
                $this->backend->display('cs/v_invoice_ap', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
                redirect('cs/apExternal/created');
            }
        }
    }
    public function ApInternal()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Internal Account Payable';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Internal Account Payable';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['proforma'] = $this->cs->getApInternal()->result_array();
            $this->backend->display('cs/v_invoice_ap_internal', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
                $data['title'] = 'Internal Account Payable';
                $data['shipment_id'] = $shipment_id;
                $breadcrumb_items = [];
                $data['subtitle'] = 'Internal Account Payable';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['proforma'] = $this->cs->getApInternal()->result_array();
                $this->backend->display('cs/v_invoice_ap_internal', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
                redirect('cs/apExternal/created');
            }
        }
    }

    public function detailAp($id_vendor)
    {
        $id_vendor = decrypt_url($id_vendor);
        $data['title'] = 'Detail AP';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Detail AP';

        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['shipments'] = $this->cs->getShipmentByCost()->result_array();
        // $data['vendor'] = $this->cs->getInvoiceAp($id_vendor)->row_array();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        // $data['total_invoice'] = $this->db->get_where('tbl_invoice_ap', ['id_ap' => $id_vendor])->num_rows();
        $data['invoice'] = $this->cs->getApByVendor($id_vendor)->result_array();
        $data['total_invoice'] = $this->cs->getApByVendor($id_vendor)->num_rows();
        $this->backend->display('cs/v_detail_ap_external', $data);
    }
    public function editInvoice($unique_invoice, $id_vendor)
    {
        $id_vendor = decrypt_url($id_vendor);
        $data['title'] = "Edit PO";
        $breadcrumb_items = [];
        $data['subtitle'] = "Edit PO";
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->result_array();
        // var_dump($data['invoice']);
        // die;
        $data['total_invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->num_rows();
        $this->backend->display('cs/v_detail_invoice_ap', $data);
    }
    public function detailInvoice($unique_invoice, $id_vendor)
    {
        $id_vendor = decrypt_url($id_vendor);
        $data['title'] = "Detail Invoice AP";
        $breadcrumb_items = [];
        $data['subtitle'] = "Detail Invoice AP";
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->result_array();
        $data['total_invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->num_rows();
        $this->backend->display('cs/v_detail_invoice_ap_paid', $data);
    }

    public function createAp()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $id_vendor =  $this->input->post('id_vendor');
        if ($shipment_id == NULL) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Select Minimun 1 Shipment'));
            redirect('cs/apExternal/detailAp/' . encrypt_url($id_vendor));
        }

        $data['title'] = 'Create AP';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Create AP';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['shipments'] = $shipment_id;
        $data['id_vendor'] = $id_vendor;
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $this->backend->display('cs/v_create_ap', $data);
    }

    public function createApProforma()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $variabel =  $this->input->post('variabel');
        $due_date = $this->input->post('due_date');
        $total_ap = $this->input->post('total_ap');
        $no_invoice = $this->input->post('no_invoice');
        $terbilang = $this->input->post('terbilang');
        $random_string = $this->generateRandomString();
        $via = $this->input->post('via');

        $no_pengeluaran = '';
        $pre = '';
        $cek_no_invoice = $this->db->select_max('no_pengeluaran')->get_where('tbl_pengeluaran', ['id_kat_ap' => 1])->row_array();

        $pre = 'PO-';

        if ($cek_no_invoice['no_pengeluaran'] == NULL) {
            $no_pengeluaran = $pre . '000001';
        } else {

            $potong = substr($cek_no_invoice['no_pengeluaran'], 3, 6);
            $no = $potong + 1;
            $kode =  sprintf("%06s", $no);

            $no_pengeluaran  = "$pre$kode";
        }


        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $data = array(
                'shipment_id' => $shipment_id[$i],
                // 'variabel' => $variabel[$i],
                'id_user' => $this->session->userdata('id_user'),
                'id_vendor' => $this->input->post('id_vendor'),
                'vendor' => $this->input->post('nama_vendor'),
                'mode' => $this->input->post('mode'),
                'purpose' => $this->input->post('purpose'),
                'due_date' => $this->input->post('due_date'),
                'status' => 0,
                'no_po' => $no_pengeluaran,
                'via_transfer' => $via,
                'no_invoice' => $no_invoice,
                'unique_invoice' => $random_string,
                'date' => date('Y-m-d'),
                'due_date' => $due_date,
                'terbilang' => $terbilang,
                'status' => 0,
                'total_ap' => $total_ap,

            );
            // var_dump($data);
            // die;

            $insert = $this->db->insert('tbl_invoice_ap_final', $data);
            $data = array(
                'status_ap' => 1
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $shipment_id[$i]]);

            $data = array(
                'status' => 1
            );
            $this->db->update('tbl_invoice_ap', $data, ['shipment_id' => $shipment_id[$i], 'id_vendor' => $this->input->post('id_vendor')]);
        }
        if ($insert) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Create AP'));
            redirect('cs/apExternal/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/apExternal/created');
        }
    }


    public function processEditAp()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $id_invoice =  $this->input->post('id_invoice');
        $variabel =  $this->input->post('variabel');
        $unique_invoice =  $this->input->post('unique_invoice');

        $due_date = $this->input->post('due_date');
        $total_ap = $this->input->post('total_ap');
        $no_invoice = $this->input->post('no_invoice');
        // $ppn = $this->input->post('ppn');
        // $pph = $this->input->post('pph');
        $terbilang = $this->input->post('terbilang');
        $id_vendor = $this->input->post('id_vendor');
        $via = $this->input->post('via');



        for ($i = 0; $i < sizeof($id_invoice); $i++) {
            $data = array(
                'variabel' => $variabel[$i],
                // 'is_ppn' => $is_ppn,
                'due_date' => $this->input->post('due_date'),
                'no_invoice' => $no_invoice,
                'mode' => $this->input->post('mode'),
                'purpose' => $this->input->post('purpose'),
                'via_transfer' => $via,
                'terbilang' => $terbilang,
                'status' => 0,
                'total_ap' => $total_ap,
                // 'ppn' => $ppn,
                // 'pph' => $pph,
                'update_by' => $this->session->userdata('id_user'),
                'update_at' => date('Y-m-d H:i:s')
            );

            $update = $this->db->update('tbl_invoice_ap_final', $data, ['id_invoice' => $id_invoice[$i]]);
        }
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Update PO'));
            redirect('cs/apExternal/editInvoice/' . $unique_invoice . '/' . encrypt_url($id_vendor));
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/apExternal/editInvoice/' . $unique_invoice . '/' . encrypt_url($id_vendor));
        }
    }



    public function printProformaFull($no_invoice)
    {
        $data['invoice'] = $this->cs->getInvoice($no_invoice)->result_array();
        $data['info'] = $this->cs->getInvoice($no_invoice)->row_array();

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


    public function paid()
    {
        $data = array(
            'payment_date' => $this->input->post('payment_date'),
            'status' => 1,
            'payment_eksekusi' => date('Y-m-d H:i:s')
        );
        $update = $this->db->update('tbl_invoice_ap_final', $data, ['unique_invoice' => $this->input->post('unique_invoice')]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
            redirect('cs/apExternal/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/apExternal/created');
        }
    }
    public function approveAtasan($uniq)
    {
        $where = array('unique_invoice' => $uniq);
        $data = array(
            'no_pengeluaran' => $uniq,
            'approve_by_atasan' => $this->session->userdata('id_user'),
            'created_atasan' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->insert('tbl_approve_pengeluaran_external', $data);
        if ($insert) {
            $this->db->update('tbl_invoice_ap_final', ['status' => 1], $where);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Approve'));
            redirect('cs/apExternal/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/apExternal/created');
        }
    }
    public function approveSm($uniq)
    {
        $where = array('unique_invoice' => $uniq);
        $data = array(
            'approve_by_sm' => $this->session->userdata('id_user'),
            'created_sm' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->update('tbl_approve_pengeluaran_external', $data, ['no_pengeluaran' => $uniq]);
        if ($insert) {
            $this->db->update('tbl_invoice_ap_final', ['status' => 2], $where);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Approve'));
            redirect('cs/apExternal/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/apExternal/created');
        }
    }

    function generateRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function print($no_ap, $id_vendor, $unique_invoice)
    {
        $data['info'] = $this->cs->getApByNoInvoice($unique_invoice)->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->result_array();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['approval'] = $this->db->get_where('tbl_approve_pengeluaran_external', ['no_pengeluaran' => $unique_invoice])->row_array();

        // var_dump($data['approval']);
        // die;

        $this->load->view('superadmin/v_cetak_ap_external', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper('A5', 'landscape');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        // return $this->dompdf->output();
        $output = $this->dompdf->output();
        ob_end_clean();
        // file_put_contents('uploads/barcode' . '/' . "$shipment_id.pdf", $output);
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
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
