<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengambilan_alat extends CI_Controller
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
        
        $pengambilan = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*, tb_pinjam.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_pinjam.status', 'Belum diambil')
            ->where('tb_pinjam.id_bidang_lab',$id_bidang_lab)
            ->group_by('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->get();

        $data = array(
            'pengambilan' => $pengambilan,
            'page' => 'laboran/pengambilan_alat/index',
            'link' => 'laboran/pengambilan_alat',
            'script' => 'laboran/pengambilan_alat/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function detail($id)
    {
        //cek apakah sedang ada permohonan pinjam alat
        $id_bidang_lab = $this->session->userdata('id_bidang_lab');
        $cek_mohon_ambil_alat = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*, tb_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_pinjam.status', 'Belum diambil')
            ->where('tb_pinjam.id_bidang_lab',$id_bidang_lab)
            ->get();

        // $user = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
        //     ->from('tb_permohonan_pinjam_alat')
        //     ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
        //     ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
        //     ->where('tb_permohonan_pinjam_alat.status_track', 'Belum diambil')
        //     ->where('tb_permohonan_pinjam_alat.status', 'Diizinkan')
        //     ->get();
        
        $user = $this->db->query("SELECT a.*,b.* FROM tb_user a LEFT JOIN tb_permohonan_pinjam_alat b ON a.id_user = b.id_user LEFT JOIN tb_pinjam c ON c.id_permohonan_pinjam_alat = b.id_permohonan_pinjam_alat WHERE c.id_bidang_lab ='$id_bidang_lab' AND c.status='Belum diambil'");

        // echo '<pre>';print_r($user->result());exit;
        

        if ($user->num_rows() == 0) {
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
            exit();
        }

        $data = array(
            'data' => $cek_mohon_ambil_alat->result(),
            'user' => $user->row(),
            'page' => 'laboran/pengambilan_alat/detail/index',
            'link' => 'laboran/pengambilan_alat',
            'script' => 'laboran/pengambilan_alat/detail/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function diambil()
    {
        $id_permohonan = $this->input->post('id_permohonan');
        $id_bidang_lab = $this->session->userdata('id_bidang_lab');

        $data = $this->db->select('tb_pinjam.*, tb_permohonan_pinjam_alat.*')
            ->from('tb_pinjam')
            ->join('tb_permohonan_pinjam_alat', 'tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat=tb_pinjam.id_permohonan_pinjam_alat')
            ->where('tb_pinjam.id_permohonan_pinjam_alat', $id_permohonan)
            ->where('tb_pinjam.id_bidang_lab', $id_bidang_lab)
            ->where('tb_pinjam.status','Belum diambil')
            ->get();

        $this->db->trans_begin();

        foreach ($data->result() as $list_data) {
            $data_to_save = array(
                'status' => 'Sedang dipinjam',
            );

            $this->db->update('tb_pinjam', $data_to_save, array('id_pinjam' => $list_data->id_pinjam));
        }
        
        // check apabila sisa 1, maka tb_permohonan_pinjam_alat dijadikan diizinkan
        $check = $this->db->query("SELECT * FROM tb_pinjam WHERE id_permohonan_pinjam_alat = '$id_permohonan' AND status = 'Belum diambil' ")->result();

        if(count($check) == '0'){
            $data_to_save2 = array(
                'tgl_peminjaman' => date('Y-m-d'),
                'status_track' => 'Sudah diambil',
            );
        }else {
            $data_to_save2 = array(
                'tgl_peminjaman' => date('Y-m-d'),
                'status_track' => 'Belum diambil',
            );
        }

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
