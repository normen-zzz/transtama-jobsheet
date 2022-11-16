<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManagementFrontend extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect('dsitbacksystem');
		}
		$this->load->library('upload');
		cek_role();
	}

	public function messageAlert($type, $title)
	{
		$messageAlert = "
			var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		  });

			Toast.fire({
					type: '" . $type . "',
					title: '" . $title . "'
			});
			";
		return $messageAlert;
	}

	// CRUD MEDIA SOSIAL
	public function medsos()
	{
		$data['title'] = 'Media Sosial';
		$data['medsos'] = $this->db->get('tb_medsos')->result_array();
		$this->backend->display('superadmin/medsos', $data);
	}

	public function addMedsos()
	{
		$data = array(
			'nama_medsos' => $this->input->post('nama_medsos'),
			'link' => $this->input->post('link'),
			'icon' => $this->input->post('icon')
		);
		$insert = $this->db->insert('tb_medsos', $data);
		if ($insert) {
			log_aktifitas('insert', 'tb_medsos');
			$this->session->set_flashdata('message', 'Ditambahkan');
			redirect('superadmin/managementFrontend/medsos');
		} else {
			$this->session->set_flashdata('message', 'Ditambahkan');
			redirect('superadmin/managementFrontend/medsos');
		}
	}

	public function editMedsos()
	{
		$data = array(
			'nama_medsos' => $this->input->post('nama_medsos'),
			'link' => $this->input->post('link'),
			'icon' => $this->input->post('icon')
		);
		$where = array('id' => $this->input->post('id'));
		$update = $this->db->update('tb_medsos', $data, $where);
		if ($update) {
			log_aktifitas('update', 'tb_medsos');
			$this->session->set_flashdata('message', 'Diedit');
			redirect('superadmin/managementFrontend/medsos');
		} else {
			$this->session->set_flashdata('message', 'Diedit');
			redirect('superadmin/managementFrontend/medsos');
		}
	}

	public function deleteMedsos($id)
	{
		$where = array('id' => $id);
		$delete = $this->db->delete('tb_medsos', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_medsos');
			$this->session->set_flashdata('message', 'Dihapus');
			redirect('superadmin/managementFrontend/medsos');
		} else {
			$this->session->set_flashdata('message', 'Dihapus');
			redirect('superadmin/managementFrontend/medsos');
		}
	}

	// CRUD LAYANAN PEMBELAJARAN
	public function layananPembelajaran()
	{
		$data['title'] = 'Layanan Pembelajaran';
		$data['layanan'] = $this->db->get('tb_layanan')->result_array();
		$this->backend->display('superadmin/v_layanan', $data);
	}
	public function addLayanan()
	{
		$data = array(
			'nama_layanan' => $this->input->post('nama_layanan'),
			'link' => $this->input->post('link'),
			'icon' => $this->input->post('icon'),
			'color_icon' => $this->input->post('color_icon'),
			'deskripsi' => $this->input->post('deskripsi'),
		);
		$insert = $this->db->insert('tb_layanan', $data);
		if ($insert) {
			log_aktifitas('insert', 'tb_layanan');
			$this->session->set_flashdata('message', 'Ditambahkan');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		} else {
			$this->session->set_flashdata('message', 'Ditambahkan');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		}
	}
	public function editLayanan()
	{
		$data = array(
			'nama_layanan' => $this->input->post('nama_layanan'),
			'link' => $this->input->post('link'),
			'icon' => $this->input->post('icon'),
			'color_icon' => $this->input->post('color_icon'),
			'deskripsi' => $this->input->post('deskripsi'),
		);
		$where = array('id' => $this->input->post('id'));
		$delete = $this->db->update('tb_layanan', $data, $where);
		if ($delete) {
			log_aktifitas('update', 'tb_layanan');
			$this->session->set_flashdata('message', 'Diedit');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		} else {
			$this->session->set_flashdata('message', 'Diedit');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		}
	}
	public function deleteLayanan($id)
	{
		$where = array('id' => $id);
		$delete = $this->db->delete('tb_layanan', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_layanan');
			$this->session->set_flashdata('message', 'Didelete');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		} else {
			$this->session->set_flashdata('message', 'Didelete');
			redirect('superadmin/managementFrontend/layananPembelajaran');
		}
	}

	// CRUD SLIDER

	public function slider()
	{
		$data['title'] = 'Slider';
		$data['slider'] = $this->db->get('tb_slider')->result_array();
		$this->backend->display('superadmin/v_slider', $data);
	}

	function simpan()
	{

		$config['upload_path'] = './assets/front/img/slide/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

		$this->upload->initialize($config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/front/img/slide/';
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '60%';
				$config['width'] = 1920;
				$config['height'] = 1080;
				$config['new_image'] = './assets/front/img/slide/';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$judul = $this->input->post('judul');
				$link = $this->input->post('link');
				$deskripsi = $this->input->post('deskripsi');
				$data = array(
					'judul' => $judul,
					'deskripsi' => $deskripsi,
					'link' => $link,
					'gambar' => $gambar,
				);
				$this->db->insert('tb_slider', $data);
				log_aktifitas('insert', 'tb_slider');
				$this->session->set_flashdata('message', 'Ditambahkan');
				redirect('superadmin/managementFrontend/slider');
			} else {
				$this->session->set_flashdata('message', 'Ditambahkan');
				redirect('superadmin/managementFrontend/slider');
			}
		} else {
			$this->session->set_flashdata('message', 'Ditambahkan');
			redirect('superadmin/managementFrontend/slider');
		}
	}
	public function deleteSlider($id, $gambar)
	{
		$where = array('id_slider' => $id);
		$delete = $this->db->delete('tb_slider', $where);
		if ($delete) {
			log_aktifitas('delete', 'tb_slider');
			$this->session->set_flashdata('message', 'Didelete');
			unlink('./assets/front/img/slide/' . $gambar);
			redirect('superadmin/managementFrontend/slider');
		} else {
			$this->session->set_flashdata('message', 'Didelete');
			redirect('superadmin/managementFrontend/slider');
		}
	}

	function editSlider()
	{

		$config['upload_path'] = './assets/front/img/slide/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$where = array('id_slider' => $this->input->post('id_slider'));

		$this->upload->initialize($config);
		if (!empty($_FILES['foto']['name'])) {
			if ($this->upload->do_upload('foto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/front/img/slide/';
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '60%';
				$config['width'] = 1920;
				$config['height'] = 1080;
				$config['new_image'] = './assets/front/img/slide/';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$judul = $this->input->post('judul');
				$link = $this->input->post('link');
				$deskripsi = $this->input->post('deskripsi');
				$data = array(
					'judul' => $judul,
					'deskripsi' => $deskripsi,
					'link' => $link,
					'gambar' => $gambar,
				);
				$this->db->update('tb_slider', $data, $where);
				log_aktifitas('update', 'tb_slider');
				$this->session->set_flashdata('message', 'Diedit');
				redirect('superadmin/managementFrontend/slider');
			} else {
				$this->session->set_flashdata('message', 'Diedit');
				redirect('superadmin/managementFrontend/slider');
			}
		} else {
			$judul = $this->input->post('judul');
			$link = $this->input->post('link');
			$deskripsi = $this->input->post('deskripsi');
			$data = array(
				'judul' => $judul,
				'deskripsi' => $deskripsi,
				'link' => $link,
			);
			$this->db->update('tb_slider', $data, $where);
			log_aktifitas('update', 'tb_slider');
			$this->session->set_flashdata('message', 'Diedit');
			redirect('superadmin/managementFrontend/slider');
		}
	}
}
