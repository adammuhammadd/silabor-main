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

        if ($this->session->userdata('level') != 'Kepala_Lab') {
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

        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status_laboran', 'Belum diizinkan')
            ->get();

        $bebas_lab = $this->filter_fakultas();

        $data = array(
            'peminjam_alat' => $peminjam_alat,
            'pinjam_alat' => $pinjam_alat,
            'bebas_lab' => $bebas_lab,
            'page' => 'kepala_lab/home/index',
            'link' => 'kepala_lab/home',
            'script' => 'kepala_lab/home/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    private function filter_fakultas()
    {
        $result = array();

        $fakultas_permohonan = $this->db->query("SELECT tb_permohonan_bebas_lab.*, tb_user.*, tb_prodi.*, tb_fakultas.*
        FROM tb_permohonan_bebas_lab
        JOIN tb_user ON tb_user.id_user=tb_permohonan_bebas_lab.id_user
        JOIN tb_prodi ON tb_prodi.id_prodi=tb_user.id_prodi
        JOIN tb_fakultas ON tb_fakultas.id_fakultas=tb_prodi.id_fakultas
        WHERE NOT tb_permohonan_bebas_lab.status='Tidak diizinkan'");

        $fakultas_kalab = $this->db->select('tb_user.*, tb_bidang_lab.*')
            ->from('tb_user')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab')
            ->where('tb_user.id_user', $this->session->userdata('id_user'))
            ->get()
            ->row();


        foreach ($fakultas_permohonan->result() as $permohonan) {
            $where = "(tb_validasi_kalab.id_kalab = '" . $this->session->userdata('id_user') . "')
            AND (tb_permohonan_bebas_lab.id_permohonan_bebas_lab = '" . $permohonan->id_permohonan_bebas_lab . "')
            AND (tb_validasi_kalab.status_validasi = 'Tidak diizinkan'
            OR tb_validasi_kalab.status_validasi = 'Diizinkan')";

            $validasi_kalab = $this->db->select('tb_permohonan_bebas_lab.*, tb_validasi_kalab.*, tb_user.*')
                ->from('tb_permohonan_bebas_lab')
                ->join('tb_validasi_kalab', 'tb_validasi_kalab.id_permohonan_bebas_lab=tb_permohonan_bebas_lab.id_permohonan_bebas_lab')
                ->join('tb_user', 'tb_user.id_user=tb_validasi_kalab.id_kalab')
                ->where($where)
                ->get();

            $cek_history_pinjam = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*, tb_bidang_lab.*')
                ->from('tb_permohonan_pinjam_alat')
                ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
                ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
                ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
                ->where('tb_permohonan_pinjam_alat.id_user', $permohonan->id_user)
                ->where('tb_permohonan_pinjam_alat.status_track', "Telah dikembalikan")
                ->group_by('tb_bidang_lab.bidang_lab')
                ->get();

            if ($validasi_kalab->num_rows() > 0) {
                continue;
            }

            if ($cek_history_pinjam->num_rows() == 0) {
                continue;
            }

            if ($permohonan->fakultas == '') {
                return;
            }

            if (
                $fakultas_kalab->bidang_lab == 'LAB. KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. MULTIMEDIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. BIOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. SAINS ATMOSFER & KEPLANETAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. FARMASI' ||
                $fakultas_kalab->bidang_lab == 'LAB. MATEMATIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. AKTUARIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. SAINS LINGKUNGAN KELAUTAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. MULTIMEDIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. BIOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK SIPIL' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK GEOMATIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK LINGKUNGAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK KELAUTAN' ||
                $fakultas_kalab->bidang_lab == 'STUDIO PWK' ||
                $fakultas_kalab->bidang_lab == 'STUDIO ARSITEKTUR' ||
                $fakultas_kalab->bidang_lab == 'STUDIO DKV' ||
                $fakultas_kalab->bidang_lab == 'STUDIO ARSITEKTUR LANSKAP' ||
                $fakultas_kalab->bidang_lab == 'LAB. KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. MULTIMEDIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. BIOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK BIOSISTEM' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNOLOGI INDUSTRI PERTANIAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNOLOGI PANGAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. REKAYASA KEHUTANAN' ||
                $fakultas_kalab->bidang_lab == 'LAB. KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. MULTIMEDIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. BIOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK ELEKTRO' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK SISTEM ENERGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK TELEKOMUNIKASI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK BIOMEDIK' ||
                $fakultas_kalab->bidang_lab == 'LAB. KIMIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. FISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. MULTIMEDIA' ||
                $fakultas_kalab->bidang_lab == 'LAB. BIOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK GEOLOGI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK GEOFISIKA' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK MESIN' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK INDUSTRI' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK MATERIAL' ||
                $fakultas_kalab->bidang_lab == 'LAB. TEKNIK PERTAMBANGAN'
            ) {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == $fakultas_kalab->bidang_lab) {
                        array_push($result, $permohonan);
                    }
                }
            }
        }

        return $result;
    }

    // private function cek_validasi()
    // {
    //     return $this->db->query("SELECT tb_permohonan_bebas_lab.*, tb_user.*, tb_prodi.*, tb_fakultas.*
    //     FROM tb_permohonan_bebas_lab
    //     JOIN tb_user ON tb_user.id_user=tb_permohonan_bebas_lab.id_user
    //     JOIN tb_prodi ON tb_prodi.id_prodi=tb_user.id_prodi
    //     JOIN tb_fakultas ON tb_fakultas.id_fakultas=tb_prodi.id_fakultas
    //     WHERE tb_permohonan_bebas_lab.status='Diizinkan'");
    // }
}
