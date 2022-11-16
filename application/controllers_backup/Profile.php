<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backofficeManagement');
        }
        $this->load->library('upload');
        $this->load->library('breadcrumb');
        $this->load->model('KeuanganModel', 'keuangan');
    }

    public function index()
    {
        $breadcrumb_items = [];
        $data['subtitle'] = 'Profil User';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['title'] = 'Edit profil';
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        // var_dump($data['profile']);
        // die();
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        $this->backend->display('v_profile', $data);
    }

    public function editUser()
    {
        $where = array('id_user' => $this->session->userdata('id_user'));
        $paswword = $this->input->post('password');
        if ($paswword) {
            $config['upload_path'] = './uploads/profile/';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!empty($_FILES['file']['name'])) {
                if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $file = $data['file_name'];
                    $data = array(
                        'nama_user' => $this->input->post('nama_user'),
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'foto' => $file,
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

                    );
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
                }
            } else {
                $data = array(
                    'nama_user' => $this->input->post('nama_user'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

                );
            }
        } else {
            $config['upload_path'] = './uploads/profile/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf';

            $this->upload->initialize($config);
            if (!empty($_FILES['file']['name'])) {
                if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $file = $data['file_name'];
                    $data = array(
                        'nama_user' => $this->input->post('nama_user'),
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'foto' => $file,

                    );
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
                }
            } else {
                $data = array(
                    'nama_user' => $this->input->post('nama_user'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),

                );
            }
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
            $role = $this->session->userdata('id_role');
            if ($role == 1) {
                redirect('superadmin/dashboard');
            } elseif ($role == 2) {
                redirect('keuangan/dashboard');
            } elseif ($role == 3) {
                redirect('akademik/dashboard');
            } elseif ($role == 4) {
                redirect('dosen/dashboard');
            } elseif ($role == 6) {
                redirect('superadmin/dashboard');
            } else {

                redirect('mahasiswa/dashboard');
            }
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
            $role = $this->session->userdata('id_role');
            if ($role == 1) {
                redirect('superadmin/dashboard');
            } elseif ($role == 2) {
                redirect('keuangan/dashboard');
            } elseif ($role == 3) {
                redirect('akademik/dashboard');
            } elseif ($role == 4) {
                redirect('dosen/dashboard');
            } elseif ($role == 6) {
                redirect('superadmin/dashboard');
            } else {

                redirect('mahasiswa/dashboard');
            }
        }
    }
}
