<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
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
        $peminjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $dikembalikan = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Telah dikembalikan')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status', 'Diizinkan')
            ->get();

        $belum_bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        $data = array(
            'peminjam_alat' => $peminjam_alat,
            'dikembalikan' => $dikembalikan,
            'bebas_lab' => $bebas_lab,
            'belum_bebas_lab' => $belum_bebas_lab,
            'page' => 'admin/history/index',
            'link' => 'admin/history',
            'script' => 'admin/history/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function detail_belum_bebas_lab($id)
    {
        $belum_bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get()
            ->row();

        $get_kepala_upt = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_kepala_upt')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get()
            ->row();

        $data = array(
            'cek_kepala_lab' => $this->cek_status_validasi($id),
            'data_kepala_upt' => $get_kepala_upt,
            'belum_bebas_lab' => $belum_bebas_lab,
            'page' => 'admin/detail_belum_bebas_lab/index',
            'link' => 'admin/history',
            'script' => 'admin/detail_belum_bebas_lab/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    private function cek_status_validasi($id)
    {
        $result_array = array();
        $fakultas = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*, tb_prodi.*, tb_fakultas.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get()
            ->row();

        $kimia = $this->validasi_kalab($id, 'LAB. KIMIA');
        $fisika = $this->validasi_kalab($id, 'LAB. FISIKA');
        $multimedia = $this->validasi_kalab($id, 'LAB. MULTIMEDIA');
        $biologi = $this->validasi_kalab($id, 'LAB. BIOLOGI');

        $tk_sipil = $this->validasi_kalab($id, 'LAB. TEKNIK SIPIL');
        $tk_geomatika = $this->validasi_kalab($id, 'LAB. TEKNIK GEOMATIKA');
        $tk_ling = $this->validasi_kalab($id, 'LAB. TEKNIK LINGKUNGAN');
        $tk_laut = $this->validasi_kalab($id, 'LAB. TEKNIK KELAUTAN');
        $studio_pwk = $this->validasi_kalab($id, 'STUDIO PWK');
        $studio_ars = $this->validasi_kalab($id, 'STUDIO ARSITEKTUR');
        $studio_dkv = $this->validasi_kalab($id, 'STUDIO DKV');
        $studio_ars_lans = $this->validasi_kalab($id, 'STUDIO ARSITEKTUR LANSKAP');

        $sains_atm = $this->validasi_kalab($id, "LAB. SAINS ATMOSFER & KEPLANETAN");
        $farmasi = $this->validasi_kalab($id, "LAB. FARMASI");
        $matematika = $this->validasi_kalab($id, "LAB. MATEMATIKA");
        $aktuaria = $this->validasi_kalab($id, "LAB. AKTUARIA");
        $sains_ling = $this->validasi_kalab($id, "LAB. SAINS LINGKUNGAN KELAUTAN");

        $tk_biosistem = $this->validasi_kalab($id, "LAB. TEKNIK BIOSISTEM");
        $tk_kimia = $this->validasi_kalab($id, "LAB. TEKNIK KIMIA");
        $tk_ind_tani = $this->validasi_kalab($id, "LAB. TEKNOLOGI INDUSTRI PERTANIAN");
        $tk_pangan = $this->validasi_kalab($id, "LAB. TEKNOLOGI PANGAN");
        $rek_hutan = $this->validasi_kalab($id, "LAB. REKAYASA KEHUTANAN");

        $tk_elektro = $this->validasi_kalab($id, 'LAB. TEKNIK ELEKTRO');
        $tk_fisika = $this->validasi_kalab($id, 'LAB. TEKNIK FISIKA');
        $tk_sis_energi = $this->validasi_kalab($id, 'LAB. TEKNIK SISTEM ENERGI');
        $tk_telkom = $this->validasi_kalab($id, 'LAB. TEKNIK TELEKOMUNIKASI');
        $tk_biomedik = $this->validasi_kalab($id, 'LAB. TEKNIK BIOMEDIK');

        $tk_geologi = $this->validasi_kalab($id, 'LAB. TEKNIK GEOLOGI');
        $tk_geofisika = $this->validasi_kalab($id, 'LAB. TEKNIK GEOFISIKA');
        $tk_mesin = $this->validasi_kalab($id, 'LAB. TEKNIK MESIN');
        $tk_industri = $this->validasi_kalab($id, 'LAB. TEKNIK INDUSTRI');
        $tk_material = $this->validasi_kalab($id, 'LAB. TEKNIK MATERIAL');
        $tk_pertambangan = $this->validasi_kalab($id, 'LAB. TEKNIK PERTAMBANGAN');

        if ($kimia->row() == null) {
            $result_array['Kepala Lab. Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Kimia'] = 'SUDAH VALIDASI';
        }
        if ($fisika->row() == null) {
            $result_array['Kepala Lab. Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Fisika'] = 'SUDAH VALIDASI';
        }
        if ($multimedia->row() == null) {
            $result_array['Kepala Lab. Multimedia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Multimedia'] = 'SUDAH VALIDASI';
        }
        if ($biologi->row() == null) {
            $result_array['Kepala Lab. Biologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Biologi'] = 'SUDAH VALIDASI';
        }
        if ($tk_sipil->row() == null) {
            $result_array['Kepala Lab. Teknik Sipil'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Sipil'] = 'SUDAH VALIDASI';
        }
        if ($tk_geomatika->row() == null) {
            $result_array['Kepala Lab. Teknik Geomatika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Geomatika'] = 'SUDAH VALIDASI';
        }
        if ($tk_ling->row() == null) {
            $result_array['Kepala Lab. Teknik Lingkungan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Lingkungan'] = 'SUDAH VALIDASI';
        }
        if ($tk_laut->row() == null) {
            $result_array['Kepala Lab. Teknik Kelautan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Kelautan'] = 'SUDAH VALIDASI';
        }
        if ($studio_pwk->row() == null) {
            $result_array['Kepala Lab. Studio PWK'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Studio PWK'] = 'SUDAH VALIDASI';
        }
        if ($studio_ars->row() == null) {
            $result_array['Kepala Lab. Studio Arsitektur'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Studio Arsitektur'] = 'SUDAH VALIDASI';
        }
        if ($studio_dkv->row() == null) {
            $result_array['Kepala Lab. Studio DKV'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Studio DKV'] = 'SUDAH VALIDASI';
        }
        if ($studio_ars_lans->row() == null) {
            $result_array['Kepala Lab. Studio Arsitektur Lanskap'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Studio Arsitektur Lanskap'] = 'SUDAH VALIDASI';
        }
        if ($kimia->row() == null) {
            $result_array['Kepala Lab. Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Kimia'] = 'SUDAH VALIDASI';
        }
        if ($fisika->row() == null) {
            $result_array['Kepala Lab. Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Fisika'] = 'SUDAH VALIDASI';
        }
        if ($multimedia->row() == null) {
            $result_array['Kepala Lab. Multimedia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Multimedia'] = 'SUDAH VALIDASI';
        }
        if ($biologi->row() == null) {
            $result_array['Kepala Lab. Biologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Biologi'] = 'SUDAH VALIDASI';
        }
        if ($sains_atm->row() == null) {
            $result_array['Kepala Lab. Sains Atmosfer & Keplanetan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Sains Atmosfer & Keplanetan'] = 'SUDAH VALIDASI';
        }
        if ($farmasi->row() == null) {
            $result_array['Kepala Lab. Farmasi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Farmasi'] = 'SUDAH VALIDASI';
        }
        if ($matematika->row() == null) {
            $result_array['Kepala Lab. Matematika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Matematika'] = 'SUDAH VALIDASI';
        }
        if ($aktuaria->row() == null) {
            $result_array['Kepala Lab. Aktuaria'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Aktuaria'] = 'SUDAH VALIDASI';
        }
        if ($sains_ling->row() == null) {
            $result_array['Kepala Lab. Sains Lingkungan Kelautan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Sains Lingkungan Kelautan'] = 'SUDAH VALIDASI';
        }
        if ($kimia->row() == null) {
            $result_array['Kepala Lab. Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Kimia'] = 'SUDAH VALIDASI';
        }
        if ($fisika->row() == null) {
            $result_array['Kepala Lab. Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Fisika'] = 'SUDAH VALIDASI';
        }
        if ($multimedia->row() == null) {
            $result_array['Kepala Lab. Multimedia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Multimedia'] = 'SUDAH VALIDASI';
        }
        if ($biologi->row() == null) {
            $result_array['Kepala Lab. Biologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Biologi'] = 'SUDAH VALIDASI';
        }
        if ($tk_biosistem->row() == null) {
            $result_array['Kepala Lab. Teknik Biosistem'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Biosistem'] = 'SUDAH VALIDASI';
        }
        if ($tk_kimia->row() == null) {
            $result_array['Kepala Lab. Teknik Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Kimia'] = 'SUDAH VALIDASI';
        }
        if ($tk_ind_tani->row() == null) {
            $result_array['Kepala Lab. Teknik Industri Pertanian'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Industri Pertanian'] = 'SUDAH VALIDASI';
        }
        if ($tk_pangan->row() == null) {
            $result_array['Kepala Lab. Teknik Pangan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Pangan'] = 'SUDAH VALIDASI';
        }
        if ($rek_hutan->row() == null) {
            $result_array['Kepala Lab. Rekayasa Kehutanan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Rekayasa Kehutanan'] = 'SUDAH VALIDASI';
        }
        if ($kimia->row() == null) {
            $result_array['Kepala Lab. Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Kimia'] = 'SUDAH VALIDASI';
        }
        if ($fisika->row() == null) {
            $result_array['Kepala Lab. Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Fisika'] = 'SUDAH VALIDASI';
        }
        if ($multimedia->row() == null) {
            $result_array['Kepala Lab. Multimedia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Multimedia'] = 'SUDAH VALIDASI';
        }
        if ($biologi->row() == null) {
            $result_array['Kepala Lab. Biologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Biologi'] = 'SUDAH VALIDASI';
        }
        if ($tk_elektro->row() == null) {
            $result_array['Kepala Lab. Teknik Elektro'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Elektro'] = 'SUDAH VALIDASI';
        }
        if ($tk_fisika->row() == null) {
            $result_array['Kepala Lab. Teknik Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Fisika'] = 'SUDAH VALIDASI';
        }
        if ($tk_sis_energi->row() == null) {
            $result_array['Kepala Lab. Teknik Sistem Energi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Sistem Energi'] = 'SUDAH VALIDASI';
        }
        if ($tk_telkom->row() == null) {
            $result_array['Kepala Lab. Teknik Telekomunikasi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Telekomunikasi'] = 'SUDAH VALIDASI';
        }
        if ($tk_biomedik->row() == null) {
            $result_array['Kepala Lab. Teknik Biomedik'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Biomedik'] = 'SUDAH VALIDASI';
        }
        if ($kimia->row() == null) {
            $result_array['Kepala Lab. Kimia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Kimia'] = 'SUDAH VALIDASI';
        }
        if ($fisika->row() == null) {
            $result_array['Kepala Lab. Fisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Fisika'] = 'SUDAH VALIDASI';
        }
        if ($multimedia->row() == null) {
            $result_array['Kepala Lab. Multimedia'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Multimedia'] = 'SUDAH VALIDASI';
        }
        if ($biologi->row() == null) {
            $result_array['Kepala Lab. Biologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Biologi'] = 'SUDAH VALIDASI';
        }
        if ($tk_geologi->row() == null) {
            $result_array['Kepala Lab. Teknik Geologi'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Geologi'] = 'SUDAH VALIDASI';
        }
        if ($tk_geofisika->row() == null) {
            $result_array['Kepala Lab. Teknik Geofisika'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Geofisika'] = 'SUDAH VALIDASI';
        }
        if ($tk_mesin->row() == null) {
            $result_array['Kepala Lab. Teknik Mesin'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Mesin'] = 'SUDAH VALIDASI';
        }
        if ($tk_industri->row() == null) {
            $result_array['Kepala Lab. Teknik Industri'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Industri'] = 'SUDAH VALIDASI';
        }
        if ($tk_material->row() == null) {
            $result_array['Kepala Lab. Teknik Material'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Material'] = 'SUDAH VALIDASI';
        }
        if ($tk_pertambangan->row() == null) {
            $result_array['Kepala Lab. Teknik Pertambangan'] = 'BELUM VALIDASI';
        } else {
            $result_array['Kepala Lab. Teknik Pertambangan'] = 'SUDAH VALIDASI';
        }
        return $result_array;
    }

    private function validasi_kalab($id, $nama_lab)
    {
        return $this->db->select('tb_validasi_kalab.*, tb_user.*, tb_bidang_lab.*')
            ->from('tb_validasi_kalab')
            ->join('tb_user', 'tb_user.id_user=tb_validasi_kalab.id_kalab')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab')
            ->where('tb_validasi_kalab.id_permohonan_bebas_lab', $id)
            ->where('tb_bidang_lab.bidang_lab', $nama_lab)
            ->get();
    }
}
