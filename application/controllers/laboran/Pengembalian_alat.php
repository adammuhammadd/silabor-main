<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_alat extends CI_Controller
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
        $pengembalian = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->get();

        $data = array(
            'pengembalian' => $pengembalian,
            'page' => 'laboran/pengembalian_alat/index',
            'link' => 'laboran/pengembalian_alat',
            'script' => 'laboran/pengembalian_alat/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function detail($id)
    {
        //cek apakah sedang ada permohonan pinjam alat
        $pengembalian_alat = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*, tb_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->get();

        $user = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->where('tb_permohonan_pinjam_alat.status_track', 'Sudah diambil')
            ->where('tb_permohonan_pinjam_alat.status', 'Diizinkan')
            ->get();

        if ($user->num_rows() == 0) {
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
            exit();
        }

        $data = array(
            'data' => $pengembalian_alat->result(),
            'user' => $user->row(),
            'page' => 'laboran/pengembalian_alat/detail/index',
            'link' => 'laboran/pengembalian_alat',
            'script' => 'laboran/pengembalian_alat/detail/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function dikembalikan()
    {
        $id_permohonan = $this->input->post('id_permohonan');
        $data = $this->input->post('data');

        $this->db->trans_begin();

        foreach ($data as $list_data) {
            $data_to_save = array(
                'status' => 'Telah dikembalikan',
                'kondisi_akhir' => $list_data['kondisi'],
            );

            $this->db->update('tb_pinjam', $data_to_save, array('id_pinjam' => $list_data['id_pinjam']));
        }

        $data_to_save2 = array(
            'tgl_pengembalian' => date('Y-m-d'),
            'status_track' => 'Telah dikembalikan',
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
