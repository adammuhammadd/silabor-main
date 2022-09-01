<!-- Page Body Start-->
<div class="page-body-wrapper sidebar-icon">
  <!-- Page Sidebar Start-->
  <header class="main-nav">
    <nav>
      <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">
          <ul class="nav-menu custom-scrollbar">

            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>

            <li><a class="nav-link menu-title link-nav <?php if (@$link == 'admin/home') {
                                                          echo 'active';
                                                        } ?>" href="<?= base_url() ?>admin/home"><i data-feather="home"></i><span>Dashboard</span></a></li>

            <li class="dropdown"><a class="nav-link menu-title <?php if (@$link == 'admin/alat_lab' || @$link == 'admin/bidang_lab' || @$link == 'admin/fakultas' || @$link == 'admin/prodi' || @$link == 'admin/user') {
                                                                  echo 'active';
                                                                } ?>" href="javascript:void(0)"><i data-feather="book-open"></i><span>Data Master</span></a>
              <ul class="nav-submenu menu-content" style="display: <?php if (@$link == 'admin/alat_lab' || @$link == 'admin/bidang_lab' || @$link == 'admin/fakultas' || @$link == 'admin/prodi' || @$link == 'admin/user') {
                                                                      echo 'block';
                                                                    } else {
                                                                      echo 'none';
                                                                    } ?>">
                <li><a href="<?= base_url() ?>admin/alat_lab" class="<?php if (@$link == 'admin/alat_lab') {
                                                                        echo 'active';
                                                                      } ?>">Alat Lab</a></li>
                <li><a href="<?= base_url() ?>admin/fakultas" class="<?php if (@$link == 'admin/fakultas') {
                                                                        echo 'active';
                                                                      } ?>">Fakultas</a></li>
                <li><a href="<?= base_url() ?>admin/prodi" class="<?php if (@$link == 'admin/prodi') {
                                                                    echo 'active';
                                                                  } ?>">Prodi</a></li>
                <li><a href="<?= base_url() ?>admin/bidang_lab" class="<?php if (@$link == 'admin/bidang_lab') {
                                                                          echo 'active';
                                                                        } ?>">Bidang Lab</a></li>
                <li><a href="<?= base_url() ?>admin/user" class="<?php if (@$link == 'admin/user') {
                                                                    echo 'active';
                                                                  } ?>">User</a></li>
              </ul>
            </li>


            <li><a class="nav-link menu-title link-nav <?php if (@$link == 'admin/history') {
                                                          echo 'active';
                                                        } ?>" href="<?= base_url() ?>admin/history"><i data-feather="list"></i><span>History</span></a></li>



            <li><a class="nav-link menu-title link-nav" href="<?= base_url() ?>home/logout"><i data-feather="log-out"></i><span>Log Out</span></a></li>

          </ul>
        </div>
        <div id="bottom" class="d-flex flex-column justify-content-center align-items-center bg-primary p-3">
          <div class="h5 m-0"><?= $this->session->userdata('nama_lengkap') ?></div>
          <div><?= $this->session->userdata('level') ?></div>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </div>
    </nav>
  </header>