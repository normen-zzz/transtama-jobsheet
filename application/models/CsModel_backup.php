<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CsModel extends M_Datatables
{
	function getJs2()
	{
		$query  = "SELECT * FROM tbl_shp_order";
		$search = array('so_id', 'shipper', 'shipment_id', 'consigne');
		// $where  = null;
		$where  = array('status' => 0);
		// jika memakai IS NULL pada where sql
		$isWhere = null;
		// $isWhere = 'artikel.deleted_at IS NULL';
		header('Content-Type: application/json');
		$query = $this->M_Datatables->get_tables_query($query, $search, $where, $isWhere);
		return $query;
	}
	function getJs()
	{
		$this->db->select('a.tgl_pickup, b.*, c.nama_user');
		$this->db->from('tbl_so a');
		$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
		$this->db->join('tb_user c', 'a.id_sales=c.id_user');
		$this->db->order_by('b.tgl_pickup', 'ASC');
		$this->db->where('b.status_so', 1);
		$query = $this->db->get();
		return $query;
	}
	function getAll($customer = NULL)
	{
		if ($customer == NULL) {
			$this->db->select('a.tgl_pickup, b.*, c.nama_user,d.service_name');
			$this->db->from('tbl_so a');
			$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
			$this->db->join('tb_user c', 'a.id_sales=c.id_user');
			$this->db->join('tb_service_type d', 'b.service_type=d.code');
			$this->db->order_by('b.tgl_pickup', 'ASC');
			$this->db->where('b.status_so >=', 1);
			$this->db->where('b.status_so <=', 3);
			$query = $this->db->get();
			return $query;
		} else {
			$this->db->select('a.tgl_pickup, b.*, c.nama_user,d.service_name');
			$this->db->from('tbl_so a');
			$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
			$this->db->join('tb_user c', 'a.id_sales=c.id_user');
			$this->db->join('tb_service_type d', 'b.service_type=d.code');
			$this->db->order_by('b.tgl_pickup', 'ASC');
			$this->db->where('b.shipper', $customer);
			$this->db->where('b.status_so >=', 1);
			$this->db->where('b.status_so <=', 3);
			$query = $this->db->get();
			return $query;
		}
	}
	function getJsApproveCs()
	{
		$this->db->select('a.tgl_pickup, b.*, c.nama_user');
		$this->db->from('tbl_so a');
		$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
		$this->db->join('tb_user c', 'a.id_sales=c.id_user');
		$this->db->order_by('b.tgl_pickup', 'ASC');
		$this->db->where('b.status_so >=', 2);
		// $this->db->order('b.id', 'DESC');
		$query = $this->db->get();
		return $query;
	}
	function getJsApproveMgrCs()
	{
		$this->db->select('a.tgl_pickup, b.*, c.nama_user');
		$this->db->from('tbl_so a');
		$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
		$this->db->join('tb_user c', 'a.id_sales=c.id_user');
		$this->db->order_by('b.tgl_pickup', 'ASC');
		$this->db->where('b.status_so', 3);
		$query = $this->db->get();
		return $query;
	}
	function getJsApproveFinance()
	{
		$this->db->select('a.tgl_pickup, b.*, c.nama_user');
		$this->db->from('tbl_so a');
		$this->db->join('tbl_shp_order b', 'a.id_so=b.id_so');
		$this->db->join('tb_user c', 'a.id_sales=c.id_user');
		$this->db->order_by('b.tgl_pickup', 'ASC');
		$this->db->where('b.status_so >=', 4);
		$query = $this->db->get();
		return $query;
	}
	function getDetailSo($id)
	{
		$this->db->select('a.*, b.service_name, c.nama_user');
		$this->db->from('tbl_shp_order a');
		$this->db->join('tb_service_type b', 'a.service_type=b.code');
		$this->db->join('tbl_so d', 'a.id_so=d.id_so');
		$this->db->join('tb_user c', 'd.id_sales=c.id_user');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		return $query;
	}
	function getRevisiJs()
	{
		$this->db->select('a.*, b.created_at as tgl_pengajuan, b.status as status_pengajuan, b.id_request, c.nama_user');
		$this->db->from('tbl_shp_order a');
		$this->db->join('tbl_request_revisi b', 'a.id=b.shipment_id');
		$this->db->join('tbl_so d', 'a.id_so=d.id_so');
		$this->db->join('tb_user c', 'd.id_sales=c.id_user');
		$query = $this->db->get();
		return $query;
	}
	function getNamaSales($id_so)
	{
		$this->db->select('b.nama_user, a.created_at, b.ttd');
		$this->db->from('tbl_so a');
		$this->db->join('tb_user b', 'a.id_sales=b.id_user');
		$this->db->where('a.id_so', $id_so);
		$query = $this->db->get();
		return $query;
	}
	function getNamaManagerSales($id_so)
	{
		$this->db->select('b.nama_user, b.ttd');
		$this->db->from('tbl_so a');
		$this->db->join('tb_user b', 'a.id_atasan_sales=b.id_user');
		$this->db->where('a.id_so', $id_so);
		$query = $this->db->get();
		return $query;
	}
	function getApproveSo($id)
	{
		$this->db->select('b.nama_user as pic_js,b.ttd as ttd_pic, c.nama_user as mgr_cs,c.ttd as ttd_mgr_cs, d.nama_user as finance,d.ttd as ttd_finance, a.created_at_cs, a.approve_mgr_cs_date, a.created_at_finance');
		$this->db->from('tbl_approve_so_cs a');
		$this->db->join('tb_user b', 'a.approve_cs=b.id_user');
		$this->db->join('tb_user c', 'a.approve_mgr_cs=c.id_user', 'LEFT');
		$this->db->join('tb_user d', 'a.approve_finance=d.id_user', 'LEFT');
		$this->db->where('a.shipment_id', $id);
		$query = $this->db->get();
		return $query;
	}
}
