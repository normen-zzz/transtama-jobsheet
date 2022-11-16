<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('dsitbacksystem');
        }
        $this->load->model('M_pengumuman', 'pengumuman');
        $this->load->library('upload');
        $this->load->library('breadcrumb');
        cek_role();
    }

    public function index()
    {
        $breadcrumb_items = [
            'Pengumuman' => 'superadmin/pengumuman',
        ];
        $data['subtitle'] = 'Manajemen Informasi';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Mata Kuliah';
        $data['role'] = $this->db->get('tb_role')->result_array();
        $data['pengumuman'] = $this->pengumuman->getpengumuman()->result_array();
        $this->backend->display('superadmin/v_pengumuman', $data);
    }

    public function addPengumuman()
    {
        $config['upload_path'] = './uploads/pengumuman/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';

        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $file = $data['file_name'];
                var_dump($file);
                // die;
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'gambar' => $file,
                    'pengumuman' => $this->input->post('pengumuman'),
                    // 'created_at' => $this->input->post('created_at'),
                    'role_id' => $this->input->post('role_id'),
                    'penulis_id' => $this->session->userdata('id_user'),
                );

                if ($this->db->insert('tb_pengumuman', $data)) {
                    log_aktifitas('insert', 'tb_pengumuman');
                    $dataflash = array(
                        'title' => 'Data Pengumuman',
                        'text' => 'Data Pengumuman Berhasil ditambahkan',
                        'type' => 'success',
                        'icon'  => 'success',
                        'confirmButtonColor' => '#0095cc',
                        'confirmButtonText' => 'Oke',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                }
            }
        }

        redirect('superadmin/pengumuman');
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $delete = $this->db->delete('tb_pengumuman', $where);
        if ($delete) {
            log_aktifitas('delete', 'tb_pengumuman');
            $dataflash = array(
                'title' => 'Data Pengumuman',
                'text' => 'Data Pengumuman Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/pengumuman');
        } else {
            $dataflash = array(
                'title' => 'Data Pengumuman',
                'text' => 'Data Pengumuman Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/pengumuman');
        }
    }

    public function edit()
    {
        $where = array('id' => $this->input->post('id'));
        $config['upload_path'] = './uploads/pengumuman/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';

        $this->upload->initialize($config);
        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $file = $data['file_name'];
                var_dump($file);
                // die;
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'gambar' => $file,
                    'pengumuman' => $this->input->post('pengumuman'),
                    // 'created_at' => $this->input->post('created_at'),
                    'role_id' => $this->input->post('role_id'),
                    'penulis_id' => $this->session->userdata('id_user'),
                );

                $update = $this->db->update('tb_pengumuman', $data, $where);
                if ($update) {
                    log_aktifitas('update', 'tb_pengumuman');
                    $dataflash = array(
                        'title' => 'Data Pengumuman',
                        'text' => 'Data Pengumuman Berhasil di Update',
                        'type' => 'success',
                        'icon'  => 'success',
                        'confirmButtonColor' => '#0095cc',
                        'confirmButtonText' => 'Oke',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                    redirect('superadmin/pengumuman');
                } else {
                    $dataflash = array(
                        'title' => 'Data Pengumuman',
                        'text' => 'Data Pengumuman Gagal di Update',
                        'type' => 'error',
                        'icon'  => 'error',
                        'confirmButtonColor' => '#ff562f',
                        'confirmButtonText' => 'Close',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                    redirect('superadmin/pengumuman');
                }
            }
        }
    }
}
