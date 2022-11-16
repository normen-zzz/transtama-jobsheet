<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backOfficeManagement');
        }
        $this->load->library('form_validation');
        $this->load->library('breadcrumb');
        $this->load->model('M_mahasiswa', 'mahasiswa');
        cek_role();
    }

    public function index()
    {
        $breadcrumb_items = [
            'Data Mahasiswa' => 'superadmin/mahasiswa',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data Mahasiswa';
        $data['mahasiswa'] = $this->mahasiswa->getListMahasiswa()->result_array();
        // var_dump($data['mahasiswa']);
        // die;
        $this->backend->display('superadmin/v_mahasiswa', $data);
    }

    public function add()
    {
        $breadcrumb_items = [
            'Data Mahasiswa' => 'superadmin/mahasiswa',
            'Tambah Mahasiswa' => 'superadmin/mahasiswa/add',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data Mahasiswa';
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['kewarganegaraan'] = $this->db->get('kewarganegaraan')->result_array();
        $data['jenis_tinggal'] = $this->db->get('jenis_tinggal')->result_array();
        $data['jenjang_pendidikan'] = $this->db->get('jenjang_pendidikan')->result_array();
        $data['alat_transportasi'] = $this->db->get('data_transportasi')->result_array();
        $data['pekerjaan'] = $this->db->get('pekerjaan')->result_array();
        $data['penghasilan'] = $this->db->get('penghasilan')->result_array();
        // var_dump($data['mahasiswa']);
        // die;
        $this->backend->display('superadmin/v_add_mahasiswa', $data);
    }

    public function detailEdit($id_mhs)
    {
        $breadcrumb_items = [
            'Data Mahasiswa' => 'superadmin/mahasiswa',
            'Edit Mahasiswa' => 'superadmin/mahasiswa/detaiEdit',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data Mahasiswa';
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['kewarganegaraan'] = $this->db->get('kewarganegaraan')->result_array();
        $data['jenis_tinggal'] = $this->db->get('jenis_tinggal')->result_array();
        $data['jenjang_pendidikan'] = $this->db->get('jenjang_pendidikan')->result_array();
        $data['alat_transportasi'] = $this->db->get('data_transportasi')->result_array();
        $data['pekerjaan'] = $this->db->get('pekerjaan')->result_array();
        $data['penghasilan'] = $this->db->get('penghasilan')->result_array();
        // $data['mahasiswa'] = $this->db->get_where('mhs', ['id' => $id_mhs])->row_array();
        $data['mahasiswa'] = $this->mahasiswa->getDetailMahasiswa3($id_mhs)->row_array();
        // var_dump($data['mahasiswa']);
        // die;
        $this->backend->display('superadmin/v_edit_mahasiswa', $data);
    }

    public function addMahasiswa()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tb_user.email]');
        $this->form_validation->set_rules('nim', 'nim', 'trim|required|is_unique[tb_user.username]');
        if ($this->form_validation->run()) {
            $data = array(
                'nm_pd' => $this->input->post('nm_pd'),
                'jk' => $this->input->post('jk'),
                'tmpt_lahir' => $this->input->post('tmpt_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jln' => $this->input->post('jln'),
                'id_agama' => $this->input->post('id_agama'),
                'no_tel_rmh' => $this->input->post('no_tel_rmh'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email')
            );
            $insert = $this->db->insert('mhs', $data);

            if ($insert) {
                log_aktifitas('insert', 'mhs');
                $get_last_id = $this->db->order_by('id', 'DESC')->limit(1)->get('mhs')->row_array();
                $data2 = array(
                    'username' => $this->input->post('nim'),
                    'identify' => $get_last_id['id'],
                    'email' => $this->input->post('email'),
                    'nama_user' => $this->input->post('nm_pd'),
                    'id_role' => 5,
                    'id_fakultas' => 1,
                    'id_prodi' => 11,
                    'status' => 1,
                    'password' => password_hash($this->input->post('nim'), PASSWORD_DEFAULT)

                );
                $this->db->insert('tb_user', $data2);
                log_aktifitas('insert', 'tb_user');
                $dataflash = array(
                    'title' => 'Data Mahasiswa',
                    'text' => 'Data Mahasiswa Berhasil ditambahkan',
                    'type' => 'success',
                    'icon'  => 'success',
                    'confirmButtonColor' => '#0095cc',
                    'confirmButtonText' => 'Oke',
                );
                $this->session->set_flashdata('message', $dataflash);
            }
            redirect('superadmin/mahasiswa');
        } else {
            $dataflash = array(
                'title' => 'Data Mahasiswa',
                'text' => 'Email atau NIM sudah terdaftar',
                'type' => 'danger',
                'icon'  => 'danger',
                'confirmButtonColor' => '#F64E60',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/mahasiswa');
        }
    }

    public function importMahasiswa()
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            foreach ($sheetData as $rowdata) {
                # code...
                $data = array(
                    'nm_pd' => $rowdata[0],
                    'jk' => $rowdata[1],
                    'nik' => $rowdata[2],
                    'email' => $rowdata[3],
                    'tmpt_lahir' => $rowdata[4],
                    'tgl_lahir' => $rowdata[5],
                    'kewarganegaraan' => $rowdata[6],
                    'id_agama' => $rowdata[7],
                );
                // var_dump($rowdata[2]);
                // echo '<br>';
                $a = $this->db->get_where('mhs', ['nik' => $rowdata[2]])->result_array();
                $username = $this->db->get_where('tb_user', ['username' => $rowdata[8]])->num_rows();
                $email = $this->db->get_where('tb_user', ['email' => $rowdata[3]])->num_rows();
                if (count($a) == 0 && $username == 0 && $email == 0) {
                    // var_dump($username);
                    // var_dump($email);
                    // die;
                    $insert = $this->db->insert('mhs', $data);
                    // var_dump($insert);
                    // die;
                    if ($insert) {
                        log_aktifitas('insert', 'mhs');
                        $get_last_id = $this->db->order_by('id', 'DESC')->limit(1)->get('mhs')->row_array();
                        $data2 = array(
                            'username' => $rowdata[8],
                            'identify' => $get_last_id['id'],
                            'email' => $rowdata[3],
                            'nama_user' => $rowdata[0],
                            'id_role' => 5,
                            'id_fakultas' => $rowdata[9],
                            'id_prodi' => $rowdata[10],
                            'status' => 1,
                            'password' => password_hash($rowdata[8], PASSWORD_DEFAULT)

                        );
                        $this->db->insert('tb_user', $data2);
                        log_aktifitas('insert', 'tb_user');
                        $dataflash = array(
                            'title' => 'Data Mahasiswa',
                            'text' => 'Data Mahasiswa Berhasil ditambahkan',
                            'type' => 'success',
                            'icon'  => 'success',
                            'confirmButtonColor' => '#0095cc',
                            'confirmButtonText' => 'Oke',
                        );
                        $this->session->set_flashdata('message', $dataflash);
                    }
                } else {
                    $dataflash = array(
                        'title' => 'Data Mahasiswa',
                        'text' => 'Gagal !!, Data Mahasiswa ' . $rowdata[0] . ' Sudah Ada',
                        'type' => 'danger',
                        'icon'  => 'danger',
                        'confirmButtonColor' => '#F64E60',
                        'confirmButtonText' => 'Oke',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                }
            }
        }



        redirect('superadmin/mahasiswa');
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $delete = $this->db->delete('mhs', $where);
        if ($delete) {
            log_aktifitas('delete', 'mhs');
            $dataflash = array(
                'title' => 'Data Mahasiswa',
                'text' => 'Data Mahasiswa Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/mahasiswa');
        } else {
            $dataflash = array(
                'title' => 'Data Mahasiswa',
                'text' => 'Data Mahasiswa Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/mahasiswa');
        }
    }

    public function edit()
    {
        $where = array('id' => $this->input->post('id'));

        $data = array(
            'nm_pd' => $this->input->post('nm_pd'),
            'jk' => $this->input->post('jk'),
            'nisn' => $this->input->post('nisn'),
            'nirm' => $this->input->post('nirm'),
            'nirl' => $this->input->post('nirl'),
            'pin' => $this->input->post('pin'),
            'npwp' => $this->input->post('npwp'),
            'nik' => $this->input->post('nik'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'id_kk' => $this->input->post('id_kk'),
            'jln' => $this->input->post('jln'),
            'id_agama' => $this->input->post('id_agama'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'ds_kel' => $this->input->post('ds_kel'),
            'kode_pos' => $this->input->post('kode_pos'),
            'id_jns_tinggal' => $this->input->post('id_jns_tinggal'),
            'id_alat_transport' => $this->input->post('id_alat_transport'),
            'no_tel_rmh' => $this->input->post('no_tel_rmh'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'nik_ayah' => $this->input->post('nik_ayah'),
            'nm_ayah' => $this->input->post('nm_ayah'),
            'tgl_lahir_ayah' => $this->input->post('tgl_lahir_ayah'),
            'id_jenjang_pendidikan_ayah' => $this->input->post('id_jenjang_pendidikan_ayah'),
            'id_pekerjaan_ayah' => $this->input->post('id_pekerjaan_ayah'),
            'id_penghasilan_ayah' => $this->input->post('id_penghasilan_ayah'),
            'nik_ibu' => $this->input->post('nik_ibu'),
            'nm_ibu_kandung' => $this->input->post('nm_ibu_kandung'),
            'tgl_lahir_ibu' => $this->input->post('tgl_lahir_ibu'),
            'id_jenjang_pendidikan_ibu' => $this->input->post('id_jenjang_pendidikan_ibu'),
            'id_pekerjaan_ibu' => $this->input->post('id_pekerjaan_ibu'),
            'id_penghasilan_ibu' => $this->input->post('id_penghasilan_ibu'),
            'nik_wali' => $this->input->post('nik_wali'),
            'nm_wali' => $this->input->post('nm_wali'),
            'tgl_lahir_wali' => $this->input->post('tgl_lahir_wali'),
            'id_jenjang_pendidikan_wali' => $this->input->post('id_jenjang_pendidikan_wali'),
            'id_pekerjaan_wali' => $this->input->post('id_pekerjaan_wali'),
            'id_penghasilan_wali' => $this->input->post('id_penghasilan_wali'),
            'kewarganegaraan' => $this->input->post('kewarganegaraan'),
        );

        $update = $this->db->update('mhs', $data, $where);
        if ($update) {
            log_aktifitas('update', 'mhs');
            $dataflash = array(
                'title' => 'Data Mahasiswa',
                'text' => 'Data Mahasiswa Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/Mahasiswa');
        } else {
            $dataflash = array(
                'title' => 'Data Mahasiswa',
                'text' => 'Data Mahasiswa Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/Mahasiswa');
        }
    }

    public function Exportpdf($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            $data['title'] = "Data Mahasiswa dari $start sampai $end ";
            $data['mahasiswa'] = $this->mahasiswa->getMahasiswa()->result_array();
        } else {
            $data['title'] = "Export Mahasiswa";
            $data['mahasiswa'] = $this->mahasiswa->getMahasiswa()->result_array();
        }

        $this->load->view('superadmin/v_export_mahasiswa_pdf', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }

    public function Exportexcel($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=export-mahasiswa-$start-$end.xls");
            $data['title'] = "Laporan Produk dari $start sampai $end ";
            $data['mahasiswa'] = $this->mahasiswa->getMahasiswa()->result_array();
        } else {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=export-mahasiswa.xls");
            $data['title'] = "Laporan Produk Keseluruhan ";
            $data['mahasiswa'] = $this->mahasiswa->getMahasiswa()->result_array();
        }
        $data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

        $this->load->view('superadmin/v_export_mahasiswa_excel', $data);
    }
}
