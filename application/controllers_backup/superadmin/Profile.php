<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('dsitbacksystem');
        }
        cek_role();
        $this->load->library('breadcrumb');
    }

    public function index()
    {
        $breadcrumb_items = [
            'Manajemen Profile' => 'dosen/bimbingan',
        ];
        $data['subtitle'] = 'Manajemen';
        // $data['sub_header_page'] = 'exist';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['title'] = 'Program  Studi';
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        // var_dump($data['profile']);
        // die();
        $this->backend->display('superadmin/v_profile', $data);
    }

    public function editUser()
    {
        $where = array('id_user' => $this->session->userdata('id_user'));
        $paswword = $this->input->post('password');
        if ($paswword) {
            $data = array(
                'nama_user' => $this->input->post('nama_user'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

            );
        } else {
            $data = array(
                'nama_user' => $this->input->post('nama_user'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email')

            );
        }
        $update = $this->db->update('tb_user', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tb_user');
            $dataflash = array(
                'title' => 'Data Profile',
                'text' => 'Data Profile Berhasil di update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            // var_dump($dataflash);
            // die();
            redirect('superadmin/profile');
        } else {
            $dataflash = array(
                'title' => 'Data Profile',
                'text' => 'Data Profile Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            $this->session->set_flashdata('message', 'Gagal Diedit');
            redirect('superadmin/profile');
        }
    }
}
