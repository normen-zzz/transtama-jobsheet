<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileStudent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backofficeManagement');
        }
        $this->load->library('upload');
        $this->load->model('KeuanganModel', 'keuangan');
        $this->load->model('M_mahasiswa', 'mahasiswa');
        $this->load->library('breadcrumb');
    }

    public function index()
    {
        $breadcrumb_items = [];
        $data['subtitle'] = 'Edit Profile';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['title'] = 'Edit profil';
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        $data['mahasiswa'] = $this->mahasiswa->getDetailMahasiswa2($id_user)->row_array();
        // var_dump($data['mahasiswa']);
        // die;
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['kewarganegaraan'] = $this->db->get('kewarganegaraan')->result_array();
        $data['jenis_tinggal'] = $this->db->get('jenis_tinggal')->result_array();
        $data['jenjang_pendidikan'] = $this->db->get('jenjang_pendidikan')->result_array();
        $data['alat_transportasi'] = $this->db->get('data_transportasi')->result_array();
        $data['pekerjaan'] = $this->db->get('pekerjaan')->result_array();
        $data['penghasilan'] = $this->db->get('penghasilan')->result_array();
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        $this->backend->display('v_profile_student', $data);
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
                        'nama_user' => $this->input->post('nm_pd'),
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
                    'nama_user' => $this->input->post('nm_pd'),
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
                        'nama_user' => $this->input->post('nm_pd'),
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
                    'nama_user' => $this->input->post('nm_pd'),
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
            $this->edit();
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

        $this->db->update('mhs', $data, $where);
    }
}
