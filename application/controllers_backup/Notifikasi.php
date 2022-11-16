<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('dsitbacksystem');
        }
        $this->load->model('M_pengumuman', 'pengumuman');
        $this->load->model('KeuanganModel', 'keuangan');
        $this->load->library('upload');
    }

    public function getNotifikasi()
    {
        $id_role = $this->input->post('role_id');
        // $data['title'] = 'Mata Kuliah';
        // $data['role'] = $this->db->get('tb_role')->result_array();
        $data['belum_dibaca'] = $this->pengumuman->getBelumDibacaByRole()->num_rows();
        $data['pengumuman'] = $this->pengumuman->getpengumumanByRole()->result_array();
        // var_dump($data['belum_dibaca']);
        // die;
        echo json_encode(array(
            'data' => $data
        ));
    }

    public function getDetailNotifikasi($id)
    {
        $data['title'] = 'Detail Notifikasi';
        $data['role'] = $this->db->get('tb_role')->result_array();
        $data['pengumuman'] = $this->pengumuman->getpengumumanById($id)->row_array();
        $data['cek_du'] = $this->keuangan->getInvoiceSemesterByMhs()->result_array();
        $id_user = $this->session->userdata('id_user');
        $dataArray = array(
            'id_pengumuman' => $id,
            'id_user' => $id_user,
            'status' => 1
        );
        $cek_status = $this->db->get_where('status_notifikasi', ['id_pengumuman' => $id, 'id_user' => $id_user])->result_array();
        // var_dump($cek_status);
        // die;
        if (!$cek_status) {
            # code...
            $this->db->insert('status_notifikasi', $dataArray);
        }

        $this->backend->display('v_detail_notifikasi', $data);
    }
}
