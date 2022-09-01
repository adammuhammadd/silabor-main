<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Silahkan Login Terlebih Dahulu !</b></div><hr>');
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
        }

        if ($this->session->userdata('level') != 'Admin') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . 'home";</script>';
        }
    }

    public function index()
    {
        $list_permohonan = array();

        //cek permohonan pinjam yang telah di approve laboran
        $cek_konfirmasi_pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->where('tb_pinjam.status', 'Sedang diajukan')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        foreach ($cek_konfirmasi_pinjam_alat->result() as $konf_pinjam) {
            $list_permohonan[] = $konf_pinjam;
        }

        $cek_konfirmasi_bebas_lab = $this->db->query('SELECT tb_permohonan_bebas_lab.*, tb_user.*
        FROM tb_permohonan_bebas_lab
        JOIN tb_user ON tb_user.id_user=tb_permohonan_bebas_lab.id_user
        WHERE tb_permohonan_bebas_lab.status="Belum diizinkan"');

        foreach ($cek_konfirmasi_bebas_lab->result() as $konf_bebas) {
            $list_permohonan[] = $konf_bebas;
        }

        $peminjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Telah dikembalikan')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.status', 'Diizinkan')
            ->get();

        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->get();

        $data = array(
            'bebas_lab' => $bebas_lab,
            'pinjam_alat' => $pinjam_alat,
            'peminjam_alat' => $peminjam_alat,
            'list_permohonan' => $list_permohonan,
            'page' => 'admin/home/index',
            'link' => 'admin/home',
            'script' => 'admin/home/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    private function generate_code()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randstring = '';

        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, 35)];
        }

        return 'PBL-' . $randstring . '-' . date("dmY");
    }
}
