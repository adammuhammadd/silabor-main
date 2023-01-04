<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alat_lab extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Silahkan Login Terlebih Dahulu !</b></div><hr>');
            echo '<script>window.location.href="' . base_url('home') . '";</script>';
        }

        if ($this->session->userdata('level') != 'Laboran') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . 'home";</script>';
        }
    }

    public function index()
    {
        $query = $this->db->select('tb_alat.*, tb_bidang_lab.*')
            ->from('tb_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
            ->get();

        $bidang_lab = $this->db->get('tb_bidang_lab');

        $data = array(
            'data' => $query->result(),
            'bidang_lab' => $bidang_lab->result(),
            'page' => 'laboran/alat_lab/index',
            'link' => 'laboran/alat_lab',
            'script' => 'laboran/alat_lab/script'
        );
        $this->load->view('template_viho/wrapper', $data);
    }

    public function store()
    {
        $nama_alat = $this->input->post('nama_alat');
        $jumlah_alat = $this->input->post('jumlah_alat');
        $id_bidang_lab = $this->input->post('bidang_lab');

        $this->load->library('upload');

        //cek berdasarkan nama alat
        $cek = $this->db->select('tb_alat.*, tb_bidang_lab.*')
            ->from('tb_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
            ->where('tb_alat.nama_alat', $nama_alat)
            ->where('tb_alat.id_bidang_lab', $id_bidang_lab)
            ->get();

        // $cek = $this->db->get_where('tb_alat', array('nama_alat' => $nama_alat));
        if ($cek->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">' . $cek->row()->nama_alat . ' pada lab ' . $cek->row()->bidang_lab . ' sudah ada !</div>'
            );
            echo json_encode($return);
            exit();
        }

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

        $config['upload_path'] = './upload/alat/';
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
            'id_bidang_lab' => $id_bidang_lab,
            'nama_alat' => $nama_alat,
            'gambar' => $nama_file,
            'jumlah_alat' => $jumlah_alat,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $simpan = $this->db->insert('tb_alat', $data_to_save);

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
        $id = $this->input->post('id_alat');
        $id_bidang_lab = $this->input->post('bidang_lab');
        $nama_alat = $this->input->post('nama_alat');
        $jumlah_alat = $this->input->post('jumlah_alat');

        $this->load->library('upload');
        $cek = $this->db->select('tb_alat.*, tb_bidang_lab.*')
            ->from('tb_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab')
            ->where('tb_alat.nama_alat', $nama_alat)
            ->where('tb_alat.id_bidang_lab', $id_bidang_lab)
            ->get();

        if ($cek->num_rows() > 0) {
            if ($cek->row()->id_alat != $id) {

                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">' . $cek->row()->nama_alat . ' pada lab ' . $cek->row()->bidang_lab . ' sudah ada !</div>'
                );
                echo json_encode($return);
                exit();
            }
        }

        //cek apakah gambar tidak ada
        if (!empty($_FILES['gambar']['name'])) {
            //cek ukuran gambar(2 MB)
            if ($_FILES['gambar']['size'] > 2048000) {
                $return = array(
                    'status' => 'failed',
                    'text' => '<div class="alert alert-danger">Ukuran Foto Terlalu Besar (Max 2MB) !</div>'
                );
                echo json_encode($return);
                exit();
            }

            $config['upload_path'] = './upload/alat/';
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
                'id_bidang_lab' => $id_bidang_lab,
                'nama_alat' => $nama_alat,
                'gambar' => $nama_file,
                'jumlah_alat' => $jumlah_alat,
                'date_modified' => date('Y-m-d H:i:s'),
            );
        } else {
            $this->db->trans_begin();
            $data_to_save = array(
                'id_bidang_lab' => $id_bidang_lab,
                'nama_alat' => $nama_alat,
                'jumlah_alat' => $jumlah_alat,
                'date_modified' => date('Y-m-d H:i:s'),
            );
        }

        $this->db->update('tb_alat', $data_to_save, array('id_alat' => $id));

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
        $id_alat = $this->input->post('id', true);
        $hapus = $this->db->delete('tb_alat', array('id_alat' => $id_alat));
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


    public function get_bidang_lab()
    {
        $id = $this->input->post('id');

        $query = $this->db->select('tb_bidang_lab.*')
            ->from('tb_bidang_lab')
            ->where('tb_bidang_lab.id_prodi', $id)
            ->get();

        echo json_encode($query->result());
    }

    public function get_id()
    {
        $id = $this->input->post('id');

        $query = $this->db->select('tb_alat.*, tb_bidang_lab.*')
            ->from('tb_alat')
            ->join('tb_bidang_lab', 'tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab', 'left')
            ->where('tb_alat.id_alat', $id)
            ->get();

        echo json_encode($query->row());
    }
}
