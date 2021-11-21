<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = "";
if (isset($this->session->user_session)) {
  $username = $this->session->user_session->user_name;
} else {
  redirect("");
}
?>
<style type="text/css">
  /*.mybg:before{
      content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    border-bottom: 70px solid #f1f5f7;
    border-left: 80px solid white;
    width: 0;
  }*/
  .myMenuIcons{
    background-color: #ffffff;
    padding: 10px 20px 10px 20px;
    /*border-radius: 20px 0px 20px 0px;*/
    -webkit-box-shadow: 0px 2px 5px 2px #afaeae;
    margin-right: 10px;
    font-size: 20px!important;
    color: #495057;
  }
  .myMenuIcons:focus
  {
    background-color: #d2454d;
    color: #ffffff;
  }
  .has_skew{
    transform:skew(-30deg);
    text-decoration:none;
  }
  .has_no_skew
  {
    transform:skew(30deg)!important;
  }
</style>
<style type="text/css">
  @use postcss-preset-env {
  stage: 0;
}

/* helpers/accessibility.css */

.invisible {
  left: -999px;
  overflow: hidden;
  position: absolute;
  top: -999px;
}

/* helpers/align.css */

.align {
  display: grid;
  place-items: center;
}

/* layout/base.css */

:root {
  --body-background-color: #82a8ee;
  --body-color: #97adc6;
}



/* modules/anchor.css */

a {
  color: inherit;
  outline: 0;
}

/* modules/icon.css */

.icons {
  display: none;
}

.icon {
  block-size: 1em;
  display: inline-block;
  fill: currentcolor;
  inline-size: 1em;
  vertical-align: middle;
}

.icon--2x {
  font-size: 2rem;
}

/* modules/image.css */

svg {
  max-inline-size: 100%;
}

/* modules/navigation.css */

:root {
  --navigation-background-color: #f0f6ff;
  --navigation-border-radius: 0.25em;

  --navigation-anchor-padding: 1.5em;
}

.navigation {
  background-color: var(--navigation-background-color);
  border-radius: var(--navigation-border-radius);
  box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.3);
}

.navigation ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.navigation a {
  display: block;
  padding: var(--navigation-anchor-padding);
  position: relative;
  text-decoration: none;
}

.navigation a:focus::after,
.navigation a:hover::after {
  opacity: 1;
}

.navigation a::after {
  block-size: 100%;
  box-shadow: 0 0.5em 1em rgba(0, 0, 0, 0.3);
  content: '';
  inline-size: 100%;
  left: 0;
  opacity: 0;
  position: absolute;
  top: 0;
  transition: opacity 0.3s;
}

.navigation--inline ul {
  display: flex;
}

</style>
<body class="sidebar-mini">
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg" style="background: #ffffff;height: 10px;"></div>
      <div class="navbar-bg" style="background: #d2454d;height: 10px;margin-top: 10px;"></div>
      <div class="navbar-bg mybg" style="background: #f1f5f7;height: 70px;margin-top: 30px;    "></div>

      <nav class="navbar navbar-expand-lg main-navbar" style="margin-top: 30px;left: -25px;-webkit-box-shadow: 0px 2px 7px 4px #ccc; transform:skew(-30deg,0deg);
    background: white;width: 100%;">
        <img id="logo_img" src="<?php echo base_url(); ?>assets/img/ECOVIS RKCA - Logo.png" width="250px" height="50px" alt="Gold Berries" style="padding-left: 55px;transform:skew(30deg);">
        
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
           <!--  <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li> -->

            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>

          </ul>
        <!--   <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div> -->
        </form>
      <!--   <div class="subnav1" style="transform:skew(30deg);">
          <button class="subnavbtn1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $username ?></div> <i class="fa fa-caret-down"></i></button>
          <div class="subnav-content1">
            <a href="#link1" class="customMenu">Link 1</a>
            <a href="#link2">Link 2</a>
            <a href="#link3">Link 3</a>
            <a href="#link4">Link 4</a>
          </div>
        </div> -->
        <!-- <div class="dd"></div> -->
        <ul class="navbar-nav navbar-right">
        
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="color: black;">
            <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1" style="transform:skew(30deg);">
            <div class="d-sm-none d-lg-inline-block" style="transform:skew(30deg);">Hi, <?= $username ?></div></a>
            <div class="dropdown-menu dropdown-menu-right" style="width: 970px;background: transparent;margin-top: 30px;">
              <a href="#" class="has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">Execution<span>
              </a>
              <a href="#" data-toggle="dropdown" class="dropdown has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">Planning<span>
                  
              </a>
                <div class="dropdown-menu" style="transform:skew(30deg);">
                       <nav class="navigation navigation--inline">
    <ul>
      <li>
        <a href="#">
          
            <i class="fa fa-home"></i>
          
          <span class="invisible">Home</span>
        </a>
      </li>
      <li>
        <a href="#">
          <svg class="icon icon--2x">
            <use xlink:href="#icon-search" />
          </svg>
          <span class="invisible">Search</span>
        </a>
      </li>
      <li>
        <a href="#">
          <svg class="icon icon--2x">
            <use xlink:href="#icon-cart" />
          </svg>
          <span class="invisible">Products</span>
        </a>
      </li>
    
    </ul>
  </nav>
                </div>
              <a href="#" class="has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">Communication<span>
              </a>
              <a href="#" class="has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">Knowledge Store<span>
              </a>
              <a href="#" class="has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">Financial Controls<span>
              </a>
              <a href="#" class="has-icon myMenuIcons has_skew">
                 <span class="has_no_skew">CRM<span>
              </a>
             <!--  <a href="<?= base_url('logout'); ?>" class="has-icon myMenuIcons has_skew" >
                <i class="fas fa-sign-out-alt"></i> Logout
              </a> -->
              
            </div>

          </li>
       
         
       </ul>

      </nav>
