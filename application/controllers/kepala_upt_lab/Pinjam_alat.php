<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam_alat extends CI_Controller
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
        //cek permohonan pinjam yang telah di approve laboran
        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status_laboran', 'Diizinkan')
            ->where('tb_permohonan_pinjam_alat.status_kepala_upt', 'Belum diizinkan')
            ->get();

        $data = array(
            'data' => $pinjam_alat->result(),
            'page' => 'kepala_upt_lab/pinjam_alat/index',
            'link' => 'kepala_upt_lab/pinjam_alat',
            'script' => 'kepala_upt_lab/pinjam_alat/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function detail($id)
    {
        //cek apakah sedang ada permohonan pinjam alat
        $cek_mohon_pinjam_alat = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*, tb_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->get();

        $user = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get();

        if ($user->row()->status == 'Diizinkan' || $user->row()->status == 'Tidak diizinkan') {
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
        }

        $data = array(
            'data' => $cek_mohon_pinjam_alat->result(),
            'user' => $user->row(),
            'page' => 'kepala_upt_lab/pinjam_alat/detail/index',
            'link' => 'kepala_upt_lab/pinjam_alat',
            'script' => 'kepala_upt_lab/pinjam_alat/detail/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function terima()
    {
        $id_permohonan = $this->input->post('id_permohonan');

        $data = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id_permohonan)
            ->get();

        $this->db->trans_begin();

        foreach ($data->result() as $list_data) {
            $data_to_save = array(
                'status' => 'Belum diambil',
            );

            $this->db->update('tb_pinjam', $data_to_save, array('id_pinjam' => $list_data->id_pinjam));
        }

        $data_to_save2 = array(
            'status_kepala_upt' => 'Diizinkan',
            'status' => 'Diizinkan',
            'status_track' => 'Belum diambil',
            'id_kepala_upt_lab' => $this->session->userdata('id_user')
        );
        $this->db->update('tb_permohonan_pinjam_alat', $data_to_save2, array('id_permohonan_pinjam_alat' => $id_permohonan));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
        } else {
            $this->db->trans_commit();
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
        }
    }

    public function tolak()
    {
        $id_permohonan = $this->input->post('id_permohonan');

        $data = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id_permohonan)
            ->get();

        $this->db->trans_begin();

        foreach ($data->result() as $list_data) {
            $data_to_save = array(
                'status' => 'Ditolak',
            );

            $this->db->update('tb_pinjam', $data_to_save, array('id_pinjam' => $list_data->id_pinjam));
        }

        $data_to_save2 = array(
            'status_kepala_upt' => 'Tidak diizinkan',
            'status' => 'Tidak diizinkan',
            'status_track' => 'Ditolak',
        );
        $this->db->update('tb_permohonan_pinjam_alat', $data_to_save2, array('id_permohonan_pinjam_alat' => $id_permohonan));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Data gagal disimpan</div>'
            );
            echo json_encode($return);
        } else {
            $this->db->trans_commit();
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success">Data berhasil disimpan</div>'
            );
            echo json_encode($return);
        }
    }
}
