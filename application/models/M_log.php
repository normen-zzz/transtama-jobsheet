<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model
{
    public function save_log($param)
    {
        $sql        = $this->db->insert_string('tb_log_login', $param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }
    public function update_log($id, $param)
    {
        $sql        = $this->db->update('tb_log_login', $param, ['id_log' => $id]);
        return $sql;
    }

    public function save_log_aktifitas($param)
    {
        $sql        = $this->db->insert_string('tb_log_aktifitas', $param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }
    public function getAktivitas()
    {
        $this->db->select('a.*, b.nama_user, b.email,c.nama_role');
        $this->db->from('tb_log_aktifitas a');
        $this->db->join('tb_user b', 'a.id_user=b.id_user');
        $this->db->join('tb_role c', 'c.id_role=b.id_role');
        $query = $this->db->get();
        return $query;
    }
}
