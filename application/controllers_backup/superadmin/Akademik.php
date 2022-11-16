<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akademik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backOfficeManagement');
        }
        $this->load->model('KeuanganModel', 'keuangan');
        $this->load->model('M_akademik', 'akademik');
        $this->load->library('upload');
        $this->load->library('breadcrumb');
        $this->load->model('M_KalenderAkademik', 'kalender');
        cek_role();
    }
    public function krs()
    {
        $breadcrumb_items = [
            'KRS Mahasiswa' => 'superadmin/akademik/krs',
        ];
        $data['subtitle'] = 'Manajemen Akademik';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $id_semester = $this->input->post('id_semester');

        // $data['id_semester_dipilih'] = $id_semester;
        $data['title'] = 'Kartu Rencana Studi';
        if ($id_semester) {
            $data['krs'] = $this->akademik->getKrs($id_semester)->result_array();
        } else {
            $data['krs'] = $this->akademik->getKrs()->result_array();
            // var_dump($data['krs']);
            // die;
        }

        $data['semester'] = $this->db->get('semester')->result_array();
        // var_dump($data['krs']);
        // die;
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        if ($id_semester) {
            echo json_encode(array(
                'data' => $data
            ));
        } else {
            $this->backend->display('superadmin/v_krs', $data);
        }
    }

    public function cekKrsMahasiswa()
    {
        $breadcrumb_items = [
            'Belum Ambil KRS' => 'superadmin/akademik/cekKrsMahasiswa',
        ];
        $data['subtitle'] = 'Manajemen Informasi';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $semester = $this->db->order_by('id_semester', 'DESC')->limit(1)->get('semester')->row_array();

        $data['title'] = 'List Mahasiswa Belum Ambil KRS';
        $data['mahasiswa'] = $this->akademik->getMahasiswaBelumAmbilKrs($semester['id_semester'])->result_array();
        // var_dump($data['mahasiswa']);
        // die;

        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();

        $this->backend->display('superadmin/v_mahasiswa_belum_ambil_krs', $data);
    }

    public function khs()
    {
        $breadcrumb_items = [
            'KHS Mahasiswa' => 'superadmin/akademik/khs',
        ];
        $data['subtitle'] = 'Manajemen Akademik';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $id_semester = $this->input->post('id_semester');

        if ($id_semester) {
            $data['khs'] = $this->akademik->getKhs($id_semester)->result_array();
        } else {
            $data['khs'] = $this->akademik->getKhs()->result_array();
        }
        $data['title'] = 'Kartu Hasil Studi Studi';
        $data['semester'] = $this->db->get('semester')->result_array();
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        if ($id_semester) {
            echo json_encode(array(
                'data' => $data
            ));
        } else {
            $this->backend->display('superadmin/v_khs', $data);
        }
    }


    public function viewKrs($id_semester = '', $id_user = '')
    {
        $data['id_semester'] = $id_semester;
        // var_dump($data['id_semester']);
        // die;
        $breadcrumb_items = [
            'KRS Mahasiswa' => 'superadmin/akademik/krs',
            'Detail KRS' => 'superadmin/akademik/viewKrs',
        ];
        $data['subtitle'] = 'Manajemen Akademik';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['id_user'] = $id_user;
        $data['title'] = 'Detail Kartu Rencana Studi';
        if ($id_semester) {
            # code...
            $data['krs'] = $this->akademik->getDetailKrsByMhs($data['id_semester'], $data['id_user'])->result_array();
        } else {
            $data['krs'] = $this->akademik->getDetailKrsByMhs()->result_array();
        }
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        $this->backend->display('mahasiswa/v_detail_krs', $data);
    }

    public function cetakKrs($id_semester, $id_user)
    {
        $id = $id_semester;
        // $id_user = $this->session->userdata('id_user');
        // $data['krs'] = $this->db->get_where('tb_invoice', ['id_invoice' => $id])->row_array();
        $data['user'] = $this->akademik->getMhsById($id_user)->row_array();
        $data['semester'] = $this->akademik->getInfoSemesterByMhs($id_user, $id)->row_array();
        $data['semester_mhs'] = $this->akademik->getInfoSemesterMhs($id_user, $id)->row_array();
        $data['sks'] = $this->akademik->getDetailKrsByMhs($id_semester, $id_user)->result_array();
        // var_dump($data['sks']);
        // die;
        $this->load->view('mahasiswa/v_cetak_krs', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }

    public function cetakKhs($semester_id, $user_id)
    {
        $id_semester = $semester_id;
        $id_user = $user_id;
        // $data['krs'] = $this->db->get_where('tb_invoice', ['id_invoice' => $id])->row_array();
        $data['user'] = $this->akademik->getMhsById($id_user)->row_array();
        $data['semester'] = $this->akademik->getInfoSemesterByMhs($id_user, $id_semester)->row_array();
        $data['semester_mhs'] = $this->akademik->getInfoSemesterMhs($id_user, $id_semester)->row_array();
        $data['khs'] = $this->akademik->getDetailKhsByMhs($id_semester, $id_user)->result_array();

        $this->load->view('mahasiswa/v_cetak_khs', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }
    public function kalender()
    {
        $breadcrumb_items = [
            'Kalender Akademik' => 'superadmin/akademik/kalender',
        ];
        $data['subtitle'] = 'Manajemen Akademik';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['title'] = 'Kalender Akademik';
        // $data['kalender'] = $this->db->get('kalender_akademik')->result_array();
        $data['kalender'] = $this->kalender->getKalenderAkademikByLastSemester()->result_array();
        $this->backend->display('dosen/v_kalender', $data);
    }


    public function hsk()
    {
        $breadcrumb_items = [
            'HSK Mahasiswa' => 'superadmin/akademik/hsk',
        ];
        $data['subtitle'] = 'Manajemen Akademik';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $id_semester = $this->input->post('id_semester');

        if ($id_semester) {
            $data['hsk'] = $this->akademik->getHsk($id_semester)->result_array();
        } else {
            $data['hsk'] = $this->akademik->getHsk()->result_array();
        }
        $data['title'] = 'Kartu Hasil Studi Komulatif';
        $data['semester'] = $this->db->get('semester')->result_array();
        // $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        // var_dump($data['hsk']);
        // die;
        if ($id_semester) {
            echo json_encode(array(
                'data' => $data
            ));
        } else {
            $this->backend->display('superadmin/v_hsk', $data);
        }
    }

    public function cetakhsk($id_semester, $id_mhs, $id_prodi)
    {
        // var_dump($id_mhs);
        // var_dump($id_prodi);
        // die;
        // $id_user = $this->session->userdata('id_user');
        // $id_jurusan = $this->session->userdata('id_jurusan');
        $data['user'] = $this->akademik->getMhsById($id_mhs)->row_array();
        $data['semester'] = $this->db->order_by('id_semester', 'DESC')->get('semester')->row_array();
        $data['semester_mhs'] = $this->akademik->getInfoSemesterMhs($id_mhs)->num_rows();
        $data['semester_all'] = $this->db->get_where('tbl_du', ['id_mhs' => $id_mhs])->result_array();
        $data['kurikulum'] = $this->db->get_where('kurikulum', ['id_prodi' => $id_prodi])->row_array();
        // var_dump($data['semester_all']);
        // die;
        $this->load->view('akademik/v_cetak_hsk', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }
}
