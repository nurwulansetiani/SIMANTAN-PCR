<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->model('Kegiatan_Model');
		$this->load->model('Komentar_Model');
		date_default_timezone_set("Asia/Jakarta"); //Mengatur Zona waktu Jadi Indonesia
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function komentar($kegiatan = '1')
	{
		$data['user'] = $this->User_Model->get_by_id('2'); //ambil dari session
		$data['komentar'] = $this->Komentar_Model->get_by_id($kegiatan); //ambil dari parameter 
		$data['kegiatan'] = $this->Kegiatan_Model->get_by_id($kegiatan); //disini parameter id kegiatan untuk mengambil datanya
		$this->form_validation->set_rules('komentar', 'Komentar', 'required', [
			'required' => 'Nama Tidak Boleh Kosong'
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header');
			$this->load->view('detail/index', $data);
			$this->load->view('layout/footer');
		} else {
			if ($data['kegiatan']['status'] == 1) {
				echo "<script> alert('mau nge hack yaaa'); document.location.href = '".base_url()."';</script>";

			} else {
				$input = [
					'user' => $this->input->post('user'),
					'kegiatan' => $this->input->post('kegiatan'),
					'komentar' => htmlspecialchars($this->input->post('komentar', true)),
					'tanggal' => $this->input->post('tanggal')
				];
				// print_r($input);
				$this->Komentar_Model->insert($input);
				// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan Berhasil Ditambah!</div>');
				redirect('Detail/komentar/' . $input['kegiatan']);
			}
		}
	}

	public function approve($id)
	{
		$this->Kegiatan_Model->gantiStatus($id);
		redirect('kegiatan/');
	}
	
	public function LihatDetail($id)
	{
		$data['kegiatan'] = $this->Kegiatan_Model->get_by_id($id);
		$this->load->view('layout/header');
		$this->load->view('detail/detail', $data);
		$this->load->view('layout/footer');
	}
}
