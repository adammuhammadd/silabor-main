  <!-- footer start-->
  <footer class="footer text-center">
    <div class="container-fluid">
      <div class="footer-copyright">
        <p class="mb-0" style="color: #434142;">&copy; Copyright 2022 <strong><span>SILABOR - ITERA.</span></strong>
      </div>
    </div>
  </footer>
  </div>
  </div>

  <!-- latest jquery-->
  <script src="<?= base_url() ?>assets_viho/assets/js/jquery-3.5.1.min.js"></script>

  <!-- feather icon js-->
  <script src="<?= base_url() ?>assets_viho/assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/icons/feather-icon/feather-icon.js"></script>

  <!-- Sidebar jquery-->
  <script src="<?= base_url() ?>assets_viho/assets/js/sidebar-menu.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/config.js"></script>

  <!-- Bootstrap js-->
  <script src="<?= base_url() ?>assets_viho/assets/js/bootstrap/popper.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/bootstrap/bootstrap.min.js"></script>


  <!-- Plugins JS start-->
  <script src="<?= base_url() ?>assets_viho/assets/js/select2/select2.full.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/select2/select2-custom.js"></script>

  <script src="<?= base_url() ?>assets_viho/assets/js/tooltip-init.js"></script>
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/chart/chartjs/chart.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/chart/chartist/chartist.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script> -->
  <script src="<?= base_url() ?>assets_viho/assets/js/chart/knob/knob.min.js"></script>
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/chart/knob/knob-chart.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/chart/apex-chart/apex-chart.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/chart/apex-chart/stock-prices.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/prism/prism.min.js"></script> -->
  <script src="<?= base_url() ?>assets_viho/assets/js/clipboard/clipboard.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/counter/jquery.waypoints.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/counter/jquery.counterup.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/counter/counter-custom.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/custom-card/custom-card.js"></script>
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/notify/bootstrap-notify.min.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-au-mill.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
<script src="<?= base_url() ?>assets_viho/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/dashboard/default.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/notify/index.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/datepicker/date-picker/datepicker.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/datepicker/date-picker/datepicker.en.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/datepicker/date-picker/datepicker.custom.js"></script> -->

  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/owlcarousel/owl.carousel.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/owlcarousel/owl-custom.js"></script> -->
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/dashboard/dashboard_2.js"></script> -->
  <!-- Plugins JS Ends-->

  <!-- Theme js-->
  <script src="<?= base_url() ?>assets_viho/assets/js/script.js"></script>
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/theme-customizer/customizer.js"></script> -->

  <!-- login js-->
  <!-- Plugin used-->
  <script src="<?= base_url() ?>assets_viho/assets/js/datepicker/date-picker/datepicker.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/datepicker/date-picker/datepicker.en.js"></script>

  <script src="<?= base_url() ?>assets_viho/assets/js/touchspin/touchspin.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/touchspin/input-groups.min.js"></script>
  <!-- <script src="<?= base_url() ?>assets_viho/assets/js/form-validation-custom.js"></script> -->

  <!-- Plugin Tabel -->
  <script src="<?= base_url() ?>assets_viho/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets_viho/assets/js/datatable/datatables/datatable.custom.js"></script>

  <!-- Page Specific JS File -->
  <?php
  if (!empty($script)) {
    $this->load->view($script);
  }
  ?>
  </body>

  </html>