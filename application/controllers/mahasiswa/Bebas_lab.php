<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Bebas_lab extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Silahkan Login Terlebih Dahulu !</b></div><hr>');
            echo '<script>window.location.href="' . base_url('login') . '"</script>';
        }

        if ($this->session->userdata('level') != 'Mahasiswa') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
        }
    }

    public function index()
    {
        $id = $this->session->userdata('id_user');

        //cek permohonan bebas lab
        $cek_bebas_lab_belum = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $id)
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        //cek permohonan bebas lab
        $cek_bebas_lab_sudah = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $id)
            ->where('tb_permohonan_bebas_lab.status', 'Diizinkan')
            ->get();

        $id = $this->session->userdata('id_user');

        $data = array(
            'id' => $id,
            'cek_bebas_lab_belum' => $cek_bebas_lab_belum,
            'cek_bebas_lab_sudah' => $cek_bebas_lab_sudah,
            'page' => 'mahasiswa/bebas_lab/index',
            'link' => 'mahasiswa/bebas_lab',
            'script' => 'mahasiswa/bebas_lab/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function ajukan()
    {
        $id = $this->session->userdata('id_user');

        //cek permohonan bebas lab
        $cek_bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $id)
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        if ($cek_bebas_lab->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"> Anda masih memiliki permohonan bebas lab yang belum diproses !</div>'
            );
            echo json_encode($return);
            exit();
        }

        //cek permohonan pinjam alat
        $cek_pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $id)
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->get();

        if ($cek_pinjam_alat->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"> Anda masih memiliki permohonan pinjam alat yang belum diproses !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $cek_peminjaman1 = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status_track', 'Belum diambil')
            ->get();

        $cek_peminjaman2 = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sedang dipinjam')
            ->get();

        if ($cek_peminjaman1->num_rows() > 0 || $cek_peminjaman2->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"> Harap mengembalikan alat sebelum mengajukan permohonan bebas laboratorium !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->load->library('upload');

        //cek apakah gambar tidak ada
        if (empty($_FILES['gambar']['name'])) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Foto Harus Diisi !</div>'
            );
            echo json_encode($return);
            exit();
        }

        //cek ukuran gambar(2 MB)
        if ($_FILES['gambar']['size'] > 2048000) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Ukuran Foto Terlalu Besar (Max 2MB) !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $config['upload_path'] = './upload/file_kompre/';
        $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
        $config['max_size'] = '2000';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>',
            );
            echo json_encode($return);
            exit();
        }

        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];

        $this->db->trans_begin();
        $data_to_save = array(
            'kode_permohonan' => $this->generate_code(),
            'id_user' => (int)$id,
            'file' => $nama_file,
            'status' => 'Belum diizinkan',
            "date_created" => date("Y-m-d H:i:s")
        );

        $this->db->insert('tb_permohonan_bebas_lab', $data_to_save);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Gagal Mengirimkan Permohonan</div>'
            );
            echo json_encode($return);
        } else {
            $this->db->trans_commit();
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success">Berhasil Mengirimkan Permohonan</div>'
            );
            echo json_encode($return);
        }
    }

    public function batalkan()
    {
        $id_user = $this->session->userdata('id_user');

        //cek permohonan bebas lab
        $id_permohonan = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $id_user)
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

        $this->db->delete('tb_permohonan_bebas_lab', array('id_permohonan_bebas_lab' => $id_permohonan->row()->id_permohonan_bebas_lab));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Gagal membatalkan permohonan</div>'
            );
            echo json_encode($return);
        } else {
            $this->db->trans_commit();
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success">Berhasil membatalkan permohonan</div>'
            );
            echo json_encode($return);
        }
    }

    public function form_bebas_lab_old($id)
    {
        $cek_status = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*, tb_bidang_lab.*, tb_prodi.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab', 'left')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi', 'left')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get()
            ->row();

        $get_kalab = $this->db->select('tb_validasi_kalab.*, tb_permohonan_bebas_lab.*, tb_user.*, tb_bidang_lab.*')
            ->from('tb_validasi_kalab')
            ->join('tb_permohonan_bebas_lab', 'tb_permohonan_bebas_lab.id_permohonan_bebas_lab=tb_validasi_kalab.id_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_validasi_kalab.id_kalab')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get();

        $cek_history_pinjam = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*, tb_bidang_lab.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
            ->where('tb_permohonan_pinjam_alat.id_user', $cek_status->id_user)
            ->where('tb_permohonan_pinjam_alat.status_track', "Telah dikembalikan")
            ->group_by('tb_bidang_lab.bidang_lab')
            ->get();

        $data_kepala_upt = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_kepala_upt')
            ->get()
            ->row();

        $get_kode = substr($cek_status->kode_permohonan, 4, -7);

        $kode_kepala_upt = 'Ditandatangani_Oleh_:_' . $data_kepala_upt->nama_lengkap . '_|_No_surat_:_' . $get_kode;

        $kode_kalab_kimia = '';
        $kode_kalab_fisika = '';
        $kode_kalab_multimedia = '';
        $kode_kalab_biologi = '';
        $kode_kalab_sains_atm = '';
        $kode_kalab_farmasi = '';
        $kode_kalab_matematika = '';
        $kode_kalab_aktuaria = '';
        $kode_kalab_sains_ling = '';
        $kode_kalab_tk_sipil = '';
        $kode_kalab_tk_geomatika = '';
        $kode_kalab_tk_ling = '';
        $kode_kalab_tk_laut = '';
        $kode_kalab_studio_pwk = '';
        $kode_kalab_studio_ars = '';
        $kode_kalab_studio_dkv = '';
        $kode_kalab_studio_ars_lans = '';
        $kode_kalab_kimia = '';
        $kode_kalab_fisika = '';
        $kode_kalab_multimedia = '';
        $kode_kalab_biologi = '';
        $kode_kalab_tk_biosistem = '';
        $kode_kalab_tk_kimia = '';
        $kode_kalab_tk_ind_tani = '';
        $kode_kalab_tk_pangan = '';
        $kode_kalab_rek_hutan = '';
        $kode_kalab_tk_elektro = '';
        $kode_kalab_tk_fisika = '';
        $kode_kalab_tk_sis_energi = '';
        $kode_kalab_tk_telkom = '';
        $kode_kalab_tk_biomedik = '';
        $kode_kalab_tk_geologi = '';
        $kode_kalab_tk_geofisika = '';
        $kode_kalab_tk_mesin = '';
        $kode_kalab_tk_industri = '';
        $kode_kalab_tk_material = '';
        $kode_kalab_tk_pertambangan = '';

        $data_kalab_kimia = '';
        $data_kalab_fisika = '';
        $data_kalab_multimedia = '';
        $data_kalab_biologi = '';
        $data_kalab_sains_atm = '';
        $data_kalab_farmasi = '';
        $data_kalab_matematika = '';
        $data_kalab_aktuaria = '';
        $data_kalab_sains_ling = '';
        $data_kalab_tk_sipil = '';
        $data_kalab_tk_geomatika = '';
        $data_kalab_tk_ling = '';
        $data_kalab_tk_laut = '';
        $data_kalab_studio_pwk = '';
        $data_kalab_studio_ars = '';
        $data_kalab_studio_dkv = '';
        $data_kalab_studio_ars_lans = '';
        $data_kalab_tk_biosistem = '';
        $data_kalab_tk_kimia = '';
        $data_kalab_tk_ind_tani = '';
        $data_kalab_tk_pangan = '';
        $data_kalab_rek_hutan = '';
        $data_kalab_tk_elektro = '';
        $data_kalab_tk_fisika = '';
        $data_kalab_tk_sis_energi = '';
        $data_kalab_tk_telkom = '';
        $data_kalab_tk_biomedik = '';
        $data_kalab_tk_geologi = '';
        $data_kalab_tk_geofisika = '';
        $data_kalab_tk_mesin = '';
        $data_kalab_tk_industri = '';
        $data_kalab_tk_material = '';
        $data_kalab_tk_pertambangan = '';


        foreach ($get_kalab->result() as $kalab) {
            if ($kalab->bidang_lab == 'LAB. KIMIA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. KIMIA') {
                        $data_kalab_kimia = $kalab;
                        $kode_kalab_kimia = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. FISIKA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. FISIKA') {
                        $data_kalab_fisika = $kalab;
                        $kode_kalab_fisika = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. MULTIMEDIA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. MULTIMEDIA') {
                        $data_kalab_multimedia = $kalab;
                        $kode_kalab_multimedia = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. BIOLOGI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. BIOLOGI') {
                        $data_kalab_biologi = $kalab;
                        $kode_kalab_biologi = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. SAINS ATMOSFER & KEPLANETAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. SAINS ATMOSFER & KEPLANETAN') {
                        $data_kalab_sains_atm = $kalab;
                        $kode_kalab_sains_atm = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. FARMASI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. FARMASI') {
                        $data_kalab_farmasi = $kalab;
                        $kode_kalab_farmasi = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. MATEMATIKA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. MATEMATIKA') {
                        $data_kalab_matematika = $kalab;
                        $kode_kalab_matematika = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. AKTUARIA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. AKTUARIA') {
                        $data_kalab_aktuaria = $kalab;
                        $kode_kalab_aktuaria = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. SAINS LINGKUNGAN KELAUTAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. SAINS LINGKUNGAN KELAUTAN') {
                        $data_kalab_sains_ling = $kalab;
                        $kode_kalab_sains_ling = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK SIPIL') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK SIPIL') {
                        $data_kalab_tk_sipil = $kalab;
                        $kode_kalab_tk_sipil = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK GEOMATIKA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK GEOMATIKA') {
                        $data_kalab_tk_geomatika = $kalab;
                        $kode_kalab_tk_geomatika = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK LINGKUNGAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK LINGKUNGAN') {
                        $data_kalab_tk_ling = $kalab;
                        $kode_kalab_tk_ling = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK KELAUTAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK KELAUTAN') {
                        $data_kalab_tk_laut = $kalab;
                        $kode_kalab_tk_laut = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'STUDIO PWK') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'STUDIO PWK') {
                        $data_kalab_studio_pwk = $kalab;
                        $kode_kalab_studio_pwk = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'STUDIO ARSITEKTUR') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'STUDIO ARSITEKTUR') {
                        $data_kalab_studio_ars = $kalab;
                        $kode_kalab_studio_ars = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'STUDIO DKV') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'STUDIO DKV') {
                        $data_kalab_studio_dkv = $kalab;
                        $kode_kalab_studio_dkv = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'STUDIO ARSITEKTUR LANSKAP') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'STUDIO ARSITEKTUR LANSKAP') {
                        $data_kalab_studio_ars_lans = $kalab;
                        $kode_kalab_studio_ars_lans = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK BIOSISTEM') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK BIOSISTEM') {
                        $data_kalab_tk_biosistem = $kalab;
                        $kode_kalab_tk_biosistem = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK KIMIA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK KIMIA') {
                        $data_kalab_tk_kimia = $kalab;
                        $kode_kalab_tk_kimia = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNOLOGI INDUSTRI PERTANIAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNOLOGI INDUSTRI PERTANIAN') {
                        $data_kalab_tk_ind_tani = $kalab;
                        $kode_kalab_tk_ind_tani = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNOLOGI PANGAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNOLOGI PANGAN') {
                        $data_kalab_tk_pangan = $kalab;
                        $kode_kalab_tk_pangan = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. REKAYASA KEHUTANAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. REKAYASA KEHUTANAN') {
                        $data_kalab_rek_hutan = $kalab;
                        $kode_kalab_rek_hutan = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK ELEKTRO') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK ELEKTRO') {
                        $data_kalab_tk_elektro = $kalab;
                        $kode_kalab_tk_elektro = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK FISIKA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK FISIKA') {
                        $data_kalab_tk_fisika = $kalab;
                        $kode_kalab_tk_fisika = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK SISTEM ENERGI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK SISTEM ENERGI') {
                        $data_kalab_tk_sis_energi = $kalab;
                        $kode_kalab_tk_sis_energi = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK TELEKOMUNIKASI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK TELEKOMUNIKASI') {
                        $data_kalab_tk_telkom = $kalab;
                        $kode_kalab_tk_telkom = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK BIOMEDIK') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK BIOMEDIK') {
                        $data_kalab_tk_biomedik = $kalab;
                        $kode_kalab_tk_biomedik = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK GEOLOGI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK GEOLOGI') {
                        $data_kalab_tk_geologi = $kalab;
                        $kode_kalab_tk_geologi = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK GEOFISIKA') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK GEOFISIKA') {
                        $data_kalab_tk_geofisika = $kalab;
                        $kode_kalab_tk_geofisika = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK MESIN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK MESIN') {
                        $data_kalab_tk_mesin = $kalab;
                        $kode_kalab_tk_mesin = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK INDUSTRI') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK INDUSTRI') {
                        $data_kalab_tk_industri = $kalab;
                        $kode_kalab_tk_industri = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK MATERIAL') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK MATERIAL') {
                        $data_kalab_tk_material = $kalab;
                        $kode_kalab_tk_material = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
            if ($kalab->bidang_lab == 'LAB. TEKNIK PERTAMBANGAN') {
                foreach ($cek_history_pinjam->result() as $pinjam) {
                    if ($pinjam->bidang_lab == 'LAB. TEKNIK PERTAMBANGAN') {
                        $data_kalab_tk_pertambangan = $kalab;
                        $kode_kalab_tk_pertambangan = 'Ditandatangani_Oleh_:_' . $kalab->nama_lengkap . '_|_No_surat_:_' . $get_kode;
                    }
                }
            }
        }

        $data = array(
            'nama' => $cek_status->nama_lengkap,
            'nim' => $cek_status->nim,
            'prodi' => $cek_status->prodi,
            'tgl_penerimaan' => date("d-m-Y"),
            'kode_permohonan' => $cek_status->kode_permohonan,

            'kode_kepala_upt' => $kode_kepala_upt,

            'kode_kalab_kimia' => $kode_kalab_kimia,
            'kode_kalab_fisika' => $kode_kalab_fisika,
            'kode_kalab_multimedia' => $kode_kalab_multimedia,
            'kode_kalab_biologi' => $kode_kalab_biologi,
            'kode_kalab_sains_atm' => $kode_kalab_sains_atm,
            'kode_kalab_farmasi' => $kode_kalab_farmasi,
            'kode_kalab_matematika' => $kode_kalab_matematika,
            'kode_kalab_aktuaria' => $kode_kalab_aktuaria,
            'kode_kalab_sains_ling' => $kode_kalab_sains_ling,
            'kode_kalab_tk_sipil' => $kode_kalab_tk_sipil,
            'kode_kalab_tk_geomatika' => $kode_kalab_tk_geomatika,
            'kode_kalab_tk_ling' => $kode_kalab_tk_ling,
            'kode_kalab_tk_laut' => $kode_kalab_tk_laut,
            'kode_kalab_studio_pwk' => $kode_kalab_studio_pwk,
            'kode_kalab_studio_ars' => $kode_kalab_studio_ars,
            'kode_kalab_studio_dkv' => $kode_kalab_studio_dkv,
            'kode_kalab_studio_ars_lans' => $kode_kalab_studio_ars_lans,
            'kode_kalab_tk_biosistem' => $kode_kalab_tk_biosistem,
            'kode_kalab_tk_kimia' => $kode_kalab_tk_kimia,
            'kode_kalab_tk_ind_tani' => $kode_kalab_tk_ind_tani,
            'kode_kalab_tk_pangan' => $kode_kalab_tk_pangan,
            'kode_kalab_rek_hutan' => $kode_kalab_rek_hutan,
            'kode_kalab_tk_elektro' => $kode_kalab_tk_elektro,
            'kode_kalab_tk_fisika' => $kode_kalab_tk_fisika,
            'kode_kalab_tk_sis_energi' => $kode_kalab_tk_sis_energi,
            'kode_kalab_tk_telkom' => $kode_kalab_tk_telkom,
            'kode_kalab_tk_biomedik' => $kode_kalab_tk_biomedik,
            'kode_kalab_tk_geologi' => $kode_kalab_tk_geologi,
            'kode_kalab_tk_geofisika' => $kode_kalab_tk_geofisika,
            'kode_kalab_tk_mesin' => $kode_kalab_tk_mesin,
            'kode_kalab_tk_industri' => $kode_kalab_tk_industri,
            'kode_kalab_tk_material' => $kode_kalab_tk_material,
            'kode_kalab_tk_pertambangan' => $kode_kalab_tk_pertambangan,

            'data_kalab_kimia' => $data_kalab_kimia,
            'data_kalab_fisika' => $data_kalab_fisika,
            'data_kalab_multimedia' => $data_kalab_multimedia,
            'data_kalab_biologi' => $data_kalab_biologi,
            'data_kalab_sains_atm' => $data_kalab_sains_atm,
            'data_kalab_farmasi' => $data_kalab_farmasi,
            'data_kalab_matematika' => $data_kalab_matematika,
            'data_kalab_aktuaria' => $data_kalab_aktuaria,
            'data_kalab_sains_ling' => $data_kalab_sains_ling,
            'data_kalab_tk_sipil' => $data_kalab_tk_sipil,
            'data_kalab_tk_geomatika' => $data_kalab_tk_geomatika,
            'data_kalab_tk_ling' => $data_kalab_tk_ling,
            'data_kalab_tk_laut' => $data_kalab_tk_laut,
            'data_kalab_studio_pwk' => $data_kalab_studio_pwk,
            'data_kalab_studio_ars' => $data_kalab_studio_ars,
            'data_kalab_studio_dkv' => $data_kalab_studio_dkv,
            'data_kalab_studio_ars_lans' => $data_kalab_studio_ars_lans,
            'data_kalab_tk_biosistem' => $data_kalab_tk_biosistem,
            'data_kalab_tk_kimia' => $data_kalab_tk_kimia,
            'data_kalab_tk_ind_tani' => $data_kalab_tk_ind_tani,
            'data_kalab_tk_pangan' => $data_kalab_tk_pangan,
            'data_kalab_rek_hutan' => $data_kalab_rek_hutan,
            'data_kalab_tk_elektro' => $data_kalab_tk_elektro,
            'data_kalab_tk_fisika' => $data_kalab_tk_fisika,
            'data_kalab_tk_sis_energi' => $data_kalab_tk_sis_energi,
            'data_kalab_tk_telkom' => $data_kalab_tk_telkom,
            'data_kalab_tk_biomedik' => $data_kalab_tk_biomedik,
            'data_kalab_tk_geologi' => $data_kalab_tk_geologi,
            'data_kalab_tk_geofisika' => $data_kalab_tk_geofisika,
            'data_kalab_tk_mesin' => $data_kalab_tk_mesin,
            'data_kalab_tk_industri' => $data_kalab_tk_industri,
            'data_kalab_tk_material' => $data_kalab_tk_material,
            'data_kalab_tk_pertambangan' => $data_kalab_tk_pertambangan,
        );
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = $this->load->view('form_bebas_lab', $data, true);;

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        $dompdf->render();

        $dompdf->stream('form_bebas_lab.pdf', array("Attachment" => false));

        exit(0);
    }

    public function form_bebas_lab($id)
    {
        $cek_status = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*, tb_bidang_lab.*, tb_prodi.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab', 'left')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi', 'left')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get()
            ->row();

        $get_kalab = $this->db->select('tb_validasi_kalab.*, tb_permohonan_bebas_lab.*, tb_user.*, tb_bidang_lab.*')
            ->from('tb_validasi_kalab')
            ->join('tb_permohonan_bebas_lab', 'tb_permohonan_bebas_lab.id_permohonan_bebas_lab=tb_validasi_kalab.id_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_validasi_kalab.id_kalab')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab')
            ->where('tb_permohonan_bebas_lab.id_permohonan_bebas_lab', $id)
            ->get();

        $cek_history_pinjam = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*, tb_bidang_lab.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
            ->where('tb_permohonan_pinjam_alat.id_user', $cek_status->id_user)
            ->where('tb_permohonan_pinjam_alat.status_track', "Telah dikembalikan")
            ->group_by('tb_bidang_lab.bidang_lab')
            ->get();
        


        $get_kode = substr($cek_status->kode_permohonan, 4, -7);
        foreach ($get_kalab->result() as $key => $row) {
            $str = 'Ditandatangani_Oleh_:_' . $row->nama_lengkap . '_|_No_surat_:_' . $get_kode;
            $kode_kalab[] = $str;
            $data_kalab[] = $row;
        }

        $kepala_upt     = $this->db->query("SELECT * FROM tb_user WHERE is_level='Kepala UPT Lab'")->row();
        $ttd_kepala_upt = 'Ditandatangani_Oleh_:_' . $kepala_upt->nama_lengkap . '_|_No_surat_:_' . $get_kode;
        
        $data = array(
            'nama'              => $cek_status->nama_lengkap,
            'nim'               => $cek_status->nim,
            'prodi'             => $cek_status->prodi,
            'tgl_penerimaan'    => date("d-m-Y"),
            'kode_permohonan'   => $cek_status->kode_permohonan,
            'kode_kalab'        => $kode_kalab,
            'data_kalab'        => $data_kalab,
            'kode_kepala_upt'   => $ttd_kepala_upt
        );

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = $this->load->view('form_bebas_lab', $data, true);;

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        $dompdf->render();

        $dompdf->stream('form_bebas_lab.pdf', array("Attachment" => false));

        exit(0);
    }

    public function qr($data)
    {
        return QRcode::png(
            $data,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }


    private function generate_code()
    {
        $get_kode = $this->db->select('tb_permohonan_bebas_lab.kode_permohonan')
            ->from('tb_permohonan_bebas_lab')
            ->get();

        if ($get_kode->num_rows() == 0) {
            return 'PBL-1-' . date("dmy");
        }

        if ($get_kode->num_rows() > 0) {
            $last = $this->db->select('tb_permohonan_bebas_lab.kode_permohonan')
                ->from('tb_permohonan_bebas_lab')
                ->order_by('id_permohonan_bebas_lab', "desc")
                ->limit(1)
                ->get()
                ->row();

            $get_kode = substr($last->kode_permohonan, 4, -7) + 1;

            return 'PBL-' . $get_kode . '-' . date("dmy");
        }
    }
}
