<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('UserModel');
        $this->load->library('breadcrumb');
        cek_role();
    }

    public function index()
    {
        $breadcrumb_items = [
            'Bimbingan' => 'superadmin/bimbingan',
        ];
        $data['subtitle'] = 'Bimbingan';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $id_jurusan = $this->session->userdata('id_jurusan');
        $data['title'] = 'Floating Mahasiswa Bimbingan';
        $data['mahasiswa'] = $this->db->get_where('tb_user', ['id_role' => 5, 'id_prodi' => $id_jurusan])->result_array();
        $data['dosen'] = $this->db->get_where('tb_user', ['id_role' => 4, 'id_prodi' => $id_jurusan])->result_array();
        $this->backend->display('superadmin/v_float_bimbingan', $data);
    }
    public function addMahasiswaBimbingan()
    {

        $id_mhs = $this->input->post('id_mhs');

        for ($i = 0; $i < sizeof($id_mhs); $i++) {
            $data = array(
                'id_dosen' =>   $this->input->post('id_dosen'),
                'id_prodi' =>   $this->session->userdata('id_jurusan'),
                'id_fakultas' =>   $this->session->userdata('id_fakultas'),
                'id_mhs' => $id_mhs[$i],
            );
            $insert = $this->db->insert('tbl_mahasiswa_bimbingan', $data);
        }
        if ($insert) {
            log_aktifitas('insert', 'tbl_mahasiswa_bimbingan');
            $dataflash = array(
                'title' => 'Floating Mahasiswa Bimbingan',
                'text' => 'Berhasil ditambahkan',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
        } else {
            $dataflash = array(
                'title' => 'Floating Mahasiswa Bimbingan',
                'text' => 'Gagal ditambahkan',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
        }
        redirect('superadmin/bimbingan');
    }
    public function listMahasiswaBimbingan($id_dosen)
    {
        $id_dosen = decrypt_url($id_dosen);
        $data['id_dosen'] = $id_dosen;
        $data['title'] = 'List Mahasiswa Bimbingan';
        $data['users'] = $this->UserModel->getMhsBimbinganByDosen($id_dosen)->result_array();
        $this->backend->display('superadmin/v_list_bimbingan', $data);
    }

    public function delete($id_bimbingan, $id_dosen)
    {
        $where = array('id_bimbingan' => decrypt_url($id_bimbingan));
        $delete = $this->db->delete('tbl_mahasiswa_bimbingan', $where);
        if ($delete) {
            log_aktifitas('delete', 'tbl_mahasiswa_bimbingan');
            $dataflash = array(
                'title' => 'Mahasiswa Bimbingan',
                'text' => 'Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/bimbingan/listMahasiswaBimbingan/' . $id_dosen);
        } else {
            $dataflash = array(
                'title' => 'Mahasiswa Bimbingan',
                'text' => 'Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/bimbingan/listMahasiswaBimbingan/' . $id_dosen);
        }
    }
    public function edit()
    {
        $where = array('id_prodi' => $this->input->post('id_prodi'));
        $data = array(
            'nama_prodi' => $this->input->post('nama_prodi'),
            'kode_prodi' => $this->input->post('kode_prodi'),
            'status' => $this->input->post('status'),
            'id_fakultas' => $this->input->post('id_fakultas'),
            'id_jenjang_didik' => $this->input->post('id_jenjang_didik'),
        );
        $update = $this->db->update('tb_jurusan', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tb_jurusan');
            $dataflash = array(
                'title' => 'Data Prodi',
                'text' => 'Data Prodi Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/prodi');
        } else {
            $dataflash = array(
                'title' => 'Data Prodi',
                'text' => 'Data Prodi Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/prodi');
        }
    }
}
