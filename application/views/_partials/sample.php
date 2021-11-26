<?php
$user_id = $this->session->user_session->user_id;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style type="text/css">
  body
  {
    margin: 0px!important;
  }
  .navbar-bg {
    content: ' ';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 115px;
    background-color: #6777ef;
    z-index: -1;
}
.navbar{
    transition: all .5s;
    align-items: center;
    height: 60px;
    left: 250px;
    right: 5px;
    position: absolute;
    z-index: 890;
    background-color: transparent;
}
@media (min-width: 992px){
.navbar-expand-lg {
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -ms-flex-pack: start;
    justify-content: flex-start;
}
}
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
  /* Dropdown Button */
.dropbtn {
    background-color: transparent;
    color: black;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: transparent;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: transparent;
    min-width: 160px;
    /*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
}
.dropdown-content1 {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    /*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
}
/* Links inside the dropdown */
.dropdown-content1 a {
    color: black;
    padding: 12px 20px;
    text-decoration: none;
    display: block;
    -webkit-box-shadow: 0px 2px 6px 0px #cccccc;
    /*text-align: center;*/
}

/* Change color of dropdown links on hover */
.dropdown-content1 a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
.show1 {display:block;}
</style>
<style>

.navbar1 {
  /*overflow: hidden;*/
  background-color: transparent; 
  color: black;
}

.navbar1 a {
  float: left;
  font-size: 16px;
  color: black;
  text-align: center;
  padding: 7px 15px;
  text-decoration: none;

}

.subnav1 {
  float: left;
  /*overflow: hidden;*/
}

.subnav1 .subnavbtn1 {
  font-size: 16px;  
  border: none;
  outline: none;
  color: black;
  padding: 14px 16px;
  background-color: white;
  font-family: inherit;
  margin: 0;
}

.navbar1 a:hover, .subnav1:hover .subnavbtn1 {
  background-color: #d2454d;
  color: white;
}

.subnav-content1 {
  display: none;
  position: absolute;
  /*left: 0;*/
  background-color: transparent;
  /*width: 100%;*/
  z-index: 1;
  /*margin-top: 10px;*/
  margin-left: -15px;
  /*padding-top:10px; */
   /*-webkit-box-shadow: 0px 2px 5px 2px #afaeae;*/
}

.subnav-content1 a {
  float: left;
  color: black;
  text-decoration: none;
}

.subnav-content1 a:hover {
  background-color: white;
  color: black;
   -webkit-box-shadow: 0px 2px 5px 2px #afaeae;
}

.subnav1:hover .subnav-content1 {
  display: block;
}
.dropbtn:focus
{
  outline: none;
}
</style>
<style type="text/css">
  .myCss
  {
    background-color: #ffffff;
    padding: 10px 20px 10px 20px;
    /* border-radius: 20px 0px 20px 0px; */
    -webkit-box-shadow: 0px 2px 5px 2px #afaeae;
    margin-right: 10px;
    font-size: 17px!important;
    color: #495057;
    transform: skew( 
  -30deg
   );
      text-decoration: none;
  }
  .icon_size
  {
    font-size: 40px!important;
  }
  .my_menu_child
  {
        background-color: #ffffff!important;
    height: 47px!important;
    margin-top: 10px!important;
    -webkit-box-shadow: 0px 2px 5px 2px #afaeae!important;
  }
  .rkca_logo
  {
    width: 200px;
    height: 40px;
    padding-left: 55px;
    transform:skew(30deg);
    vertical-align: middle!important;
    border-style: none;
    margin-top: 1px;
  }
</style>
<style type="text/css">
    #desktop_view
    {
      display: block;
    }
    #mobile_view
    {
      display: none;
    }
  /* mobile view*/
   @media (max-width: 800.98px) {
      #desktop_view
      {
        display: none;
      }
       #mobile_view
      {
        display: block;
      }
     .rkca_logo
      {
        width: 150px;
        height: 41px;
        padding-left: 20px;
        transform:skew(30deg);
        vertical-align: middle!important;
        border-style: none;
        margin-top: 0px;
      }
      .mobile_a_menu
      {
          font-size: 24px!important;
          color:#d2454d;
          padding: 8px;
          transform: skew( 30deg);
      }
      .mobile_a_menu:hover
      {
         -webkit-box-shadow: 0px 2px 7px 4px #ccc;
         transform: skew( 30deg);
          padding: 5px 15px 5px 15px;
      }
      .menu_mm
      {
        transform: skew( 30deg);
      }
      .execution_bar
      {
        position: relative;
        top: 100px;
        z-index: 4;
        height: 40px;
        background-color: white;
        -webkit-box-shadow: 0px 2px 7px 4px #ccc;
        transform: skew( -30deg,0deg);
        left: -58px;
        padding-left: 60px; 
        
      }
       .planning_bar
      {
        position: relative;
        top: 100px;
        z-index: 4;
        height: 40px;
        background-color: white;
        -webkit-box-shadow: 0px 2px 7px 4px #ccc;
        transform: skew( -30deg,0deg);
        left: -58px;
        padding-left: 60px; 
       
      }
   }
</style>
<input type="hidden" id="email_emp" name="email_emp" value="<?php echo $user_id ?>">
  <div style="left: 0;right: 0;">
     <div class="navbar-bg" style="background: #ffffff;height: 10px;left: 0;right: 0;"></div>
     <div class="navbar-bg" style="background: #d2454d;height: 10px;left: 0;right: 0;margin-top: 10px;"></div>
     <div class="navbar-bg mybg" style="background: transparent;height: 70px;margin-top: 30px;    "></div>
     <nav class="navbar navbar-expand-lg main-navbar" style="margin-top: 30px;left: -25px;-webkit-box-shadow: 0px 2px 7px 4px #ccc; transform:skew(-30deg,0deg);
          background: white;width: 100%;">
      <img id="logo_img" src="<?php echo base_url(); ?>assets/img/ECOVIS RKCA - Logo.png" class="rkca_logo" alt="Gold Berries">
     
        <div class="dropdown" id="desktop_view" style="transform:skew(30deg); margin-left: auto!important;float: right;margin-top: 1px;background: transparent;">
        
          <button onclick="myFunctionDropDown()" class="dropbtn"><?php echo $user_id?> <i class="fa fa-sort-down "></i></button>
          <div id="myDropdown" class="dropdown-content" style="
    right: 0;
    left: auto;width: 410px;background: transparent;margin-top: 15px;
">
           <div class="navbar1">
  <a href="#" onclick="goToPage('EventManagement')" class="myCss"><div style="transform:skew(30deg)!important;">Events Management</div></a>
  <a href="#" onclick="goToPage('AtheletManagement')" class="myCss"><div style="transform:skew(30deg)!important;">Athelets</div></a>
  <a href="#" onclick="goToPage('EnquiryManagement')" class="myCss"><div style="transform:skew(30deg)!important;">Enquiries</div></a>



</div>
          </div>

      </div>
      <div id="mobile_view" style="transform:skew(30deg); margin-left: auto!important;float: right;margin-top: 1px;background: transparent;">
        <button type="button" class="btn btn-link text-muted" style="font-size: 20px;"><i onclick="myFunctionDropDown1()" class="fa fa-th dropbtn1"></i></button>
         <div id="myDropdowndata" class="dropdown-content1" style="
            right: 0;left: auto;width: 200px;margin-top: 15px;">
            <a onclick="goToHrms('execution')" class="Execution">Execution</a>
            <a onclick="goToHrms('execution')" class="Execution">Athelets</a>
            <a onclick="goToHrms('execution')" class="Execution">Enquiries</a>

        </div>
      </div>
      <a href="<?= base_url('logout'); ?>" >
        <i class="fas fa-sign-out-alt text-muted" style="transform:skew(30deg)!important;"></i>
      </a>
     </nav>

  </div>
    <div class="execution_bar sameSubmenuClass" id="ExecutionsubmenuBar" style="display: none;">
       
    </div>
<script type="text/javascript">
  /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunctionDropDown() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function myFunctionDropDown1() {
    document.getElementById("myDropdowndata").classList.toggle("show");
    var divsToHide=document.getElementsByClassName("sameSubmenuClass");
  for(var i = 0; i < divsToHide.length; i++){
        
        divsToHide[i].style.display = "none"; 
    }
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
  if (!event.target.matches('.dropbtn1')) {

    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function goToPage(id){
    window.location.href='<?= base_url()?>'+id;

}


  function goToCrm(id) {
	var email=$("#email_emp").val();
	  window.location.href = "https://amgt.docango.com/survey/LoginController/login_api/"+email+"/" + id ;
  }


</script>
