<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Ap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backoffice');
        }
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $this->load->model('ApModel', 'ap');
        $this->load->model('Sendwa', 'wa');
        cek_role();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'Account Payable';
        $data['ap'] = $this->ap->getMyApCs()->result_array();
        $this->backend->display('cs/v_ap', $data);
    }

    public function history()
    {

        $data['title'] = 'History Account Payable';
        $data['ap'] = $this->ap->getMyApCsHistory()->result_array();
        $this->backend->display('cs/v_ap_history', $data);
    }

    public function apNeedApprove()
    {

        $data['title'] = 'Account Payable (Need Approve)';
        $data['ap'] = $this->ap->getMyApCs()->result_array();
        $this->backend->display('cs/v_ap_need_approve', $data);
    }

    public function detail($no_ap)
    {

        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $this->backend->display('cs/v_detail_ap', $data);
    }
    public function add()
    {

        $data['title'] = 'Add Account Payable';
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $this->backend->display('cs/v_add_ap', $data);
    }

    public function processAdd()
    {
        $id_kategori_pengeluaran = $this->input->post('id_category');
        $description = $this->input->post('descriptions');
        $amount_proposed = $this->input->post('amount_proposed');
        $attachment = $this->input->post('attachment');
        $mode = $this->input->post('mode');
        $via = $this->input->post('via');

        $total = array_sum($amount_proposed);

        $id_kategori = $this->input->post('id_kategori_pengeluaran');
        // 1= po
        // 2= ca
        // 3=car
        // 4 = re
        $no_pengeluaran = '';
        $pre = '';
        $cek_no_invoice = $this->db->select_max('no_pengeluaran')->get_where('tbl_pengeluaran', ['id_kat_ap' => $id_kategori])->row_array();
        if ($id_kategori == 1) {
            $pre = 'PO-';
        } elseif ($id_kategori == 2) {
            $pre = 'CA-';
        } elseif ($id_kategori == 3) {
            $pre = 'CAR-';
        } elseif ($id_kategori == 4) {
            $pre = 'RE-';
        }
        if ($cek_no_invoice['no_pengeluaran'] == NULL) {
            $no_pengeluaran = $pre . '000001';
        } else {
            if ($id_kategori == 3) {
                $potong = substr($cek_no_invoice['no_pengeluaran'], 4, 6);
            } else {
                $potong = substr($cek_no_invoice['no_pengeluaran'], 3, 6);
            }

            $no = $potong + 1;
            $kode =  sprintf("%06s", $no);

            $no_pengeluaran  = "$pre$kode";
        }
        $id_atasan = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();


        for ($i = 0; $i < sizeof($id_kategori_pengeluaran); $i++) {
            $data = array(
                'id_kategori_pengeluaran' => $id_kategori_pengeluaran[$i],
                'description' => $description[$i],
                'amount_proposed' => $amount_proposed[$i],
                'attachment' => $attachment[$i],
                'purpose' => $this->input->post('purpose'),
                'id_kat_ap' => $this->input->post('id_kategori_pengeluaran'),
                'date' => date('Y-m-d'),
                'total' => $total,
                'payment_mode' => $mode,
                'via_transfer' => $via,
                'no_pengeluaran' => $no_pengeluaran,
                'id_user' => $this->session->userdata('id_user'),
                'id_atasan' => $id_atasan['id_atasan']
            );
            $folderUpload = "./uploads/ap/";
            $files = $_FILES;

            $namaFile = $files['attachment']['name'][$i];
            $lokasiTmp = $files['attachment']['tmp_name'][$i];
            // # kita tambahkan uniqid() agar nama gambar bersifat unik
            $namaBaru = uniqid() . '-' . $namaFile;
            $lokasiBaru = "{$folderUpload}/{$namaBaru}";
            move_uploaded_file($lokasiTmp, $lokasiBaru);
            $ktp = array('attachment' => $namaBaru);
            $data = array_merge($data, $ktp);
            $insert =  $this->db->insert('tbl_pengeluaran', $data);
            if ($insert) {
                $get_last_ap = $this->db->limit(1)->order_by('no_pengeluaran', 'DESC')->get('tbl_pengeluaran')->row_array();
                $id_atasan = $this->session->userdata('id_atasan');
                if ($id_atasan == 0 || $id_atasan == NULL) {
                    $data_status = array(
                        'status' => 1,
                    );
                    $data_approve = array(
                        'approve_by_atasan' => $this->session->userdata('id_user'),
                        'no_pengeluaran' =>  $get_last_ap['no_pengeluaran']
                    );

                    $this->db->insert('tbl_approve_pengeluaran', $data_approve);
                    $this->db->update('tbl_pengeluaran', $data_status, ['no_pengeluaran' => $get_last_ap['no_pengeluaran']]);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
					alert-danger" role="alert">Failed</div>');
                redirect('cs/ap/');
            }
        }
        $this->session->set_flashdata('message', '<div class="alert
		alert-success" role="alert">Success</div>');
        redirect('cs/ap/');
    }

    public function processAddDetail()
    {
        $where = array('no_pengeluaran' => $this->input->post('no_pengeluaran1'));
        $id_kategori_pengeluaran = $this->input->post('id_category');
        $description = $this->input->post('descriptions');
        $amount_proposed = $this->input->post('amount_proposed');
        $attachment = $this->input->post('attachment');
        $total = array_sum($amount_proposed);
        $mode = $this->input->post('mode');
        $via = $this->input->post('via');

        $id_kategori = $this->input->post('id_kategori_pengeluaran1');
        // 1= po
        // 2= ca
        // 3=car
        // 4 = re
        $no_pengeluaran = $this->input->post('no_pengeluaran1');

        if ($id_kategori_pengeluaran[0] == NULL) {
            $data = array(
                'purpose' => $this->input->post('purpose'),
                'payment_mode' => $mode,
                'via_transfer' => $via,
            );
            $update = $this->db->update('tbl_pengeluaran', $data, $where);
            if ($update) {
                // unlink('uploads/ap/' . $attachment_lama);
                $this->session->set_flashdata('message', 'Diedit');
                redirect('cs/ap/detail/' . $no_pengeluaran);
            } else {
                $this->session->set_flashdata('message', 'Diedit');
                redirect('cs/ap/detail/' . $no_pengeluaran);
            }
        } else {
            $id_atasan = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

            for ($i = 0; $i < sizeof($id_kategori_pengeluaran); $i++) {
                $data = array(
                    'id_kategori_pengeluaran' => $id_kategori_pengeluaran[$i],
                    'description' => $description[$i],
                    'amount_proposed' => $amount_proposed[$i],
                    'attachment' => $attachment[$i],
                    'purpose' => $this->input->post('purpose'),
                    'id_kat_ap' => $this->input->post('id_kategori_pengeluaran1'),
                    'date' => date('Y-m-d'),
                    'total' => $total,

                    'no_pengeluaran' => $no_pengeluaran,
                    'id_user' => $this->session->userdata('id_user'),
                    'id_atasan' => $id_atasan['id_atasan']
                );
                $folderUpload = "./uploads/ap/";
                $files = $_FILES;

                $namaFile = $files['attachment']['name'][$i];
                $lokasiTmp = $files['attachment']['tmp_name'][$i];
                // # kita tambahkan uniqid() agar nama gambar bersifat unik
                $namaBaru = uniqid() . '-' . $namaFile;
                $lokasiBaru = "{$folderUpload}/{$namaBaru}";
                move_uploaded_file($lokasiTmp, $lokasiBaru);
                $ktp = array('attachment' => $namaBaru);
                $data = array_merge($data, $ktp);
                $insert =  $this->db->insert('tbl_pengeluaran', $data);
                if ($insert) {
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
								alert-danger" role="alert">Failed</div>');
                    redirect('cs/ap/detail/' . $this->input->post('no_pengeluaran1'));
                }
            }
            $this->session->set_flashdata('message', '<div class="alert
					alert-success" role="alert">Success</div>');
            redirect('cs/ap/detail/' . $this->input->post('no_pengeluaran1'));
        }
        // var_dump($id_kategori_pengeluaran[0]);
        // die;



    }
    public function getKategori()
    {
        $kategori = $this->db->get('tbl_list_pengeluaran')->result_array();
        echo json_encode($kategori);
    }

    public function approve($no_pengeluaran)
    {
        $where = array('no_pengeluaran' => $no_pengeluaran);
        $data = array(
            'no_pengeluaran' => $no_pengeluaran,
            'approve_by_sm' => $this->session->userdata('id_user'),
            'created_sm' => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->update('tbl_approve_pengeluaran', $data, $where);
        if ($insert) {
            $this->db->update('tbl_pengeluaran', ['status' => 2], $where);
            $get_ap = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
            $no_ap = $get_ap['no_pengeluaran'];
            $purpose = $get_ap['purpose'];
            $date = $get_ap['date'];
            $pesan = "Hallo Finance, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date*. Tolong Segera Cek Ya, Terima Kasih";
            // no finance
           
            $this->wa->pickup('+6289629096425', "$pesan");
            $this->wa->pickup('+6287771116286', "$pesan");
            //Norman
            $this->wa->pickup('+6285697780467', "$pesan");
            $this->session->set_flashdata('message', 'Success Approve');
            redirect('cs/ap');
        } else {
            $this->session->set_flashdata('message', 'Failed Approve');
            redirect('cs/ap');
        }
    }

    public function delete($id)
    {
        $where = array('id_customer' => $id);
        $delete = $this->db->delete('tb_customer', $where);
        if ($delete) {
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('cs/customer');
        } else {
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('cs/customer');
        }
    }
    public function edit()
    {
        $description = $this->input->post('description');
        $amount_proposed = $this->input->post('amount_proposed');
        $attachment_lama = $this->input->post('attachment_lama');
        $id_pengeluaran = $this->input->post('id_pengeluaran');
        $no_pengeluaran = $this->input->post('no_pengeluaran');
        $where = array('id_pengeluaran' => $this->input->post('id_pengeluaran'));
        $data = array(
            'description' => $description,
            'amount_proposed' => $amount_proposed,
        );

        $folderUpload = "./uploads/ap/";
        $files = $_FILES;
        $attachment = $files['attachment']['name'];

        if ($attachment != NULL) {
            $namaFile = $files['attachment']['name'];
            $lokasiTmp = $files['attachment']['tmp_name'];
            // # kita tambahkan uniqid() agar nama gambar bersifat unik
            $namaBaru = uniqid() . '-' . $namaFile;
            $lokasiBaru = "{$folderUpload}/{$namaBaru}";
            move_uploaded_file($lokasiTmp, $lokasiBaru);
            $ktp = array('attachment' => $namaBaru);
            $data = array_merge($data, $ktp);
        }

        $update = $this->db->update('tbl_pengeluaran', $data, $where);
        if ($update) {
            // unlink('uploads/ap/' . $attachment_lama);
            $this->session->set_flashdata('message', 'Diedit');
            redirect('cs/ap/detail/' . $no_pengeluaran);
        } else {
            $this->session->set_flashdata('message', 'Diedit');
            redirect('cs/ap/detail/' . $no_pengeluaran);
        }
    }
    public function print($no_ap)
    {
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['approval'] = $this->db->get_where('tbl_approve_pengeluaran', ['no_pengeluaran' => $no_ap])->row_array();


        $this->load->view('superadmin/v_cetak_ap', $data);
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
    function getCustomerById()
    {
        $ket = $this->input->post('id', TRUE);
        $data = $this->db->get_where('tb_customer', ['id_customer' => $ket])->row_array();
        echo json_encode($data);
    }
}
