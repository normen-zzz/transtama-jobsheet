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
            $resi .= '\r\n '.$js1['shipment_id'] . ' Tanggal Pickup: '. $date;
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
        $js = $this->cs->getJs();

       
        $resi = '';

        foreach ($js->result_array()  as $js1) {

            $date = date('d-m-Y',strtotime($js1['tgl_pickup']));
            $resi .= '\r\n'.$js1['shipment_id'] . ' Tanggal Pickup: '. $date;
        }

        $pesan = "Halo Pic Jobsheet (CS), Ada jobsheet yang belum anda Kerjakan, berikut resi yang terlampir $resi";

        if ($js->num_rows() != 0) {
            // Norman
            $this->wa->pickup('+6285697780467', "$pesan");
            //Raga CS
            $this->wa->pickup('+6287776150830', "$pesan");
        }
       

    }
	
	public function stars(){
		
function draw_star($im, $x, $y, $radius, $color) {
    $points = array();
    for ($i = 0; $i < 10; $i++) {
        $angle = deg2rad($i * 36);
        $length = $i % 2 == 0 ? $radius : $radius / 2;
        $points[] = $x + cos($angle) * $length;
        $points[] = $y + sin($angle) * $length;
    }
    imagefilledpolygon($im, $points, 10, $color);
}

$im = imagecreatetruecolor(400, 300);
$white = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 255, 0, 0);
$green = imagecolorallocate($im, 0, 255, 0);

imagefill($im, 0, 0, $white);

draw_star($im, 200, 150, 80, $red);
draw_star($im, 200, 150, 60, $white);
draw_star($im, 200, 150, 40, $red);
draw_star($im, 200, 150, 20, $white);

imagefilledrectangle($im, 195, 250, 205, 280,$green);

header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);


	}
}
