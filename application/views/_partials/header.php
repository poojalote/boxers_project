<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Patil's</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
  <!-- CSS Libraries -->
<?php

if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "index") { ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
   <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery.stickynote.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/StickyNoteDemo.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery.ui.resizable.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php }
if ($this->uri->segment(1) == "dashboard") { ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery.stickynote.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/StickyNoteDemo.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/stickynote/css/jquery.ui.resizable.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/ui/trumbowyg.min.css" integrity="sha512-nwpMzLYxfwDnu68Rt9PqLqgVtHkIJxEPrlu3PfTfLQKVgBAlTKDmim1JvCGNyNRtyvCx1nNIVBfYm8UZotWd4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php }?>

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fullcalendar_cdn/fullcalendar.min.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.css"> -->

  <!-- <link href="https://payroll.docango.com/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" /> -->
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
<!-- Start GA -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_page_custom.css?version=<?php echo date('dmy his')?>">

<style type="text/css">
  body
  {
    background-color: #e3eaef78;
  }
  .main-content
  {
    padding-left:30px;
    top:50px;
  }
  body.sidebar-mini .main-content, body.sidebar-mini .main-footer {
    padding-left: 50px;
    padding-right: 50px;
  }
  body.sidebar-mini .navbar {
    left: 10px;
}
 @media (max-width: 800.98px) {
   .main-content {
      padding-left: 20px;
      padding-right: 20px;
    }
  }
</style>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<?php
if ($this->uri->segment(2) == "layout_transparent") {
  $this->load->view('dist/_partials/layout-2');
  $this->load->view('dist/_partials/sidebar-2');
}elseif ($this->uri->segment(2) == "layout_top_navigation") {
  $this->load->view('dist/_partials/layout-3');
  $this->load->view('dist/_partials/navbar');
}elseif ($this->uri->segment(2) != "auth_login" && $this->uri->segment(2) != "auth_forgot_password"&& $this->uri->segment(2) != "auth_register" && $this->uri->segment(2) != "auth_reset_password" && $this->uri->segment(2) != "errors_503" && $this->uri->segment(2) != "errors_403" && $this->uri->segment(2) != "errors_404" && $this->uri->segment(2) != "errors_500" && $this->uri->segment(2) != "utilities_contact" && $this->uri->segment(2) != "utilities_subscribe") {
  $this->load->view('_partials/layout');
  $this->load->view('_partials/sample');
  // $this->load->view('dist/_partials/sidebar');
}
?>
