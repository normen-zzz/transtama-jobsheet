<?php
defined('BASEPATH') or exit('No direct script access allowed');

use phpDocumentor\Reflection\Types\Null_;
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

        $data['title'] = 'Account Payable - Payment Order';
        $data['ap'] = $this->ap->getApByCategory(1)->result_array();
        $data['ap2'] = $this->ap->getApByCategory(1)->result_array();

        $this->backend->display('finance/v_ap', $data);
    }
    public function history()
    {

        $data['title'] = 'Account Payable - Payment Order';
        $data['ap'] = $this->ap->getHistoryApByCategory(1)->result_array();

        $this->backend->display('finance/v_ap_history', $data);
    }
    public function ca()
    {

        $data['title'] = 'Account Payable - Cash Advance';
        $data['ap'] = $this->ap->getApByCategory(2)->result_array();
        $data['ap2'] = $this->ap->getApByCategory(2)->result_array();

        $this->backend->display('finance/v_ap', $data);
    }
    public function historyCa()
    {

        $data['title'] = 'Account Payable - Cash Advance';
        $data['ap'] = $this->ap->getHistoryApByCategory(2)->result_array();

        $this->backend->display('finance/v_ap_history', $data);
    }

    public function car()
    {

        $data['title'] = 'Account Payable - Cash Advance Report';
        $data['ap'] = $this->ap->getApByCategory(3)->result_array();
        $data['ap2'] = $this->ap->getApByCategory(3)->result_array();

        $this->backend->display('finance/v_ap', $data);
    }
    public function historyCar()
    {

        $data['title'] = 'Account Payable - Cash Advance Report';
        $data['ap'] = $this->ap->getHistoryApByCategory(3)->result_array();

        $this->backend->display('finance/v_ap_history', $data);
    }
    public function re()
    {

        $data['title'] = 'Account Payable - Reimbursment';
        $data['ap'] = $this->ap->getApByCategory(4)->result_array();
        $data['ap2'] = $this->ap->getApByCategory(4)->result_array();

        $this->backend->display('finance/v_ap', $data);
    }
    public function historyRe()
    {

        $data['title'] = 'Account Payable - Reimbursment';
        $data['ap'] = $this->ap->getHistoryApByCategory(4)->result_array();

        $this->backend->display('finance/v_ap_history', $data);
    }
    public function list_pengeluaran()
    {

        $data['title'] = 'List Pengeluaran';
        $data['ap'] = $this->db->get('tbl_list_pengeluaran')->result_array();

        $this->backend->display('finance/v_list_pengeluaran', $data);
    }
    public function editKategori()
    {
        $where = array('id_kategori' => $this->input->post('id_kategori'));
        $data = array(
            'nama_kategori_pengeluaran' => $this->input->post('nama_kategori_pengeluaran'),
            'kode_kategori' => $this->input->post('kode_kategori'),
        );
        $update = $this->db->update('tbl_list_pengeluaran', $data, $where);
        if ($update) {
            $this->session->set_flashdata('message', 'Success Edit');
            redirect('finance/ap/list_pengeluaran');
        } else {
            $this->session->set_flashdata('message', 'Failed Edit');
            redirect('finance/ap/list_pengeluaran');
        }
    }
    public function add()
    {
        $data = array(
            'nama_kategori_pengeluaran' => $this->input->post('nama_kategori_pengeluaran'),
            'kode_kategori' => $this->input->post('kode_kategori'),
        );
        $insert = $this->db->insert('tbl_list_pengeluaran', $data);
        if ($insert) {
            $this->session->set_flashdata('message', 'Success');
            redirect('finance/ap/list_pengeluaran');
        } else {
            $this->session->set_flashdata('message', 'Failed');
            redirect('finance/ap/list_pengeluaran');
        }
    }
    public function detail($no_ap)
    {

        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['ap2'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $data['approval'] = $this->db->get_where('tbl_approve_pengeluaran', ['no_pengeluaran', $no_ap])->row_array();
        $this->backend->display('finance/v_detail_ap', $data);
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
                redirect('finance/ap/');
            }
        }
        $this->session->set_flashdata('message', '<div class="alert
		alert-success" role="alert">Success</div>');
        redirect('finance/ap/');
    }

    public function processAddDetail()
    {
        $amount_approved = $this->input->post('amount_approved');
        $id_pengeluaran = $this->input->post('id_pengeluaran');
        $no_pengeluaran1 = $this->input->post('no_pengeluaran1');
        $total = array_sum($amount_approved);

        for ($i = 0; $i < sizeof($id_pengeluaran); $i++) {
            $data = array(
                'id_kategori_pengeluaran' => $this->input->post('kategori')[$i],
                'amount_approved' => $amount_approved[$i],
                'total_approved' => $total,
            );
            $this->db->update('tbl_pengeluaran', $data, ['id_pengeluaran' => $id_pengeluaran[$i]]);
        }
        $get_ap = $this->db->get_where('tbl_pengeluaran', ['no_pengeluaran' => $this->input->post('no_pengeluaran1')])->row_array();
        $no_ap = $get_ap['no_pengeluaran'];
        $purpose = $get_ap['purpose'];
        $date = $get_ap['date'];
        $get_user = $this->db->get_where('tb_user', ['id_user' => $get_ap['id_user']])->row_array();
        if ($get_ap['status'] == 3) {
            $data_status = array(
                'status' => 7,
            );
            $link = "https://jobsheet.transtama.com/approval/detailGm/$no_ap";
            $pesan = "Hallo, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date* Yang Telah Diapprove Manager Finance. Silahkan approve melalui link berikut : $link . Terima Kasih";
            if ($get_user['id_role'] == 4 || $get_user['id_role'] == 6) {
                // no mba vema
                $this->wa->pickup('+628111910711', "$pesan");
                //Norman
                $this->wa->pickup('+6285697780467', "$pesan");
                // var_dump('ini finance dan sales');
            }
        } else {
            $data_status = array(
                'status' => 3,
            );
            $link = "https://jobsheet.transtama.com/approval/detailFinance/$no_ap";
            $pesan = "Hallo, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date*. Silahkan approve melalui link berikut : $link . Terima Kasih";
            // no mba dwi
            $this->wa->pickup('+6281212311908', "$pesan");
            //Norman
            $this->wa->pickup('+6285697780467', "$pesan");
        }

        $data_approve = array(
            'received_by' => $this->session->userdata('id_user'),
            'created_received' =>  date('Y-m-d H:i:s')
        );

        $this->db->update('tbl_approve_pengeluaran', $data_approve, ['no_pengeluaran' => $this->input->post('no_pengeluaran1')]);
        $this->db->update('tbl_pengeluaran', $data_status, ['no_pengeluaran' => $this->input->post('no_pengeluaran1')]);

        // kirim WA




        $this->session->set_flashdata('message', '<div class="alert
					alert-success" role="alert">Success</div>');
        redirect('finance/ap/detail/' . $this->input->post('no_pengeluaran1'));
    }

    public function approveFinance($no_ap)
    {
        $data_status = array(
            'status' => 7,
        );
        $data_approve = array(
            'approve_mgr_finance' => $this->session->userdata('id_user'),
            'created_mgr_finance' =>  date('Y-m-d H:i:s')
        );

        $this->db->update('tbl_approve_pengeluaran', $data_approve, ['no_pengeluaran' => $no_ap]);
        $this->db->update('tbl_pengeluaran', $data_status, ['no_pengeluaran' => $no_ap]);

        // kirim WA

        $get_ap = $this->db->get_where('tbl_pengeluaran', ['no_pengeluaran' => $no_ap])->row_array();
        $get_user = $this->db->get_where('tb_user', ['id_user' => $get_ap['id_user']])->row_array();
        $no_ap = $get_ap['no_pengeluaran'];
        $purpose = $get_ap['purpose'];
        $date = $get_ap['date'];
        $link = "https://jobsheet.transtama.com/approval/detailGm/$no_ap";
        // $link = "http://jobsheet.test/approval/ap/$no_ap";
        // echo "<li><a href='whatsapp://send?text=$actual_link'>Share</a></li>";
        $pesan = "Hallo, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date* Yang Telah Diapprove Manager Finance. Silahkan approve melalui link berikut : $link . Terima Kasih";
        if ($get_user['id_role'] == 4 || $get_user['id_role'] == 6) {
            // no mba vema
            $this->wa->pickup('+628111910711', "$pesan");
            //Norman
            $this->wa->pickup('+6285697780467', "$pesan");
            // var_dump('ini finance dan sales');
        }

        $this->session->set_flashdata('message', '<div class="alert
					alert-success" role="alert">Success</div>');
        redirect('finance/ap/detail/' . $no_ap);
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
        $insert = $this->db->insert('tbl_approve_pengeluaran', $data);
        if ($insert) {
            $this->db->update('tbl_pengeluaran', ['status' => 2], $where);
            $this->session->set_flashdata('message', 'Success Approve');
            redirect('finance/ap');
        } else {
            $this->session->set_flashdata('message', 'Failed Approve');
            redirect('finance/ap');
        }
    }
    public function approveGm($no_pengeluaran, $url = Null)
    {
        if ($url == NULL) {
            $url = "finance/ap/";
        } else {
            $url = "finance/ap/$url";
        }
        $where = array('no_pengeluaran' => $no_pengeluaran);
        $data = array(
            'approve_by_gm' => $this->session->userdata('id_user'),
            'created_gm' => date('Y-m-d H:i:s'),
        );
        $update = $this->db->update('tbl_approve_pengeluaran', $data, $where);
        if ($update) {
            $this->db->update('tbl_pengeluaran', ['status' => 5], $where);

            $get_ap = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
            $no_ap = $get_ap['no_pengeluaran'];
            $purpose = $get_ap['purpose'];
            $date = $get_ap['date'];
            $pesan = "Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date* Sudah di Approve GM. Tolong Segera Bayar Ya, Terima Kasih";
            // no finance
            // $this->wa->pickup('+6285157906966', "$pesan");
            $this->wa->pickup('+6289629096425', "$pesan");
            $this->wa->pickup('+6287771116286', "$pesan");
            //Norman
            $this->wa->pickup('+6285697780467', "$pesan");

            $this->session->set_flashdata('message', 'Success Approve');
            redirect($url);
        } else {
            $this->session->set_flashdata('message', 'Failed Approve');
            redirect($url);
        }
    }

    public function delete($id)
    {
        $where = array('id_customer' => $id);
        $delete = $this->db->delete('tb_customer', $where);
        if ($delete) {
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('finance/customer');
        } else {
            $this->session->set_flashdata('message', 'Dihapus');
            redirect('finance/customer');
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
            redirect('finance/ap/detail/' . $no_pengeluaran);
        } else {
            $this->session->set_flashdata('message', 'Diedit');
            redirect('finance/ap/detail/' . $no_pengeluaran);
        }
    }
    public function paid()
    {
        $url = $this->input->post('url');
        if ($url == NULL) {
            $url = "finance/ap/";
        } else {
            $url = "finance/ap/$url";
        }
        $data = array(
            'payment_date' => $this->input->post('payment_date'),
            'status' => 4
        );

        $folderUpload = "./uploads/ap_proof/";
        $files = $_FILES;
        $namaFile = $files['ktp']['name'];
        $lokasiTmp = $files['ktp']['tmp_name'];

        # kita tambahkan uniqid() agar nama gambar bersifat unik
        $namaBaru = uniqid() . '-' . $namaFile;

        array_push($listNamaBaru, $namaBaru);
        $lokasiBaru = "{$folderUpload}/{$namaBaru}";
        move_uploaded_file($lokasiTmp, $lokasiBaru);

        $ktp = array('payment_proof' => $namaBaru);
        $data = array_merge($data, $ktp);

        $update = $this->db->update('tbl_pengeluaran', $data, ['no_pengeluaran' => $this->input->post('no_invoice')]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
            redirect($url);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect($url);
        }
    }
    public function paidLangsung()
    {
        $url = $this->input->post('url');
        if ($url == NULL) {
            $url = "finance/ap/";
        } else {
            $url = "finance/ap/$url";
        }
        $id_pengeluaran = $this->input->post('id_pengeluaran');
        $amount_approved = $this->input->post('amount_approved');
        $total = array_sum($amount_approved);
        for ($i = 0; $i < sizeof($id_pengeluaran); $i++) {
            $dataApprove = array(
                'amount_approved' => $amount_approved[$i],
                'total_approved' => $total,
            );
            $this->db->update('tbl_pengeluaran', $dataApprove, ['id_pengeluaran' => $id_pengeluaran[$i]]);
        }
        $data = array(
            'payment_date' => $this->input->post('payment_date'),
            'status' => 4
        );

        $folderUpload = "./uploads/ap_proof/";
        $files = $_FILES;
        $namaFile = $files['ktp']['name'];
        $lokasiTmp = $files['ktp']['tmp_name'];

        # kita tambahkan uniqid() agar nama gambar bersifat unik
        $namaBaru = uniqid() . '-' . $namaFile;

        array_push($listNamaBaru, $namaBaru);
        $lokasiBaru = "{$folderUpload}/{$namaBaru}";
        move_uploaded_file($lokasiTmp, $lokasiBaru);

        $ktp = array('payment_proof' => $namaBaru);
        $data = array_merge($data, $ktp);

        $update = $this->db->update('tbl_pengeluaran', $data, ['no_pengeluaran' => $this->input->post('no_invoice')]);
        if ($update) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success Paid'));
            redirect($url);
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Failed'));
            redirect($url);
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

    public function void()
    {
        $where = array('no_pengeluaran' => $this->input->post('no_pengeluaran'));
        $data = array(
            'reason_void' => $this->input->post('reason'),
            'void_date' => date('Y-m-d H:i:s'),
            'status' => 6
        );
        $update = $this->db->update('tbl_pengeluaran', $data, $where);
        if ($update) {
            $this->session->set_flashdata('message', 'Success Void');
            redirect('finance/ap/detail/' . $this->input->post('no_pengeluaran'));
        } else {
            $this->session->set_flashdata('message', 'Failed Void');
            redirect('finance/ap/detail/' . $this->input->post('no_pengeluaran'));
        }
    }

    public function addCar()
    {

        $data['title'] = 'Add Account Payable';
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $this->backend->display('finance/v_add_ap', $data);
    }
    public function processAddCar()
    {
        $id_kategori_pengeluaran = $this->input->post('id_category');
        $description = $this->input->post('descriptions');
        $amount_proposed = $this->input->post('amount_proposed');
        $attachment = $this->input->post('attachment');
        $mode = $this->input->post('mode');
        $via = $this->input->post('via');
        $no_ca = $this->input->post('no_ca');

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
                $get_ca = $this->db->get_where('tbl_pengeluaran', ['no_pengeluaran' => $no_ca])->row_array();
                if ($get_ca) {
                    $potong =    substr($get_ca['no_pengeluaran'], 4, 6);
                    $no_pengeluaran = "CAR-$potong";
                } else {
                    $this->session->set_flashdata('message', "<div class='alert
					alert-danger' role='alert'>No CA with This $no_ca</div>");
                    redirect('finance/ap/addCar');
                }
            } else {
                $potong = substr($cek_no_invoice['no_pengeluaran'], 3, 6);
                $no = $potong + 1;
                $kode =  sprintf("%06s", $no);

                $no_pengeluaran  = "$pre$kode";
            }
        }
        $id_atasan = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        for ($i = 0; $i < sizeof($id_kategori_pengeluaran); $i++) {
            $data = array(
                'id_kategori_pengeluaran' => $id_kategori_pengeluaran[$i],
                'description' => $description[$i],
                'amount_proposed' => $amount_proposed[$i],
                // 'attachment' => $attachment[$i],
                'purpose' => $this->input->post('purpose'),
                'id_kat_ap' => $this->input->post('id_kategori_pengeluaran'),
                'date' => date('Y-m-d'),
                'total' => $total,
                'payment_mode' => $mode,
                'via_transfer' => $via,
                'no_ca' => $no_ca,
                'no_pengeluaran' => $no_pengeluaran,
                'id_user' => $this->session->userdata('id_user'),
                'id_atasan' => $id_atasan['id_atasan'],
                'is_approve_sm' => 0,
                'status' => 2
            );

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
            }
            //  else {
            //     // $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            //     // redirect('finance/ap/car');
            // }
        }
        $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
        redirect('finance/ap/car');
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

    public function cekAp()
    {
        if ($this->input->post('no_pengeluaran') == NULL) {
            $data['title'] = 'CEK AP';
            $data['no_pengeluaran'] = NULL;
            $this->backend->display('finance/v_cek_ap', $data);
        } else {
            
            $pengeluaran = $this->db->query('SELECT * FROM tbl_pengeluaran WHERE no_pengeluaran = "'.$this->input->post('no_pengeluaran').'" LIMIT 1 ');
            $pengeluaranExternal = $this->db->query('SELECT * FROM tbl_pengeluaran WHERE no_po = "'.$this->input->post('no_pengeluaran').'" LIMIT 1 ');
            
            $data['title'] = 'CEK AP';
            $data['no_pengeluaran'] = $this->input->post('no_pengeluaran');

            if ($pengeluaran->num_rows() == NULL && $pengeluaranExternal->num_rows() != NULL) {
                $data['pengeluaran'] = $pengeluaranExternal->row_array();
            } elseif ($pengeluaran->num_rows() != NULL && $pengeluaranExternal->num_rows() == NULL) {
                $data['pengeluaran'] = $pengeluaran->row_array();
            }else{
                $data['pengeluaran'] = NULL;
            }
            $this->backend->display('finance/v_cek_ap', $data);
        }
    }
}
