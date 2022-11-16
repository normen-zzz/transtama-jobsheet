<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalMatakuliah extends CI_Controller
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
        $this->load->model('M_jadwalMatakuliah', 'jadwal');
        $this->load->model('M_matakuliah', 'matakuliah');
        cek_role();
    }
    public function index()
    {
        $breadcrumb_items = [
            'Plotting Jadwal Matakuliah' => 'superadmin/JadwalMatakuliah',
        ];
        $data['subtitle'] = 'Aktivitas Pembelajaran';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $id_prodi = $this->session->userdata('id_jurusan');
        $id_semester = $this->input->post('id_semester');
        $data['title'] = 'Plotting Matakuliah';
        if ($id_prodi) {
            $data['semester'] = $this->db->order_by('id_semester', 'desc')->get('semester')->result_array();
            $data['matakuliah'] = $this->matakuliah->getMatakuliahByProdi($id_prodi)->result_array();
            // $data['dosen'] = $this->db->get_where('dosen', ['id_prodi' => $id_prodi])->result_array();
            $data['dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
            $data['tbl_jadwal'] = $this->db->get('tbl_jadwal')->result_array();
            $data['jadwal_matkul'] = $this->jadwal->getJadwalMatkul($id_semester)->result_array();
        } else {
            $data['semester'] = $this->db->order_by('id_semester', 'desc')->get('semester')->result_array();
            $data['matakuliah'] = $this->db->get('tb_mata_kuliah')->result_array();
            // $data['dosen'] = $this->db->get('dosen')->result_array();
            $data['dosen'] = $this->db->get_where('tb_user', ['id_role' => 4])->result_array();
            $data['tbl_jadwal'] = $this->db->get('tbl_jadwal')->result_array();
            $data['jadwal_matkul'] = $this->jadwal->getJadwalMatkul($id_semester)->result_array();
        }
        $data['id_semester'] = $id_semester;

        $this->backend->display('superadmin/v_plot_matkul', $data);
    }

    public function GetMatkulBySemester()
    {
        $id_semester = $this->input->post('semester');

        $data['matakuliah'] = $this->db->get_where('tb_mata_kuliah', ['semester' => $id_semester])->result_array();
        // var_dump($data['krs']);
        // die;
        echo json_encode(array(
            'data' => $data
        ));
    }

    public function addJadwalMatakuliah()
    {

        $data = array(
            'semester' => $this->input->post('semester'),
            'id_semester' => $this->input->post('id_semester'),
            'id_mk' => $this->input->post('id_mk'),
            'id_sdm1' => $this->input->post('id_sdm1'),
            'id_sdm2' => $this->input->post('id_sdm2'),
            'hari' => $this->input->post('hari'),
            'ruang' => $this->input->post('ruang'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_akhir' => $this->input->post('waktu_akhir'),
        );

        $this->form_validation->set_rules('hari', 'hari', 'trim|required');
        $this->form_validation->set_rules('ruang', 'ruang', 'trim|required');
        $this->form_validation->set_rules('waktu_mulai', 'waktu_mulai', 'trim|required');
        $this->form_validation->set_rules('waktu_akhir', 'waktu_akhir', 'trim|required|unique_hari_ruang_waktu');

        if ($this->form_validation->run() == false) {
            $dataflash = array(
                'title' => 'Data Jadwal Matakuliah',
                'text' => 'Data Jadwal Matakuliah Sudah Ada,atau Kelas Penuh!',
                'type' => 'danger',
                'icon'  => 'danger',
                'confirmButtonColor' => '#F64E60',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalMatakuliah');
        } else {
            if ($this->db->insert('tbl_jadwal', $data)) {
                log_aktifitas('insert', 'tbl_jadwal');
                $dataflash = array(
                    'title' => 'Data Jadwal Matakuliah',
                    'text' => 'Data Jadwal Matakuliah Berhasil ditambahkan',
                    'type' => 'success',
                    'icon'  => 'success',
                    'confirmButtonColor' => '#0095cc',
                    'confirmButtonText' => 'Oke',
                );
                $this->session->set_flashdata('message', $dataflash);
            }
        }

        redirect('superadmin/jadwalMatakuliah');
    }
    public function editJadwalMatakuliah()
    {
        $where = array('id' => $this->input->post('id'));
        $data = array(
            'semester' => $this->input->post('semester'),
            'id_mk' => $this->input->post('id_mk'),
            'id_sdm1' => $this->input->post('id_sdm1'),
            'id_sdm2' => $this->input->post('id_sdm2'),
            'hari' => $this->input->post('hari'),
            'ruang' => $this->input->post('ruang'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'waktu_akhir' => $this->input->post('waktu_akhir'),
        );
        $update = $this->db->update('tbl_jadwal', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tbl_jadwal');
            $dataflash = array(
                'title' => 'Data Jadwal Matakuliah',
                'text' => 'Data Jadwal Matakuliah Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalMatakuliah');
        } else {
            $dataflash = array(
                'title' => 'Data Jadwal Matakuliah',
                'text' => 'Data Jadwal Matakuliah Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalMatakuliah');
        }
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $delete = $this->db->delete('tbl_jadwal', $where);
        if ($delete) {
            log_aktifitas('delete', 'tbl_jadwal');
            $dataflash = array(
                'title' => 'Data Jadwal Matakuliah',
                'text' => 'Data Jadwal Matakuliah Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalMatakuliah');
        } else {
            $dataflash = array(
                'title' => 'Data Jadwal Matakuliah',
                'text' => 'Data Jadwal Matakuliah Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/jadwalMatakuliah');
        }
    }
}
