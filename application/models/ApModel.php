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

    public function getApByCategory($id_kategori)
    {

        $ignore = array(4, 0, 1);

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
