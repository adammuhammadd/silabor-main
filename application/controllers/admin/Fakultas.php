<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas extends CI_Controller
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
        $fakultas = $this->db->get('tb_fakultas');

        $data = array(
            'data' => $fakultas->result(),
			'page' => 'admin/fakultas/index',
			'link' => 'admin/fakultas',
			'script' => 'admin/fakultas/script'
		);
		$this->load->view('template_viho/wrapper', $data);
    }

    public function store()
    {
        $fakultas = $this->input->post('fakultas');

        //cek berdasarkan nama bidang lab
        $cek = $this->db->get_where('tb_fakultas', array('fakultas' => $fakultas));
        if ($cek->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">' . $fakultas . ' sudah ada !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'fakultas' => $fakultas,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_fakultas', $data_to_save);

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
        $id = $this->input->post('id_fakultas');
        $fakultas = $this->input->post('fakultas');

        //cek berdasarkan nama bidang lab
        $cek = $this->db->get_where('tb_fakultas', array('fakultas' => $fakultas));
        if ($cek->num_rows() > 0) {
            if (md5($cek->row()->id_fakultas) != $id) {

                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">' . $fakultas . ' sudah ada !</div>'
                );
                echo json_encode($return);
                exit();
            }
        }

        $this->db->trans_begin();
        $data_to_save = array(
            'fakultas' => $fakultas,
            'date_modified' => date('Y-m-d H:i:s'),
        );

        $this->db->update('tb_fakultas', $data_to_save, array('md5(id_fakultas)' => $id));

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
        $id_fakultas = $this->input->post('id', true);

        $this->db->delete('tb_fakultas', array('md5(id_fakultas)' => $id_fakultas));
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
        $query = $this->db->get_where('tb_fakultas', array('md5(id_fakultas)' => $id));
        echo json_encode($query->row());
    }

}
