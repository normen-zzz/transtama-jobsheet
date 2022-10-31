<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApModel extends CI_Model
{

    public function getMyAp($id_user = NULL)
    {
        if ($id_user == NULL) {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.status>=', 1);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.id_user', $id_user);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
    public function getMyApCs($id_user = NULL)
    {
        if ($id_user == NULL) {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.status>=', 1);
            $this->db->where('a.is_approve_sm', 1);
            $this->db->where('a.status!=', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.id_user', $id_user);
            $this->db->where('a.status!=', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
    public function getMyApCsHistory($id_user = NULL)
    {
        if ($id_user == NULL) {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.status>=', 1);
            $this->db->where('a.is_approve_sm', 1);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.id_user', $id_user);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
    public function getApByNo($no_ap)
    {

        $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran');
        $this->db->from('tbl_pengeluaran a');
        $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
        $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
        $this->db->where('a.no_pengeluaran', $no_ap);
        return $this->db->get();
    }
    public function getMyApAtasan($id_atasan)
    {
        $this->db->select('a.*, b.nama_kategori, c.nama_user');
        $this->db->from('tbl_pengeluaran a');
        $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
        $this->db->join('tb_user c', 'a.id_user=c.id_user');
        $this->db->where('a.id_atasan', $id_atasan);
        $this->db->or_where('a.id_user', $id_atasan);
        $this->db->group_by('a.no_pengeluaran');
        $this->db->order_by('a.id_pengeluaran', 'DESC');
        return $this->db->get();
    }

    public function getModalJoinShp($bulan, $tahun)
    {
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('a.*, b.*,b.shipment_id AS kode,e.*');
            $this->db->from('tbl_modal a');
            $this->db->join('tbl_shp_order b', 'a.shipment_id=b.id');
            $this->db->join('tbl_so d', 'b.id_so=d.id_so');
            $this->db->join('tb_user c', 'd.id_sales=c.id_user');
            $this->db->join('tb_service_type e', 'b.service_type=e.code');
            $this->db->where('b.deleted', 0);
            $this->db->group_by('a.shipment_id');
            $this->db->order_by('a.shipment_id', 'ASC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.*,b.shipment_id AS kode,e.*');
            $this->db->from('tbl_modal a');
            $this->db->join('tbl_shp_order b', 'a.shipment_id=b.id');
            $this->db->join('tbl_so d', 'b.id_so=d.id_so');
            $this->db->join('tb_user c', 'd.id_sales=c.id_user');
            $this->db->join('tb_service_type e', 'b.service_type=e.code');
            $this->db->where('b.deleted', 0);
            $this->db->where('MONTH(b.tgl_pickup)', $bulan);
            $this->db->where('YEAR(b.tgl_pickup)', $tahun);
            $this->db->group_by('a.shipment_id');
            $this->db->order_by('a.shipment_id', 'ASC');
            return $this->db->get();
        }
    }

    public function getAdjust($bagian, $bulan, $tahun)
    {
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('*');
            $this->db->from('tbl_real');
            $this->db->where('bagian', $bagian);
            $this->db->order_by('id_real', 'ASC');
            return $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from('tbl_real');
            $this->db->where('MONTH(date)', $bulan);
            $this->db->where('YEAR(date)', $tahun);
            $this->db->where('bagian', $bagian);
            $this->db->order_by('id_real', 'ASC');
            return $this->db->get();
        }
    }

    public function getApByCategory($id_kategori)
    {

        $ignore = array(0, 1);

        $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
        $this->db->from('tbl_pengeluaran a');
        $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
        $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
        $this->db->join('tb_user d', 'a.id_user=d.id_user');
        $this->db->where('a.id_kat_ap', $id_kategori);
        $this->db->where_not_in('a.status', $ignore);
        // $this->db->where('a.status>=', 2);
        $this->db->group_by('a.no_pengeluaran');
        $this->db->order_by('a.id_pengeluaran', 'DESC');
        return $this->db->get();
    }

    public function getApByListReport($id_kategori, $bulan, $tahun)
    {

        $ignore = array(6, 0,);
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where('a.id_kategori_pengeluaran', $id_kategori);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where('a.id_kategori_pengeluaran', $id_kategori);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->where('MONTH(a.date)', $bulan);
            $this->db->where('YEAR(a.date)', $tahun);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }

    public function getApByOverhead($bulan, $tahun)
    {

        $listOverhead = array(1, 14, 2, 22, 26);
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where_in('a.id_kategori_pengeluaran', $listOverhead);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where_in('a.id_kategori_pengeluaran', $listOverhead);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->where('MONTH(a.date)', $bulan);
            $this->db->where('YEAR(a.date)', $tahun);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }

    public function getApByAmExp($bulan, $tahun)
    {

        $listNotIn = array(22, 26, 14, 1, 2);
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where_not_in('a.id_kategori_pengeluaran', $listNotIn);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            $this->db->where_not_in('a.id_kategori_pengeluaran', $listNotIn);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->where('MONTH(a.date)', $bulan);
            $this->db->where('YEAR(a.date)', $tahun);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
    public function getAllApReport($bulan, $tahun)
    {

        $ignore = array(6, 0,);
        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            // $this->db->where('a.id_kategori_pengeluaran', $id_kategori);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
            $this->db->join('tb_user d', 'a.id_user=d.id_user');
            // $this->db->where('a.id_kategori_pengeluaran', $id_kategori);
            // $this->db->where_not_in('a.status', $ignore);
            $this->db->where('a.status', 4);
            $this->db->where('MONTH(a.date)', $bulan);
            $this->db->where('YEAR(a.date)', $tahun);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
    //AP External Report Profit Loss
    public function getApExternal($bulan, $tahun)
    {

        if ($bulan == NULL && $tahun == NULL) {
            $this->db->select('*');
            $this->db->from('tbl_invoice_ap_final');
            $this->db->where('status', 4);
            $this->db->group_by('no_invoice');
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from('tbl_invoice_ap_final');
            $this->db->where('status', 4);
            $this->db->where('MONTH(date)', $bulan);
            $this->db->where('YEAR(date)', $tahun);
            $this->db->group_by('no_invoice');
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get();
        }
    }
    public function getHistoryApByCategory($id_kategori)
    {

        $ignore = array(0, 1);

        $this->db->select('a.*, b.nama_kategori, b.keterangan,c.nama_kategori_pengeluaran, d.nama_user');
        $this->db->from('tbl_pengeluaran a');
        $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
        $this->db->join('tbl_list_pengeluaran c', 'a.id_kategori_pengeluaran=c.id_kategori');
        $this->db->join('tb_user d', 'a.id_user=d.id_user');
        $this->db->where('a.id_kat_ap', $id_kategori);
        $this->db->where_not_in('a.status', $ignore);
        $this->db->where('a.status', 4);
        $this->db->group_by('a.no_pengeluaran');
        $this->db->order_by('a.id_pengeluaran', 'DESC');
        return $this->db->get();
    }
    public function getApByCategoryStatusSm($id_kategori)
    {

        $this->db->select('a.*');
        $this->db->from('tbl_pengeluaran a');
        $this->db->where('a.id_kat_ap', $id_kategori);
        $this->db->where('a.status', 2);
        // $this->db->or_where('a.status', 5);
        $this->db->group_by('a.no_pengeluaran');
        return $this->db->get();
    }
    public function getApByCategoryStatusFinance($id_kategori)
    {
        $this->db->select('a.*');
        $this->db->from('tbl_pengeluaran a');
        $this->db->where('a.id_kat_ap', $id_kategori);
        $this->db->where('a.status', 7);
        $this->db->group_by('a.no_pengeluaran');
        return $this->db->get();
    }
    public function getApPaid($awal = NULL, $akhir = NULL)
    {
        // var_dump($awal);
        // die;
        if ($awal == NULL && $akhir == NULL) {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.status', 4);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        } else {
            $this->db->select('a.*, b.nama_kategori, c.nama_user');
            $this->db->from('tbl_pengeluaran a');
            $this->db->join('tbl_kat_ap b', 'a.id_kat_ap=b.id_kategori_ap');
            $this->db->join('tb_user c', 'a.id_user=c.id_user');
            $this->db->where('a.status', 4);
            $this->db->where('a.date >=', $awal);
            $this->db->where('a.date <=',  $akhir);
            $this->db->group_by('a.no_pengeluaran');
            $this->db->order_by('a.id_pengeluaran', 'DESC');
            return $this->db->get();
        }
    }
}
