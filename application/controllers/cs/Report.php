<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backoffice');
        }
        $this->load->library('breadcrumb');
        $this->load->library('upload');
        $this->load->model('M_Datatables');
        $this->load->model('CsModel', 'cs');
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        cek_role();
    }
    public function index()
    {
        $data['title'] = 'Proforma Invoice';
        $breadcrumb_items = [];
        $data['subtitle'] = 'Proforma Invoice';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['proforma'] = $this->cs->getProformaInvoice()->result_array();
        $this->backend->display('finance/v_proforma_invoice', $data);
    }
    public function msr()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {
            $data['title'] = 'Report MSR';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Report MSR';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Overall Delivery Report';
            $data['total_shipments'] = $this->cs->getTotalShipments($bulan = null, $tahun = null)->num_rows();
            $data['total_so'] = $this->cs->getTotalSo($bulan = null, $tahun = null)->num_rows();
            $data['jobsheet_pending'] =  $this->cs->getJobsheetPending($bulan = null, $tahun = null)->num_rows();
            $data['jobsheet_approve_pic'] =  $this->cs->getJobsheetApprovePic($bulan = null, $tahun = null)->num_rows();
            $data['jobsheet_approve_mgr'] =  $this->cs->getJobsheetApproveMgr($bulan = null, $tahun = null)->num_rows();
            $this->backend->display('cs/v_report_ap', $data);
        } else {
            $data['title'] = 'Report MSR';
            $breadcrumb_items = [];
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['subtitle'] = 'Report MSR';
            $bulan1 = bulan($bulan);
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = "Repert Delivery  $bulan1 $tahun";
            $data['total_shipments'] = $this->cs->getTotalShipments($bulan, $tahun)->num_rows();
            $data['total_so'] = $this->cs->getTotalSo($bulan, $tahun)->num_rows();
            $data['jobsheet_pending'] =  $this->cs->getJobsheetPending($bulan, $tahun)->num_rows();
            $data['jobsheet_approve_pic'] =  $this->cs->getJobsheetApprovePic($bulan, $tahun)->num_rows();
            $data['jobsheet_approve_mgr'] =  $this->cs->getJobsheetApproveMgr($bulan, $tahun)->num_rows();
            $this->backend->display('cs/v_report_ap_filter', $data);
        }
    }
    public function Exportexcel($bulan = NULL, $tahun = NULL)
    {
        $shipments = $this->cs->getReportMsr($bulan, $tahun)->result_array();

        // var_dump($shipments);
        // die;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'TGL');
        $sheet->setCellValue('C1', 'NO STP');
        $sheet->setCellValue('D1', 'CUSTOMER');
        $sheet->setCellValue('E1', 'CONSIGNEE');
        $sheet->setCellValue('F1', 'DEST');
        $sheet->setCellValue('G1', 'SERVICE');
        $sheet->setCellValue('H1', 'COMM');
        $sheet->setCellValue('I1', 'PETUGAS PICKUP/ANTAR');
        $sheet->setCellValue('J1', 'NO FLIGHT');
        $sheet->setCellValue('K1', 'NO SMU');
        $sheet->setCellValue('L1', 'COLLY');
        $sheet->setCellValue('M1', 'BERAT JS');
        $sheet->setCellValue('N1', 'BERAT MSR');
        $sheet->setCellValue('O1', 'FREIGHT/KG');
        $sheet->setCellValue('P1', 'FREIGHT');
        $sheet->setCellValue('Q1', 'PACKING');
        $sheet->setCellValue('R1', 'OTHERS');
        $sheet->setCellValue('S1', 'SURCHARGE');
        $sheet->setCellValue('T1', 'INSURANCE');
        $sheet->setCellValue('U1', 'DISC');
        $sheet->setCellValue('V1', 'CN');
        $sheet->setCellValue('W1', 'TOTAL SALES');
        $sheet->setCellValue('X1', 'FLIGHT SMU');
        $sheet->setCellValue('Y1', 'RA');
        $sheet->setCellValue('Z1', 'PACKING');
        $sheet->setCellValue('AA1', 'REFUND');
        $sheet->setCellValue('AB1', 'INSURANCE');
        $sheet->setCellValue('AC1', 'SURCHARGE');
        $sheet->setCellValue('AD1', 'HAND. CGK');
        $sheet->setCellValue('AE1', 'HAND. PICK UP/DELIVERY');
        $sheet->setCellValue('AF1', 'HD. DAERAH');
        $sheet->setCellValue('AG1', 'PPH 23');
        $sheet->setCellValue('AH1', 'SDM');
        $sheet->setCellValue('AI1', 'TOTAL COST');
        $sheet->setCellValue('AJ1', 'TOTAL PROFIT');
        $sheet->setCellValue('AK1', '%');
        $sheet->setCellValue('AL1', 'AM/KA');
        $sheet->setCellValue('AM1', 'KETERANGAN');
        // $sheet->setCellValue('AN1', 'NO INVOICE');
        // $sheet->setCellValue('AO1', 'STATUS INVOICE');

        $no = 1;
        $x = 2;
        $freight_kg = 0;
        $disc = 0;
        $ra = 0;
        $packing = 0;
        foreach ($shipments as $row) {
            $sales = $this->cs->getSales($row['id_so'])->row_array();
            $get_do = $this->db->select('no_do,no_so, berat, koli')->get_where('tbl_no_do', ['shipment_id' => $row['shipment_id']])->result_array();
            $jumlah = $this->db->select('no_do')->get_where('tbl_no_do', ['shipment_id' => $row['shipment_id']])->num_rows();

            $no_do = '';
            $no_so = '';
            if ($get_do) {
                $i = 1;
                foreach ($get_do as $d) {
                    $no_do = ($i == $jumlah) ? $d['no_do'] : $d['no_do'] . '/';
                    $i++;
                }
            } else {
                $no_do =  $row['note_cs'];
            }

            // no so
            if ($get_do) {
                $i = 1;
                foreach ($get_do as $d) {

                    $no_so =  ($i == $jumlah) ? $d['no_so'] : $d['no_so'] . '/';
                    $i++;
                }
            } else {
                $no_so =  $row['no_so'];
            }

            // total sales
            $service =  $row['service_name'];
            if ($service == 'Charter Service') {
                $packing = $row['packing'];
                $total_sales = ($row['freight_kg'] + $packing +  $row['special_freight'] +  $row['others'] + $row['surcharge'] + $row['insurance']);
                $freight_kg = $row['special_freight'];
            } else {
                $disc = $row['disc'];
                // kalo gada disc
                if ($disc == 0) {
                    $freight  = $row['berat_js'] * $row['freight_kg'];
                    $special_freight  = $row['berat_msr'] * $row['special_freight'];
                } else {
                    $freight_discount = $row['freight_kg'] * $disc;
                    $special_freight_discount = $row['special_freight'] * $disc;

                    $freight = $freight_discount * $row['berat_js'];
                    $special_freight  = $special_freight_discount * $row['berat_msr'];
                }
                $freight_kg = $freight + $special_freight;


                $packing = $row['packing'];
                $total_sales = ($freight + $packing + $special_freight +  $row['others'] + $row['surcharge'] + $row['insurance']);

                $total_sales = $total_sales;
            }
            // total cost
            $refund = $row['refund2'] / 100;
            $pph = $row['pph2'] / 100;

            if ($service == 'Charter Service') {
                $total_cost = $row['flight_msu2'] + ($row['ra2']) + ($row['packing2']) +
                    ($total_sales * $refund) + $row['insurance2'] + $row['surcharge2'] + ($row['hand_cgk2']) +
                    ($row['hand_pickup2']) + ($row['hd_daerah2']) + ($total_sales * $pph) +
                    $row['sdm2'] + $row['others2'];
            } else {
                // sdm
                $sdm_biasa  = $row['berat_js'] * $row['sdm2'];
                $sdm_special  = $row['berat_msr'] * $row['sdm2'];
                $sdm = $sdm_biasa + $sdm_special;
                // ra
                $ra_biasa  = $row['berat_js'] * $row['ra2'];
                $ra_special  = $row['berat_msr'] * $row['ra2'];
                $ra = $ra_biasa + $ra_special;
                // packing
                $packing_biasa  = $row['berat_js'] * $row['packing2'];
                $packing_special  = $row['berat_msr'] * $row['packing2'];
                $packing = $packing_biasa + $packing_special;
                // hand cgk
                $hand_cgk_biasa  = $row['berat_js'] * $row['hand_cgk2'];
                $hand_cgk_special  = $row['berat_msr'] * $row['hand_cgk2'];
                $hand_cgk = $hand_cgk_biasa + $hand_cgk_special;
                // hand pickup
                $hand_pickup_biasa  = $row['berat_js'] * $row['hand_pickup2'];
                $hand_pickup_special  = $row['berat_msr'] * $row['hand_pickup2'];
                $hand_pickup = $hand_pickup_biasa + $hand_pickup_special;

                $total_cost = $row['flight_msu2'] + $ra + $packing +
                    ($total_sales * $refund) + $row['insurance2'] + $row['surcharge2'] + $hand_cgk +
                    $hand_pickup + $row['hd_daerah2'] + ($total_sales * $pph) +
                    $sdm + $row['others2'];
            }
            if ($service == 'Charter Service') {
                $ra = $row['ra2'];
                $packing = $row['packing2'];
                $hand_cgk = $row['hand_cgk2'];
                $hand_pickup =  $row['hand_pickup2'];
                $sdm = $row['sdm2'];
            } else {

                $ra_biasa  = $row['berat_js'] * $row['ra2'];
                $ra_special  = $row['berat_msr'] * $row['ra2'];
                $ra = $ra_biasa + $ra_special;

                $packing_biasa  = $row['berat_js'] * $row['packing2'];
                $packing_special  = $row['berat_msr'] * $row['packing2'];
                $packing = $packing_biasa + $packing_special;

                $hand_cgk_biasa  = $row['berat_js'] * $row['hand_cgk2'];
                $hand_cgk_special  = $row['berat_msr'] * $row['hand_cgk2'];
                $hand_cgk = $hand_cgk_biasa + $hand_cgk_special;


                $hand_pickup_biasa  = $row['berat_js'] * $row['hand_pickup2'];
                $hand_pickup_special  = $row['berat_msr'] * $row['hand_pickup2'];
                $hand_pickup = $hand_pickup_biasa + $hand_pickup_special;

                $sdm_biasa  = $row['berat_js'] * $row['sdm2'];
                $sdm_special  = $row['berat_msr'] * $row['sdm2'];
                $sdm = $sdm_biasa + $sdm_special;
            }



            $refund = $total_sales * $refund;
            $profit = $total_sales - $total_cost;

            $sheet->setCellValue('A' . $x, $no)->getColumnDimension('A')
                ->setAutoSize(true);
            $sheet->setCellValue('B' . $x, $row['tgl_pickup'])->getColumnDimension('B')
                ->setAutoSize(true);
            $sheet->setCellValue('C' . $x, $row['shipment_id'] . '/' . $row['no_stp'])->getColumnDimension('C')
                ->setAutoSize(true);
            $sheet->setCellValue('D' . $x, $row['shipper'])->getColumnDimension('D')
                ->setAutoSize(true);
            $sheet->setCellValue('E' . $x, $row['consigne'])->getColumnDimension('E')
                ->setAutoSize(true);
            $sheet->setCellValue('F' . $x, $row['tree_consignee'] . '/' . $row['city_consigne'])->getColumnDimension('F')
                ->setAutoSize(true);
            $sheet->setCellValue('G' . $x, $row['service_name'])->getColumnDimension('G')
                ->setAutoSize(true);
            $sheet->setCellValue('H' . $x, $row['pu_commodity'] . '/' . $no_do . '-' . $no_so)->getColumnDimension('H')
                ->setAutoSize(true);
            $sheet->setCellValue('I' . $x, $row['nama_user'])->getColumnDimension('I')
                ->setAutoSize(true);
            $sheet->setCellValue('J' . $x, $row['no_flight'])->getColumnDimension('J')
                ->setAutoSize(true);
            $sheet->setCellValue('K' . $x, $row['no_smu'])->getColumnDimension('K')
                ->setAutoSize(true);
            $sheet->setCellValue('L' . $x, $row['koli'])->getColumnDimension('L')
                ->setAutoSize(true);
            $sheet->setCellValue('M' . $x, $row['berat_js']);
            $sheet->setCellValue('N' . $x, $row['berat_msr'])->getColumnDimension('N')
                ->setAutoSize(true);
            if ($row['freight_kg'] != 0) {
                $sheet->getStyle("O" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('O' . $x, $row['freight_kg'])->getColumnDimension('O')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('O' . $x, $row['freight_kg'])->getColumnDimension('O')
                    ->setAutoSize(true);
            }
            if ($freight_kg != 0) {
                $sheet->getStyle("P" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('P' . $x, $freight_kg)->getColumnDimension('P')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('P' . $x, $freight_kg)->getColumnDimension('P')
                    ->setAutoSize(true);
            }
            if ($packing != 0) {
                $sheet->getStyle("Q" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('Q' . $x, $packing)->getColumnDimension('Q')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('Q' . $x, $packing)->getColumnDimension('Q')
                    ->setAutoSize(true);
            }
            if ($packing != 0) {
                $sheet->getStyle("Q" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('Q' . $x, $packing)->getColumnDimension('Q')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('Q' . $x, $packing)->getColumnDimension('Q')
                    ->setAutoSize(true);
            }
            if ($row['others'] != 0) {
                $sheet->getStyle("R" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('R' . $x, $row['others'])->getColumnDimension('R')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('R' . $x, $row['others'])->getColumnDimension('R')
                    ->setAutoSize(true);
            }
            if ($row['surcharge'] != 0) {
                $sheet->getStyle("S" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('S' . $x, $row['surcharge'])->getColumnDimension('S')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('S' . $x, $row['surcharge'])->getColumnDimension('S')
                    ->setAutoSize(true);
            }
            if ($row['insurance'] != 0) {
                $sheet->getStyle("T" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('T' . $x, $row['insurance'])->getColumnDimension('T')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('T' . $x, $row['insurance'])->getColumnDimension('T')
                    ->setAutoSize(true);
            }

            $sheet->setCellValue('U' . $x, $disc  * 100 . '%')->getColumnDimension('U')
                ->setAutoSize(true);
            $sheet->setCellValue('V' . $x, $row['cn'] * 100 . '%')->getColumnDimension('V')
                ->setAutoSize(true);

            if ($total_sales != 0) {
                $sheet->getStyle("W" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('W' . $x, $total_sales)->getColumnDimension('W')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('W' . $x, $total_sales)->getColumnDimension('W')
                    ->setAutoSize(true);
            }

            if ($row['flight_msu2'] != 0) {
                $sheet->getStyle("X" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('X' . $x, $row['flight_msu2'])->getColumnDimension('X')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('X' . $x, $row['flight_msu2'])->getColumnDimension('X')
                    ->setAutoSize(true);
            }
            if ($ra != 0) {
                $sheet->getStyle("Y" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('Y' . $x, $ra)->getColumnDimension('Y')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('Y' . $x, $ra)->getColumnDimension('Y')
                    ->setAutoSize(true);
            }
            if ($packing != 0) {
                $sheet->getStyle("Z" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('Z' . $x, $packing)->getColumnDimension('Z')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('Z' . $x, $packing)->getColumnDimension('Z')
                    ->setAutoSize(true);
            }

            if ($refund != 0) {
                $sheet->getStyle("AA" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AA' . $x, $refund)->getColumnDimension('AA')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AA' . $x, $refund)->getColumnDimension('AA')
                    ->setAutoSize(true);
            }
            if ($row['insurance2'] != 0) {
                $sheet->getStyle("AB" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AB' . $x, $row['insurance2'])->getColumnDimension('AB')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AB' . $x, $row['insurance2'])->getColumnDimension('AB')
                    ->setAutoSize(true);
            }
            if ($row['surcharge2'] != 0) {
                $sheet->getStyle("AC" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AC' . $x, $row['surcharge2'])->getColumnDimension('AC')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AC' . $x, $row['surcharge2'])->getColumnDimension('AC')
                    ->setAutoSize(true);
            }
            if ($hand_cgk != 0) {
                $sheet->getStyle("AD" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AD' . $x, $hand_cgk)->getColumnDimension('AD')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AD' . $x, $hand_cgk)->getColumnDimension('AD')
                    ->setAutoSize(true);
            }
            if ($hand_pickup != 0) {
                $sheet->getStyle("AE" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AE' . $x, $hand_pickup)->getColumnDimension('AE')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AE' . $x, $hand_pickup)->getColumnDimension('AE')
                    ->setAutoSize(true);
            }
            if ($row['hd_daerah2'] != 0) {
                $sheet->getStyle("AF" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AF' . $x, $row['hd_daerah2'])->getColumnDimension('AF')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AF' . $x, $row['hd_daerah2'])->getColumnDimension('AF')
                    ->setAutoSize(true);
            }
            if ($total_sales * ($row['pph2'] / 100) != 0) {
                $sheet->getStyle("AG" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AG' . $x, $total_sales * ($row['pph2'] / 100))->getColumnDimension('AG')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AG' . $x, $total_sales * ($row['pph2'] / 100))->getColumnDimension('AG')
                    ->setAutoSize(true);
            }
            if ($sdm != 0) {
                $sheet->getStyle("AH" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AH' . $x, $sdm)->getColumnDimension('AH')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AH' . $x, $sdm)->getColumnDimension('AH')
                    ->setAutoSize(true);
            }
            if ($total_cost != 0) {
                $sheet->getStyle("AI" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AI' . $x, $total_cost)->getColumnDimension('AI')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AI' . $x, $total_cost)->getColumnDimension('AI')
                    ->setAutoSize(true);
            }
            if ($profit != 0) {
                $sheet->getStyle("AJ" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('AJ' . $x, $profit)->getColumnDimension('AJ')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('AJ' . $x, $profit)->getColumnDimension('AJ')
                    ->setAutoSize(true);
            }
            $sheet->setCellValue('AK' . $x, round($profit / $total_sales * 100, 0))->getColumnDimension('AK')
                ->setAutoSize(true);

            $sheet->setCellValue('AL' . $x, $sales['nama_user'])->getColumnDimension('AL')
                ->setAutoSize(true);
            $sheet->setCellValue('AM' . $x, $row['note_pic_js'])->getColumnDimension('AM')
                ->setAutoSize(true);

            $x++;
            $no++;
        }
        $bulan = bulan($bulan);
        $filename = "MSR-$bulan-$tahun";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

        // header("Content-type: application/octet-stream");
        // header("Content-Disposition: attachment;Filename=export-laporan-invoice.xls");
        // $data['title'] = "Invoice";

        // $this->load->view('finance/report_invoice', $data);
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
