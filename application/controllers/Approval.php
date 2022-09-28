<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sendwa', 'wa');
        $this->load->model('ApModel', 'ap');
        $this->load->model('CsModel', 'cs');
    }

    // ini untuk approval ap

    public function detail($no_ap)
    {
        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $this->load->view('v_detail_ap', $data);
    }
    public function detailFinance($no_ap)
    {
        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $this->load->view('v_detail_ap_finance', $data);
    }
    public function detailGm($no_ap)
    {
        $data['title'] = 'Detail Account Payable';
        $data['ap'] = $this->ap->getApByNo($no_ap)->result_array();
        $data['info'] = $this->ap->getApByNo($no_ap)->row_array();
        $data['kategori_ap'] = $this->db->get('tbl_kat_ap')->result_array();
        $data['kategori_pengeluaran'] = $this->db->get('tbl_list_pengeluaran')->result_array();
        $this->load->view('v_detail_ap_gm', $data);
    }


    // ap approval sam
    public function ap($no_pengeluaran)
    {
        $where = array('no_pengeluaran' => $no_pengeluaran);
        $cek_data = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
        if ($cek_data) {
            $data = array(
                'no_pengeluaran' => $no_pengeluaran,
                'approve_by_sm' => $this->session->userdata('id_user'),
                'created_sm' => date('Y-m-d H:i:s'),
            );
            $update = $this->db->update('tbl_approve_pengeluaran', $data, $where);
            if ($update) {
                $get_ap = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
                $no_ap = $get_ap['no_pengeluaran'];
                $purpose = $get_ap['purpose'];
                $date = $get_ap['date'];
                $pesan = "Hallo Finance, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date*. Tolong Segera Cek Ya, Terima Kasih";
                // no finance
                // $this->wa->pickup('+6285157906966', "$pesan");
                $this->wa->pickup('+6289629096425', "$pesan");
                $this->wa->pickup('+6287771116286', "$pesan");
                echo "<script>alert('Success Approve')</script>";
                echo "<script>window.close();</script>";
            } else {
                echo "<script>alert('Failed Approve')</script>";
                echo "<script>window.close();</script>";
            }
        } else {
            echo "<script>alert('Failed Approve, No Data Selected')</script>";
            echo "<script>window.close();</script>";
        }
    }

    public function approveFinance($no_ap)
    {
        $where = array('no_pengeluaran' => $no_ap);
        $cek_data = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
        if ($cek_data) {
            $data_status = array(
                'status' => 7,
            );
            $data_approve = array(
                'approve_mgr_finance' => $this->session->userdata('id_user'),
                'created_mgr_finance' =>  date('Y-m-d H:i:s')
            );

            $this->db->update('tbl_approve_pengeluaran', $data_approve, ['no_pengeluaran' => $no_ap]);
            $this->db->update('tbl_pengeluaran', $data_status, ['no_pengeluaran' => $no_ap]);
            // kirim WA

            $get_ap = $this->db->get_where('tbl_pengeluaran', ['no_pengeluaran' => $no_ap])->row_array();
            $no_ap = $get_ap['no_pengeluaran'];
            $purpose = $get_ap['purpose'];
            $date = $get_ap['date'];
            $link = "https://jobsheet.transtama.com/approval/detailGm/$no_ap";
            // $link = "http://jobsheet.test/approval/ap/$no_ap";
            // echo "<li><a href='whatsapp://send?text=$actual_link'>Share</a></li>";
            $pesan = "Hallo, ada pengajuan Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date* Yang Telah Diapprove Manager Finance. Silahkan approve melalui link berikut : $link . Terima Kasih";
            // no mba vema
            $this->wa->pickup('+628111910711', "$pesan");

            echo "<script>alert('Success Approve')</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert('Failed Approve, No Data Selected')</script>";
            echo "<script>window.close();</script>";
        }
    }

    public function approveGm($no_pengeluaran)
    {
        $where = array('no_pengeluaran' => $no_pengeluaran);
        $cek_data = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
        if ($cek_data) {
            $data = array(
                'approve_by_gm' => $this->session->userdata('id_user'),
                'created_gm' => date('Y-m-d H:i:s'),
            );
            $update = $this->db->update('tbl_approve_pengeluaran', $data, $where);
            if ($update) {
                $this->db->update('tbl_pengeluaran', ['status' => 5], $where);

                $get_ap = $this->db->get_where('tbl_pengeluaran', $where)->row_array();
                $no_ap = $get_ap['no_pengeluaran'];
                $purpose = $get_ap['purpose'];
                $date = $get_ap['date'];
                $pesan = "Ap No. *$no_ap* Dengan Tujuan *$purpose* Tanggal *$date* Sudah di Approve GM. Tolong Segera Bayar Ya, Terima Kasih";
                // no finance
                // $this->wa->pickup('+6285157906966', "$pesan");
                $this->wa->pickup('+6289629096425', "$pesan");
                $this->wa->pickup('+6287771116286', "$pesan");

                echo "<script>alert('Success Approve')</script>";
                echo "<script>window.close();</script>";
            } else {
                echo "<script>alert('Failed Approve, No Data Selected')</script>";
                echo "<script>window.close();</script>";
            }
        } else {
            echo "<script>alert('Failed Approve, No Data Selected')</script>";
            echo "<script>window.close();</script>";
        }
    }


    // ini untuk approval revisi so
    public function detailRevisiGm($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        $data['request'] = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
        $data['request_revisi'] = $this->db->get_where('tbl_request_revisi', ['shipment_id' => $id])->row_array();
        $data['so_lama'] = $this->db->get_where('tbl_revisi_so_lama', ['shipment_id' => $id])->row_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $this->load->view('v_detail_revisi_gm', $data);
    }
    public function detailRevisiSm($id)
    {
        $data['subtitle'] = 'Detail Sales Order';
        $data['title'] = 'Detail Sales Order';
        $data['msr'] = $this->cs->getDetailSo($id)->row_array();
        $data['request'] = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
        $data['request_revisi'] = $this->db->get_where('tbl_request_revisi', ['shipment_id' => $id])->row_array();
        $data['so_lama'] = $this->db->get_where('tbl_revisi_so_lama', ['shipment_id' => $id])->row_array();
        $data['modal'] = $this->db->get_where('tbl_modal', ['shipment_id' => $id])->result_array();
        $this->load->view('v_detail_revisi_sm', $data);
    }

    // approve ka GM

    public function approveRevisiGm($id)
    {
        $data = array(
            'status_revisi' => 3,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_gm' => 14,
                'tgl_approve_gm' => date('Y-m-d H:i:s'),
                'status_approve_gm' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            $link = "https://jobsheet.transtama.com/approval/detailRevisiSm/$id";

            $pesan = "Hallo, Mohon Untuk dicek dan di Approve Pengajuan Revisi SO Melalu Link Berikut : $link";
            // no sam
            // $this->wa->pickup('+628111910711', "$pesan");
            $this->wa->pickup('+6285157906966', "$pesan");

            echo "<script>alert('Success Approve')</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert('Failed Approve')</script>";
            echo "<script>window.close();</script>";
        }
    }
    public function declineRevisiGm($id)
    {
        $data = array(
            'status_revisi' => 6,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_user_gm' => 14,
                'tgl_approve_gm' => date('Y-m-d H:i:s'),
                'status_approve_gm' => 0
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            echo "<script>alert('Success Decline')</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert('Failed Decline')</script>";
            echo "<script>window.close();</script>";
        }
    }

    // APPROVE SM
    public function approveRevisiSm($id)
    {
        $data = array(
            'status_revisi' => 7,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $get_new_so = $this->db->get_where('tbl_revisi_so', ['shipment_id' => $id])->row_array();
            $get_old_so = $this->db->get_where('tbl_shp_order', ['id' => $id])->row_array();
            $data = array(
                'freight_kg' => $get_new_so['freight_baru'],
                'packing' => $get_new_so['packing_baru'],
                'special_freight' => $get_new_so['special_freight_baru'],
                'others' => $get_new_so['others_baru'],
                'surcharge' => $get_new_so['surcharge_baru'],
                'insurance' => $get_new_so['insurance_baru'],
                'disc' => $get_new_so['disc_baru'],
                'cn' => $get_new_so['cn_baru'],
            );
            $this->db->update('tbl_shp_order', $data, ['id' => $id]);
            $data = array(
                'freight_lama' => $get_old_so['freight_kg'],
                'packing_lama' => $get_old_so['packing'],
                'special_freight_lama' => $get_old_so['special_freight'],
                'others_lama' => $get_old_so['others'],
                'surcharge_lama' => $get_old_so['surcharge'],
                'insurance_lama' => $get_old_so['insurance'],
                'disc_lama' => $get_old_so['disc'],
                'cn_lama' => $get_old_so['cn'],
                'shipment_id' => $id,
            );
            $this->db->insert('tbl_revisi_so_lama', $data);
            $data = array(
                'id_sm' => 32,
                'tgl_approve_sm' => date('Y-m-d H:i:s'),
                'status_approve_sm' => 1
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);

            echo "<script>alert('Success Approve')</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert('Failed Decline')</script>";
            echo "<script>window.close();</script>";
        }
    }
    public function declineRevisiSm($id)
    {
        $data = array(
            'status_revisi' => 8,
        );
        $update = $this->db->update('tbl_revisi_so', $data, ['shipment_id' => $id]);
        if ($update) {
            $data = array(
                'id_sm' => 32,
                'tgl_approve_sm' => date('Y-m-d H:i:s'),
                'status_approve_sm' => 0
            );
            $this->db->update('tbl_approve_revisi_so', $data, ['shipment_id' => $id]);
            echo "<script>alert('Success Decline')</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert('Failed Decline')</script>";
            echo "<script>window.close();</script>";
        }
    }
}
