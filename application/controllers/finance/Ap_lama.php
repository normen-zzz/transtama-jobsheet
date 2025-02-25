<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ap extends CI_Controller
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
        $this->backend->display('finance/v_ap', $data);
    }

    public function created()
    {
        $shipment_id = $this->input->post('shipment_id');
        if ($shipment_id == NULL) {
            $data['title'] = 'Account Payable';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Account Payable';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['proforma'] = $this->cs->getApVendor()->result_array();
            $this->backend->display('finance/v_invoice_ap', $data);
        } else {
            $cek_data = $this->cs->cekShipment($shipment_id)->row_array();
            if ($cek_data) {
                $data['invoice'] = $this->db->get_where('tbl_invoice', ['shipment_id' => $cek_data['id']])->row_array();
                $data['title'] = 'Account Payable';
                $data['shipment_id'] = $shipment_id;
                $breadcrumb_items = [];
                $data['subtitle'] = 'Account Payable';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['proforma'] = $this->cs->getApVendor()->result_array();
                $this->backend->display('finance/v_invoice_ap', $data);
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Shipment ID Not Found'));
                redirect('finance/ap/created');
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
        $this->backend->display('finance/v_detail_ap', $data);
    }
    public function editInvoice($unique_invoice, $id_vendor)
    {
        $id_vendor = decrypt_url($id_vendor);
        $data['title'] = "Edit Invoice AP";
        $breadcrumb_items = [];
        $data['subtitle'] = "Edit Invoice AP";
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $data['invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->result_array();
        $data['total_invoice'] = $this->cs->getApByNoInvoice($unique_invoice)->num_rows();
        $this->backend->display('finance/v_detail_invoice_ap', $data);
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
        $this->backend->display('finance/v_detail_invoice_ap_paid', $data);
    }

    public function createAp()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $id_vendor =  $this->input->post('id_vendor');
        if ($shipment_id == NULL) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Please Select Minimun 1 Shipment'));
            redirect('finance/ap/detailAp/' . encrypt_url($id_vendor));
        }

        $data['title'] = 'Create AP';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Create AP';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['shipments'] = $shipment_id;
        $data['id_vendor'] = $id_vendor;
        $data['vendor'] = $this->db->get_where('tbl_vendor', ['id_vendor' => $id_vendor])->row_array();
        $this->backend->display('finance/v_create_ap', $data);
    }

    public function createApProforma()
    {
        $shipment_id =  $this->input->post('shipment_id');
        $variabel =  $this->input->post('variabel');

        $due_date = $this->input->post('due_date');
        $total_ap = $this->input->post('total_ap');
        $no_invoice = $this->input->post('no_invoice');
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');
        $terbilang = $this->input->post('terbilang');

        $random_string = $this->generateRandomString();

        // KALO DIA TIDAK ADA PPN DAN PPH
        if ($ppn != 1) {
            $is_ppn = 0;
            $ppn = 0;
        } else {
            $is_ppn = 1;
            $ppn =  $total_ap * 0.011;
        }
        if ($pph != 1) {
            $is_pph = 0;
            $pph =  0;
        } else {
            $is_pph = 1;
            $pph =  $total_ap * 0.02;
        }

        for ($i = 0; $i < sizeof($shipment_id); $i++) {
            $data = array(
                'shipment_id' => $shipment_id[$i],
                'variabel' => $variabel[$i],
                'id_user' => $this->session->userdata('id_user'),
                'id_vendor' => $this->input->post('id_vendor'),
                'vendor' => $this->input->post('nama_vendor'),
                'status' => 0,
                'is_ppn' => $is_ppn,
                'is_pph' => $is_pph,
                'no_invoice' => $no_invoice,
                'unique_invoice' => $random_string,
                'date' => date('Y-m-d'),
                'due_date' => $due_date,
                'terbilang' => $terbilang,
                'status' => 0,
                'total_ap' => $total_ap,
                'ppn' => $ppn,
                'pph' => $pph,
            );

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
            redirect('finance/ap/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/ap/created');
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
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');
        $terbilang = $this->input->post('terbilang');
        $id_vendor = $this->input->post('id_vendor');


        // KALO DIA TIDAK ADA PPN DAN PPH
        if ($ppn != 1) {
            $is_ppn = 0;
            $ppn = 0;
        } else {
            $is_ppn = 1;
            $ppn =  $total_ap * 0.011;
        }
        if ($pph != 1) {
            $is_pph = 0;
            $pph =  0;
        } else {
            $is_pph = 1;
            $pph =  $total_ap * 0.02;
        }

        for ($i = 0; $i < sizeof($id_invoice); $i++) {
            $data = array(
                'variabel' => $variabel[$i],
                'is_ppn' => $is_ppn,
                'is_pph' => $is_pph,
                'no_invoice' => $no_invoice,
                'date' => date('Y-m-d'),
                'due_date' => $due_date,
                'terbilang' => $terbilang,
                'status' => 0,
                'total_ap' => $total_ap,
                'ppn' => $ppn,
                'pph' => $pph,
                'update_by' => $this->session->userdata('id_user'),
                'update_at' => date('Y-m-d H:i:s')
            );

            $update = $this->db->update('tbl_invoice_ap_final', $data, ['id_invoice' => $id_invoice[$i]]);
        }
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Update AP'));
            redirect('finance/ap/editInvoice/' . $unique_invoice . '/' . encrypt_url($id_vendor));
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/ap/editInvoice/' . $unique_invoice . '/' . encrypt_url($id_vendor));
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
        // var_dump($data);
        // $config['upload_path'] = './uploads/ap/';
        // $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['encrypt_name'] = TRUE;
        // $this->upload->initialize($config);

        // $folderUpload = "./uploads/ap/";
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
        $update = $this->db->update('tbl_invoice_ap_final', $data, ['unique_invoice' => $this->input->post('unique_invoice')]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
            redirect('finance/ap/created');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('finance/ap/created');
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
