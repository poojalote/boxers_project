
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    height: 70px;
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

/* Links inside the dropdown */
/*.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}*/

/* Change color of dropdown links on hover */
/*.dropdown-content a:hover {background-color: #f1f1f1}*/

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
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
  padding: 14px 20px;
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
  background-color: inherit;
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
</style>
<style type="text/css">
	.myCss
	{
		background-color: #ffffff;
    padding: 10px 20px 10px 20px;
    /* border-radius: 20px 0px 20px 0px; */
    -webkit-box-shadow: 0px 2px 5px 2px #afaeae;
    margin-right: 10px;
    font-size: 20px!important;
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
    height: 60px!important;
    margin-top: 10px!important;
    -webkit-box-shadow: 0px 2px 5px 2px #afaeae!important;
	}
</style>

	<div style="left: 0;right: 0;">
		 <div class="navbar-bg" style="background: #ffffff;height: 10px;left: 0;right: 0;"></div>
		 <div class="navbar-bg" style="background: #d2454d;height: 10px;left: 0;right: 0;margin-top: 10px;"></div>
		 <div class="navbar-bg mybg" style="background: transparent;height: 70px;margin-top: 30px;    "></div>
		 <nav class="navbar navbar-expand-lg main-navbar" style="margin-top: 30px;left: -25px;-webkit-box-shadow: 0px 2px 7px 4px #ccc; transform:skew(-30deg,0deg);
			    background: white;width: 99%;">
			<img id="logo_img" src="<?php echo base_url(); ?>assets/img/ECOVIS RKCA - Logo.png" width="150px" height="50px" alt="Gold Berries" style="padding-left: 55px;transform:skew(30deg);vertical-align: middle!important;
    border-style: none;margin-top: 10px;">
    		<div class="dropdown" style="transform:skew(30deg); margin-right: auto!important;float: right;margin-top: 10px;background: transparent;">
			  
				  <button onclick="myFunctionDropDown()" class="dropbtn">Mentor Suite <i class="fa fa-sort-down "></i></button>
				  <div id="myDropdown" class="dropdown-content" style="
    right: 0;
    left: auto;width: 990px;background: transparent;margin-top: 20px;
">
				   <div class="navbar1">
  <a href="#home" class="myCss"><div style="transform:skew(30deg)!important;">Execution</div></a>
  <div class="subnav1">
    <button class="subnavbtn1 myCss" style="padding: 14px 20px 13px 20px;margin-right: 10px;"><div style="transform:skew(30deg)!important;">Planning <i class="fa fa-caret-down"></i></div></button>
    <div class="subnav-content1">
    	<div class="my_menu_child">
      <a href="#company"><i class="fa fa-home" style="font-size: 30px!important;color:#d2454d;"></i></a>
      <a href="#team"><i class="fa fa-file" style="font-size: 30px!important;color:#d2454d;"></i></a>
      <a href="#careers"><i class="fa fa-calendar" style="font-size: 30px!important;color:#d2454d;"></i></a>
      </div>
    </div>
  </div> 
  <div class="subnav1">
    <button class="subnavbtn1 myCss" style="padding: 14px 20px 13px 20px;margin-right: 10px;"><div style="transform:skew(30deg)!important;">Communication <i class="fa fa-caret-down"></i></div></button>
    <div class="subnav-content1">
    	<div class="my_menu_child">
      <a href="#bring">Bring</a>
      <a href="#deliver">Deliver</a>
      <a href="#package">Package</a>
      <a href="#express">Express</a>
  </div>
    </div>
  </div> 
  <div class="subnav1">
    <button class="subnavbtn1 myCss" style="padding: 14px 20px 13px 20px;margin-right: 10px;"><div style="transform:skew(30deg)!important;">Knowledge Store <i class="fa fa-caret-down"></i></div></button>
    <div class="subnav-content1">
    	<div class="my_menu_child">
      <a href="#link1">Link 1</a>
      <a href="#link2">Link 2</a>
      <a href="#link3">Link 3</a>
      <a href="#link4">Link 4</a>
  </div>
    </div>
  </div>
  <a href="#contact" class="myCss"><div style="transform:skew(30deg)!important;">Financial Controls</div></a>
  <a href="#contact" class="myCss"><div style="transform:skew(30deg)!important;">CRM</div></a>
</div>
				  </div>

			</div>
		 </nav>
	</div>

<script type="text/javascript">
	/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunctionDropDown() {
    document.getElementById("myDropdown").classList.toggle("show");
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
}
</script>
