<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang_lab extends CI_Controller
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
        $bidang_lab = $this->db->select('tb_bidang_lab.*')
            ->from('tb_bidang_lab')
            ->get();

        $data = array(
            'data' => $bidang_lab->result(),
            'page' => 'admin/bidang_lab/index',
            'link' => 'admin/bidang_lab',
            'script' => 'admin/bidang_lab/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function store()
    {
        $bidang_lab = $this->input->post('bidang_lab');

        //cek berdasarkan nama bidang lab
        $cek = $this->db->select('tb_bidang_lab.*')
            ->from('tb_bidang_lab')
            ->where('tb_bidang_lab.bidang_lab', $bidang_lab)
            ->get();

        if ($cek->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Bidang lab (' . $bidang_lab . ') sudah ada !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'bidang_lab' => $bidang_lab,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_bidang_lab', $data_to_save);

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
        $id = $this->input->post('id_bidang_lab');

        $bidang_lab = $this->input->post('bidang_lab');

        //cek berdasarkan nama bidang lab
        $cek = $this->db->select('tb_bidang_lab.*')
            ->from('tb_bidang_lab')
            ->where('tb_bidang_lab.bidang_lab', $bidang_lab)
            ->get();

        if ($cek->num_rows() > 0) {
            if ($cek->row()->id_bidang_lab != $id) {

                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">Bidang Lab (' . $bidang_lab . ') sudah ada !</div>'
                );
                echo json_encode($return);
                exit();
            }
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'bidang_lab' => $bidang_lab,
            'date_modified' => date('Y-m-d H:i:s'),
        );

        $this->db->update('tb_bidang_lab', $data_to_save, array('id_bidang_lab' => $id));

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
        $id_bidang_lab = $this->input->post('id', true);

        $this->db->delete('tb_bidang_lab', array('id_bidang_lab' => $id_bidang_lab));
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

        $query = $this->db->select('tb_bidang_lab.*')
            ->from('tb_bidang_lab')
            ->where('tb_bidang_lab.id_bidang_lab', $id)
            ->get();

        echo json_encode($query->row());
    }
}
