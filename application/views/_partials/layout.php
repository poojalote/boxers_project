<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = "";
if (isset($this->session->user_session)) {
  $username = $this->session->user_session->user_id;
} else {
  redirect("");
}
?>



<body class="sidebar-mini">
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
   