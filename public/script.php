<!-- jQuery -->
<script src="../../../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="../../../public/plugins/select2/js/select2.full.min.js"></script>

<!-- bs-custom-file-input -->
<script src="../../../public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../public/plugins/jszip/jszip.min.js"></script>
<script src="../../../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="../../../public/dist/js/adminlte.min.js"></script>


<!-- jQuery UI 1.11.4 -->
<script src="../../../public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="../../../public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../../public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../../public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../../public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../../public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../../public/plugins/moment/moment.min.js"></script>
<script src="../../../public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../../public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../../public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>


<!-- Page specific script -->
<script>
    $(function() {
        bsCustomFileInput.init();
    })
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>