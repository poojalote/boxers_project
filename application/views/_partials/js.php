<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
  
<script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
  
  <!-- JS Libraies -->
  <?php if ($this->uri->segment(1) == "") { ?>
  <script src="<?php echo base_url(); ?>assets/js/login.js?version=<?= time(); ?>"></script>
<?php } ?>
<?php
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "index" || $this->uri->segment(1) == "EventManagement") { ?>

    <!-- <script src="<?php echo base_url(); ?>assets/stickynote/js/jquery-1.5.2.min.js"></script> -->
  <!-- <script src="<?php echo base_url(); ?>assets/stickynote/js/jquery-ui-1.7.3.min.js"></script> -->

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/stickynote/js/jquery.stickynote.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/stickynote/js/StickyNotes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.6.0/src/loadingoverlay.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fullCalendarFunction.js?version=<?= time(); ?>"></script>
    <?php
}?>
<?php
if ( $this->uri->segment(1) == "dashboard") { ?>
    <!--<script src="application/dist/trumbowyg.min.js" type="text/javascript"></script>
    <script src="application/dist/plugins/base64/trumbowyg.base64.min.js" type="text/javascript"></script>-->
    <!-- <script src="<?php echo base_url(); ?>assets/stickynote/js/jquery-1.5.2.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/stickynote/js/jquery-ui-1.7.3.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js" integrity="sha512-t4CFex/T+ioTF5y0QZnCY9r5fkE8bMf9uoNH2HNSwsiTaMQMO0C9KbKPMvwWNdVaEO51nDL3pAzg4ydjWXaqbg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/plugins/base64/trumbowyg.base64.min.js" integrity="sha512-L1afpNgAjxlMYDMjEnvHo2g71G9rlmur1XnU1UNs2gsaZiVc+YxyxiQn7+b+cT0inAMcBQerGLmJMiODNGofLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo base_url(); ?>assets/js/fullCalendarFunction.js?version=<?= time(); ?>"></script>
    <?php
}?>
<?php
if ( $this->uri->segment(1) == "AtheletManagement") { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js" integrity="sha512-t4CFex/T+ioTF5y0QZnCY9r5fkE8bMf9uoNH2HNSwsiTaMQMO0C9KbKPMvwWNdVaEO51nDL3pAzg4ydjWXaqbg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/plugins/base64/trumbowyg.base64.min.js" integrity="sha512-L1afpNgAjxlMYDMjEnvHo2g71G9rlmur1XnU1UNs2gsaZiVc+YxyxiQn7+b+cT0inAMcBQerGLmJMiODNGofLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php
}?>

    <!-- Page Specific JS File -->
  <script src="<?php echo base_url(); ?>assets/js/page/components-chat-box.js"></script>
    <!-- JS Libraies -->
  <!-- <script src="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.js"></script> -->

  <!-- Page Specific JS File -->
  <!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-calendar.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fullcalendar_cdn/fullcalendar.min.js"></script>
<!-- <script src="https://payroll.docango.com/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script> -->

  <!-- Template JS File -->
  
  <script src="<?php echo base_url(); ?>assets/js/page/modules-toastr.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.rsLiteGrid.js"></script>
</body>
</html>