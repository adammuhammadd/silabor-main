<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pinjam_alat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('pesan_form', '<hr><div class="text-danger text-center"><b>Silahkan Login Terlebih Dahulu !</b></div><hr>');
            echo '<script>window.location.href="' . base_url('login') . '"</script>';
        }

        if ($this->session->userdata('level') != 'Dosen') {
            echo '<script>window.location.href="' . base_url(strtolower($this->session->userdata('level'))) . '/home"</script>';
        }
    }

    public function index()
    {
        $alat_dipinjam = $this->db->query('SELECT tb_alat.*, tb_pinjam.status, tb_bidang_lab.*,
                                                tb_alat.jumlah_alat - SUM(COALESCE(CASE WHEN tb_pinjam.status = "Telah dikembalikan" THEN 0
                                                                                        WHEN tb_pinjam.status = "Ditolak" then 0
                                                                                        else tb_pinjam.jml_alat END, 0)) as jumlah_alat_sisa
                                            FROM tb_alat
                                            LEFT JOIN tb_pinjam ON tb_pinjam.id_alat=tb_alat.id_alat
                                            LEFT JOIN tb_bidang_lab ON tb_bidang_lab.id_bidang_lab=tb_alat.id_bidang_lab
                                            GROUP BY tb_alat.id_alat');

        $data = array(
            'data' => $alat_dipinjam->result(),
            'page' => 'dosen/pinjam_alat/index',
            'link' => 'dosen/pinjam_alat',
            'script' => 'dosen/pinjam_alat/script'
        );

        $this->load->view('template_viho/wrapper', $data);
    }

    public function ajukan()
    {
        $data = json_decode($this->input->post('data'));

        $data_pinjam = array();

        $cek_mohon_alat = $this->db->select('tb_permohonan_pinjam_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->where('tb_permohonan_pinjam_alat.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_pinjam_alat.status', 'Belum diizinkan')
            ->get();

        $cek_mohon_lab =  $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_bebas_lab.status', 'Belum diizinkan')
            ->get();

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

        $cek_pernah_bebas_lab = $this->db->select('tb_permohonan_bebas_lab.*')
            ->from('tb_permohonan_bebas_lab')
            ->where('tb_permohonan_bebas_lab.id_user', $this->session->userdata('id_user'))
            ->where('tb_permohonan_bebas_lab.status', 'Diizinkan')
            ->get();

        if ($cek_pernah_bebas_lab->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger">Anda sudah pernah mengambil bebas lab, tidak bisa meminjam alat !</div>'
            );
            echo json_encode($return);
            exit();
        }

        if ($cek_peminjaman1->num_rows() > 0 || $cek_peminjaman2->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"> Harap mengembalikan alat sebelum meminjam kembali !</div>'
            );
            echo json_encode($return);
            exit();
        }

        if ($cek_mohon_alat->num_rows() > 0 || $cek_mohon_lab->num_rows() > 0) {
            $return = array(
                'status' => 'failed',
                'text' => '<div class="alert alert-danger"> Anda masih memiliki permohonan yang belum diproses !</div>'
            );
            echo json_encode($return);
            exit();
        }

        $this->db->trans_begin();
        $data_permohonan = array(
            "kode_pinjam" => $this->generate_code(),
            "id_user" => (int)$this->session->userdata('id_user'),
            "status" => "Belum diizinkan",
            "date_created" => date("Y-m-d H:i:s")
        );

        $this->db->insert('tb_permohonan_pinjam_alat', $data_permohonan);
        $id_permohonan = $this->db->insert_id();

        foreach ($data as $item) {
            $data_pinjam[] = array(
                "id_permohonan_pinjam_alat" => (int)$id_permohonan,
                "id_alat" => (int)$item->id_alat,
                "jml_alat" => (int)$item->jml_alat,
                "status" => "Sedang diajukan",
                "date_created" => date("Y-m-d H:i:s")
            );
        }

        $this->db->insert_batch('tb_pinjam', $data_pinjam);

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

    public function form_pinjam_alat($id)
    {
        $cek_status = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*, tb_prodi.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_user.id_prodi', 'left')
            ->where('tb_permohonan_pinjam_alat.status_track', 'Belum diambil')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get()
            ->row();

        $list_alat = $this->db->select('tb_permohonan_pinjam_alat.*, tb_pinjam.*, tb_alat.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_pinjam', 'tb_pinjam.id_permohonan_pinjam_alat=tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat')
            ->join('tb_alat', 'tb_alat.id_alat=tb_pinjam.id_alat')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get();

        $get_kode_1 = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_user')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get()
            ->row();

        $get_kode_2 = $this->db->select('tb_permohonan_pinjam_alat.*, tb_user.*')
            ->from('tb_permohonan_pinjam_alat')
            ->join('tb_user', 'tb_user.id_user=tb_permohonan_pinjam_alat.id_kepala_upt_lab')
            ->where('tb_permohonan_pinjam_alat.id_permohonan_pinjam_alat', $id)
            ->get()
            ->row();

        $kode_1 = 'Ditandatangani_Oleh_:_' . $get_kode_1->nama_lengkap . '_|_' . date("d-m-Y", strtotime($get_kode_1->date_created));
        $kode_2 = 'Ditandatangani_Oleh_:_' . $get_kode_2->nama_lengkap . '_|_' . date("d-m-Y", strtotime($get_kode_2->date_created));

        $data = array(
            'nama' => $cek_status->nama_lengkap,
            'nim' => $cek_status->nim,
            'prodi' => $cek_status->prodi,
            'kode_1' => $kode_1,
            'kode_2' => $kode_2,
            'list_data' => $list_alat->result()
        );

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = $this->load->view('form_pinjam_alat', $data, true);;

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        $dompdf->render();

        $dompdf->stream('form_pinjam_alat.pdf', array("Attachment" => false));

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
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randstring = '';

        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, 35)];
        }

        return 'PAL-' . $randstring . '-' . date("dmY");
    }
}
