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

        if ($this->session->userdata('level') != 'Dosen') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
        }
    }

    public function index()
    {
        $permohonan = '';
        $penolakan = array();

        //cek apakah sedang ada penolakan pinjam alat
        $cek_pinjam_ditolak = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status', 'Tidak diizinkan')
            ->get();

        //cek apakah sedang ada penolakan bebas lab
        $cek_bebas_ditolak = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_bebas_lab.status', 'Tidak diizinkan')
            ->get();

        if ($cek_pinjam_ditolak->num_rows() > 0) {
            foreach ($cek_pinjam_ditolak->result() as $tolak) {
                $penolakan[] = $tolak;
            }
        }

        $data_pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->get();

        //cek apakah sedang ada permohonan pinjam alat
        $cek_mohon_pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->get();

        //cek apakah sedang ada permohonan bebas lab
        $cek_mohon_bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        //cek peminjaman yang diterima
        $peminjaman = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status_track', 'Belum diambil')
            ->get();

        $user = $this->db->select('tb_user.*, tb_permohonan_pinjam_alat.*')
            ->from('tb_user')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_user=tb_user.id_user')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->get();

        $data = $this->db->select('tb_alat.*, tb_permohonan_pinjam_alat.*, tb_pinjam.*')
            ->from('tb_user')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_user=tb_user.id_user')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->get();

        $alat_dipinjam = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->get();

        //cek permohonan bebas lab
        $cek_bebas_lab_sudah = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_bebas_lab.status', 'Diizinkan')
            ->get();

        if ($cek_bebas_ditolak->num_rows() > 0) {
            foreach ($cek_bebas_ditolak->result() as $tolak) {
                $penolakan[] = $tolak;
            }
        }

        if ($cek_mohon_bebas_lab->num_rows() > 0) {
            $permohonan = 'Bebas Lab';
            $query = $cek_mohon_bebas_lab;
        } else if ($cek_mohon_pinjam_alat->num_rows() > 0) {
            $permohonan = 'Pinjam Alat';
            $query = $data_pinjam_alat;
        } else {
            $permohonan = 'Tidak Ada';
            $query = '';
        }

        $data = array(
            'permohonan' => $permohonan,
            'penolakan' => $penolakan,
            'peminjaman' => $peminjaman,
            'alat_dipinjam' => $alat_dipinjam,
            'cek_bebas_lab_sudah' => $cek_bebas_lab_sudah,
            'user' => $user->row(),
            'data' => $query,
            'page' => 'dosen/home/index',
            'link' => 'dosen/home',
            'script' => 'dosen/home/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }
}
