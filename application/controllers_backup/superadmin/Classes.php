<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('dsitbacksystem');
        }
        $this->load->helper('Kodekelas');
        $this->load->helper('tgl_indo');
        $this->load->model('ClassModel');
        $this->load->model('AgendaModel');
        $this->load->library('upload');
        $this->load->library('breadcrumb');
        require_once APPPATH . 'third_party/vendor/autoload.php';
        cek_role();
    }
    public function index()
    {
        $breadcrumb_items = [
            'Kelas' => 'superadmin/classess',
        ];
        $data['subtitle'] = 'Aktivitas Pembelajaran';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Class';
        $data['classes'] = $this->ClassModel->getClassAll()->result_array();
        $data['semester'] = $this->db->get('tb_semester')->result_array();
        $this->backend->display('superadmin/v_kelas', $data);
    }
    // add class
    public function detail($kode)
    {
        $data['title'] = 'Detail Class';
        $data['class'] = $this->ClassModel->getClassByCode($kode)->row_array();
        // var_dump($data['class']);
        // die;
        $id_kelas = $data['class']['id_kelas'];
        $data['semester'] = $this->db->get('tb_semester')->result_array();
        $data['materi'] = $this->db->get_where('tb_materi', ['id_kelas' => $id_kelas])->result_array();
        $data['total_mahasiswa'] = $this->db->get_where('tb_join_kelas', ['kode_kelas' => $kode])->num_rows();
        $data['classes'] = $this->ClassModel->getClassByLecture()->result_array();
        $data['agenda'] = $this->AgendaModel->getAgendaByIdKelas($id_kelas)->result_array();
        $this->backend->display('dosen/v_detail_kelas', $data);
    }

    public function editClass()
    {
        $kode = $this->input->post('kode_kelas');
        $where = array('id_kelas' => $this->input->post('id_kelas'));

        $data = array(
            'id_semester' => $this->input->post('id_semester'),
            'id_user' => $this->session->userdata('id_user'),
            'nama_kelas' => $this->input->post('nama_kelas'),
            'deskripsi_kelas' => $this->input->post('deskripsi_kelas'),
            'hari' => $this->input->post('hari'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'tgl_selesai' => $this->input->post('tgl_selesai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
        );
        $this->db->update('tb_kelas', $data, $where);
        log_aktifitas('update', 'tb_kelas');
        $this->session->set_flashdata('message', 'Berhasil Diedit');
        redirect('dosen/classes/detail/' . $kode);
    }

    public function classAktif($id_kelas)
    {
        $where = array('id_kelas' => $id_kelas);
        $data = array(
            'status' => 1,
        );
        $update = $this->db->update('tb_kelas', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tb_kelas');
            $dataflash = array(
                'title' => 'Data Kelas',
                'text' => 'Kelas Berhasil diaktifkan',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );

            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/classes');
        } else {
            $dataflash = array(
                'title' => 'Data Kelas',
                'text' => 'Kelas Gagal diaktifkan',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/classes');
        }
    }

    public function classOff($id_kelas)
    {
        $where = array('id_kelas' => $id_kelas);
        $data = array(
            'status' => 0,
        );
        $update = $this->db->update('tb_kelas', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tb_kelas');
            $dataflash = array(
                'title' => 'Data Kelas',
                'text' => 'Kelas Berhasil di Nonaktifkan',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );

            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/classes');
        } else {
            $dataflash = array(
                'title' => 'Data Kelas',
                'text' => 'Kelas Gagal di Nonaktifkan',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/classes');
        }
    }
    public function laporan()
    {
        $breadcrumb_items = [
            'Laporan' => 'superadmin/classess/laporan',
        ];
        $data['subtitle'] = 'Aktivitas Pembelajaran';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();


        $data['title'] = 'Laporan Kelas';
        $data['classes'] = $this->ClassModel->getClassAll()->result_array();
        $this->backend->display('superadmin/v_laporan_kelas', $data);
    }
    public function beritaAcara($id_kelas, $id_user)
    {
        $breadcrumb_items = [
            'Laporan' => 'superadmin/classes/laporan',
            'Berita Acara' => 'superadmin/classess/beritaAcara',
        ];
        $data['subtitle'] = 'Aktivitas Pembelajaran';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $new_id = decrypt_url($id_kelas);
        $data['title'] = 'Berita Acara';
        $data['id_kelas'] = $new_id;
        $data['id_user'] = decrypt_url($id_user);
        $data['ba'] = $this->db->get_where('tbl_berita_acara', ['id_kelas' => $new_id])->result_array();
        $data['kelas'] =  $this->ClassModel->getClassById($new_id)->row_array();
        $this->backend->display('superadmin/v_ba', $data);
    }
    public function cetakBeritaAcara($id_kelas, $id_user)
    {
        $new_id = decrypt_url($id_kelas);
        $data['ba'] = $this->db->get_where('tbl_berita_acara', ['id_kelas' => $new_id])->result_array();
        $data['dosen'] = $this->db->get_where('tbl_user', ['id_user' => decrypt_url($id_user)])->row_array();
        $data['kelas'] =  $this->ClassModel->getClassById($new_id)->row_array();

        $this->load->view('superadmin/v_cetak_ba', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }
}
