<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $user = $this->db->select('tb_user.*, tb_fakultas.*, tb_prodi.*, tb_bidang_lab.*')
            ->from('tb_user')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab', 'left')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi', 'left')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas', 'left')
            ->get();

        $bidang_lab = $this->db->get('tb_bidang_lab');
        $fakultas = $this->db->get('tb_fakultas');
        $prodi = $this->db->get('tb_prodi');

        $data = array(
            'data' => $user->result(),
            'bidang_lab' => $bidang_lab->result(),
            'fakultas' => $fakultas->result(),
            'prodi' => $prodi->result(),
            'page' => 'admin/user/index',
            'link' => 'admin/user',
            'script' => 'admin/user/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function store()
    {
        $nama_lengkap = $this->input->post('nama_lengkap');
        $id_bidang_lab = $this->input->post('bidang_lab');
        $id_prodi = $this->input->post('prodi');
        $nim = $this->input->post('nim');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenkel = $this->input->post('jenkel');
        $level = $this->input->post('level');

        //cek berdasarkan nim
        $cek = $this->db->select('tb_user.*')
            ->from('tb_user')
            ->where('tb_user.nim', $nim)
            ->get();

        if ($cek->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">' . $cek->row()->nim . ' telah terdaftar !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'nama_lengkap' => $nama_lengkap,
            'id_bidang_lab' => $id_bidang_lab,
            'id_prodi' => $id_prodi,
            'nim' => $nim,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'alamat' => $alamat,
            'tgl_lahir' => $tgl_lahir,
            'jenkel' => $jenkel,
            'is_level' => $level,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_user', $data_to_save);

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

    public function update()
    {
        $id = $this->input->post('id_user');

        $nama_lengkap = $this->input->post('nama_lengkap');
        $id_bidang_lab = $this->input->post('bidang_lab');
        $id_prodi = $this->input->post('prodi');
        $nim = $this->input->post('nim');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenkel = $this->input->post('jenkel');
        $level = $this->input->post('level');

        //cek berdasarkan nim
        $cek = $this->db->select('tb_user.*')
            ->from('tb_user')
            ->where('tb_user.nim', $nim)
            ->get();

        if ($cek->num_rows() > 0) {
            if ($cek->row()->id_user != $id) {

                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">NIM (' . $cek->row()->nim . ') telah terdaftar !</div>'
                );
                echo json_encode($return);
                exit();
            }
        }

        $this->db->trans_begin();

        if ($password == null) {
            $data_to_save = array(
                'nama_lengkap' => $nama_lengkap,
                'id_bidang_lab' => $id_bidang_lab,
                'id_prodi' => $id_prodi,
                'nim' => $nim,
                'email' => $email,
                'alamat' => $alamat,
                'tgl_lahir' => $tgl_lahir,
                'jenkel' => $jenkel,
                'is_level' => $level,
                'date_created' => date('Y-m-d H:i:s'),
            );
        } else {
            $data_to_save = array(
                'nama_lengkap' => $nama_lengkap,
                'id_bidang_lab' => $id_bidang_lab,
                'id_prodi' => $id_prodi,
                'nim' => $nim,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'alamat' => $alamat,
                'tgl_lahir' => $tgl_lahir,
                'jenkel' => $jenkel,
                'is_level' => $level,
                'date_created' => date('Y-m-d H:i:s'),
            );
        }

        $this->db->update('tb_user', $data_to_save, array('id_user' => $id));

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

    public function delete()
    {
        $this->db->trans_begin();
        $id_user = $this->input->post('id', true);

        $this->db->delete('tb_user', array('id_user' => $id_user));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Data gagal dihapus</div>'
            );
            echo json_encode($return);
        } else {
            $this->db->trans_commit();
            $return = array(
                'status' => 'success',
                'text' => '<div class="alert alert-success">Data berhasil dihapus</div>'
            );
            echo json_encode($return);
        }
    }

    public function get_prodi()
    {
        $id = $this->input->post('id');

        $query = $this->db->select('tb_prodi.*')
            ->from('tb_prodi')
            ->where('tb_prodi.id_fakultas', $id)
            ->get();

        echo json_encode($query->result());
    }

    public function get_bidang_lab()
    {
        $id = $this->input->post('id');

        $query = $this->db->get('tb_bidang_lab');
        echo json_encode($query->result());
    }

    public function get_id()
    {
        $id = $this->input->post('id');

        $query = $this->db->select('tb_user.*, tb_bidang_lab.*, tb_fakultas.*, tb_prodi.*')
            ->from('tb_user')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_user.id_bidang_lab', 'left')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi', 'left')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas', 'left')
            ->where('tb_user.id_user', $id)
            ->get();

        echo json_encode($query->row());
    }
}
