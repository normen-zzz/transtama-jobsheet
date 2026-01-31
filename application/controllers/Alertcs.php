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

            $date = date('d-m-Y', strtotime($js1['tgl_pickup']));
            $resi .= '\r\n ' . $js1['shipment_id'] . ' Tanggal Pickup: ' . $date;
        }

        $pesan = "Halo Manager Cs, Ada jobsheet yang belum anda approve, berikut resi yang terlampir $resi";

        if ($js->num_rows() != 0) {
            $this->wa->pickup('+6285697780467', "$pesan");
            // reina 
            //$this->wa->pickup('+6285771006587', "$pesan");
            //lili CS
            $this->wa->pickup('+6281293753199', "$pesan");
        }
    }

    public function picJs()
    {
        $this->db->select('b.shipment_id, b.tgl_pickup');
        $this->db->from('tbl_so a');
        $this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
        $this->db->join('tb_user c', 'a.id_sales=c.id_user');
        $this->db->where('b.status_so', 1);
        $this->db->where('b.deleted', 0);
        $this->db->where('b.deadline_manager_cs IS NULL');
        //where b.tgl_pickup >= 1 september 2025
        $this->db->where('b.tgl_pickup >=', '2025-09-01');
        $this->db->order_by('b.id', 'DESC');
        $js = $this->db->get();
        $all_resi = $js->result_array();
        $total_resi = $js->num_rows();

        if ($total_resi > 0) {
            // Batch setiap 100 resi
            $batch_size = 150;
            $batches = array_chunk($all_resi, $batch_size);

            foreach ($batches as $batch_index => $batch) {
                $resi = '\r\n\r\n ';

                foreach ($batch as $js1) {
                    // Handle resi yang depannya angka 2 hilang
                    $shipment_id = $js1['shipment_id'];


                    $resi .= $shipment_id . ' Tanggal Pickup: ' . date('d-m-Y', strtotime($js1['tgl_pickup'])) . '\n ';
                }

                $batch_number = $batch_index + 1;
                $total_batches = count($batches);
                $batch_info = '\r\n\r\n Batch ' . $batch_number . ' dari ' . $total_batches;
                $batch_total = '\r\n Total Resi di Batch ini: ' . count($batch);
                $grand_total = '\r\n Total Keseluruhan Resi: ' . $total_resi;
                $tanggal_dikirim = '\r\n Alert tanggal: ' . date('d-m-Y H:i:s');

                $pesan = "Halo PIC JS, Ada jobsheet yang belum anda Kerjakan, berikut resi yang terlampir $resi $batch_info $batch_total $grand_total $tanggal_dikirim";

                // Norman
                $send1 = $this->wa->pickup('+6285697780467', "$pesan");

                //     sri
                //     // $send2 = $this->wa->pickup('+62818679758', "$pesan");

                //     reina finance
                //     // $send3 = $this->wa->pickup('+6285771006587', "$pesan");

                //     dwi finance
                //     // $send4 = $this->wa->pickup('+6281212311908', "$pesan");
                //     // $send = $send1 && $send2 && $send3 && $send4;

                if ($send1) {
                    echo "Berhasil kirim WA batch " . $batch_number . "<br>";
                } else {
                    echo "Gagal kirim WA batch " . $batch_number . "<br>";
                }

                // Delay antar batch untuk menghindari spam (opsional)
                if ($batch_index < count($batches) - 1) {
                    sleep(2); // delay 2 detik
                }
            }
        } else {
            echo "Tidak ada resi yang perlu diingatkan";
        }
    }

    public function mgrCs()
    {

        $this->db->select('b.shipment_id, b.tgl_pickup');
        $this->db->from('tbl_so a');
        $this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
        $this->db->join('tb_user c', 'a.id_sales=c.id_user');
        $this->db->where('b.status_so', 2);
        $this->db->where('b.deadline_finance IS NULL');
        $this->db->where('b.deleted', 0);
        $this->db->order_by('b.id', 'DESC');
        // $this->db->order('b.id', 'DESC');
        $js = $this->db->get();
        $all_resi = $js->result_array();
        $total_resi = $js->num_rows();

        if ($total_resi > 0) {
            // Batch setiap 100 resi
            $batch_size = 150;
            $batches = array_chunk($all_resi, $batch_size);

            foreach ($batches as $batch_index => $batch) {
                $resi = '\r\n\r\n ';

                foreach ($batch as $js1) {
                    // Handle resi yang depannya angka 2 hilang
                    $shipment_id = $js1['shipment_id'];


                    $resi .= $shipment_id . ' Tanggal Pickup: ' . date('d-m-Y', strtotime($js1['tgl_pickup'])) . '\n ';
                }

                $batch_number = $batch_index + 1;
                $total_batches = count($batches);
                $batch_info = '\r\n\r\n Batch ' . $batch_number . ' dari ' . $total_batches;
                $batch_total = '\r\n Total Resi di Batch ini: ' . count($batch);
                $grand_total = '\r\n Total Keseluruhan Resi: ' . $total_resi;
                $tanggal_dikirim = '\r\n Alert tanggal: ' . date('d-m-Y H:i:s');

                $pesan = "Halo Manager Cs, Ada jobsheet yang belum anda approve, berikut resi yang terlampir $resi $batch_info $batch_total $grand_total $tanggal_dikirim";

                // Norman
                $send1 = $this->wa->pickup('+6285697780467', "$pesan");
                // yunita cs
                // $send2 = $this->wa->pickup('+6282310047100', "$pesan");
                //reina finance
                // $send3 = $this->wa->pickup('+6285771006587', "$pesan");
                //dwi finance
                // $send4 = $this->wa->pickup('+6281212311908', "$pesan");

                if ($send1) {
                    echo "Berhasil kirim WA batch " . $batch_number . "<br>";
                } else {
                    echo "Gagal kirim WA batch " . $batch_number . "<br>";
                }

                // Delay antar batch untuk menghindari spam (opsional)
                if ($batch_index < count($batches) - 1) {
                    sleep(2); // delay 2 detik
                }
            }
        } else {
            echo "Tidak ada resi yang perlu diingatkan";
        }
    }

    public function testAja()
    {
        $send = $this->wa->pickup('+6285697780467', "test aja");
        if ($send) {
            echo "berhasil";
        } else {
            echo "gagal";
        }
    }
}
