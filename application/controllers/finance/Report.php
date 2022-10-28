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
        $this->load->model('ApModel', 'ap');
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
    public function ap()
    {
        $bulan = $this->input->post('bulan');

        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {
            $data['title'] = 'Report AP';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Report AP';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Overall Delivery Report';
            $data['total_shipments'] = $this->cs->getInvoiceReport($bulan = null, $tahun = null)->num_rows();
            $data['invoice_created'] =  $this->cs->getTotalInvoice($bulan = null, $tahun = null)->num_rows();
            $data['invoice_paid'] =  $this->cs->getInvoicePaid($bulan = null, $tahun = null)->num_rows();
            $data['invoice_pending'] =  $this->cs->getInvoicePending($bulan = null, $tahun = null)->num_rows();
            $data['invoice_proforma'] =  $this->cs->getInvoiceProforma($bulan = null, $tahun = null)->num_rows();
            $this->backend->display('finance/v_report_ap', $data);
        } else {
            $data['title'] = 'Report AP';
            $breadcrumb_items = [];
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['subtitle'] = 'Report AP';
            $bulan1 = bulan($bulan);
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = "Repert Delivery  $bulan1 $tahun";
            $data['total_shipments'] = $this->cs->getInvoiceReport($bulan, $tahun)->num_rows();
            $data['invoice_created'] =  $this->cs->getTotalInvoice($bulan, $tahun)->num_rows();
            $data['invoice_paid'] =  $this->cs->getInvoicePaid($bulan, $tahun)->num_rows();
            $data['invoice_pending'] =  $this->cs->getInvoicePending($bulan, $tahun)->num_rows();
            $data['invoice_proforma'] =  $this->cs->getInvoiceProforma($bulan, $tahun)->num_rows();
            $this->backend->display('finance/v_report_ap_filter', $data);
        }
    }
    public function ap2()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        if ($awal == NULL && $akhir == NULL) {
            $data['title'] = 'Report AP Internal';
            $breadcrumb_items = [];
            $data['subtitle'] = 'Report AP Internal';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['ap'] = $this->ap->getApPaid()->result_array();
            $this->backend->display('finance/v_report_ap_internal', $data);
        } else {
            $breadcrumb_items = [];
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            $data['subtitle'] = "Repert Ap  $awal $akhir";
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['ap'] = $this->ap->getApPaid($awal, $akhir)->result_array();
            $awal = bulan_indo($awal);
            $akhir = bulan_indo($akhir);
            $data['title'] = "Repert Ap $awal - $akhir";
            $this->backend->display('finance/v_report_ap_internal_filter', $data);
        }
    }

    public function addAp($uri)
    {

        $data['title'] = 'Add Account Payable';
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['uri'] = $uri;
        $this->backend->display('finance/v_add_ap_report', $data);
    }
    public function processAddAp()
    {
        $id_kategori_pengeluaran = $this->input->post('id_category');
        $description = $this->input->post('descriptions');
        $amount_proposed = $this->input->post('amount_proposed');
        $attachment = $this->input->post('attachment');
        $mode = $this->input->post('mode');
        $via = $this->input->post('via');
        $no_ca = $this->input->post('no_ca');

        $total = array_sum($amount_proposed);

        $id_kategori = $this->input->post('id_kategori_pengeluaran');
        // 1= po
        // 2= ca
        // 3=car
        // 4 = re
        $no_pengeluaran = '';
        $pre = '';
        $cek_no_invoice = $this->db->select_max('no_pengeluaran')->get_where('tbl_pengeluaran', ['id_kat_ap' => $id_kategori])->row_array();

        if ($id_kategori == 1) {
            $pre = 'PO-';
        } elseif ($id_kategori == 2) {
            $pre = 'CA-';
        } elseif ($id_kategori == 3) {
            $pre = 'CAR-';
        } elseif ($id_kategori == 4) {
            $pre = 'RE-';
        }

        if ($cek_no_invoice['no_pengeluaran'] == NULL) {
            $no_pengeluaran = $pre . '000001';
        } else {
            if ($id_kategori == 3) {
                $get_ca = $this->db->get_where('tbl_pengeluaran', ['no_pengeluaran' => $no_ca])->row_array();
                if ($get_ca) {
                    $potong =    substr($get_ca['no_pengeluaran'], 4, 6);
                    $no_pengeluaran = "CAR-$potong";
                } else {
                    $this->session->set_flashdata('message', "<div class='alert
					alert-danger' role='alert'>No CA with This $no_ca</div>");
                    redirect('finance/ap/addCar');
                }
            } else {
                $potong = substr($cek_no_invoice['no_pengeluaran'], 3, 6);
                $no = $potong + 1;
                $kode =  sprintf("%06s", $no);

                $no_pengeluaran  = "$pre$kode";
            }
        }
        $id_atasan = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        for ($i = 0; $i < sizeof($id_kategori_pengeluaran); $i++) {
            $data = array(
                'id_kategori_pengeluaran' => $id_kategori_pengeluaran[$i],
                'description' => $description[$i],
                'amount_proposed' => $amount_proposed[$i],
                'amount_approved' => $amount_proposed[$i],
                // 'attachment' => $attachment[$i],
                'purpose' => $this->input->post('purpose'),
                'id_kat_ap' => $this->input->post('id_kategori_pengeluaran'),
                'date' => $this->input->post('date'),
                'total' => $total,
                'total_approved' => $total,
                'payment_mode' => $mode,
                'via_transfer' => $via,
                'no_ca' => $no_ca,
                'no_pengeluaran' => $no_pengeluaran,
                'id_user' => $this->session->userdata('id_user'),
                'id_atasan' => $id_atasan['id_atasan'],
                'is_approve_sm' => 0,
                'status' => 4
            );

            $this->db->insert('tbl_pengeluaran', $data);

            //  else {
            //     // $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            //     // redirect('finance/ap/car');
            // }
        }
        $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
        $month = date('m', strtotime($this->input->post('date')));
        $year = date('Y', strtotime($this->input->post('date')));
        redirect('finance/Report/' . $this->input->post('uri') . '/' . $month . '/' . $year);
    }


    public function detailAp($no_ap)
    {

        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $data['jabatan'] = $this->session->userdata('id_jabatan');
        $this->backend->display('finance/v_detail_ap_report', $data);
    }
    public function editApSatuanAjax()
    {
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        $ap = $this->db->get_where('tbl_pengeluaran', array('id_pengeluaran' => $id))->row_array();
        $data = array(
            $field => $value,

        );
        $update = $this->db->update('tbl_pengeluaran', $data, array('id_pengeluaran' => $id));
        if ($update) {
            $allAp = $this->db->get_where('tbl_pengeluaran', array('no_pengeluaran' => $ap['no_pengeluaran']))->result_array();
            $total = 0;
            foreach ($allAp as $allAp) {
                $total += $allAp['amount_approved'];
            }
            $dataTotal = [
                'total_approved' => $total
            ];
            if ($this->db->update('tbl_pengeluaran', $dataTotal, array('no_pengeluaran' => $ap['no_pengeluaran']))) {
                // $this->session->set_flashdata('message', 'Diedit');
                echo 1;
                exit;
            }

            // redirect('cs/ap/detail/' . $id);
        } else {
            $this->session->set_flashdata('message', 'Gagal');
            // redirect('cs/ap/detail/' . $id);
        }
    }

    public function profitLoss($bln = NULL, $thn = NULL)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if ($bulan == NULL && $tahun == NULL) {
            if ($bln == NULL && $thn == NULL) {
                $msr = $this->cs->getAllMsr(date('m'), date('Y'))->result_array();
                //Perhitungan Total Sales
                $totalallsales = 0;
                foreach ($msr as $msr) {
                    $service =  $msr['service_name'];
                    if ($service == 'Charter Service') {
                        // $total_sales = $msr['special_freight'];
                        $packing = $msr['packing'];
                        $total_sales = ((int)$msr['freight_kg'] + $packing +  (int)$msr['special_freight'] +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                    } else {
                        $disc = $msr['disc'];
                        // kalo gada disc
                        if ($disc == 0) {
                            $freight  = (int)$msr['berat_js'] * (int)$msr['freight_kg'];
                            $special_freight  = (int)$msr['berat_msr'] * (int)$msr['special_freight'];
                        } else {
                            $freight_discount = $msr['freight_kg'] * $disc;
                            $special_freight_discount = $msr['special_freight'] * $disc;

                            $freight = $freight_discount * $msr['berat_js'];
                            $special_freight  = $special_freight_discount * $msr['berat_msr'];
                        }

                        // var_dump($freight);
                        // die;

                        $packing = (int)$msr['packing'];
                        $total_sales = ($freight + $packing + $special_freight +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                        // $comm = $msr['cn'] * $total_sales;
                        // $disc = $msr['disc'] * $total_sales;

                        $total_sales = $total_sales;
                    }
                    $totalallsales += $total_sales;
                }
                //Cari  Material
                //Ambil dari list Material di modal
                $apMaterial = $this->ap->getModalJoinShp(date('m'), date('Y'))->result_array();
                $totalApMaterial = 0;
                foreach ($apMaterial as $apMaterial) {
                    $totalApMaterial += $apMaterial['packing2'];
                }

                //Cari  handling charges
                //Ambil dari list Material dimodal
                $apHandlingCharges = $this->ap->getModalJoinShp(date('m'), date('Y'))->result_array();
                $totalApHandlingCharges = 0;
                foreach ($apHandlingCharges as $apHandlingCharges) {
                    $totalApHandlingCharges += ($apHandlingCharges['hand_cgk2'] + $apHandlingCharges['hand_pickup2'] + $apHandlingCharges['hd_daerah2'] + $apHandlingCharges['ra2']);
                }

                //COST OF FREIGHT DARI AP EXTERNAL
                $costOfFreight = $this->ap->getModalJoinShp(date('m'), date('Y'))->result_array();
                $totalCostOfFreight = 0;
                foreach ($costOfFreight as $costOfFreight) {
                    $service =  $costOfFreight['service_name'];
                    if ($service == 'Charter Service') {
                        $packing = $costOfFreight['packing'];
                        $total_sales = ($costOfFreight['freight_kg'] + $packing +  $costOfFreight['special_freight'] +  $costOfFreight['others'] + $costOfFreight['surcharge'] + $costOfFreight['insurance']);
                    } else {
                        $disc = $costOfFreight['disc'];
                        // kalo gada disc
                        if ($disc == 0) {
                            $freight  = $costOfFreight['berat_js'] * $costOfFreight['freight_kg'];
                            $special_freight  = $costOfFreight['berat_msr'] * $costOfFreight['special_freight'];
                        } else {
                            $freight_discount = $costOfFreight['freight_kg'] * $disc;
                            $special_freight_discount = $costOfFreight['special_freight'] * $disc;

                            $freight = $freight_discount * $costOfFreight['berat_js'];
                            $special_freight  = $special_freight_discount * $costOfFreight['berat_msr'];
                        }

                        $packing = $costOfFreight['packing'];
                        $total_sales = ($freight + $packing + $special_freight +  $costOfFreight['others'] + $costOfFreight['surcharge'] + $costOfFreight['insurance']);
                        $total_sales = $total_sales;
                    }

                    if ($costOfFreight['refund2'] == 0) {
                        $refund = $costOfFreight['specialrefund2'];
                    } elseif ($costOfFreight['specialrefund2'] == 0) {
                        $refund = $total_sales * ($costOfFreight['refund2'] / 100);
                    }
                    $totalCostOfFreight += ((int)$costOfFreight['flight_msu2'] + (int)$costOfFreight['insurance2'] + $refund);
                }

                //Untuk ap diambil dari Paid
                $allAp = $this->ap->getAllApReport(date('m'), date('Y'));
                $totalAllAp = 0;
                foreach ($allAp->result_array() as $allAp) {
                    $totalAllAp += $allAp['total'];
                }

                //Overhead
                // Dari transport,entertain,pengembanganpegawai,sallary,overtime
                $OverheadAp = $this->ap->getApByOverhead(date('m'), date('Y'))->result_array();
                $totalOverhead = 0;
                foreach ($OverheadAp as $OverheadAp) {
                    $totalOverhead += $OverheadAp['total'];
                }
                //General Am EXP
                $generalAmExpAp = $this->ap->getApByAmExp(date('m'), date('Y'))->result_array();
                $totalAmExp = 0;
                foreach ($generalAmExpAp as $generalAmExpAp) {
                    $totalAmExp += $generalAmExpAp['total'];
                }

                //Cari AP Human Resource
                $apHumanResource = $this->ap->getModalJoinShp(date('m'), date('Y'))->result_array();
                $totalApHumanResource = 0;
                foreach ($apHumanResource as $apHumanResource) {
                    $totalApHumanResource += $apHumanResource['sdm2'];
                }



                $data['title'] = 'Report Profit Loss ' . bulan(date('m')) . ' ' . date('Y');
                $breadcrumb_items = [];
                $data['subtitle'] = 'Report AP';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['tahun'] = date('Y');
                $data['bulan'] = date('m');
                $data['heading'] = 'Profit Loss Report';
                $data['totalsales'] = $totalallsales - ($totalallsales * 0.011);
                $data['apMaterial'] = $totalApMaterial;
                $data['apHandlingCharges'] = $totalApHandlingCharges;
                $data['apOverhead'] = $totalOverhead;
                $data['apGeneralAmExp'] = $totalAmExp;
                $data['apHumanResource'] = $totalApHumanResource;
                $data['apCostOfFreight'] = $totalCostOfFreight;
                $data['adjustCostOfFreight'] = $this->ap->getAdjust('Cost Of Freight', date('m'), date('Y'))->result_array();
                $data['adjustHandlingCharges'] = $this->ap->getAdjust('Handling Charges', date('m'), date('Y'))->result_array();
                $data['adjustHumanResource'] = $this->ap->getAdjust('Human Resource', date('m'), date('Y'))->result_array();
                $data['adjustMaterial'] = $this->ap->getAdjust('Material', date('m'), date('Y'))->result_array();
                $data['allAp'] = $totalAllAp;
                $this->backend->display('finance/v_profitloss', $data);
            } else {
                $msr = $this->cs->getAllMsr($bln, $thn)->result_array();
                //Perhitungan Total Sales
                $totalallsales = 0;
                foreach ($msr as $msr) {
                    $service =  $msr['service_name'];
                    if ($service == 'Charter Service') {
                        // $total_sales = $msr['special_freight'];
                        $packing = $msr['packing'];
                        $total_sales = ((int)$msr['freight_kg'] + $packing +  (int)$msr['special_freight'] +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                    } else {
                        $disc = $msr['disc'];
                        // kalo gada disc
                        if ($disc == 0) {
                            $freight  = (int)$msr['berat_js'] * (int)$msr['freight_kg'];
                            $special_freight  = (int)$msr['berat_msr'] * (int)$msr['special_freight'];
                        } else {
                            $freight_discount = $msr['freight_kg'] * $disc;
                            $special_freight_discount = $msr['special_freight'] * $disc;

                            $freight = $freight_discount * $msr['berat_js'];
                            $special_freight  = $special_freight_discount * $msr['berat_msr'];
                        }

                        // var_dump($freight);
                        // die;

                        $packing = (int)$msr['packing'];
                        $total_sales = ($freight + $packing + $special_freight +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                        // $comm = $msr['cn'] * $total_sales;
                        // $disc = $msr['disc'] * $total_sales;

                        $total_sales = $total_sales;
                    }
                    $totalallsales += $total_sales;
                }
                //Cari  Material
                //Ambil dari list Material di modal
                $apMaterial = $this->ap->getModalJoinShp($bln, $thn)->result_array();
                $totalApMaterial = 0;
                foreach ($apMaterial as $apMaterial) {
                    $totalApMaterial += $apMaterial['packing2'];
                }

                //Cari  handling charges
                //Ambil dari list Material dimodal
                $apHandlingCharges = $this->ap->getModalJoinShp($bln, $thn)->result_array();
                $totalApHandlingCharges = 0;
                foreach ($apHandlingCharges as $apHandlingCharges) {
                    $totalApHandlingCharges += ((int)$apHandlingCharges['hand_cgk2'] + (int)$apHandlingCharges['hand_pickup2'] + (int)$apHandlingCharges['hd_daerah2'] + (int)$apHandlingCharges['ra2']);
                }

                //COST OF FREIGHT DARI AP EXTERNAL
                $costOfFreight = $this->ap->getModalJoinShp($bln, $thn)->result_array();
                $totalCostOfFreight = 0;
                foreach ($costOfFreight as $costOfFreight) {
                    $service =  $costOfFreight['service_name'];
                    if ($service == 'Charter Service') {
                        $packing = $costOfFreight['packing'];
                        $total_sales = ((int)$costOfFreight['freight_kg'] + $packing +  (int)$costOfFreight['special_freight'] +  (int)$costOfFreight['others'] + (int)$costOfFreight['surcharge'] + (int)$costOfFreight['insurance']);
                    } else {
                        $disc = $costOfFreight['disc'];
                        // kalo gada disc
                        if ($disc == 0) {
                            $freight  = (int)$costOfFreight['berat_js'] * (int)$costOfFreight['freight_kg'];
                            $special_freight  = (int)$costOfFreight['berat_msr'] * (int)$costOfFreight['special_freight'];
                        } else {
                            $freight_discount = $costOfFreight['freight_kg'] * $disc;
                            $special_freight_discount = $costOfFreight['special_freight'] * $disc;

                            $freight = $freight_discount * $costOfFreight['berat_js'];
                            $special_freight  = $special_freight_discount * $costOfFreight['berat_msr'];
                        }

                        $packing = (int)$costOfFreight['packing'];
                        $total_sales = ($freight + $packing + $special_freight +  (int)$costOfFreight['others'] + (int)$costOfFreight['surcharge'] + (int)$costOfFreight['insurance']);
                        $total_sales = $total_sales;
                    }

                    if ($costOfFreight['refund2'] == 0) {
                        $refund = $costOfFreight['specialrefund2'];
                    } elseif ($costOfFreight['specialrefund2'] == 0) {
                        $refund = $total_sales * ($costOfFreight['refund2'] / 100);
                    }
                    $totalCostOfFreight += ((int)$costOfFreight['flight_msu2'] + (int)$costOfFreight['insurance2'] + $refund);
                }

                //Untuk ap diambil dari Paid
                $allAp = $this->ap->getAllApReport($bln, $thn);
                $totalAllAp = 0;
                foreach ($allAp->result_array() as $allAp) {
                    $totalAllAp += $allAp['total'];
                }

                //Overhead
                // Dari transport,entertain,pengembanganpegawai,sallary,overtime
                $OverheadAp = $this->ap->getApByOverhead($bln, $thn)->result_array();
                $totalOverhead = 0;
                foreach ($OverheadAp as $OverheadAp) {
                    $totalOverhead += $OverheadAp['total'];
                }
                //General Am EXP
                $generalAmExpAp = $this->ap->getApByAmExp($bln, $thn)->result_array();
                $totalAmExp = 0;
                foreach ($generalAmExpAp as $generalAmExpAp) {
                    $totalAmExp += $generalAmExpAp['total'];
                }

                //Cari AP Human Resource
                $apHumanResource = $this->ap->getModalJoinShp($bln, $thn)->result_array();
                $totalApHumanResource = 0;
                foreach ($apHumanResource as $apHumanResource) {
                    $totalApHumanResource += $apHumanResource['sdm2'];
                }


                $data['title'] = 'Report Profit Loss ' . bulan($bln) . ' ' . $thn;
                $breadcrumb_items = [];
                $data['subtitle'] = 'Report AP';
                $this->breadcrumb->add_item($breadcrumb_items);
                $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
                $data['heading'] = 'Profit Loss Report';
                $data['tahun'] = $thn;
                $data['bulan'] = $bln;
                $data['totalsales'] = $totalallsales - ($totalallsales * 0.011);
                $data['apMaterial'] = $totalApMaterial;
                $data['adjustMaterial'] = $this->ap->getAdjust('Material', $bln, $thn)->result_array();
                $data['apHandlingCharges'] = $totalApHandlingCharges;
                $data['apOverhead'] = $totalOverhead;
                $data['apGeneralAmExp'] = $totalAmExp;
                $data['apHumanResource'] = $totalApHumanResource;
                $data['apCostOfFreight'] = $totalCostOfFreight;
                $data['adjustCostOfFreight'] = $this->ap->getAdjust('Cost Of Freight', $bln, $thn)->result_array();
                $data['adjustHandlingCharges'] = $this->ap->getAdjust('Handling Charges', $bln, $thn)->result_array();
                $data['adjustHumanResource'] = $this->ap->getAdjust('Human Resource', $bln, $thn)->result_array();
                $data['adjustMaterial'] = $this->ap->getAdjust('Material', $bln, $thn)->result_array();
                $data['allAp'] = $totalAllAp;
                $this->backend->display('finance/v_profitloss', $data);
            }
        } else {
            $msr = $this->cs->getAllMsr($bulan, $tahun)->result_array();
            //Perhitungan Total Sales
            $totalallsales = 0;
            foreach ($msr as $msr) {
                $service =  $msr['service_name'];
                if ($service == 'Charter Service') {
                    // $total_sales = $msr['special_freight'];
                    $packing = $msr['packing'];
                    $total_sales = ((int)$msr['freight_kg'] + $packing +  (int)$msr['special_freight'] +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                } else {
                    $disc = $msr['disc'];
                    // kalo gada disc
                    if ($disc == 0) {
                        $freight  = (int)$msr['berat_js'] * (int)$msr['freight_kg'];
                        $special_freight  = (int)$msr['berat_msr'] * (int)$msr['special_freight'];
                    } else {
                        $freight_discount = $msr['freight_kg'] * $disc;
                        $special_freight_discount = $msr['special_freight'] * $disc;

                        $freight = $freight_discount * $msr['berat_js'];
                        $special_freight  = $special_freight_discount * $msr['berat_msr'];
                    }

                    // var_dump($freight);
                    // die;

                    $packing = (int)$msr['packing'];
                    $total_sales = ($freight + $packing + $special_freight +  (int)$msr['others'] + (int)$msr['surcharge'] + (int)$msr['insurance']);
                    // $comm = $msr['cn'] * $total_sales;
                    // $disc = $msr['disc'] * $total_sales;

                    $total_sales = $total_sales;
                }
                $totalallsales += $total_sales;
            }
            //Cari AP Material
            $apMaterial = $this->ap->getModalJoinShp($bulan, $tahun)->result_array();
            $totalApMaterial = 0;
            foreach ($apMaterial as $apMaterial) {
                $totalApMaterial += $apMaterial['packing2'];
            }

            //Cari  handling charges
            //Ambil dari list Material dimodal
            $apHandlingCharges = $this->ap->getModalJoinShp($bulan, $tahun)->result_array();
            $totalApHandlingCharges = 0;
            foreach ($apHandlingCharges as $apHandlingCharges) {
                $totalApHandlingCharges += ((int)$apHandlingCharges['hand_cgk2'] + (int)$apHandlingCharges['hand_pickup2'] + (int)$apHandlingCharges['hd_daerah2'] + (int)$apHandlingCharges['ra2']);
            }

            //COST OF FREIGHT DARI AP EXTERNAL
            $costOfFreight = $this->ap->getModalJoinShp($bulan, $tahun)->result_array();
            $totalCostOfFreight = 0;
            foreach ($costOfFreight as $costOfFreight) {
                $service =  $costOfFreight['service_name'];
                if ($service == 'Charter Service') {
                    $packing = (int)$costOfFreight['packing'];
                    $total_sales = ((int)$costOfFreight['freight_kg'] + $packing +  (int)$costOfFreight['special_freight'] +  (int)$costOfFreight['others'] + (int)$costOfFreight['surcharge'] + (int)$costOfFreight['insurance']);
                } else {
                    $disc = $costOfFreight['disc'];
                    // kalo gada disc
                    if ($disc == 0) {
                        $freight  = (int)$costOfFreight['berat_js'] * (int)$costOfFreight['freight_kg'];
                        $special_freight  = (int)$costOfFreight['berat_msr'] * (int)$costOfFreight['special_freight'];
                    } else {
                        $freight_discount = $costOfFreight['freight_kg'] * $disc;
                        $special_freight_discount = $costOfFreight['special_freight'] * $disc;

                        $freight = $freight_discount * $costOfFreight['berat_js'];
                        $special_freight  = $special_freight_discount * $costOfFreight['berat_msr'];
                    }

                    $packing = (int)$costOfFreight['packing'];
                    $total_sales = ($freight + $packing + $special_freight +  (int)$costOfFreight['others'] + (int)$costOfFreight['surcharge'] + (int)$costOfFreight['insurance']);
                    $total_sales = $total_sales;
                }

                if ($costOfFreight['refund2'] == 0) {
                    $refund = $costOfFreight['specialrefund2'];
                } elseif ($costOfFreight['specialrefund2'] == 0) {
                    $refund = $total_sales * ($costOfFreight['refund2'] / 100);
                }
                $totalCostOfFreight += ((int)$costOfFreight['flight_msu2'] + (int)$costOfFreight['insurance2'] + $refund);
            }

            //Cari AP Human Resource
            $apHumanResource = $this->ap->getModalJoinShp($bulan, $tahun)->result_array();
            $totalApHumanResource = 0;
            foreach ($apHumanResource as $apHumanResource) {
                $totalApHumanResource += $apHumanResource['sdm2'];
            }

            //Untuk ap diambil dari Paid
            $allAp = $this->ap->getAllApReport($bulan, $tahun);
            $totalAllAp = 0;
            foreach ($allAp->result_array() as $allAp) {
                $totalAllAp += $allAp['total'];
            }

            //Overhead
            // Dari transport,entertain,pengembanganpegawai,sallary,overtime
            $OverheadAp = $this->ap->getApByOverhead($bulan, $tahun)->result_array();
            $totalOverhead = 0;
            foreach ($OverheadAp as $OverheadAp) {
                $totalOverhead += $OverheadAp['total'];
            }
            //General Am EXP
            $generalAmExpAp = $this->ap->getApByAmExp($bulan, $tahun)->result_array();
            $totalAmExp = 0;
            foreach ($generalAmExpAp as $generalAmExpAp) {
                $totalAmExp += $generalAmExpAp['total'];
            }
            $data['title'] = 'Report Profit Loss ' . bulan($bulan) . ' ' . $tahun;
            $breadcrumb_items = [];
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['subtitle'] = 'Report AP';
            $bulan1 = bulan($bulan);
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = "Repert Delivery  $bulan1 $tahun";
            $data['totalsales'] = $totalallsales - ($totalallsales * 0.011);
            $data['apMaterial'] = $totalApMaterial;
            $data['adjustMaterial'] = $this->ap->getAdjust('Material', $bulan, $tahun)->result_array();
            $data['apHandlingCharges'] = $totalApHandlingCharges;
            $data['apOverhead'] = $totalOverhead;
            $data['apGeneralAmExp'] = $totalAmExp;
            $data['apHumanResource'] = $totalApHumanResource;
            $data['apCostOfFreight'] = $totalCostOfFreight;
            $data['adjustCostOfFreight'] = $this->ap->getAdjust('Cost Of Freight', $bln, $thn)->result_array();
            $data['adjustHandlingCharges'] = $this->ap->getAdjust('Handling Charges', $bln, $thn)->result_array();
            $data['adjustHumanResource'] = $this->ap->getAdjust('Human Resource', $bln, $thn)->result_array();
            $data['adjustMaterial'] = $this->ap->getAdjust('Material', $bln, $thn)->result_array();
            $data['allAp'] = $totalAllAp;
            $this->backend->display('finance/v_profitloss_filter', $data);
        }
    }

    public function detailOverhead($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {

            $data['title'] = 'Report';
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $breadcrumb_items = [];
            $data['subtitle'] = 'Overhead Cost';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Overhead Cost ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getApByOverhead($bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss_ap', $data);
        } else {
            redirect('finance/Report/detailOverhead/' . $bulan . '/' . $tahun);
        }
    }
    public function detailAmExp($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {

            $data['title'] = 'Report';
            $breadcrumb_items = [];
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $data['subtitle'] = 'AM EXP Cost ' . bulan($bln) . $thn;
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Am Exp Report ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getApByAmExp($bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss_ap', $data);
        } else {
            redirect('finance/Report/detailAmExp/' . $bulan . '/' . $tahun);
        }
    }
    public function detailMaterial($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {

            $data['title'] = 'Report';
            $breadcrumb_items = [];
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $data['subtitle'] = 'Material Cost';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Material Cost Report ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getModalJoinShp($bln, $thn)->result_array();
            $data['adjust'] = $this->ap->getAdjust('Material', $bln, $thn)->result_array();
            $data['adjust2'] = $this->ap->getAdjust('Material', $bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss', $data);
        } else {
            redirect('finance/Report/detailMaterialCost/' . $bulan . '/' . $tahun);
        }
    }

    public function detailHandlingCharges($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {

            $data['title'] = 'Report';
            $breadcrumb_items = [];
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $data['subtitle'] = 'Handling Charges Cost';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Handling Charges Cost Report ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getModalJoinShp($bln, $thn)->result_array();
            $data['adjust'] = $this->ap->getAdjust('Handling Charges', $bln, $thn)->result_array();
            $data['adjust2'] = $this->ap->getAdjust('Handling Charges', $bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss', $data);
        } else {
            redirect('finance/Report/detailHandlingCharges/' . $bulan . '/' . $tahun);
        }
    }

    public function detailHumanResource($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        if ($bulan == NULL && $tahun == NULL) {

            $data['title'] = 'Report';
            $breadcrumb_items = [];
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $data['subtitle'] = 'Human Resource Cost';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Human Resource Cost Report ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getModalJoinShp($bln, $thn)->result_array();
            $data['adjust'] = $this->ap->getAdjust('Human Resource', $bln, $thn)->result_array();
            $data['adjust2'] = $this->ap->getAdjust('Human Resource', $bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss', $data);
        } else {
            redirect('finance/Report/detailHumanResource/' . $bulan . '/' . $tahun);
        }
    }

    public function detailCostOfFreight($bln, $thn)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if ($bulan == NULL && $tahun == NULL) {
            $data['title'] = 'Report';
            $breadcrumb_items = [];
            $data['tahun'] = $thn;
            $data['bulan'] = $bln;
            $data['subtitle'] = 'Cost Of Freight';
            $this->breadcrumb->add_item($breadcrumb_items);
            $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
            $data['heading'] = 'Cost Of Freight ' . bulan($bln) . $thn;
            $data['ap'] = $this->ap->getModalJoinShp($bln, $thn)->result_array();
            $data['adjust'] = $this->ap->getAdjust('Cost Of Freight', $bln, $thn)->result_array();
            $data['adjust2'] = $this->ap->getAdjust('Cost Of Freight', $bln, $thn)->result_array();
            $this->backend->display('finance/v_detail_profitloss', $data);
        } else {


            redirect('finance/Report/detailCostOfFreight/' . $bulan . '/' . $tahun);
        }
    }

    public function addReal($uri)
    {

        $data['title'] = 'Add Adjust';
        // $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        // $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['uri'] = $uri;
        $this->backend->display('finance/v_add_real_report', $data);
    }
    public function processAddReal()
    {
        $bagian = $this->input->post('bagian');
        $description = $this->input->post('description');
        $amount = preg_replace("/[^0-9]/", "", $this->input->post('amount'));
        $date = $this->input->post('date');

        $data = [
            'bagian'        => $bagian,
            'description'   => $description,
            'date'          => $date,
            'amount'        => $amount,
            'operation'        => $this->input->post('operation'),
            'user'          => $this->session->userdata('nama_user')
        ];
        if ($this->db->insert('tbl_real', $data)) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function editReal($id)
    {
        $amount = preg_replace("/[^0-9]/", "", $this->input->post('amount'));
        $dataEdit = [
            'description' => $this->input->post('description'),
            'operation' => $this->input->post('operation'),
            'amount' => $amount,
        ];
        if ($this->db->update('tbl_real', $dataEdit, array('id_real' => $id))) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            var_dump($dataEdit);
        }
    }

    public function deleteReal($id)
    {
        if ($this->db->delete('tbl_real', array('id_real' => $id))) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Success'));
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function soa()
    {
        $data['title'] = 'SOA';
        $breadcrumb_items = [];
        $data['subtitle'] = 'SOA';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['proforma'] = $this->cs->getSoa()->result_array();
        $this->backend->display('finance/v_soa', $data);
    }

    public function Exportexcel($bulan = NULL, $tahun = NULL)
    {
        $shipments = $this->cs->getInvoiceReport($bulan, $tahun)->result_array();
        $shipments_void = $this->cs->getInvoiceVoidReport($bulan, $tahun)->result_array();

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
        $sheet->setCellValue('AN1', 'NO INVOICE');
        $sheet->setCellValue('AO1', 'TANGGAL BAYAR INVOICE');
        $sheet->setCellValue('AP1', 'INVOICE CREATED');
        $sheet->setCellValue('AQ1', 'DUE DATE INVOICE');
        $sheet->setCellValue('AR1', 'SELISIH WAKTU');
        $sheet->setCellValue('AS1', 'PU POIN');
        // $sheet->setCellValue('AO1', 'STATUS INVOICE');

        // new sheet VOID
        $spreadsheet->createSheet();
        // $spreadsheet->getActiveSheet();
        $sheet2 =  $spreadsheet->setActiveSheetIndex(1)->setTitle("VOID SHIPMENT");
        $sheet2->setCellValue('A1', 'NO');
        $sheet2->setCellValue('B1', 'TGL');
        $sheet2->setCellValue('C1', 'NO STP');
        $sheet2->setCellValue('D1', 'CUSTOMER');
        $sheet2->setCellValue('E1', 'CONSIGNEE');
        $sheet2->setCellValue('F1', 'DEST');
        $sheet2->setCellValue('G1', 'SERVICE');
        $sheet2->setCellValue('H1', 'COMM');
        $sheet2->setCellValue('I1', 'PETUGAS PICKUP/ANTAR');
        $sheet2->setCellValue('J1', 'NO FLIGHT');
        $sheet2->setCellValue('K1', 'NO SMU');
        $sheet2->setCellValue('L1', 'COLLY');
        $sheet2->setCellValue('M1', 'BERAT JS');
        $sheet2->setCellValue('N1', 'BERAT MSR');
        $sheet2->setCellValue('O1', 'ALASAN DIVOID');

        $no = 1;
        $x = 2;
        $freight_kg = 0;
        $disc = 0;
        $ra = 0;
        $packing = 0;
        foreach ($shipments as $row) {
            $sales = $this->cs->getSales($row['id_so'])->row_array();
            $puPoin = $this->cs->getPuPoin($row['id_so'])->row_array();
            $get_do = $this->db->select('no_do,no_so, berat, koli')->get_where('tbl_no_do', ['shipment_id' => $row['shipment_id']])->result_array();
            $jumlah = $this->db->select('no_do')->get_where('tbl_no_do', ['shipment_id' => $row['shipment_id']])->num_rows();
            $no_invoice = $row['no_invoice'];
            $status_invoice = '';
            $tgl_bayar_invoice = '';

            if ($no_invoice == NULL) {
                $no_invoice = 'Belum Dibuat Invoice';
                $status_invoice = '-';
            } else {
                $no_invoice = $no_invoice;
                if ($row['status_invoice'] == 0) {
                    $status_invoice = 'Proforma Invoice';
                } elseif ($row['status_invoice'] == 1) {
                    $status_invoice = 'Pending Payment';
                } elseif ($row['status_invoice'] == 2) {
                    $status_invoice = 'Paid';
                } else {
                    $status_invoice = 'Unpaid';
                }
            }
            // kalo dia udah bayar invoice

            if ($row['status_invoice'] == 2) {
                $tgl_bayar_invoice = bulan_indo($row['payment_date']);
            }
            $tgl1 = strtotime($row['payment_date']);
            $tgl2 = strtotime($row['due_date']);

            $jarak = $tgl1 - $tgl2;

            if ($row['payment_date'] == NULL) {
                $perbedaan = '';
            } else {
                $perbedaan = $jarak / 60 / 60 / 24;
            }

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
            $sheet->setCellValue('AN' . $x, $no_invoice . '/' . $status_invoice)->getColumnDimension('AN')
                ->setAutoSize(true);
            $sheet->setCellValue('AO' . $x, $tgl_bayar_invoice)->getColumnDimension('AO')
                ->setAutoSize(true);
            $sheet->setCellValue('AP' . $x, bulan_indo($row['date']))->getColumnDimension('AP')
                ->setAutoSize(true);
            $sheet->setCellValue('AQ' . $x, bulan_indo($row['due_date']))->getColumnDimension('AQ')
                ->setAutoSize(true);
            $sheet->setCellValue('AR' . $x, $perbedaan)->getColumnDimension('AR')
                ->setAutoSize(true);
            $sheet->setCellValue('AS' . $x, $puPoin['pu_poin'])->getColumnDimension('AS')
                ->setAutoSize(true);

            // $sheet->setCellValue('A0' . $x, $status_invoice)->getColumnDimension('AO')
            //     ->setAutoSize(true);
            $x++;
            $no++;
        }
        $no2 = 1;
        $x2 = 2;
        foreach ($shipments_void as $row) {
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


            $sheet2->setCellValue('A' . $x2, $no2)->getColumnDimension('A')
                ->setAutoSize(true);
            $sheet2->setCellValue('B' . $x2, $row['tgl_pickup'])->getColumnDimension('B')
                ->setAutoSize(true);
            $sheet2->setCellValue('C' . $x2, $row['shipment_id'] . '/' . $row['no_stp'])->getColumnDimension('C')
                ->setAutoSize(true);
            $sheet2->setCellValue('D' . $x2, $row['shipper'])->getColumnDimension('D')
                ->setAutoSize(true);
            $sheet2->setCellValue('E' . $x2, $row['consigne'])->getColumnDimension('E')
                ->setAutoSize(true);
            $sheet2->setCellValue('F' . $x2, $row['tree_consignee'] . '/' . $row['city_consigne'])->getColumnDimension('F')
                ->setAutoSize(true);
            $sheet2->setCellValue('G' . $x2, $row['service_name'])->getColumnDimension('G')
                ->setAutoSize(true);
            $sheet2->setCellValue('H' . $x2, $row['pu_commodity'] . '/' . $no_do . '-' . $no_so)->getColumnDimension('H')
                ->setAutoSize(true);
            $sheet2->setCellValue('I' . $x2, $row['nama_user'])->getColumnDimension('I')
                ->setAutoSize(true);
            $sheet2->setCellValue('J' . $x2, $row['no_flight'])->getColumnDimension('J')
                ->setAutoSize(true);
            $sheet2->setCellValue('K' . $x2, $row['no_smu'])->getColumnDimension('K')
                ->setAutoSize(true);
            $sheet2->setCellValue('L' . $x2, $row['koli'])->getColumnDimension('L')
                ->setAutoSize(true);
            $sheet2->setCellValue('M' . $x2, $row['berat_js']);
            $sheet2->setCellValue('N' . $x2, $row['berat_msr'])->getColumnDimension('N')
                ->setAutoSize(true);
            $sheet2->setCellValue('O' . $x2, $row['reason_delete'])->getColumnDimension('N')
                ->setAutoSize(true);

            $x2++;
            $no2++;
        }


        $filename = "report order";

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
    public function ExportSoa()
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;Filename=export-soa.xls");
        $data['title'] = "SOA";
        $data['proforma'] = $this->cs->getSoa()->result_array();
        $this->load->view('finance/export_soa', $data);
    }

    public function printProformaFull($awal = NULL, $akhir = NULL)
    {
        $data['ap'] = $this->ap->getApPaid($awal, $akhir)->result_array();

        $this->load->view('superadmin/v_cetak_ap_pdf', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("legal", 'potrait');
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        // $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("report_ap_$awal - $akhir.pdf", array('Attachment' => 0));
    }

    public function ExportApExcell($awal = NULL, $akhir = NULL)
    {
        $ap = $this->ap->getApPaid($awal, $akhir)->result_array();
        // var_dump($ap);
        // die;
        $title = "REPORT AP $awal - $akhir";

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', $title)->mergeCells('A1:F1')->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'NO AP');
        $sheet->setCellValue('C2', 'REQUEST BY');
        $sheet->setCellValue('D2', 'DATE');
        $sheet->setCellValue('E2', 'AMOUNT PROPOSED');
        $sheet->setCellValue('F2', 'AMOUNT APPROVED');
        $sheet->setCellValue('G2', 'ATTACHMENT');
        $link_style_array = [
            'font'  => [
                'color' => ['rgb' => '0000FF'],
                'underline' => 'single'
            ]
        ];

        $no = 1;
        $x = 3;
        $total_amount = 0;
        foreach ($ap as $row) {
            $url = "<a href='https://jobsheet.transtama.com/uploads/ap_proof/$row[payment_proof]'>View Proof Of Payment</a>";

            $sheet->setCellValue('A' . $x, $no)->getColumnDimension('A')
                ->setAutoSize(true);
            $sheet->setCellValue('B' . $x, $row['no_pengeluaran'])->getColumnDimension('B')
                ->setAutoSize(true);
            $sheet->setCellValue('C' . $x, $row['nama_user'])->getColumnDimension('C')
                ->setAutoSize(true);
            $sheet->setCellValue('D' . $x, bulan_indo($row['date']))->getColumnDimension('D')
                ->setAutoSize(true);
            if ($row['amount_proposed'] != 0) {
                $sheet->getStyle("E" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('E' . $x, $row['amount_proposed'])->getColumnDimension('E')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('E' . $x, $row['amount_proposed'])->getColumnDimension('E')
                    ->setAutoSize(true);
            }
            if ($row['amount_approved'] != 0) {
                $sheet->getStyle("F" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('F' . $x, $row['amount_approved'])->getColumnDimension('F')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('F' . $x, $row['amount_approved'])->getColumnDimension('F')
                    ->setAutoSize(true);
            }
            $sheet->setCellValue('G' . $x,  '=HYPERLINK("https://jobsheet.transtama.com/uploads/ap_proof/' . $row['payment_proof'] . '","' . 'View Proof Payment' . '")')->getColumnDimension('G')
                ->setAutoSize(true);
            $sheet->getStyle('G' . $x)->applyFromArray($link_style_array);
            $x++;
            $no++;
            $total_amount = $total_amount + $row['amount_approved'];
        }
        // ppn
        $total = $x + 1;

        $rowspan = 'A' . $total . ':E' . $total;
        $sheet->setCellValue('A' . $total, 'TOTAL')->mergeCells($rowspan)->getStyle('A' . $total)->getAlignment()->setHorizontal('right');

        $sheet->setCellValue('F' . $total, rupiah($total_amount));


        $filename = "Report AP $awal - $akhir";

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

    public function ExportApExternalExcell($awal = NULL, $akhir = NULL)
    {
        $proforma = $this->cs->getApVendorByDate($awal, $akhir)->result_array();

        $title = "REPORT AP EXTERNAL $awal - $akhir";

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', $title)->mergeCells('A1:F1')->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'VENDOR/AGENT');
        $sheet->setCellValue('C2', 'NO. INVOICE');
        $sheet->setCellValue('D2', 'DATE');
        $sheet->setCellValue('E2', 'INVOICE');
        $sheet->setCellValue('F2', 'PPN');
        $sheet->setCellValue('G2', 'PPH');
        $sheet->setCellValue('H2', 'TOTAL INVOICE');
        $sheet->setCellValue('I2', 'ATTACHMENT');
        $link_style_array = [
            'font'  => [
                'color' => ['rgb' => '0000FF'],
                'underline' => 'single'
            ]
        ];

        $no = 1;
        $x = 3;
        $total_invoice_all = 0;
        $total_ppn = 0;
        $total_pph = 0;
        $total_ap = 0;
        foreach ($proforma as $row) {
            $total_invoice = ($row['total_ap']) + $row['pph'] + $row['ppn'];
            $sheet->setCellValue('A' . $x, $no)->getColumnDimension('A')
                ->setAutoSize(true);
            $sheet->setCellValue('B' . $x, $row['vendor'])->getColumnDimension('B')
                ->setAutoSize(true);
            $sheet->setCellValue('C' . $x, $row['no_invoice'])->getColumnDimension('C')
                ->setAutoSize(true);
            $sheet->setCellValue('D' . $x, bulan_indo($row['date']))->getColumnDimension('D')
                ->setAutoSize(true);
            if ($row['total_ap'] != 0) {
                $sheet->getStyle("E" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('E' . $x, $row['total_ap'])->getColumnDimension('E')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('E' . $x, $row['total_ap'])->getColumnDimension('E')
                    ->setAutoSize(true);
            }
            if ($row['ppn'] != 0) {
                $sheet->getStyle("F" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('F' . $x, $row['ppn'])->getColumnDimension('F')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('F' . $x, $row['ppn'])->getColumnDimension('F')
                    ->setAutoSize(true);
            }
            if ($row['pph'] != 0) {
                $sheet->getStyle("G" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('G' . $x, $row['pph'])->getColumnDimension('G')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('G' . $x, $row['pph'])->getColumnDimension('G')
                    ->setAutoSize(true);
            }
            if ($total_invoice != 0) {
                $sheet->getStyle("H" . $x)->getNumberFormat()->setFormatCode("(\"Rp.\"* #,##0);(\"Rp.\"* \(#,##0\);(\"$\"* \"-\"??);(@_)");
                $sheet->setCellValue('H' . $x, $total_invoice)->getColumnDimension('H')
                    ->setAutoSize(true);
            } else {
                $sheet->setCellValue('H' . $x, $total_invoice)->getColumnDimension('H')
                    ->setAutoSize(true);
            }
            $sheet->setCellValue('I' . $x,  '=HYPERLINK("https://jobsheet.transtama.com/uploads/ap_proof/' . $row['bukti_bayar'] . '","' . 'View Proof Payment' . '")')->getColumnDimension('G')
                ->setAutoSize(true);
            $sheet->getStyle('I' . $x)->applyFromArray($link_style_array);
            $x++;
            $no++;
            $total_invoice_all = $total_invoice_all + $row['total_ap'];
            $total_ppn = $total_ppn + $row['ppn'];
            $total_pph = $total_pph + $row['pph'];
            $total_ap = $total_ap + $total_invoice;
        }
        // ppn
        $total = $x + 1;

        $rowspan = 'A' . $total . ':D' . $total;
        $sheet->setCellValue('A' . $total, 'TOTAL')->mergeCells($rowspan)->getStyle('A' . $total)->getAlignment()->setHorizontal('right');

        $sheet->setCellValue('E' . $total, rupiah($total_invoice_all));
        $sheet->setCellValue('F' . $total, rupiah($total_ppn));
        $sheet->setCellValue('G' . $total, rupiah($total_pph));
        $sheet->setCellValue('H' . $total, rupiah($total_ap));


        $filename = "Report AP External $awal - $akhir";

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
