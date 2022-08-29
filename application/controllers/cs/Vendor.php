<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
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
        $data['title'] = 'Vendors/Agents';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Vendors/Agents';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['vendors'] = $this->db->order_by('id_vendor', 'DESC')->get('tbl_vendor')->result_array();
        $this->backend->display('cs/v_vendor', $data);
    }
    public function add()
    {
        $data = array(
            'nama_vendor' => $this->input->post('nama_vendor'),
            'pic' => $this->input->post('pic'),
            'alamat' => $this->input->post('alamat'),
            'type' => $this->input->post('type'),
            'no_rekening' => $this->input->post('no_rekening'),
            'created_by' => $this->session->userdata('nama_user'),
            'username' => generatKode(),
            'password' => password_hash("Transtama2022", PASSWORD_DEFAULT),
            'status' => 1
        );
        $insert = $this->db->insert('tbl_vendor', $data);
        if ($insert) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/vendor');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/vendor');
        }
    }
    public function edit()
    {
        $where = array('id_vendor' => $this->input->post('id_vendor'));
        $data = array(
            'nama_vendor' => $this->input->post('nama_vendor'),
            'pic' => $this->input->post('pic'),
            'alamat' => $this->input->post('alamat'),
            'type' => $this->input->post('type'),
            'no_rekening' => $this->input->post('no_rekening'),
        );
        $update = $this->db->update('tbl_vendor', $data, $where);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/vendor');
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/vendor');
        }
    }


    public function deleteInvoice($id_invoice, $no_invoice, $shipment_id)
    {
        $delete = $this->db->delete('tbl_invoice',  ['id_invoice' => $id_invoice]);
        if ($delete) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect('cs/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect('cs/invoice/edit/' . $id_invoice . '/' . $no_invoice);
        }
    }
    public function Exportexcel($id)
    {
        $detail = $this->db->get_where('tbl_shp_order', ['id' => $id])->row_array();
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-invoice-$detail[shipment_id].xls");
        $data['title'] = "Invoice";
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();

        $this->load->view('cs/export_invoice', $data);
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
