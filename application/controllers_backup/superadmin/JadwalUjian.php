<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalUjian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backOfficeManagement');
        }
        $this->load->helper('tgl_indo');
        $this->load->library('form_validation');
        $this->load->library('MY_Form_validation');
        $this->load->library('breadcrumb');
        $this->load->model('M_jadwalUjian', 'jadwal');
        $this->load->model('M_matakuliah', 'matakuliah');
        cek_role();
    }
    public function index()
    {
        $id_prodi = $this->session->userdata('id_jurusan');
        // var_dump($id_prodi);
        // die;
        $breadcrumb_items = [
            'Plotting Jadwal Ujian' => 'superadmin/JadwalUjian',
        ];
        $data['subtitle'] = 'Aktivitas Pembelajaran';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Plotting Jadwal Ujian';
        if ($id_prodi) {
            $data['semester'] = $this->db->order_by('id_semester', 'desc')->get('semester')->result_array();
            $data['matakuliah'] = $this->matakuliah->getMatakuliahByProdi($id_prodi)->result_array();
            // $data['dosen'] = $this->db->get_where('dosen', ['id_prodi' => $id_prodi])->result_array();
            $data['dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
            $data['tbl_jadwal_ujian'] = $this->db->get('tbl_jadwal_ujian')->result_array();
            $data['jadwal_ujian'] = $this->jadwal->getJadwalUjian()->result_array();
        } else {
            $data['semester'] = $this->db->order_by('id_semester', 'desc')->get('semester')->result_array();
            $data['matakuliah'] = $this->db->get('tb_mata_kuliah')->result_array();
            // $data['dosen'] = $this->db->get('dosen')->result_array();
            $data['dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
            $data['tbl_jadwal_ujian'] = $this->db->get('tbl_jadwal_ujian')->result_array();
            $data['jadwal_ujian'] = $this->jadwal->getJadwalUjian()->result_array();
        }

        $this->backend->display('superadmin/v_plot_ujian', $data);
    }
    public function addJadwalUjian()
    {

        $data = array(
            'semester' => $this->input->post('semester'),
            'id_mk' => $this->input->post('id_mk'),
            'id_sdm1' => $this->input->post('id_sdm1'),
            'id_sdm2' => $this->input->post('id_sdm2'),
            'jenis_ujian' => $this->input->post('jenis_ujian'),
            'tanggal' => $this->input->post('tanggal'),
            'ruang' => $this->input->post('ruang'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_akhir' => $this->input->post('waktu_akhir'),
        );

        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('ruang', 'ruang', 'trim|required');
        $this->form_validation->set_rules('waktu_mulai', 'waktu_mulai', 'trim|required');
        $this->form_validation->set_rules('waktu_akhir', 'waktu_akhir', 'trim|required');

        if ($this->form_validation->run() == false) {
            $dataflash = array(
                'title' => 'Data Jadwal Ujian',
                'text' => 'Data Jadwal Ujian Sudah Ada!',
                'type' => 'danger',
                'icon'  => 'danger',
                'confirmButtonColor' => '#F64E60',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalUjian');
        } else {
            if ($this->db->insert('tbl_jadwal_ujian', $data)) {
                log_aktifitas('insert', 'tbl_jadwal_ujian');
                $dataflash = array(
                    'title' => 'Data Jadwal Ujian',
                    'text' => 'Data Jadwal Ujian Berhasil ditambahkan',
                    'type' => 'success',
                    'icon'  => 'success',
                    'confirmButtonColor' => '#0095cc',
                    'confirmButtonText' => 'Oke',
                );
                $this->session->set_flashdata('message', $dataflash);
            }
        }

        redirect('superadmin/jadwalUjian');
    }
    public function editJadwalUjian()
    {
        $where = array('id' => $this->input->post('id'));
        $data = array(
            'semester' => $this->input->post('semester'),
            'id_mk' => $this->input->post('id_mk'),
            'id_sdm1' => $this->input->post('id_sdm1'),
            'id_sdm2' => $this->input->post('id_sdm2'),
            'jenis_ujian' => $this->input->post('jenis_ujian'),
            'tanggal' => $this->input->post('tanggal'),
            'ruang' => $this->input->post('ruang'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_akhir' => $this->input->post('waktu_akhir'),
        );
        $update = $this->db->update('tbl_jadwal_ujian', $data, $where);
        // die;
        if ($update) {
            log_aktifitas('update', 'tbl_jadwal_ujian');
            $dataflash = array(
                'title' => 'Data Jadwal Ujian',
                'text' => 'Data Jadwal Ujian Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalUjian');
        } else {
            $dataflash = array(
                'title' => 'Data Jadwal Ujian',
                'text' => 'Data Jadwal Ujian Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalUjian');
        }
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $delete = $this->db->delete('tbl_jadwal_ujian', $where);
        if ($delete) {
            log_aktifitas('delete', 'tbl_jadwal_ujian');
            $dataflash = array(
                'title' => 'Data Jadwal Ujian',
                'text' => 'Data Jadwal Ujian Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalUjian');
        } else {
            $dataflash = array(
                'title' => 'Data Jadwal Ujian',
                'text' => 'Data Jadwal Ujian Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalUjian');
        }
    }
}
