<?php
$leveldir = '';
?>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $leveldir ?>dist/lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo $leveldir ?>dist/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/autosize/dist/autosize.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/moment/moment.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/summernote/summernote.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/jquery-validation/additional-methods.js"></script>
<script src="<?php echo $leveldir ?>dist/lte/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $leveldir ?>dist/lte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $leveldir ?>dist/lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?php echo $leveldir ?>plugins/sweetalert2/sweetalert2@11.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $leveldir ?>dist/lte/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        bsCustomFileInput.init();
    });

    $('.select2').select2();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
</script>