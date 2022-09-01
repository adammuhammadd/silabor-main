<?php
    include 'header.php';
    include 'navbar.php';
    if ($this->session->userdata('level') == "Admin") {
        include 'sidebar_admin.php';
    } else if ($this->session->userdata('level') == 'Mahasiswa') {
        include 'sidebar_mahasiswa.php';
    } else if ($this->session->userdata('level') == 'Laboran') {
        include 'sidebar_laboran.php';
    } else if ($this->session->userdata('level') == 'Kepala_Lab') {
        include 'sidebar_kepala_lab.php';
    } else if ($this->session->userdata('level') == 'Kepala_UPT_Lab') {
        include 'sidebar_kepala_upt_lab.php';
    } else if ($this->session->userdata('level') == 'Dosen') {
        include 'sidebar_dosen.php';
    }
    include 'content.php';
	include 'footer.php';
