<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MataKuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('backofficeManagement');
        }

        $this->load->library('breadcrumb');
        $this->load->library('pagination');
        $this->load->model('M_matakuliah', 'matakuliah');
        cek_role();
    }

    public function index()
    {
        $breadcrumb_items = [
            'Matakuliah' => 'superadmin/matakuliah',
        ];
        $data['subtitle'] = 'Manajemen';
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $id_jurusan = $this->session->userdata('id_jurusan');
        $data['title'] = 'Mata  Kuliah';
        if ($id_jurusan) {
            $data['matakuliah'] = $this->matakuliah->getMatakuliahByProdi($id_jurusan)->result_array();
            // var_dump($data['matakuliah']);
            // die;
        } else {
            $total_rows = $this->db->get('tb_mata_kuliah')->num_rows();
            $config['base_url'] = base_url('akademik/MataKuliah/index');
            $config['total_rows'] = $total_rows;
            $config['per_page'] = 10;

            $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-circle pg-teal justify-content-end">';
            $config['full_tag_close'] = ' </ul></nav>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link"  href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);

            $data['title'] = 'Mata  Kuliah';
            $data['start'] = $this->uri->segment(4);
            // $data['matakuliah'] = $this->db->get('tb_mata_kuliah', $config['per_page'], $data['start'])->result_array();
            $data['matakuliah'] = $this->matakuliah->getMatakuliah($config['per_page'], $data['start'])->result_array();

            $data['kurikulum'] = $this->db->get('kurikulum')->result_array();
        }
        $this->backend->display('superadmin/v_matakuliah', $data);
    }

    public function addMatkul()
    {
        $data = array(
            'kode_mk' => $this->input->post('kode_mk'),
            'nama_mk' => $this->input->post('nama_mk'),
            'id_kurikulum' => $this->input->post('id_kurikulum'),
            'jns_mk' => $this->input->post('jns_mk'),
            'sks' => $this->input->post('sks'),
            'sks_tm' => $this->input->post('sks_tm'),
            'sks_prak' => $this->input->post('sks_prak'),
            'semester' => $this->input->post('semester'),
        );

        if ($this->db->insert('tb_mata_kuliah', $data)) {
            log_aktifitas('insert', 'tb_mata_kuliah');
            $dataflash = array(
                'title' => 'Data Matakuliah',
                'text' => 'Data Matakuliah Berhasil ditambahkan',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
        }

        redirect('superadmin/matakuliah');
    }

    public function delete($id)
    {
        $where = array('id_matakuliah' => $id);
        $delete = $this->db->delete('tb_mata_kuliah', $where);
        if ($delete) {
            log_aktifitas('delete', 'tb_mata_kuliah');
            $dataflash = array(
                'title' => 'Data Matakuliah',
                'text' => 'Data Matakuliah Berhasil dihapus',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/matakuliah');
        } else {
            $dataflash = array(
                'title' => 'Data Matakuliah',
                'text' => 'Data Matakuliah Gagal di update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/matakuliah');
        }
    }

    public function edit()
    {
        $where = array('id_matakuliah' => $this->input->post('id_matakuliah'));
        $data = array(
            'kode_mk' => $this->input->post('kode_mk'),
            'nama_mk' => $this->input->post('nama_mk'),
            'id_kurikulum' => $this->input->post('id_kurikulum'),
            'jns_mk' => $this->input->post('jns_mk'),
            'sks' => $this->input->post('sks'),
            'sks_tm' => $this->input->post('sks_tm'),
            'sks_prak' => $this->input->post('sks_prak'),
            'semester' => $this->input->post('semester'),
        );
        $update = $this->db->update('tb_mata_kuliah', $data, $where);
        if ($update) {
            log_aktifitas('update', 'tb_mata_kuliah');
            $dataflash = array(
                'title' => 'Data Matakuliah',
                'text' => 'Data Matakuliah Berhasil di Update',
                'type' => 'success',
                'icon'  => 'success',
                'confirmButtonColor' => '#0095cc',
                'confirmButtonText' => 'Oke',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/matakuliah');
        } else {
            $dataflash = array(
                'title' => 'Data Matakuliah',
                'text' => 'Data Matakuliah Gagal di Update',
                'type' => 'error',
                'icon'  => 'error',
                'confirmButtonColor' => '#ff562f',
                'confirmButtonText' => 'Close',
            );
            $this->session->set_flashdata('message', $dataflash);
            redirect('superadmin/matakuliah');
        }
    }


    public function Exportpdf($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            $data['title'] = "Export Matakuliah dari $start sampai $end ";
            $data['matakuliah'] = $this->matakuliah->exportMatakuliah()->result_array();
        } else {
            $data['title'] = "Export Matakuliah";
            $data['matakuliah'] = $this->matakuliah->exportMatakuliah()->result_array();
        }
        // $data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

        $this->load->view('akademik/v_export_matakuliah_pdf', $data);
        $html = $this->output->get_output();
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $sekarang = date("d:F:Y:h:m:s");
        $this->dompdf->stream("Cetak" . $sekarang . ".pdf", array('Attachment' => 0));
    }

    public function Exportexcel($start = null, $end = null)
    {
        if ($start != null && $end != null) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=export-matkul-$start-$end.xls");
            $data['title'] = "Export Matakuliah dari $start sampai $end ";
            $data['matakuliah'] = $this->matakuliah->exportMatakuliah()->result_array();
        } else {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment;Filename=export-matkul.xls");
            $data['title'] = "Export Matakuliah Keseluruhan ";
            $data['matakuliah'] = $this->matakuliah->exportMatakuliah()->result_array();
        }
        $data['ttd'] = $this->db->get('tbl_tanda_tangan')->row_array();

        $this->load->view('akademik/v_export_matakuliah_excel', $data);
    }

    public function importMatakuliah()
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            foreach ($sheetData as $rowdata) {
                # code...
                $data = array(
                    'id_kurikulum' => $rowdata[0],
                    'kode_mk' => $rowdata[1],
                    'nama_mk' => $rowdata[2],
                    'jns_mk' => $rowdata[3],
                    'sks' => $rowdata[4],
                    'sks_tm' => $rowdata[5],
                    'sks_prak' => $rowdata[6],
                    'semester' => $rowdata[7],

                );
                $cek = $this->db->get_where('tb_mata_kuliah', ['kode_mk' => $rowdata[1]])->num_rows();
                // var_dump($cek);
                // die;
                // echo '<br>';

                if ($cek == 0) {
                    // var_dump($username);
                    var_dump($data);
                    // die;
                    $insert = $this->db->insert('tb_mata_kuliah', $data);
                    // var_dump($insert);
                    // die;
                    if ($insert) {
                        log_aktifitas('insert', 'matakuliah');

                        $dataflash = array(
                            'title' => 'Data Matakuliah',
                            'text' => 'Data Matakuliah Berhasil ditambahkan',
                            'type' => 'success',
                            'icon'  => 'success',
                            'confirmButtonColor' => '#0095cc',
                            'confirmButtonText' => 'Oke',
                        );
                        $this->session->set_flashdata('message', $dataflash);
                    } else {
                        $dataflash = array(
                            'title' => 'Data Matakuliah',
                            'text' => 'Data Matakuliah Gagal ditambahkan!',
                            'type' => 'danger',
                            'icon'  => 'danger',
                            'confirmButtonColor' => '#F64E60',
                            'confirmButtonText' => 'Oke',
                        );
                        $this->session->set_flashdata('message', $dataflash);
                    }
                } else {
                    $dataflash = array(
                        'title' => 'Data Matakuliah',
                        'text' => 'Gagal !!, Data Matakuliah ' . $rowdata[0] . ' Sudah Ada',
                        'type' => 'danger',
                        'icon'  => 'danger',
                        'confirmButtonColor' => '#F64E60',
                        'confirmButtonText' => 'Oke',
                    );
                    $this->session->set_flashdata('message', $dataflash);
                }
            }
        }

        // die;
        redirect('superadmin/matakuliah');
    }
}
