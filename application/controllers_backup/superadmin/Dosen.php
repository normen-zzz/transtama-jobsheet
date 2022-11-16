<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('dsitbacksystem');
        }
        $this->load->model('M_dosen', 'dosen');
        $this->load->library('form_validation');
        $this->load->library('breadcrumb');
        cek_role();
    }

    public function index()
    {
        $breadcrumb_items = [
            'Data Dosen' => 'superadmin/dosen',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data  Dosen';
        $data['dosen'] = $this->dosen->getListDosen()->result_array();
        // var_dump($data['dosen']);
        // die;
        $this->backend->display('superadmin/v_dosen', $data);
    }

    public function add()
    {
        $breadcrumb_items = [
            'Data Dosen' => 'superadmin/dosen',
            'Tambah Dosen' => 'superadmin/dosen/add',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data  Dosen';
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['kewarganegaraan'] = $this->db->get('kewarganegaraan')->result_array();
        $data['pangkat'] = $this->db->get('pangkat')->result_array();
        $data['jabfung'] = $this->db->get('jabfung')->result_array();
        $data['tb_jurusan'] = $this->db->get('tb_jurusan')->result_array();
        // $data['dosen'] = $this->dosen->getDosen()->result_array();
        $this->backend->display('superadmin/v_add_dosen', $data);
    }

    public function detailEdit($id_sdm)
    {
        $breadcrumb_items = [
            'Data Dosen' => 'superadmin/dosen',
            'Edit Dosen' => 'superadmin/dosen/detailEdit',
        ];
        $data['subtitle'] = 'Lihat Data';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Data  Dosen';
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['kewarganegaraan'] = $this->db->get('kewarganegaraan')->result_array();
        $data['pangkat'] = $this->db->get('pangkat')->result_array();
        $data['jabfung'] = $this->db->get('jabfung')->result_array();
        $data['tb_jurusan'] = $this->db->get('tb_jurusan')->result_array();
        $data['dosen'] = $this->db->get_where('dosen', ['id_sdm' => $id_sdm])->row_array();
        // $data['dosen'] = $this->dosen->getDosen()->result_array();
        $this->backend->display('superadmin/v_edit_dosen', $data);
    }

    public function addDosen()
    {

        $data = array(
            'nm_sdm' => $this->input->post('nm_sdm'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'nik' => $this->input->post('nik'),
            'no_hp' => $this->input->post('no_hp'),
            'id_agama' => $this->input->post('id_agama'),
            'statusdosen' => $this->input->post('statusdosen'),
            'jk' => $this->input->post('jk'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'no_tel_rmh' => $this->input->post('no_tel_rmh'),
            'email' => $this->input->post('email'),
            'id_jabfung' => $this->input->post('id_jabfung'),
            'id_prodi' => $this->input->post('id_prodi'),
        );
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tb_user.email]');
        $this->form_validation->set_rules('nik', 'nik', 'trim|required|is_unique[dosen.nik]');
        if ($this->form_validation->run()) {
            if ($this->db->insert('dosen', $data)) {
                log_aktifitas('insert', 'dosen');
                $get_last_id = $this->db->order_by('id_sdm', 'DESC')->limit(1)->get('dosen')->row_array();
                $data2 = array(
                    'username' => $this->input->post('email'),
                    'identify' => $get_last_id['id_sdm'],
                    'email' => $this->input->post('email'),
                    'nama_user' => $this->input->post('nm_sdm'),
                    'id_role' => 4,
                    'id_fakultas' => 1,
                    'id_prodi' => 11,
                    'status' => 1,
                    'password' => password_hash($this->input->post('email'), PASSWORD_DEFAULT)

                );
                $this->db->insert('tb_user', $data2);
                log_aktifitas('insert', 'tb_user');
                $dataflash = array(
                    'title' => 'Data Dosen',
                    'text' => 'Data Dosen Berhasil ditambahkan',
                    'type' => 'success',
                    'icon'  => 'success',
                    'confirmButtonColor' => '#0095cc',
                    'confirmButtonText' => 'Oke',
                );
                $this->session->set_flashdata('message', $dataflash);
            } else {
                $dataflash = array(
                    'title' => 'Data Dosen',
                    'text' => 'Data Dosen Gagal ditambahkan',
                    'type' => 'danger',
                    'icon'  => 'danger',
                    'confirmButtonColor' => '#ff562f',
                    'confirmButtonText' => 'Oke',
                );
                $this->session->set_flashdata('message', $dataflash);
            }
        } else {
            $dataflash = array(
                'title' => 'Data Dosen',
                'text' => 'Gagal !!, Data nik atau email sudah terdaftar',
                'type' => 'danger',
                'icon'  => 'danger',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
        }

        redirect('superadmin/dosen');
    }

    public function delete($id_sdm)
    {
        $where = array('id_sdm' => $id_sdm);
        $delete = $this->db->delete('dosen', $where);
        if ($delete) {
            log_aktifitas('delete', 'dosen');
            $dataflash = array(
                'title' => 'Data Dosen',
                'text' => 'Data Dosen Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/dosen');
        } else {
            $dataflash = array(
                'title' => 'Data Dosen',
                'text' => 'Data Dosen Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/dosen');
        }
    }

    public function edit()
    {
        $where = array('id_sdm' => $this->input->post('id_sdm'));

        $data = array(
            'nm_sdm' => $this->input->post('nm_sdm'),
            'jk' => $this->input->post('jk'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'stat_kawin' => $this->input->post('stat_kawin'),
            'nip' => $this->input->post('nip'),
            'nidn' => $this->input->post('nidn'),
            'npwp' => $this->input->post('npwp'),
            'nik' => $this->input->post('nik'),
            'jln' => $this->input->post('jln'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'ds_kel' => $this->input->post('ds_kel'),
            'kode_pos' => $this->input->post('kode_pos'),
            'no_tel_rmh' => $this->input->post('no_tel_rmh'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'kewarganegaraan' => $this->input->post('kewarganegaraan'),
            'id_agama' => $this->input->post('id_agama'),
            'id_pangkat_gol' => $this->input->post('id_pangkat_gol'),
            'kec' => $this->input->post('kec'),
            'kota' => $this->input->post('kota'),
            'propinsi' => $this->input->post('propinsi'),
            'id_jabfung' => $this->input->post('id_jabfung'),
            'statusdosen' => $this->input->post('statusdosen'),
            'id_prodi' => $this->input->post('id_prodi'),
            's1' => $this->input->post('s1'),
            'lulus1' => $this->input->post('lulus1'),
            'gelar1' => $this->input->post('gelar1'),
            's2' => $this->input->post('s2'),
            'lulus2' => $this->input->post('lulus2'),
            'gelar2' => $this->input->post('gelar2'),
            's3' => $this->input->post('s3'),
            'lulus3' => $this->input->post('lulus3'),
            'gelar3' => $this->input->post('gelar3'),
            'aktif' => $this->input->post('aktif'),
        );

        $update = $this->db->update('dosen', $data, $where);
        log_aktifitas('update', 'dosen');
        if ($update) {
            $dataflash = array(
                'title' => 'Data Dosen',
                'text' => 'Data Dosen Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/dosen');
        } else {
            $dataflash = array(
                'title' => 'Data Dosen',
                'text' => 'Data Dosen Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/dosen');
        }
    }


    public function Exportpdf($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            $data['title'] = "Data User dari $start sampai $end ";
            $data['dosen'] = $this->dosen->getDosen()->result_array();
        } else {
            $data['title'] = "Export User";
            $data['dosen'] = $this->dosen->getDosen()->result_array();
        }

        $this->load->view('superadmin/v_export_dosen_pdf', $data);
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
            header("Content-Disposition: attachment;Filename=export-users-$start-$end.xls");
            $data['title'] = "Laporan Produk dari $start sampai $end ";
            $data['dosen'] = $this->dosen->getDosen()->result_array();
        } else {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=export-users.xls");
            $data['title'] = "Laporan Produk Keseluruhan ";
            $data['dosen'] = $this->dosen->getDosen()->result_array();
        }
        $data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

        $this->load->view('superadmin/v_export_dosen_excel', $data);
    }

    public function importDosen()
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
                    'nm_sdm' => $rowdata[0],
                    'jk' => $rowdata[1],
                    'nik' => $rowdata[2],
                    'email' => $rowdata[3],
                    'tmpt_lahir' => $rowdata[4],
                    'tgl_lahir' => $rowdata[5],
                    'stat_kawin' => $rowdata[6],
                    'kewarganegaraan' => $rowdata[7],
                    'id_agama' => $rowdata[8],
                    'id_prodi' => $rowdata[11],
                );
                // var_dump($rowdata[2]);
                // echo '<br>';
                $a = $this->db->get_where('dosen', ['nik' => $rowdata[2]])->result_array();
                $username = $this->db->get_where('tb_user', ['username' => $rowdata[9]])->num_rows();
                $email = $this->db->get_where('tb_user', ['email' => $rowdata[3]])->num_rows();
                if (count($a) == 0 && $username == 0 && $email == 0) {
                    $insert = $this->db->insert('dosen', $data);
                    // var_dump($insert);
                    // die;
                    if ($insert) {
                        log_aktifitas('insert', 'dosen');
                        $get_last_id = $this->db->order_by('id_sdm', 'DESC')->limit(1)->get('dosen')->row_array();
                        $data2 = array(
                            'username' => $rowdata[9],
                            'identify' => $get_last_id['id_sdm'],
                            'email' => $rowdata[3],
                            'nama_user' => $rowdata[0],
                            'id_role' => 4,
                            'id_fakultas' => $rowdata[10],
                            'id_prodi' => $rowdata[11],
                            'status' => 1,
                            'password' => password_hash($rowdata[12], PASSWORD_DEFAULT)

                        );
                        $this->db->insert('tb_user', $data2);
                        // die;
                        log_aktifitas('insert', 'tb_user');
                        $dataflash = array(
                            'title' => 'Data Dosen',
                            'text' => 'Data Dosen Berhasil diimport',
                            'type' => 'success',
                            'icon'  => 'success',
                            'confirmButtonColor' => '#0095cc',
                            'confirmButtonText' => 'Oke',
                        );
                        $this->session->set_flashdata('message', $dataflash);
                    }
                } else {
                    $dataflash = array(
                        'title' => 'Data Dosen',
                        'text' => 'Gagal !!,Data Dosen ' . $rowdata[9] . '  sudah ada',
                        'type' => 'danger',
                        'icon'  => 'danger',
                        'confirmButtonColor' => '#ff562f',
                        'confirmButtonText' => 'Oke',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                }
            }
        }



        redirect('superadmin/dosen');
    }
}
