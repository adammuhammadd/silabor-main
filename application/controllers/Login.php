<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('level') != null) {
			echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home";</script>';
		}
	}

	public function index()
	{
		$vals = [
			'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4),
			'img_path'      => './assets_viho/assets/images/captcha/',
			'img_url'       => base_url('assets_viho/assets/images/captcha/'),
			'img_width'     => 150,
			'img_height'    => 35,
			'expiration'    => 7200,
			'word_length'   => 4,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => [
				'background' => [255, 255, 255],
				'border'    => [255, 255, 255],
				'text'      => [0, 0, 0],
				'grid'      => [255, 40, 40]
			]
		];

		$captcha = create_captcha($vals);

		$this->session->set_userdata('captcha', $captcha['word']);

		$data = array(
			'captcha' => $captcha['image'],
			'page' => 'login/index',
			'link' => 'login'
		);
		$this->load->view('login/index', $data);
	}

	public function proses()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$this->db->select('tb_user.*');
		$this->db->from('tb_user');
		$this->db->where(array('tb_user.email' => $email));
		$lev = $this->db->get();

		$post_code  = $this->input->post('captcha');
		$captcha    = $this->session->userdata('captcha');

		if ($post_code && ($post_code == $captcha)) {
			if ($lev->num_rows() != 0) {
				if (password_verify($password, $lev->row()->password)) {
					if ($lev->row()->is_level == 'Super Admin') {
						$level = 'Admin';
					} else {
						$level = $lev->row()->is_level;
					}

					$level = str_replace(" ", "_", $level);
					
					$sess = array(
						'id_user' => $lev->row()->id_user,
						'id_bidang_lab' => $lev->row()->id_bidang_lab,
						'email' => $lev->row()->email,
						'nama_lengkap' => $lev->row()->nama_lengkap,
						'level' => $level,
						// 'id_login' => $lev->row()->id_login,
					);

					$this->session->set_userdata($sess);

					if ($this->session->userdata('level') != null) {
						echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
					}
				} else {
					$this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Email Atau Password Salah !</b></div><hr>');
					echo '<script>window.location.href="' . base_url('login') . '"</script>';
				}
			} else {
				$this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Email Atau Password Salah !</b></div><hr>');
				echo '<script>window.location.href="' . base_url('login') . '"</script>';
			}
		} else {
			$this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Captcha Yang Anda Masukkan Salah !</b></div><hr>');
			echo '<script>window.location.href="' . base_url('login') . '"</script>';
		}
	}
}
