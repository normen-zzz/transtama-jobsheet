<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ChatModel extends CI_Model
{

    public function login()
    {
    }
    public function GetPesan($id_user, $id_lawan)
    {
        $this->db->select('a.*, b.status_login');
        $this->db->from('pesan a');
        $this->db->join('tb_user b', 'b.id_user = a.id_lawan');
        $this->db->where('a.id_user = ' . $id_user . ' 
        and a.id_lawan =' . $id_lawan . ' 
        or a.id_user = ' . $id_lawan . ' 
        and a.id_lawan =' . $id_user);

        // $r = $this->db->get()->result();

        return $r = $this->db->get()->result();

        # code...
    }
    public function GetPesanBelumDibaca($id_user)
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->where('id_lawan = ' . $id_user . ' 
        and status = 0');
        return $r = $this->db->get();
    }
    public function TambahChatKeSatu($in)
    {
        $this->db->insert('pesan', $in);

        # code...
    }
    public function getData($u, $p)
    {
        $this->db->from('tb_user');
        $this->db->where('username', $u);
        $this->db->where('password', $p);
        return $sql = $this->db->get()->row();
        # code...
    }
    public function getDataOnly($u)
    {
        $this->db->from('tb_user');
        $this->db->where('username', $u);
        return $sql = $this->db->get()->row();
        # code...
    }
    public function getDataById($no)
    {

        $this->db->select('*');
        $this->db->from('tb_user a');
        $this->db->join('pesan b', 'a.id_user = b.id_user');
        $this->db->where('a.id_user', $no);
        return $sql = $this->db->get()->row();
        # code...
    }
    public function GetAllOrangKecUser($id_user)
    {
        $this->db->select('b.nama_user, b.status_login, a.id_lawan, a.id_user, COUNT(a.id_user) as total');
        $this->db->from('pesan a');
        $this->db->where('a.id_lawan', $id_user);
        $this->db->join('tb_user b', 'b.id_user = a.id_user');
        $this->db->group_by('a.id_user');
        $this->db->where('a.status', 0);
        return $sql = $this->db->get()->result();
        # code...
    }

    public function GetOrangKecUser($id_user)
    {
        $this->db->from('tb_user');
        $this->db->where('id_user!=', $id_user);
        return $sql = $this->db->get()->result();
    }

    public function CariOrangKecUser($id_user, $nama_user)
    {

        $this->db->from('tb_user');
        $this->db->like('nama_user', $nama_user);
        $this->db->where('id_user!=', $id_user);
        return $sql = $this->db->get()->result();
        # code...
    }
    public function Tambah($tabel, $in)
    {
        $this->db->insert($tabel, $in);
    }
}
                        
/* End of file ChatModel.php */
