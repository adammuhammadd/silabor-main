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

            <li><a class="nav-link menu-title link-nav <?php if (@$link == 'dosen/home') {
                                                          echo 'active';
                                                        } ?>" href="<?= base_url() ?>dosen/home"><i data-feather="home"></i><span>Dashboard</span></a></li>


            <li><a class="nav-link menu-title link-nav <?php if (@$link == 'dosen/pinjam_alat') {
                                                          echo 'active';
                                                        } ?>" href="<?= base_url() ?>dosen/pinjam_alat"><i class="fa fa-wrench" style="padding-right: 17px;"></i><span>Pinjam Alat</span></a></li>

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