<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation
{

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function unique_hari_ruang_waktu()
    {

        $hari = $this->CI->input->post('hari');
        $ruang = $this->CI->input->post('ruang');
        $waktu_mulai = $this->CI->input->post('waktu_mulai');
        $waktu_akhir = $this->CI->input->post('waktu_akhir');

        // $check = $this->CI->db->get_where('tbl_jadwal', array('hari' => $hari, 'ruang' => $ruang, 'waktu_mulai' => $waktu_mulai, 'waktu_akhir' => $waktu_akhir), 1)->row_array();
        $check = $this->CI->db->get_where('tbl_jadwal', ['hari' => $hari, 'ruang' => $ruang])->result_array();

        if ($check) {
            // $this->set_message('unique_jadwal', 'Jadwal ini sudah ada!!');
            foreach ($check as $ck) {
                if (strtotime($waktu_mulai) === strtotime($ck['waktu_mulai']) && strtotime($waktu_akhir) === strtotime($ck['waktu_akhir'])) {
                    // die;
                    return FALSE;
                } elseif (strtotime($waktu_mulai) > strtotime($ck['waktu_mulai']) && strtotime($waktu_mulai) < strtotime($ck['waktu_akhir'])) {
                    return FALSE;
                } else {
                }
            }
        }

        return TRUE;
    }
}
