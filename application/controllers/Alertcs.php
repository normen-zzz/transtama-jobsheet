<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alertcs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sendwa', 'wa');
        $this->load->model('M_Datatables');
        $this->load->model('CsModel', 'cs');
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }

    public function index()
    {
        $js = $this->cs->getJsApproveCs();

       
        $resi = '';

        foreach ($js->result_array()  as $js1) {

            $date = date('d-m-Y',strtotime($js1['tgl_pickup']));
            $resi .= '\r\n'.$js1['shipment_id'] . ' Tanggal Pickup: '. $date;
        }

        $pesan = "Halo Manager Cs, Ada jobsheet yang belum anda approve, berikut resi yang terlampir $resi";

        if ($js->num_rows() != 0) {
            $this->wa->pickup('+6285697780467', "$pesan");
            // reina 
            $this->wa->pickup('+6285771006587', "$pesan");
            //lina CS
            $this->wa->pickup('+6281385687290', "$pesan");
        }
       

    }
}
