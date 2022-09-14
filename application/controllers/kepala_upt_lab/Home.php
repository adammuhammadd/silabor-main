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

        if ($this->session->userdata('level') != 'Kepala_UPT_Lab') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
        }
    }

    public function index()
    {
        $list_permohonan = array();

        $peminjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->where('tb_pinjam.status', 'Sedang dipinjam')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->get();

        $bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();
        //cek permohonan pinjam yang telah di approve laboran
        $cek_konfirmasi_pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.status_laboran', 'Diizinkan')
            ->where('tb_permohonan_pinjam_alat.status_kepala_upt', 'Belum diizinkan')
            ->where('tb_pinjam.status', 'Sedang diajukan')
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        // echo '<pre>';print_r($cek_konfirmasi_pinjam_alat->result_array());exit;


        foreach ($cek_konfirmasi_pinjam_alat->result() as $konf_pinjam) {
            $list_permohonan[] = $konf_pinjam;
        }

        // $cek_konfirmasi_bebas_lab = $this->cek_status_validasi();

        // foreach ($cek_konfirmasi_bebas_lab as $konf_bebas) {
        //     $list_permohonan[] = $konf_bebas;
        // }
        foreach($bebas_lab->result() as $key =>$row){
            $list_permohonan[] = $row;
        }

        // echo '<pre>';print_r($list_permohonan);exit;

        $data = array(
            'peminjam_alat' => $peminjam_alat,
            'pinjam_alat' => $pinjam_alat,
            'bebas_lab' => $bebas_lab,
            'list_permohonan' => $list_permohonan,
            'page' => 'kepala_upt_lab/home/index',
            'link' => 'kepala_upt_lab/home',
            'script' => 'kepala_upt_lab/home/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    private function cek_status_validasi()
    {
        $result_array = array();
        $cek = array();

        $get_fakultas = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*, tb_prodi.*, tb_fakultas.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas')
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        foreach ($get_fakultas->result() as $fakultas) {

            $cek_history_pinjam = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*, tb_bidang_lab.*')
                ->from('tb_permohonan_pinjam_alat')
                ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
                ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
                ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
                ->where('tb_permohonan_pinjam_alat.id_user', $fakultas->id_user)
                ->where('tb_permohonan_pinjam_alat.status_track', "Telah dikembalikan")
                ->group_by('tb_bidang_lab.bidang_lab')
                ->get();

            if ($fakultas->fakultas == "Teknologi Infrastruktur dan Kewilayahan") {
                if ($cek_history_pinjam->num_rows() == 0) {
                    array_push($result_array, $fakultas);
                } else {
                    foreach ($cek_history_pinjam->result() as $pinjam) {
                        if ($this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->num_rows() == 0) {
                            break;
                        } else {
                            $cek[] = $this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->row();
                        }
                    }

                    if (count($cek) > 0) {
                        array_push($result_array, $fakultas);
                    }
                }
            }
            if ($fakultas->fakultas == "Sains") {
                if ($cek_history_pinjam->num_rows() == 0) {
                    array_push($result_array, $fakultas);
                } else {
                    foreach ($cek_history_pinjam->result() as $pinjam) {
                        if ($this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->num_rows() == 0) {
                            break;
                        } else {
                            $cek[] = $this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->row();
                        }
                    }

                    if (count($cek) > 0) {
                        array_push($result_array, $fakultas);
                    }
                }
            }
            if ($fakultas->fakultas == "Teknik Proses dan Hayati") {
                if ($cek_history_pinjam->num_rows() == 0) {
                    array_push($result_array, $fakultas);
                } else {
                    foreach ($cek_history_pinjam->result() as $pinjam) {
                        if ($this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->num_rows() == 0) {
                            break;
                        } else {
                            $cek[] = $this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->row();
                        }
                    }

                    if (count($cek) > 0) {
                        array_push($result_array, $fakultas);
                    }
                }
            }
            if ($fakultas->fakultas == "Teknik Elektro, Informatika, dan Sistem Fisika") {
                if ($cek_history_pinjam->num_rows() == 0) {
                    array_push($result_array, $fakultas);
                } else {
                    foreach ($cek_history_pinjam->result() as $pinjam) {
                        if ($this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->num_rows() == 0) {
                            break;
                        } else {
                            $cek[] = $this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->row();
                        }
                    }

                    if (count($cek) > 0) {
                        array_push($result_array, $fakultas);
                    }
                }
            }
            if ($fakultas->fakultas == "Teknik Manufaktur dan Mineral Kebumian") {
                if ($cek_history_pinjam->num_rows() == 0) {
                    array_push($result_array, $fakultas);
                } else {
                    foreach ($cek_history_pinjam->result() as $pinjam) {
                        if ($this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->num_rows() == 0) {
                            break;
                        } else {
                            $cek[] = $this->validasi_kalab($fakultas->id_permohonan_bebas_lab, $pinjam->bidang_lab)->row();
                        }
                    }

                    if (count($cek) > 0) {
                        array_push($result_array, $fakultas);
                    }
                }
            }
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
