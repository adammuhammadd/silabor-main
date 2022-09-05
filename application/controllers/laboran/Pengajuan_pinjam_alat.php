<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_pinjam_alat extends CI_Controller
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
        $id_bidang_lab = $this->session->userdata('id_bidang_lab');
        // $pengajuan = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
        //     ->from('tb_permohonan_pinjam_alat')
        //     ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
        //     ->where('tb_permohonan_pinjam_alat.status_laboran', 'Belum diizinkan')
        //     ->get();

        // $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
        //     ->from('tb_permohonan_pinjam_alat')
        //     ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
        //     ->where('tb_permohonan_pinjam_alat.status_laboran', 'Belum diizinkan')
        //     ->get();

        $pengajuan = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*, tb_pinjam.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            // ->where('tb_pinjam.kondisi_awal', 'IS NULL')
            ->where('tb_pinjam.kondisi_awal', (NULL))
            ->where('tb_pinjam.id_bidang_lab',$id_bidang_lab)
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();
        $pinjam_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*, tb_pinjam.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            // ->where('tb_permohonan_pinjam_alat.status_laboran', 'Belum diizinkan')
            ->where('tb_pinjam.kondisi_awal', (NULL))
            ->where('tb_pinjam.id_bidang_lab',$id_bidang_lab)
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*, tb_user.*')
            ->from('tb_permohonan_bebas_lab')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_bebas_lab.id_user')
            ->where('tb_permohonan_bebas_lab.status_kepala_lab', 'Belum diizinkan')
            ->get();

        $data = array(
            'pinjam_alat' => $pinjam_alat,
            'pengajuan' => $pengajuan,
            'bebas_lab' => $bebas_lab,
            'page' => 'laboran/pengajuan_pinjam_alat/index',
            'link' => 'laboran/pengajuan_pinjam_alat',
            'script' => 'laboran/pengajuan_pinjam_alat/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function detail($id)
    {
        //cek apakah sedang ada permohonan pinjam alat
        $id_bidang_lab = $this->session->userdata('id_bidang_lab');

        $cek_mohon_pinjam_alat = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*, tb_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->where('tb_pinjam.kondisi_awal', (NULL))
            ->where('tb_pinjam.id_bidang_lab',$id_bidang_lab)
            ->get();

        $user = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get();

        if ($user->row()->status_laboran == 'Diizinkan') {
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
        }

        $data = array(
            'data' => $cek_mohon_pinjam_alat->result(),
            'user' => $user->row(),
            'page' => 'laboran/pengajuan_pinjam_alat/detail/index',
            'link' => 'laboran/pengajuan_pinjam_alat',
            'script' => 'laboran/pengajuan_pinjam_alat/detail/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function terima()
    {
        $id_permohonan = $this->input->post('id_permohonan');
        $data = $this->input->post('data');

        $this->db->trans_begin();

        foreach ($data as $list_data) {
            $data_to_save = array(
                'kondisi_awal' => $list_data['kondisi'],
            );

            $this->db->update('tb_pinjam', $data_to_save, array('id_pinjam' => $list_data['id_pinjam']));
        }

        // check apabila sisa 1, maka tb_permohonan_pinjam_alat dijadikan diizinkan
        $check = $this->db->query("SELECT * FROM tb_pinjam WHERE id_permohonan_pinjam_alat = '$id_permohonan' AND kondisi_awal = (NULL)")->result();
        // if(!empty($check)){
            if(count($check) == '0'){
                $data_to_save2 = array(
                    'id_laboran' => $this->session->userdata('id_user'),
                    'status_laboran' => 'Diizinkan',
                );
            }else {
                $data_to_save2 = array(
                    'id_laboran' => $this->session->userdata('id_user'),
                    'status_laboran' => 'Belum diizinkan',
                );
            }
        // }

        // $data_to_save2 = array(
        //     'id_laboran' => $this->session->userdata('id_user'),
        //     'status_laboran' => 'Diizinkan',
        // );
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
        $this->db->trans_begin();
        $id = $this->input->post('id');

        $this->db->delete('tb_pinjam', array('id_permohonan_pinjam_alat' => $id));
        $this->db->delete('tb_permohonan_pinjam_alat', array('id_permohonan_pinjam_alat' => $id));
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
}
