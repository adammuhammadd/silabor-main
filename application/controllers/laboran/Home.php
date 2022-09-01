<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Silahkan Login Terlebih Dahulu !</b></div><hr>');
            echo '<script>window.location.href="' . base_url('login') . '"</script>';
        }

        if ($this->session->userdata('level') != 'Laboran') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
        }
    }

    public function index()
    {
        $peminjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->where('tb_pinjam.status', 'Sedang dipinjam')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*, tb_pinjam.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.status_laboran', 'Belum diizinkan')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        $data = array(
            'peminjam_alat' => $peminjam_alat,
            'pinjam_alat' => $pinjam_alat,
            'bebas_lab' => $bebas_lab,
            'page' => 'laboran/home/index',
            'link' => 'laboran/home',
            'script' => 'laboran/home/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }
}
