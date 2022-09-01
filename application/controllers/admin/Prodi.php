<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
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
        $this->db->select('tb_prodi.*, tb_fakultas.*')
            ->from('tb_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas');
        $prodi = $this->db->get();

        $fakultas = $this->db->get('tb_fakultas');

        $data = array(
            'fakultas' => $fakultas->result(),
            'data' => $prodi->result(),
            'page' => 'admin/prodi/index',
            'link' => 'admin/prodi',
            'script' => 'admin/prodi/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function store()
    {
        $id_fakultas = $this->input->post('fakultas');
        $prodi = $this->input->post('prodi');

        //cek berdasarkan nama bidang lab
        $this->db->select('tb_prodi.*, tb_fakultas.*')
            ->from('tb_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas')
            ->where('tb_prodi.prodi', $prodi)
            ->where('tb_fakultas.id_fakultas', $id_fakultas);
        $cek = $this->db->get();

        if ($cek->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Prodi ' . $cek->row()->prodi . ' pada Fakultas ' . $cek->row()->fakultas . ' sudah ada !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'id_fakultas' => $id_fakultas,
            'prodi' => $prodi,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_prodi', $data_to_save);

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
        $id = $this->input->post('id_prodi');

        $id_fakultas = $this->input->post('fakultas');
        $prodi = $this->input->post('prodi');

        //cek berdasarkan nama bidang lab
        $this->db->select('tb_prodi.*, tb_fakultas.*')
            ->from('tb_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas')
            ->where('tb_prodi.prodi', $prodi)
            ->where('tb_fakultas.id_fakultas', $id_fakultas);
        $cek = $this->db->get();

        if ($cek->num_rows() > 0) {
            if (md5($cek->row()->id_prodi) != $id) {

                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">Prodi ' . $cek->row()->prodi . ' pada Fakultas ' . $cek->row()->fakultas . ' sudah ada !</div>'
                );
                echo json_encode($return);
                exit();
            }
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'id_fakultas' => $id_fakultas,
            'prodi' => $prodi,
            'date_modified' => date('Y-m-d H:i:s'),
        );

        $this->db->update('tb_prodi', $data_to_save, array('md5(id_prodi)' => $id));

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
        $id_prodi = $this->input->post('id', true);

        $this->db->delete('tb_prodi', array('md5(id_prodi)' => $id_prodi));
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

    public function get_id()
    {
        $id = $this->input->post('id');

        $this->db->select('tb_prodi.*, tb_fakultas.*')
            ->from('tb_prodi')
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas=tb_prodi.id_fakultas')
            ->where('md5(tb_prodi.id_prodi)', $id);

        $query = $this->db->get();
        echo json_encode($query->row());
    }
}
