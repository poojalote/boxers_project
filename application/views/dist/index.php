<?php
defined('BASEPATH') or exit('No direct script access allowed');
$id = "";
$user_id = "";
if (isset($this->session->user_session)) {
    $id = $this->session->user_session->id;
    $user_id = $this->session->user_session->user_id;
} else {
    redirect(base_url());
}
$this->load->view('_partials/header');
date_default_timezone_set('Asia/Kolkata');
?>

<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tribute/css/foundation.min.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tribute/tribute.css">
<link rel="stylesheet" type="text/css" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<!-- Froala editor -->
<!-- <link href="wem2/css/froala_editor.min.css" rel="stylesheet" type="text/css"> -->
<!--<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" href="https://rmt.ecovisrkca.com/assets/demo/richtext.min.css">
<style>
    .flickity-viewport {
        /*overflow-x: scroll;
        overflow-y: hidden;*/
    }

    /* no circle */
    .flickity-button {
        /*display: none;*/
        background: transparent;
    }

    .flickity-button:hover {
        /*display: none;*/
        background: transparent;
        color: black;
    }

    .flickity-prev-next-button {
        /*display: none;*/
        width: 100px;
        height: 100px;
    }

    .flickity-button-icon {
        /*display: none;*/
        fill: white;
    }

    .flickity-button:disabled {
        /*display: none;*/
    }

    .carousel {
        font-family: Arial, Helvetica, sans-serif;
        margin: auto;
        max-width: 680px;
        height: 100%;
        border-radius: 20%;
    }

    .carousel-cell {
        margin-top: 35px;
        margin-right: 35px;
        margin-bottom: 35px;
        float: right;
        max-width: 201px;
        width: 100%;
        height: 84%;
        border-radius: 15px;
        counter-increment: carousel-cell;
        transition: all .3s ease;
        opacity: 0.3;
        background: #b9b9b9;
        filter: blur(6px);

    }

    .carousel-cell.is-selected {
        filter: blur(0);
        opacity: 1;
        background: white;
        transform: scale(1.1);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    /* name */
    .carousel-cell .n {
        font-size: 18px;
        margin-top: 15px;
        text-align: center;
        color: black;
        counter-increment: carousel-cell;
    }

    /* button */
    .carousel-cell .b {
        cursor: pointer;
        margin: auto;
        width: 180px;
        padding: 1px;
        background: green;
        border: 1px solid green;
        border-radius: 15px;
        font-size: 15px;
        color: white;
        text-align: center;
        counter-increment: carousel-cell;
        transition: all .3s ease;
    }

    /* picture */
    .carousel-cell .p {
        border-radius: 15px;
        width: 201px;
        height: 250px;
        counter-increment: carousel-cell;
    }

    .carousel-cell .b:hover {
        background: #00e509;
        transform: scale(1.03);
        font-size: 16px;
    }

    .carousel-cell .b:active {
        background: white;
        color: green;
        transform: scale(0.9);
        font-size: 16px;
    }

    .carousel-cell .b-selected {
        cursor: pointer;
        margin: auto;
        width: 180px;
        padding: 1px;
        background: white;
        border: 1px solid green;
        border-radius: 15px;
        font-size: 15px;
        color: green;
        text-align: center;
        counter-increment: carousel-cell;
        transition: all .3s ease;
    }

    #add_more {
        float: right;
        /* right: -42px; */
        /* left: 41px; */
        background-color: green;
        padding: 1px 8px 4px 8px;
        color: #fff;
        border-radius: 20px;
        font-weight: 800;
        font-size: 18px;
        cursor: pointer;
    }

    #carousal_main_div {
        width: 100%;
    }

    .flickity-viewport {
        height: 500px !important;
        touch-action: none;
    }

    .carousel-cell .is-selected {
        height: 100% !important;
    }

    .flickity-viewport.is-pointer-down {
        cursor: default !important;
    }

    .flickity-enabled.is-draggable .flickity-viewport {
        cursor: default !important;
    }


</style>
<style type="text/css">
    .fc-timegrid-event-harness > .fc-timegrid-event {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: left;
    }

    .list-group-item1 {
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
    / / margin-bottom: - 1 px;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    [contenteditable="true"] {
        outline: 1px solid lightgrey;

    }

    .popover {
        overflow-x: hidden;
    }


    .vertical-timeline {
        width: 100%;
        position: relative;
    / / padding: 1.5 rem 0 1 rem
    }

    .vertical-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 15px;
        height: 100%;
        width: 4px;
        background: #e9ecef;
        border-radius: .25rem
    }

    .vertical-timeline-element {
        position: relative;
    / / margin: 0 0 1 rem
    }

    .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
        visibility: visible;
        animation: cd-bounce-1 .8s
    }

    .vertical-timeline-element-icon {
        position: absolute;
        top: 0;
        left: 10px
    }

    .badge22 {

    }

    .vertical-timeline-element-icon .badge-dot-xl {
        box-shadow: 0 0 0 5px #fff
    }

    .badge-dot-xl {
        width: 18px;
        height: 18px;
        position: relative
    }

    .badge:empty {
        display: none
    }

    .badge-dot-xl::before {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: .25rem;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -5px 0 0 -5px;
        background: #fff
    }

    .vertical-timeline-element-content {
        position: relative;
        margin-left: 30px;
        font-size: .8rem
    }

    .vertical-timeline-element-content .timeline-title {
        font-size: .8rem;
        text-transform: uppercase;
        margin: 0 0 .5rem;
        padding: 2px 0 0;
        font-weight: bold
    }

    .vertical-timeline-element-content .vertical-timeline-element-date {
        display: block;
        position: absolute;
        left: -90px;
        top: 0;
        padding-right: 10px;
        text-align: right;
        color: #adb5bd;
        font-size: .7619rem;
        white-space: nowrap
    }

    .vertical-timeline-element-content:after {
        content: "";
        display: table;
        clear: both
    }

    .nav-tabs .nav-link {
        border: none !important;
        /* border-top-left-radius: .25rem; */
        /* border-top-right-radius: .25rem; */
        border-bottom: 1px solid #e9ecef !important;
    }

</style>
<!-- Froala editor css -->
<style>
    .fr-active {
        z-index: 1100 !important;
    }

    .file_header h5 {
        color: #ae275f;
    }

    .folder_icon {
        font-size: 15px;
    }

    .file_icon {
        font-size: 15px;
    }

    .file_header {
        height: 60px;
    }

    .save_icon {
        font-size: larger;
    }

    .save_btn, .close_btn {
        font-size: x-large;
    }

    #modal_sidebar {

    }

    #modal_editor_row {
        width: 100%;
        margin: 0px !important;
    }

    .fr-wrapper > .fr-element {
        min-height: 300px !important;
    }

    .add_new_notepad, #close_notepad, #save_btn_i {
        cursor: pointer;
    }
    .btn-link:hover,.btn-link:focus
    {
        background-color: transparent!important;
    }
    /*@media (max-width: 800.98px){
        .employeeUnderUi-2 {
            left: 78px;
        }
        .employeeUnderUi-3 {
            left: 82px;
        }
    }
    @media (max-width: 576px){
        .employeeUnderUi-2 {
            left: 78px;
        }
        .employeeUnderUi-3 {
            left: 82px;
        }
    }
    @media (max-width: 540px){
        .employeeUnderUi-2 {
            left: 50px;
        }
        .employeeUnderUi-3 {
            left: 57px;
        }
    }
    @media (max-width: 425px){
        .employeeUnderUi-2 {
            left: 50px;
        }
        .employeeUnderUi-3 {
            left: 57px;
        }
    }*/
    .activities .activity .activity-detail {
        box-shadow: 0 4px 8px rgb(0 0 0 / 3%);
        background-color: #fff;
        border-radius: 3px;
        border: none;
    }
    .activities .activity .activity-icon {
        width: 20px;
        height: 20px;
        border-radius: 3px;
        line-height: 20px;
        font-size: 10px;
        text-align: center;
        margin-right: 6px;
        border-radius: 50%;
        flex-shrink: 0;
        text-align: center;
        z-index: 1;
    }
    .activities .activity {
        width: 100%;
        display: flex;
        position: unset;
    }
    .activities .activity {
        width: 100%;
        display: flex;
        position: unset;
    }
    .activities .activity .activity-detail {
        box-shadow: 0 4px 8px rgb(0 0 0 / 3%);
        background-color: #fff;
        border-radius: 3px;
        border: none;
        position: relative;
        margin-bottom: 10px;
        position: relative;
        padding: 0px;
    }
</style>
<style>
    .my_notes_txt{
        writing-mode: vertical-rl;
    }

    .content_part{
        width: 250px;
        height: 400px;
        box-shadow: 10px 8px 5px 1px rgb(0 0 0 / 7%);
        border: 1px solid lightgray;
        background-color: white;
        border-radius: 0 5px 5px 0;
    }
    .position_of_naotepad {
        left: -250px;
        top: 250px;
    }
    .position_of_2nd_naotepad {
        left: -250px;
        top: 343px;
    }
    .position_of_3nd_naotepad {
        left: -250px;
        top: 417px;
    }
    /* @media (max-width:575px){
        #my_notes_commimg{
            width: 80%;
            height: 70%;
        }
    } */
    .action_btn1
    {
        background-color: #595959;
    }
    .action_btn2
    {
        background-color: #d2454d;
    }
    .action_btn3
    {
        background-color: #595959;
    }


</style>

<!-- Main Content -->
<div class="main-content">

    <div class="row" id="backProfile" style="display: none">
        <div class="col" id="employee_name" style="font-size: 18px;
    color: black;"></div>
        <a href="<?php echo base_url(); ?>dashboard" style="margin-left:auto;" class="btn btn-link">Go Back Your
            Profile</a>

        <input type="hidden" name="user_email" id="user_email"
               value="<?php echo $this->session->user_session->email ?>">
        <input type="hidden" name="whichProfile" id="whichProfile" value="2">
        <input type="hidden" name="whichEmployeeId" id="whichEmployeeId" value="<?= $id ?>">
        <input type="hidden" name="whichEmployeeUserId" id="whichEmployeeUserId" value="<?= $user_id ?>">
    </div>

    <div class="leftside1 ">
        <div id="slidediv1" class="sidenav">
            <a id="slide_a">
                <div class="" style="width:100%;">
                    <div class="col-md-12 new_slide" style="">
                        <input type="text" id="mySearchEmployeeUnderUi" class="form-control"
                               placeholder="Search here..." title="Type here"
                               style="width: 230px!important;border: none;border-bottom: 1px solid lightgray;">
                        <div class="list-unstyled list-unstyled-border chat_scroll" id="leftSideEmployeeView"
                             style="cursor: pointer;height: 300px;">

                        </div>
                    </div>
                    <div class="col-sm-4 employeeUnderUi-2" style="">

                        <button id="myTeamButton" style=""
                                tabindex="-1" onclick="heightHideShow('slide_a')">My Team
                        </button>
                    </div>

                </div>
            </a>
        </div>
    </div>

    <div class="leftside3 ">
        <div id="slidediv3" class="sidenav1">
            <a id="slide_a1">
                <div class=" " id="stickydiv" style="width:100%;overflow-x: hidden!important;">
                    <div class="col-md-12 new_slide" style="height:300px;">
                        <div>
                            <input type="hidden" id="stickyID">
                            <input type="text" id="StickyNote"
                                   onkeydown=" runScript(event)"
                                   class="form-control"
                                   placeholder="Type here..." title="Type here"
                                   style="    margin-left: 16px;width: 230px!important;border: none;border-bottom: 1px solid lightgray;">
                        </div>

                        <div id="STickyData"></div>
                    </div>
                    <div class="col-sm-4 employeeUnderUi-1" id="stickiempId" style="">

                        <button style="transform: rotate(90deg);color:white;border:none;
                               background-color:#d2454d;padding: 3px 4px 0px 3px;z-index: 99999;font-size: 16px;position: fixed;"
                                tabindex="-1" onclick="heightHideShow('slide_a1',2)">Post It <i
                                    class="fa fa-sticky-note"></i>
                        </button>
                    </div>

                </div>
            </a>
        </div>
    </div>

    <div class="leftside1 ">
        <div id="slidediv1" class="sidenav">
            <a id="slide_a3" style="background-color: white;">
                <div class="" style="width:100%;padding-top: 10px;">
                    <div class="col-md-12 new_slide">
                        <input type="hidden" name="noteFolder" id="rootNoteFolder"/>
                        <input type="hidden" name="locationOfFolder" id="locationOfFolder"/>
                        <input type="hidden" name="currentLocation" id="currentLocation"/>
                        <input type="hidden" name="rootFolderName" id="rootFolderName"/>
                        <div class="d-flex" style="width: 240px">
                            <div class="col-md-6">
                         <span class="add_new_notepad"
                               style="    background-color: green;padding: 5px 8px 7px 5px;border-radius: 15px;color: #fff;"><i
                                     class="fas fa-plus"></i>  New</span>
                            </div>
                            <div class="col-md-6">
                                <select id="tagIdentifire1" style="height: 30px;
    padding: 2px;    border-radius: 16px;
    border-color: green;" class=" form-control-sm form-control" onchange="getFolders()"></select></div>
                        </div>
                        <input type="text" id="mySearchNotepad1" contenteditable="true"  class="form-control"
                               placeholder="Press # to search..." title="Type here"
                               style="width: 230px!important;border: none;border-bottom: 1px solid lightgray; outline: none;" onkeyup="getDataFilesearch('mySearchNotepad1')">
                        <div class="mt-3">
                            <i id="btnBack" onclick="goBack()" class="fas fa-arrow-left mr-2 d-none"></i> <span
                                    id="currentFolderLocationLable">Current Location</span>
                        </div>
                        <div class="file_body mt-3 chat_scroll" id="list_view_main_section" style="height: 350px;">
                        </div>
                        <div class="list-unstyled list-unstyled-border" id="leftSideEmployeeView"
                             style="cursor: pointer;">

                        </div>
                    </div>
                    <div class="col-sm-4 employeeUnderUi-3" style="">

                        <button style=""
                                tabindex="-1" id="btn_editor" onclick="heightHideShow('slide_a3')">Notepad
                        </button>
                    </div>

                </div>
            </a>
        </div>
    </div>
    <!--<div class="row">
        <div class="col-sm-4" style="z-index: 2;">
            <div class="d-flex position-fixed position_of_naotepad red_class" id="my_notes_commimg">
                <div class="content_part chat_scroll" style="background-color: white;">
                    <div class="new_slide" style="padding-left: 10px;">
                        <input type="text" id="mySearchEmployeeUnderUi" class="form-control"
                               placeholder="Search here..." title="Type here"
                               style="width: 100%;border: none;border-bottom: 1px solid lightgray;">
                        <ul class="list-unstyled list-unstyled-border" id="leftSideEmployeeView"
                            style="cursor: pointer;">

                        </ul>
                    </div>
                </div>
                <div class=" action_btn mx-0 px-0" id="btn_action"><P class="action_btn mx-0 my_notes_txt p-2 text-light action_btn1">My Team <i
                                class="fa fa-users"></i></P></div>
            </div>
        </div>
        <div class="col-sm-4" style="z-index: 2;">
            <div class="d-flex position-fixed position_of_2nd_naotepad red_class" id="my_notes_commimg_2">
                <div class="content_part chat_scroll" style="background-color: white;">
                    <div class="new_slide">
                        <div>
                            <input type="hidden" id="stickyID">
                            <input type="text" id="StickyNote"
                                   onkeydown=" runScript(event)"
                                   class="form-control"
                                   placeholder="Type here..." title="Type here"
                                   style="width: 100%;border: none;border-bottom: 1px solid lightgray;">
                        </div>

                        <div id="STickyData"></div>
                    </div>
                </div>
                <div class=" action_btn mx-0 px-0" id="btn_action_2">
                    <P class="action_btn mx-0 my_notes_txt p-2 text-light action_btn2">Post It <i
                                class="fa fa-sticky-note"></i></P></div>
            </div>
        </div>
        <div class="col-sm-4" style="z-index: 2;">
            <div class="d-flex position-fixed red_class  position_of_3nd_naotepad" id="my_notes_commimg_3">
                <div class="content_part chat_scroll" style="background-color: white;">
                    <div class="new_slide" style="padding-left: 20px;padding-top: 10px;">
                        <input type="hidden" name="noteFolder" id="rootNoteFolder"/>
                        <input type="hidden" name="locationOfFolder" id="locationOfFolder"/>
                        <input type="hidden" name="currentLocation" id="currentLocation"/>
                        <input type="hidden" name="rootFolderName" id="rootFolderName"/>

                        <span class="add_new_notepad"
                              style="    background-color: green;padding: 5px 8px 7px 5px;border-radius: 15px;color: #fff;"><i
                                    class="fas fa-plus"></i> Create New</span>
                        <div class="mt-3">
                            <i id="btnBack" onclick="goBack()" class="fas fa-arrow-left mr-2 d-none"></i> <span
                                    id="currentFolderLocationLable">Current Location</span>
                        </div>
                        <div class="file_body mt-3" id="list_view_main_section">
                        </div>
                        <ul class="list-unstyled list-unstyled-border" id="leftSideEmployeeView"
                            style="cursor: pointer;">

                        </ul>
                    </div>
                </div>
                <div class=" action_btn mx-0 px-0" id="btn_action_3"><P class="action_btn mx-0 my_notes_txt p-2 text-light action_btn3">Notepad <i
                                class="fa fa-file-text-o"></i></P></div>
            </div>
        </div>
    </div>-->


    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card chat-box card_height card_new" id="mychatbox2"
                     style="background-image: url('<?php echo base_url(); ?>assets/img/unsplash/focus_view3.jpg');  background-repeat: no-repeat;
                             background-origin: padding-box;
                             background-size: cover;
                             background-blend-mode: screen;
                             background-position-x: right;
                             background-position-y: top;
                             ">
                    <div class="card-header">
                        <img id="logo_img" src="<?php echo base_url(); ?>assets/img/unsplash/focus_icon.png"
                             width="40px" height="40px" alt="Gold Berries">
                        <h4> Focus Area</h4>
                        <div class="card-header-action">
                            <button type="button" id="focusAreaAddbutton"
                                    class="btn btn-link btn-sm rkca_btn addPlusBtn"
                                    onclick="submitFocusViewdata()" style="color: white;display: none"><i
                                        class="fa fa-plus"></i>
                            </button>
                            <input type="hidden" name="todayDate" id="todayDate" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="card-body chat-content chat_scroll" tabindex="3"
                         style="overflow-y: auto!important; outline: none;background-color: transparent!important;">
                        <!--    <div class="chat-item chat-left" style=""><div class="chat-details"><div class="chat-text">Wake up!</div><div class="chat-time">11:15</div></div></div> -->
                    </div>
                    <div class="card-footer chat-form">

                        <form id="chat-form2" style="display: none;">
                            <!-- <input type="text" id="focusMessageInput" onkeypress="return myKeyPress(event)" class="form-control" placeholder="Type a focus view..."> -->
                            <!-- <div class="focusTypeMessage type_mess">Type a message</div> -->
                            <div contenteditable="true" id="focusMessageInput"
                                 onkeypress="return myKeyPress(event,this,'parent','focusMessageInput','focusEmployeeDiv',0)"
                                 class="form-control chat_scroll card_foot" placeholder="Type a focus view..." style="height: 45px;
    background-color: transparent!important;
    border-radius: 0px;border: 1px solid #e3eaef;color: white;"></div>


                            <input type="hidden" name="newFocusCount" id="newFocusCount" value="0">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card chat-box card_height card_new" id="mychatbox"
                     style="background-image: url('<?php echo base_url(); ?>assets/img/unsplash/activity_view1.jpg');  background-repeat: no-repeat;
                             background-origin: padding-box;
                             background-size: cover;
                             background-blend-mode: screen;
                             background-position-x: right;
                             background-position-y: top;
                             ">
                    <div class="card-header">
                        <h4>Today's Activity</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-link btn-sm rkca_btn addPlusBtn"
                                    onclick="submitTodaysAtivityViewdate()" style="color: white;"><i
                                        class="fa fa-plus"></i></button>


                            <button class="btn btn-link btn-sm rkca_btn" onclick="todaysViewTask(1)" style=""><i
                                        style="color:#ffffff" class="fa fa-arrow-left"></i></button>
                            <button class="btn btn-link btn-sm rkca_btn" onclick="todaysViewTask(2)" style=" "><i
                                        style="color:#ffffff" class="fa fa-arrow-right"></i></button>
                            <label for="activityDate" onclick="$('#activityDate').toggle();"><i
                                        class="fa fa-calendar"></i></label>
                            <input type="date" name="activityDate" id="activityDate" class="form-control"
                                   style="display: none;" value="<?= date('Y-m-d') ?>" onchange="todaysViewTask(0)">
                        </div>
                    </div>
                    <div class="card-body chat-content chat_scroll" tabindex="3"
                         style="overflow-y: auto!important; outline: none;background: transparent!important;">

                    </div>
                    <div class="card-footer chat-form d-none">
                        <form id="chat-form">
                            <div id="todayActivityFocusDiv" class="chat_scroll"
                                 style="height: 100px;display: none; overflow-y: auto!important;padding-top:1px; ">
                                <input type="text" id="mySearchActivityFocusdata" class="form-control"
                                       placeholder="Search here..." title="Type here">
                                <ul class="list-group" id="todaysAcitivity-list">

                                </ul>
                            </div>
                            <div id="todayActivityHours" class="chat_scroll"
                                 style="height: 100px;display: none; overflow-y: auto!important;">
                                <ul class="list-group" id="todaysAcitivity-list">
                                    <!--  <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','1Hr')">1Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','2Hr')">2Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','3Hr')">3Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','4Hr')">4Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','5Hr')">5Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','6Hr')">6Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','7Hr')">7Hr</li>
                                     <li class="list-group-item emp_list" onclick="setTextToCurrentPos('activityMessageInput','8Hr')">8Hr</li> -->
                                </ul>
                            </div>
                            <div class="activityTypeMessage type_mess">Type a activity</div>
                            <div contenteditable="true" id="activityMessageInput"
                                 onkeypress="return myKeyPress(event,this,'activity','activityMessageInput','todayActivityFocusDiv',0)"
                                 class="form-control chat_scroll" placeholder="Type a focus view..." style="height: 38px;
    background-color: #FFAA4C;
    border-radius: 0px;"></div>
                            <!--  <button class="btn btn-primary">
                               <i class="far fa-paper-plane"></i>
                             </button> -->
                            <input type="hidden" name="newTodaystaskCount" id="newTodaystaskCount" value="0">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card_new" id="mytaskAssignBox"
                     style="background-image: url('<?php echo base_url(); ?>assets/img/unsplash/task_view1.jpg');  background-repeat: no-repeat;
                             background-origin: padding-box;
                             background-size: cover;
                             background-blend-mode: screen;
                             background-position-x: right;
                             background-position-y: top;
                             height: 560px;overflow-y: auto;
                             ">
                    <div class="card-header">
                        <h4>Task Assign</h4>
                        <div class="card-header-action">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " style="line-height: 15px;" id="home-tab3" data-toggle="tab"
                                       href="#home3" role="tab" aria-controls="home" aria-selected="true"
                                       onclick="showHide(1,'taskAssignFooter')">Assign To U</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="profile-tab3" style="line-height: 15px;" data-toggle="tab"
                                       href="#profile3" role="tab" aria-controls="profile" aria-selected="false"
                                       onclick="showHide(2,'taskAssignFooter')">Assign By U</a>
                                </li>
                                <button type="button" id="profile-tab-btn" class="btn btn-link btn-sm rkca_btn addPlusBtn"
                                        onclick="submitTaskAssignViewData()" style="color: white;display: none;"><i
                                            class="fa fa-plus"></i></button>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body chat_scroll" tabindex="3"
                         style="overflow-y: auto!important; outline: none;background: transparent!important;">

                        <div class="tab-content" id="myTabContent2">

                            <!-- <div class="float-right"><button class="btn btn-info" style="line-height: 15px;"><i class="fa fa-download"></i></button></div><br> -->
                            <div class="tab-pane chat-content-task-given fade  active" id="home3" role="tabpanel"
                                 aria-labelledby="home-tab3">

                                <!-- <div class="list-unstyled list-unstyled-border" id="taskAssignToU">


                                </div> -->
                            </div>
                            <div class="tab-pane chat-content-task-assign fade" id="profile3" role="tabpanel"
                                 aria-labelledby="profile-tab3"
                                 style="outline: none;background: transparent!important;">
                                <!-- <ul class="list-unstyled list-unstyled-border chat-content-task-assign">



                                </ul> -->
                            </div>

                        </div>
                    </div>
                    <div class="card-footer chat-form" id="taskAssignFooter"
                         style=" background-color: transparent;padding: 0px;">

                        <form id="chat-form-task">
                            <div id="taskAEmployeeDiv" class="chat_scroll"
                                 style="height: 100px;display: none; overflow-y: auto!important;">
                                <ul class="list-group">

                                </ul>
                            </div>
                            <!-- <div class="taskTypeMessage1 type_mess">Type a task</div> -->
                            <div contenteditable="true" id="taskAMessageInput"
                                 onkeypress="return myKeyPress(event,this,'task','taskAMessageInput','taskAEmployeeDiv',0)"
                                 class="form-control chat_scroll" placeholder="Type a focus view..." style="height: 38px;
    background-color: transparent;
    border-radius: 0px;border: none;border: 1px solid #eee;
    color: white;display: none;"></div>
                            <input type="hidden" name="newTaskAssignCount" id="newTaskAssignCount" value="0">
                            <input type="hidden" name="newTaskGivenCount" id="newTaskGivenCount" value="0">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">

                <div class="card chat_scroll card_new" style="
             background-color: #9fc4d2;

    height: 560px;overflow-y: auto;
">
                    <div class="card-header">

                        <h4>Calendar</h4>
                        <div class="card-header-action">
                            <button type="button" data-placement="top" id="locationpopover"
                                    class="btn btn-link btn-sm rkca_btn"
                                    data-toggle="popover">
                                <i style="font-size: 15px;" class="fa fa-map-marker"></i>
                            </button>
                            <span class="" id="loc_sts"></span>
                            <button class="btn btn-primary addPlusBtn" id="punchinbutton" type="button"
                                    onclick="MarkAttendance('login')">Punch In
                            </button>
                            <button class="btn btn-primary addPlusBtn" id="punchoutbutton" type="button"
                                    style="display: none" onclick="MarkAttendance('logout')">Punch Out
                            </button>
                            <button onclick="$('#mycard-collapse').toggle();" class="btn btn-icon btn-info addPlusBtn"
                                    type="button"><i class="fas fa-plus"></i></button>
                            <button class="btn btn-link " title="Go to Payroll"
                                    onclick="goToPayroll('calendar')" id="" type="button"
                                    style=""><i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body calendar_body" style="background-color: transparent;">

                        <div class="" id="mycard-collapse" style="display: none">
                            <button class="btn btn-primary" style="line-height: 11px;" type="button"
                                    onclick="$('#add_leaveDive').toggle();$('#add_regatt').hide();">Add Leave
                            </button>
                            <!--<button type="button" onclick="$('#add_eventDive').toggle();" style="line-height: 11px;"
                                    class="btn  btn-primary">Add Event
                            </button>-->
                            <button type="button" onclick="$('#add_regatt').toggle();$('#add_leaveDive').hide();" style="line-height: 11px;"
                                    class="btn  btn-primary"> Regularize Attendance
                            </button>

                        </div>
                        <div class="collapse  col-md-12" id="add_leaveDive"><br>
                            <form id="leave_request_form" method="post">
                                <div class="row">

                                    <div class="col-md-3">
                                        <select class="form-control form-control-sm"
                                                style="font-size: 12px;height: 30px;padding: 0px;0px" name="leave_type"
                                                id="leaveType">
                                            <option>Select Leave Type</option>
                                            <option value="PL">CL</option>
                                            <option value="PL">PL</option>
                                            <option value="PL">SL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control form-control-sm"
                                                style="font-size: 12px;height: 30px;padding: 0px;0px"
                                                id="day_type" name="day_type" onchange="getLeaveDates(this.value)">
                                            <option>Select Days</option>
                                            <option value="0">Single</option>
                                            <option value="1">Multiple</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="startDateDiv" style="display: none">
                                        <input type="date" id="leave_date_multiple_first"
                                               name="leave_date_multiple_first" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3" id="EndDateDiv" style="display: none">
                                        <input type="date" id="leave_date_multiple_second"
                                               name="leave_date_multiple_second" class="form-control form-control-sm">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary " onclick="RequestLeave()"
                                                style="line-height: 11px;" type="button">Save
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="collapse col-md-12" id="add_eventDive"><br>
                            <form id="add_eventForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control-sm form-control"
                                               placeholder="Enter Event Name" id="Eventname" name="Eventname">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="datetime-local" name="EventstartDate" id="EventstartDate"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="datetime-local" name="EventendDate" id="EventendDate"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary " onclick="addEventPayroll()"
                                                style="line-height: 11px;" type="button">Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="collapse col-md-12" id="add_regatt"><br>
                            <form id="missing_punch_form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" id="date_selected" name="date_selected"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" id="reg_attstartDate" name="punch_in_time"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="time" id="reg_attendDate" name="punch_out_time"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control-sm form-control"
                                               placeholder="Enter Reason"
                                               id="Missingreason" name="reason_missing">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary " onclick="AddMissingPunch()"
                                                style="line-height: 11px;" type="button">Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-12" id='calendar-container' style="height: 100%!important">
                            <div id='calendar' style="height: 100%!important"></div>
                        </div>
                        <!-- <div class="fc-overflow">
                          <div id="myEvent" class="fc fc-unthemed fc-ltr"></div>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <!--  <div class="col-md-6">
                <div class="card card_height">
                 <div class="card-header">
                   <h4>Dashboard</h4>
                   <div class="card-header-action">
                   </div>
                 </div>
                 <div class="card-body p-0">

                 </div>
               </div>
             </div> -->
        </div>
    </section>
</div>
<div id="location_data" name="location_data"></div>
<div id="map"></div>
<div id="gps_div" style="">
    <input type="hidden" id="srtaddress" name="srtaddress">
    <input type="hidden" id="longaddress" name="longaddress">
    <input id="latlng" type="hidden" value=""/>
</div>
<!-- Modal -->
<div id="StickyNoteModal" class="modal fade" role="dialog" data-backdrop="static">
    <button type="button" class="close" data-dismiss="modal" style="color: #f8f9fa;font-size: 36px;">&times;</button>
    <div style="width: 100%;height: 100%" class="modal-dialog modal-xl">


    </div>
</div>
<div id="ViewFocusComment" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="btn btn-link w-100" type="button" onclick="loadTree1(1)">
                    <div class="todo-indicator  bg-warning"></div>
                    <div class="widget-content py-0">
                        <div class="widget-content-wrapper text-left">

                            <div class="widget-content-left d-flex">
                                <div class="widget-heading col-md-9"><i><span class="badge badge-success">PL</span> </i>This
                                    is comment<i></i></div>

                                <div class="widget-subheading">12June | <i class="fa fa-download"></i></div>
                            </div>


                        </div>
                    </div>
                </a>
                <a class="btn btn-link w-100" type="button" onclick="loadTree1(1)">
                    <div class="todo-indicator  bg-warning"></div>
                    <div class="widget-content py-0">
                        <div class="widget-content-wrapper text-left">

                            <div class="widget-content-left d-flex">
                                <div class="widget-heading col-md-9"><i><span class="badge badge-danger">NJ</span> </i>This
                                    is comment<i></i></div>

                                <div class="widget-subheading">12June | <i class="fa fa-download"></i></div>
                            </div>


                        </div>
                    </div>
                </a>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>


    </div>
</div>

<div id="ViewActivityComment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="btn btn-link w-100" type="button" onclick="loadTree1(1)">
                    <div class="todo-indicator  bg-warning"></div>
                    <div class="widget-content py-0">
                        <div class="widget-content-wrapper text-left">

                            <div class="widget-content-left d-flex">
                                <div class="widget-heading col-md-9"><i><span class="badge badge-success">PL</span> </i>This
                                    is comment<i></i></div>

                                <div class="widget-subheading">12June | <i class="fa fa-download"></i></div>
                            </div>


                        </div>
                    </div>
                </a>
                <a class="btn btn-link w-100" type="button" onclick="loadTree1(1)">
                    <div class="todo-indicator  bg-warning"></div>
                    <div class="widget-content py-0">
                        <div class="widget-content-wrapper text-left">

                            <div class="widget-content-left d-flex">
                                <div class="widget-heading col-md-9"><i><span class="badge badge-danger">NJ</span> </i>This
                                    is comment<i></i></div>

                                <div class="widget-subheading">12June | <i class="fa fa-download"></i></div>
                            </div>


                        </div>
                    </div>
                </a>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>


    </div>
</div>
<div id="ViewCalendarModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title badge-info" id="calendarDate"
                      style="padding: 3px;line-height: 1;border-radius: 8px;"></span>
                <span class="modal-title badge-primary" id="EventBy"
                      style="padding: 3px;line-height: 1;border-radius: 8px; background-color:#ebbe40;margin-left: 4px;"></span>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-12" id="attendance_details">

                    </div>
                </div>
                <div class="" id="EventDiv" style="display: none">
                    <div class="">
                        <div class="list-group">
                            <a href="#" class="list-group-item1 list-group-item-action flex-column align-items-start ">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6>Event Details</h6>

                                </div>

                                <p class="mb-1">
                                <ul class="list-group" id="event_details">

                                </ul>

                                </p>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" id="Og_date" name="Og_date">

                    <div class="col-md-12" id="addevendatadiv">
                        <form id="EventForm">
                            <input type="hidden" id="updateID" name="updateID">
                            <h6 id="h6addev">Add Event</h6>
                            <div contenteditable="true" class="form_control" id="textAreaEg"
                                 onclick="getTributedata('textAreaEg','event',1)" style="padding: 5px;"></div>
                            <br>
                            <span id="eventName_Show" ></span>
                            <hr>
                            <div class="section-body">
                                <input type="hidden" id="countagendaN" name="countagendaN" value="1">
                                <h5 class="section-title" style="color: #2c1f20">Add Agenda <button class="btn btn-link" type="button" onclick="addAgendatolocal()"> <i class="fa fa-plus" style="color: #80212a"></i></button></h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="activities">
                                            <div class="activity" id="t_div1">
                                                <div class="activity-icon  text-white shadow-primary" style="background-color: #6eb9bb !important;">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="activity-detail" style="width: 100%">
                                                    <div class="mb-2">
                                                        <div class="float-right">
                                                            <button class="btn btn-link"  id="del_li_btn1" onclick="deleteli(1)"
                                                                    type="button"><i class="fa fa-trash" style="color: #80212a"></i></button>
                                                        </div>


                                                    </div>
                                                    <p id="agendaspan1" style="line-height: 18px;font-size: 13px;"></p>
                                                    <input class="form-control form-control-sm" type="text" name="addeventAgenda[]" id="addeventAgenda1">
                                                </div>
                                            </div>
                                            <div id="agendaUL" style="width: 100%">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger" title="Delete Event" id="deleteButton" style="margin-left:10px;display: none;margin-right: auto;float: right" onclick="deleteEvent()">
                                Delete
                            </button>
                            <button class="btn btn-primary" id="saveevbtn" type="button" style="margin-right: auto;float: right"
                                    onclick="addEVData()">Save
                            </button>

                        </form>
                    </div>
                </div>
                <br>

                <!--                <div class="row">-->
                <!--                    <div class="">-->
                <!--                        <div class="list-group">-->
                <!--                            <a href="#" class="list-group-item1 list-group-item-action flex-column align-items-start ">-->
                <!--                                <div class="d-flex w-100 justify-content-between">-->
                <!--                                    <h6>Task Details</h6>-->
                <!---->
                <!--                                </div>-->
                <!---->
                <!--                                <p class="mb-1">-->
                <!--                                <ul class="list-group">-->
                <!--                                    <li class="list-group-item d-flex justify-content-between align-items-center">-->
                <!--                                        task 1 from naredra-->
                <!--                                        <span class="badge text-muted badge-pill">4pm-7pm</span>-->
                <!--                                    </li>-->
                <!--                                    <li class="list-group-item d-flex justify-content-between align-items-center">-->
                <!--                                       Payroll design and backend Implementation-->
                <!--                                        <span class="badge text-muted badge-pill">11am-12pm</span>-->
                <!--                                    </li>-->
                <!--                                    <li class="list-group-item d-flex justify-content-between align-items-center">-->
                <!--                                        now available as a Beta release! Subscribe to Font Awesome Pro and get instant access to the v6 beta.-->
                <!--                                        <span class="badge text-muted  badge-pill">2pm-3pm</span>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!---->
                <!--                                </p>-->
                <!---->
                <!--                            </a>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div>

                </div>
            </div>

        </div>


    </div>
</div>

<div id="EditTodaysTaskModal" class="modal fade  modal-md " role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Attach Focus</label>
                        <select class="form-control" id="AttachFocus" style="width:100%" name="AttachFocus">
                            <option selected value="">Select Focus</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="datetime-local" class="form-control" name="todaystaskStartDate"
                               id="todaystaskStartDate">
                    </div>
                    <div class="col-md-6">
                        <label>End Date</label>
                        <input type="datetime-local" class="form-control" name="todaystaskEndDate"
                               id="todaystaskEndDate">
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button class="btn btn-primary" type="button">Save</button>
            </div>
        </div>


    </div>
</div>

<div id="EditAssignTaskModal" class="modal fade  modal-md " role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Select Employee</label>
                        <select class="form-control" id="assignTaskEmplyee" multiple style="width:100%"
                                name="assignTaskEmplyee">
                            <option selected value="">Select employee</option>
                            <option>Narendra jadhav</option>
                            <option>Pooja Lote</option>
                            <option>Supriya Wadekar</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="datetime-local" class="form-control" name="assigntaskStartDate"
                               id="assigntaskStartDate">
                    </div>
                    <div class="col-md-6">
                        <label>End Date</label>
                        <input type="datetime-local" class="form-control" name="assigntaskEndDate"
                               id="assigntaskEndDate">
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button class="btn btn-primary" type="button">Save</button>
            </div>
        </div>


    </div>
</div>
<div id="NotesModalView" class="modal fade  modal-md " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <hr>
            <div class="modal-body">
                <div class="card-body">
                    <div id="carousal_main_div">
                        <div style="">
                            <i id="add_more" class="add_more sticky-top">+</i>
                        </div>
                        <div class="carousel">
                        </div>
                    </div>
                    <!--   <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                               <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">View</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Create</a>
                           </li>

                       </ul>
                       <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

                           </div>
                           <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                               <form id="notes_form" name="folder_form">
                                   <div class="form-group mx-3 mt-2">
                                       Note Name
                                   </div>
                                   <div class="form-group mr-3 ml-3">
                                       <input type="text" name="noteName" id="noteName" class="form-control mb-2"/>
                                   </div>
                                   <input type="hidden" id="file_open_id">
                                   <div class="form-group">
                                       <textarea id="noteBody"></textarea>
                                   </div>
                                   <div class="float-right  form-group ml-3 mr-3">

                                       <button  type="submit" class="btn btn-dark btn-sm">save</button>
                                   </div>
                               </form>
                           </div>

                       </div>-->
                </div>

            </div>
            <div class="modal-footer">

            </div>
        </div>


    </div>
</div>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" id="modal_editor_row">
                <!-- left side body  -->
                <div class="col-sm-12 px-0" id="open_notepad">
                    <div class="text_area">
                        <div class="file_header align-items-center border d-flex justify-content-between text-black-50 bg-light px-2">
                            <input type="text" placeholder="Note Pad Name..." id="noteName" class="form-control col-md-4">
                            <input type="text" placeholder="Identifire..." id="otherIdentifier" class="form-control col-md-2">
                            <select  id="tagIdentifire" class="form-control col-md-4"></select>
                            <span><i class=" save_btn fas fa-check px-3" id="save_btn_i"></i></span>
                            <span><i class=" close_btn fas fa-times pr-3" id="close_notepad"></i></span>
                            <input type="hidden" name="hidden" id="file_id" value="">
                            <input type="hidden" name="hidden" id="notePath" value="">


                        </div>

                        <div class="bg-light border-bottom d-flex justify-content-end text_area_header">

                        </div>
                        <div class="text_area_body">
                            <!-- <textarea type="text" class="form-control" id="" placeholder="My Content.."></textarea> -->
                            <!-- <textarea type="text" class="form-control" id="" placeholder="My Content.."></textarea> -->
                            <textarea id="editor">

                        </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <section id="editor">
              <div id="edit">
                Your editable content goes here
              </div>
            </section> -->
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" id="NotesTask"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="col-md-12">
                <p>Notes</p>
                <div  id="Datanotes"></div>
            </div>

        </div>

    </div>
</div>
</div>
<?php $this->load->view('_partials/footer'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tribute/tribute.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAUXznG9tJxAHWfCL2w2UwYCYfDO2mlHCQ&libraries=places"></script>
<script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<!---->

<script type="text/javascript" src="https://rmt.ecovisrkca.com/assets/demo/jquery.richtext.js"></script>
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image_manager.min.js"></script>-->
<script>
    $('#editor').richText({
        bold: true,
        italic: true,
        underline: true,
        leftAlign: true,
        centerAlign: true,
        rightAlign: true,
        justify: true,
        // lists
        ol: true,
        ul: true,
        // title
        heading: true,

        // fonts
        fonts: true,
        fontList: ["Arial",
            "Arial Black",
            "Comic Sans MS",
            "Courier New",
            "Geneva",
            "Georgia",
            "Helvetica",
            "Impact",
            "Lucida Console",
            "Tahoma",
            "Times New Roman",
            "Verdana"
        ],
        fontColor: true,
        fontSize: true,
        // uploads
        imageUpload: true,
        fileUpload: false,

        urls: false,
        // code
        removeStyles: true,
        code: false,
        // colors
        colors: [],
        useParagraph: true,
        maxlength: 0,
    })
    // var editor = new FroalaEditor('#edit');
    // new FroalaEditor('div#froala-editor', {
    //  // Define new image styles.
    //  toolbarButtons: ['insertFiles'],
    //  // saveParam: 'content'
    //  saveParams: {
    //      id: 'edit'
    //  }
    // });
    // alert();

    // new FroalaEditor('.selector', {
    //   });
    // new FroalaEditor('#edit > button', {
    //   ,

    // });
    // new FroalaEditor('.selector', {
    //   heightMin: 300
    // });
    let email;
    $(document).ready(function () {

        email = $("#email_emp").val();
        // $("#btn_editor").on("click", function () {

        getNotes(email).then(res => {
            let rootPath = $("#rootNoteFolder").val();
            getFolders(rootPath);
        });
        // });

        $(".save_btn").on("click", function () {
            var email = $("#email_emp").val();
            var noteName = $("#noteName").val();
            var otherIdentifier = $("#otherIdentifier").val();
            console.log(otherIdentifier);
            var tagIdentifire = $("#tagIdentifire").val();
            var noteBody = $('.richText-editor').html();
            var notePath = $("#notePath").val();
            var file_id = $("#file_id").val();
            // alert(noteBody);

            if (noteName !== "" && notePath !== "") {
                $.ajax({
                    type: "POST",
                    url: "https://rmt.ecovisrkca.com/createNotes",
                    data: {
                        noteName: noteName,
                        noteBody: noteBody,
                        notePath: notePath,
                        otherIdentifier: otherIdentifier,
                        tagIdentifire: tagIdentifire,
                        email: email,
                        file_id: file_id
                    },
                    dataType: "json",
                    cache: false,
                    success: function (result) {
                        if (result.status === 200) {
                            $(".bd-example-modal-xl").modal("hide");
                            let rootPath = $("#rootNoteFolder").val();

							if(file_id == null)
							{
								getFolders(notePath);
							}
							else
							{
								var notePath = $('#currentLocation').val();
								getFolders(notePath);
							}
                            email = $("#email_emp").val();
                            getNotes(email).then(res => {
                                AllNotes = res.body;
                            });
                            app.successToast(result.body);
                        } else {
                            app.successToast(result.body);
                        }
                    }
                });
            } else {
                $("#noteName").focus();
            }

        });

        $(".add_new_notepad").click(function (e) {
            $("#otherIdentifier").val("");
            $("#tagIdentifire").val("");
            $(".bd-example-modal-xl").modal("show");
            $('.richText-editor').html("");
            $("#noteName").val("");
            $("#file_id").val("");
            $('#notePath').val($("#currentLocation").val());
            $("#open_notepad").show()
        });
        $("#close_notepad").click(function () {

            $(".bd-example-modal-xl").modal("hide");
            $("#open_notepad").hide()
        });

        getTagNames();
    })

    function openFolder(root, basePath, folderName, note = 0) {
        if (note === 0) {
            if (rootFolder !== null) {
                getFolders(basePath + folderName + "/");
                mainRootFolder = basePath;
                currentLocation = basePath + folderName;
                $('#locationOfFolder').val(currentLocation);
                $('#currentLocationToFileUpload').empty();
                $('#currentLocationToFileUpload').text(currentLocation);

            }
        } else {
            if (rootFolder !== null) {
                getNotesFolders(basePath + folderName + "/");
                mainRootFolder = basePath;
                currentLocation = basePath + folderName;
                $('#locationOfFolder').val(currentLocation);
                $('#currentLocationToFileUpload').empty();
                $('#currentLocationToFileUpload').text(currentLocation);

            }
        }

    }
    function getTagNames(){
        //getTagFiles
        $.ajax({
            url: "https://rmt.ecovisrkca.com/getAllTags",
            type: "POST",
            dataType: "json",
            data:{tagId:0,email:email},
            success: function (result) {

                if (result.status === 200) {
                    var option='<option value="">Select Tag Identifier</option>';
                    $.each(result.body, function (i) {
                        var tag_name=result.body[i].tag_name;
                        var tag_id=result.body[i].id;
                        option += '<option value="'+tag_id+'">'+tag_name+'</option>';
                    });
                    $("#tagIdentifire").html(option);
                    $("#tagIdentifire1").html(option);

                }
                $.LoadingOverlay("hide");
            },
            error: function (error) {
                console.log(error);
                $.LoadingOverlay("hide");
            }
        });
    }
    function getFolders(folder = -1,char='-1') {
        if(folder == -1){
            var folder = $("#rootNoteFolder").val();
        }
        var tagIdentifire1=$("#tagIdentifire1").val();
        $.LoadingOverlay("show");
        $.ajax({
            url: "https://rmt.ecovisrkca.com/get_folder_structure",
            type: "POST",
            dataType: "json",
            data: {folderName: folder, email: email,tagIdentifire1:tagIdentifire1},
            success: function (result) {
                if (result.code === 200) {
                    let folders = result.folders;
                    rootFolder = result.rootFolder;
                    currentLocation = result.currentFolder;
                    let user_id = result.user_id;
                    mainRootFolder = rootFolder;
                    root = result.root;
                    let template = '';
                    template += folders.map(setRowTemplate).join('');

                    $('#list_view_main_section').empty();
                    $('#list_view_main_section').append(template);
                    let label=setCurrentLocation(currentLocation);
                    $('#rootFolderName').val(root);
                    $('#locationOfFolder').val(rootFolder);
                    $('#currentLocation').val(currentLocation);

                    if((label==$("#rootFolderName").val()) || (label == user_id)){
                        $('#currentFolderLocationLable').text("My Notes");
                        $("#btnBack").addClass("d-none");
                    }else{
                        $('#currentFolderLocationLable').text(label);
                        let rootpath = $("#rootNoteFolder").val();
                        let backpath = $("#locationOfFolder").val();
                        if (rootpath === backpath) {
                            $("#btnBack").addClass("d-none");
                        } else {
                            $("#btnBack").removeClass("d-none");
                        }
                    }
                    if(char == 'S'){
                        searchfile();
                    }


                }
                $.LoadingOverlay("hide");
            },
            error: function (error) {
                console.log(error);
                $.LoadingOverlay("hide");
            }
        });
    }

    // formatting function
    function setCurrentLocation(name) {
        let nameArray = name.split('/');
        if (nameArray.length > 3) {
            $('#backButtonArrow').removeClass('fa-folder f-folder');
            $('#backButtonArrow').addClass('fa-arrow-left');
            return nameArray[nameArray.length - 2];
        } else {
            $('#backButtonArrow').removeClass('fa-arrow-left');
            $('#backButtonArrow').addClass('fa-folder f-folder');
            return 'My Notes';
        }
    }

    function getNotes(email=null) {
        if(email == null){
            email = $("#email_emp").val();
            var tagIdentifire1=$("#tagIdentifire1").val();
        }
        return new Promise(((resolve, reject) => {
            $.ajax({
                type: "POST",
                url: "https://rmt.ecovisrkca.com/getUserNotes",
                data: {email: email,tagIdentifire1:tagIdentifire1},
                dataType: "json",
                success: function (result) {
                    $.LoadingOverlay("hide");
                    if (result.status === 200) {
                        $("#rootNoteFolder").val(result.rootPath);
                        resolve(result)
                    } else {
                        toastr.error("Note Configuration Missing");
                        reject(0);
                    }
                }, error: function (error) {
                    $.LoadingOverlay("hide");
                    toastr.info('Something went wrong please try again');
                    reject(0);
                }
            });
        }))
    }

    function setRowTemplate(object, index) {
        if (object.type === 1) {
            return setNotesFoldersTempate(object, index);
        } else {
            return setNotesTempate(object, index);
        }
    }

    function goBack() {
        let backpath = $("#locationOfFolder").val();
        var currentLocation=$("#currentLocation").val();

        backpath.replace(currentLocation, "");
        console.log(currentLocation);
        console.log(backpath.replace(currentLocation, ""));
        // let rootpath = $("#rootNoteFolder").val();
        // if (rootpath === backpath) {
        //     $("#btnBack").addClass("d-none");
        // } else {
        //     $("#btnBack").removeClass("d-none");
        // }
        getFolders(backpath);
    }

    function setNotesFoldersTempate(object, index) {
        if (object.type == 1) {
            let t = object.basePath.split('/');
            let basePath = t.filter((e) => e !== "").join('/');
            return `<div class="align-items-baseline d-flex folder" onclick="openFolder('${object.root}','${basePath + "/"}','${object.name}',0)">
                                <span class="folder_icon ml-1"><i class="far fa-folder-open"></i></span>
                                <h6 class="folder_name ml-2"> ${object.name}</h6>
                            </div>`
        }

        // return `<div class="navbars-items f-align-items-center">
        //                                 <div class="col-sm-6">
        //                                     <div class="f-file-item-group">
        //                                        <input type="checkbox"  id="checkbox_note_${index}" name="checkbox"
        //                                     onchange="moveFolderSelected('checkbox_move_${index}',${object.type},'${object.basePath}','${object.name}')" >
        //                                          <i class="fa fa-folder text-warning mx-2"></i>
        //                                         <span class="mr-2"  ondblclick="openFolder('${object.root}','${object.basePath+"/"}','${object.name}',1)">
        //                                       ${object.name}</span>

        //                                     </div>
        //                                 </div>
        //                                 <div class="col-sm-3 text-right">

        //                                 </div>
        //                                 <div class="col-sm-3 text-right">

        //                                 </div>
        //                             </div>`
    }

    function setNotesTempate(object, index) {
        let fileInfo = getNameAndSizeIcon(object);
        var   other_identifier1 ='';
        var other_identifier=object.other_identifier;

        if(other_identifier == 'undefined' || other_identifier == null || other_identifier == ""){
               other_identifier1 ='';
        }else{
             other_identifier1 =` <span class="badge-info" style="border-radius: 8px;padding: 1px;font-size: 11px;" >${other_identifier}</span>`;

        }
        var tag='';
        var tagidentifier=object.tagidentifier;
        if(tagidentifier == '' || tagidentifier == null){
             tag=`<span class="file_icon mr-2"><i class="far fa-file-alt add_new_notepad"></i></span >`;
        }else{
            var arr=tagidentifier.split("|");
            var color=arr[0];
             tag=`<span class="file_icon mr-2"><i class="fa fa-bookmark add_new_notepad" style="color:${color}"></i></span >`;
        }
        return `<div class="align-items-baseline d-flex files" style="width: 200px" file-id="4" onclick="openNote('${fileInfo.fullName}','${object.id}','${object.basePath}')">

                                <p class="file_name ml-2 d-flex" style="font-weight: 400!important;line-height: 20px;">${tag} ${fileInfo.fullName} ${other_identifier1} </p>
                            </div>`;

    }

    function getNameAndSizeIcon(object) {

        let nameArray = object.name.split('.');
        let name = nameArray[0].substr(0, 10) + "." + nameArray[nameArray.length - 1];
        let fullName = nameArray[0] + "." + nameArray[nameArray.length - 1];
        let size = "";
        let icon = "";
        let date = new Date(object.lastModify * 1000);
        return {name: name, size: size, icon: icon, date: date, fullName: fullName};
    }

    function openNote(fileName, file_id, basePath) {
        $('.fcbtn_hide').hide();
        // data-toggle="modal" data-target=".bd-example-modal-xl"
        $(".bd-example-modal-xl").modal("show");
        $("#open_notepad").show();
        // preventDefault();
        // stopPropagation();
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: "https://rmt.ecovisrkca.com/readNotes",
            dataType: "json",
            data: {file_id: file_id},
            success: function (result) {
                $.LoadingOverlay("hide");
                $('#noteName').val("");
                $('.richText-editor').html("");
                $('#otherIdentifier').val("");
                $('#tagIdentifire').val("");
                if (result.status === 200) {
                    $('.fcbtn_hide').hide();
                    $('#noteName').val(fileName);
                    $('#otherIdentifier').val(result.other_identifier);
                    $('#tagIdentifire').val(result.tag_id);
                    $('#file_id').val(file_id);
                    let t = basePath.split('/');
                    basePath = t.filter((e) => e !== "").join('/');
                    $('#notePath').val(basePath + "/" + fileName);
                    $('.richText-editor').html("").html(result.body);
                } else {

                    toastr.error(result.body);
                }
            }, error: function (error) {
                reject(null);
                $.LoadingOverlay("hide");
                toastr.info('Something went wrong please try again');
            }
        });
    }
</script>
<script>
    let UnderEmployee;
    let UnderFocusView;
    let AllNotes;
    $(document).ready(function () {

        focusViewTask();
        todaysViewTask();
        showHide(1, 'taskAssignFooter');
        getLeaveTypes();
        getEmployeeUnderSenior();
        taskAssignByUViewdata();
        taskAssignToUviewData();
        load_data();
        CheckPunchForToday();
        GetUserPermission();

        FungetAllSticky();
        getAllNotesEmp();
        // $('body').on('click', function (e) {
        //     $('[data-toggle=popover]').each(function () {
        //         // hide any open popovers when the anywhere else in the body is clicked
        //         if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
        //             $(this).popover('hide');
        //         }
        //     });
        // });

        $("#locationpopover").attr('data-content', localStorage.getItem('LognAddr'));
    });

    function getAllsticky() {
        get_All_Sticky();
    }

    function appendRow() {
        $('#focusAreaTable').rsLiteGrid('addRow');
    }

    function addNewRow() {
        $("#seconButton").show();
        $("#firstButton").hide();
        $("#firstTableHeader").hide();
        $('#focusAreaTable').rsLiteGrid({

            cols: [{
                name: 'focus_details',
                header: 'Details',
                markup: '<input type="text" class="form-control"  onfocusout="myFunction()">'
            }, {
                name: 'date',
                header: 'Target Date',
                markup: '<input type="date" class="form-control" onfocusout="myFunction()">',

            }, {
                name: 'assign_to',
                header: 'Employee',
                markup: '<select class="form-control"><option value="1">Narendra</option>' +
                    '<option value="2">Pooja</option><option value="3">Supriya</option></select>',

            },
                {
                    // Delete button needs no name, since this columns does not need to be exported to Json
                    markup: '<button class="btn btn-link" title="delete this row"><i class="fa fa-trash"></i></button>',
                    tabStop: false
                }],

            // event fired after each row is appended to the table.
            // The right place to set the click event for the delete row button

            onAddRow: function (event, $lastNewRow) {
                // console.log($lastNewRow);
                $('.firsttext').data('myval', $lastNewRow);
                $('button', $lastNewRow).click(function () {
                    $('table').rsLiteGrid('delRow', $lastNewRow);
                });
            }

            // load table with 2 rows of data
        }).rsLiteGrid('setData', [
            // { focus_details: 'Design Idea of HRMS', assign_to: 1},
            // { focus_details: 'Implement Calendar Configuaration', assign_to: 2 },
            // { focus_details: 'Implement Sticky Note', assign_to: 3 },
        ]);

        // export data
        $('table + button').click(function () {
            console.log($('table').rsLiteGrid('getData'));
            alert('Open your browser console to see the Json data.');
        })
        $('#focusAreaTable').rsLiteGrid('addRow');

    }

    function myFunction() {
        // code to save the data
        var a = $('.firsttext').data('myval'); //getter
        console.log(a);
    }


    function getCommentDiv(id) {
        // console.log('hiiiii');
        $("#" + id).toggle();
    }


    function getLeaveDates(id) {
        if (id == 0) {
            $('#startDateDiv').show();
            $('#EndDateDiv').hide();
        } else {
            $('#EndDateDiv').show();
            $('#startDateDiv').show()
        }


    }

    function viewFocusView() {
        $("#ViewFocusComment").modal('show');

    }

    function viewTodaysView() {
        $("#ViewActivityComment").modal('show');

    }

    function GetUserPermission() {
        //focusAreaAddbutton
        app.request(baseURL + 'getPermissionUser').then(result => {
            // $.LoadingOverlay("hide");
            if (result.status === 200) {
                var permission_array = result.permission_array;
                if (permission_array['focus_area_permission'] == 1) {
                    $("#focusAreaAddbutton").show();
                } else {
                    // $("#focusAreaAddbutton").hide();
                    $("#focusAreaAddbutton").show();
                }
            } else {
                // app.errorToast(result.body);
            }
        }).catch(error => {
            console.log(error);
            // $.LoadingOverlay("hide");
            //   app.errorToast("something went wrong please try again");
        })
    }
    function getDataFilesearch(id){
if($('#'+id).val() == ""){
   getFolders();
}
        var note='';
        var loadingContent='';
        var rootNoteFolder=$("#rootNoteFolder").val();
        var arr1=rootNoteFolder.split('/');
        var user_id=arr1[2];
        loadingContent='<div style="padding: 16px">Loading</div>';
        note=getemployeeNotes();
        var final_array=[];
        $(note).each(function (index) {
          var file_path=  note[index].file_path;
          var arr=  file_path.split('/');
          if(arr[2] ==user_id){
              final_array.push(note[index])
          }
        });
         note =final_array;
         console.log(note);
        var tributeMultipleTriggers = new Tribute({
         //   autocompleteMode: true,
            // menuContainer: document.getElementById('content
            collection: [
                {
                    // The symbol that starts the lookup
                    trigger: "#",

                    loadingItemTemplate: loadingContent,

                    // The function that gets call on select that retuns the content to insert
                    selectTemplate: function(item) {
                        if (this.range.isContentEditable(this.current.element)) {
                            /*return (
                                '<span contenteditable="false" onclick="ClickSerachFile(+item.original.key +)" class="label text-info" data-emp_id="'+item.original.value+'" data-type="notes">'
                                +item.original.key +
                                "</span>&#8203;"
                            );*/
                            ClickSerachFile(item.original.key,item.original.value,item.original.file_path)
                        }
                        var d="<span onclick='"+ClickSerachFile(item.original.key,item.original.value,item.original.file_path)+"'>"+item.original.name+"</span>"
                        return d ;
                    },
                    // function retrieving an array of objects
                    values: function(_, cb) {
                        setTimeout(() => cb(note), 1000)
                    },
                    lookup: "key",

                    fillAttr: "key"

                }
            ]
        });


        // tribute.attach(document.getElementById("testInput"));
        tributeMultipleTriggers.attach(document.getElementById(id));
    }
    function ClickSerachFile(id,o_id,path) {
            console.log(id);
            $("#mySearchNotepad1").val(id);
            var arrURL;
            var  newURL;
            arrURL = path.split('/');
            arrURL.pop();
            newURL = arrURL.join('/') + '/';
            console.log(newURL);
            getFolders(newURL,'S');



    }
</script>
<script type="text/javascript">
    function showEmployeeView(emp_name, emp_id, provision, emp_user_id) {
        // var classname=document.getElementsByClassName('senior_view');
        // classname.style.display="none";


        $('.senior_view').show();
        $('.employee_view').hide();
        $('#employee_name').html(emp_name);
        $('#backProfile').show();
        $('.todayDetail').hide();
        $("#whichProfile").val(provision);
        $("#whichEmployeeId").val(emp_id);
        $("#whichEmployeeUserId").val(emp_user_id);

        $(".addPlusBtn").hide();
        focusViewTask();
        todaysViewTask();
        document.getElementById('chat-form2').style.display = "none";
        document.getElementById('chat-form').style.display = "none";
        showHide(1, 'taskAssignFooter');
        taskAssignByUViewdata();
        document.getElementById('chat-form-task').style.display = "none";
        taskAssignToUviewData();
        // load_data();
        // CheckPunchForToday();
        LoadCalendar();
        $(".employeeUnderUi-3").css({"top": "-260px"});
    }

    // $( "#focusMessageInput" ).keypress(function( event ) {
    //   console.log(event);
    //   if ( event.which == 13 ) {

    //   }

    // });

    function editTodaysListView() {
        $("#EditTodaysTaskModal").modal('show');
        $("#todaysTaskEmplyee").select2();
    }

    function editAssignTaskView(argument) {

        $("#EditAssignTaskModal").modal('show');
        $("#assignTaskEmplyee").select2();
    }
</script>
<script>
    function showHide(value, id) {
        if (value == 1) {
            $("#" + id).hide();
            $('#profile-tab-btn').hide();
        } else {
            $("#" + id).show();
            $("#taskAMessageInput").focus();
            $('#profile-tab-btn').css('display','block');
        }
    }

    // function mySearchAtListFuction(searchId,listId)
    // {


    // }

    $("#mySearchActivityFocusdata").keyup(function () {
        var filter = $(this).val();
        $("#todaysAcitivity-list li").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show()
            }
        });
    });
    $("#mySearchEmployeeUnderUi").keyup(function () {
        var filter = $(this).val();
        $("#leftSideEmployeeView li").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show()
            }
        });
    });
    $("#mySearchNotepad").keyup(function () {
        var filter = $(this).val();
        $("#list_view_main_section p").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
                //$("#list_view_main_section span").show();
            }
        });
    });
    function searchfile(){
        var filter = $("#mySearchNotepad1").val();
        $("#list_view_main_section p").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
                $("#list_view_main_section").children('.folder').removeClass('d-flex');
                $("#list_view_main_section").children('.folder').hide();

             //   $("#list_view_main_section span").hide();
                console.log('pooja');
            } else {
                console.log('pooja11');
                $(this).show();
                //$("#list_view_main_section span").show();
            }
        });
    }
    function showPopver(btnId, divId) {
        $("#" + btnId).popover({
            title: '',
            container: 'body',
            placement: 'bottom',
            html: true,
            content: function () {
                return $('#' + divId).html();
            }
        });
    }

    function getAllNotesEmp(id, empdivId) {
        email = $("#email_emp").val();
        getNotes(email).then(res => {

            AllNotes = res.body
            var userdata = res.body;
            for (var i = 0; i < userdata.length; i++) {
                list = `  <li class="list-group-item emp_list" onclick="setTextToCurrentPos('${id}','${btoa(userdata[i].name)}',${userdata[i].id},${empdivId},'employee')">${userdata[i].name}</li>`;
                $("#" + empdivId).find('.list-group').append($(list).fadeIn());
            }
        });
    }

    function getEmployeeUnderSenior() {
        // $.LoadingOverlay("show");
        app.request(baseURL + 'getEmployeeUnderSenior', null).then(result => {
            // $.LoadingOverlay("hide");
            if (result.status == 200) {
                // app.successToast(result.body);
                // console.log(result.data);
                $("#leftSideEmployeeView").empty();
                var list = ``;
                var userdata = result.data;
                UnderEmployee = result.data;
                if (userdata.length > 3) {
                    // $( "#home-tab3" ).tabs({ active: 0 });
                    $("#home-tab3").removeClass("active");
                    $("#profile-tab3").addClass("active");
                    $("#home3").removeClass("active show");
                    $("#profile3").addClass("active show");
                    $("#profile-tab-btn").show();
                } else {
                    $("#home-tab3").addClass("active");
                    $("#profile-tab3").removeClass("active");
                    $("#home3").addClass("active show");
                    $("#profile3").removeClass("active show");
                }
                for (var i = 0; i < userdata.length; i++) {
                    var check = `${userdata[i].focus_area_control}`;
                    if (check == 1) {
                        var c = "checked";
                    } else {
                        var c = "";
                    }
                    /*  list = ` <li><div class="row" style="width: 261px;"><div class="col-md-8"><span onclick="showEmployeeView('${userdata[i].user_name}',${userdata[i].id},1,'${userdata[i].user_id}')">${userdata[i].user_name}</span></div>
  <div class="col-md-4"><span title="Focus Creation Permission"><input ${c} type="checkbox" ></span></div></div></li>`;*/
                    list = ` <li><span onclick="showEmployeeView('${userdata[i].user_name}',${userdata[i].id},1,'${userdata[i].user_id}')">${userdata[i].user_name}</span>
</li>`;
                    $("#leftSideEmployeeView").append(list);
                }
            } else {
                app.errorToast(result.body);
            }
        }).catch(error => {
            // console.log(error);
            // $.LoadingOverlay("hide");
            // app.errorToast("something went wrong please try again");
        });
    }

    function listUnderEmployee(empdivId, id) {
        // console.log(UnderEmployee);
        var list = ``;
        if (UnderEmployee != "") {
            var userdata = UnderEmployee;
            $("#" + empdivId).find('.list-group').empty();
            for (var i = 0; i < userdata.length; i++) {
                list = `  <li class="list-group-item emp_list" onclick="setTextToCurrentPos('${id}','${btoa(userdata[i].user_name)}',${userdata[i].id},${empdivId},'employee')">${userdata[i].user_name}</li>`;
                $("#" + empdivId).find('.list-group').append($(list).fadeIn());
            }
        }
    }

    function getemployeeNotes() {
        let list_array = [];
        if (AllNotes != "") {
            var userdata = AllNotes;
            for (var i = 0; i < userdata.length; i++) {
                let object =  userdata[i];
                if (object.file_path !== null) {
                    let nameArray = object.file_path.split('/');
                    var newElement = {};
                    newElement['value'] = userdata[i].note_file;
                    newElement['key'] = nameArray[nameArray.length - 1];
                    newElement['file_path'] = userdata[i].file_path;
                    list_array.push(newElement);
                }

            }
        }
        console.log(list_array);
        return list_array;
    }

    function getemployeesUnderSenior() {
        let list_array = [];
        if (UnderEmployee != "") {
            var userdata = UnderEmployee;
            for (var i = 0; i < userdata.length; i++) {
                var newElement = {};
                newElement['value'] = userdata[i].id;
                newElement['key'] = userdata[i].user_name;
                list_array.push(newElement);
            }
        }
        return list_array;
    }

    function getFocusUnderSenior() {
        let list_array = [];
        if (UnderFocusView != "") {
            var userdata = UnderFocusView;
            for (var i = 0; i < userdata.length; i++) {
                var newElement = {};
                newElement['value'] = userdata[i].id;
                newElement['key'] = userdata[i].focus_details;
                list_array.push(newElement);
            }
        }
        return list_array;
    }

    function listUnderFocusView(empdivId, id) {

        if (UnderFocusView != "") {
            var userdata = UnderFocusView;
            $("#" + empdivId).find('.list-group').empty();
            for (var i = 0; i < userdata.length; i++) {
                // // var $html=$(userdata[i].focus_details);
                var html = userdata[i].focus_details;
                // var str = html.prop('outerHTML');
                //   console.log(str);
                html = html.replaceAll('?', '');
                list = `<li class="list-group-item emp_list" onclick="setTextToCurrentPos('${id}','${btoa(html)}',${userdata[i].id},${empdivId},'focus')">${html}</li>`;
                $("#" + empdivId).find('.list-group').append($(list).fadeIn());
            }
        }

    }

    function listUnderActivityHoursView(empdivId, id, listId) {
        // console.log(listId);
        $("#" + listId).find('.list-group').empty();
        for (var i = 1; i <= 24; i++) {
            // // var $html=$(userdata[i].focus_details);
            var html = i + 'Hr';
            // var str = html.prop('outerHTML');
            //   console.log(str);
            // html=html.replaceAll('?','');
            list = `<li class="list-group-item emp_list" onclick="setTextToCurrentPos('${id}','${btoa(html)}','${html}',${listId},'hours')">${html}</li>`;
            $("#" + listId).find('.list-group').append($(list).fadeIn());
        }

    }

    function getActivityHours() {
        let list_array = [];
        if (UnderFocusView != "") {
            var userdata = UnderFocusView;
            for (var i = 1; i <= 24; i++) {
                var html = i + 'Hr';
                var newElement = {};
                newElement['name'] = html;
                newElement['email'] = html;
                list_array.push(newElement);
            }
        }
        return list_array;

    }

    function heightHideShow(divId, ctrl) {
        $("#btn_editor").show();
        var x = document.getElementById(divId);
        if (x.style.left === "0px") {
            x.style.left = "-300px";
            if (divId == "slide_a") {
                $('.leftside3').css('z-index', 3);
            }
        } else {
            x.style.left = "0px";
            if (divId == "slide_a") {
                $('.leftside3').css('z-index', 1);
                $("#btn_editor").hide();
            }
        }
        if (divId == "slide_a3") {
            $('.leftside3').css('z-index', 2);
        } else {
            $('.leftside3').css('z-index', 3);
        }
        if (divId == "slide_a1") {
            // var emp_div=document.getElementById('stickiempId');
            // if(emp_div.style.top=="10px")
            // {

            //      emp_div.style.top="175px";
            // }
            // else
            // {
            //     emp_div.style.top="10px";
            // }

            FungetAllSticky();
        }


    }

    function runScript(e) {
        if (e.keyCode == 13) {
            var stickynote = $("#StickyNote").val();
            var stickyID = $("#stickyID").val();
            $("#StickyNote").val("");
            if (stickynote != "") {
                let formData = new FormData();
                formData.set("stickynote", stickynote);
                formData.set("stickyID", stickyID);
                app.request(baseURL + 'CreateNewSticky', formData).then(result => {
                    // $.LoadingOverlay("hide");
                    if (result.status === 200) {
                        app.successToast(result.body);
                        $("#StickyNote").val("");
                        $("#stickyID").val("");
                        FungetAllSticky();
                    } else {
                        app.errorToast(result.body);
                    }
                }).catch(error => {
                    console.log(error);
                    // $.LoadingOverlay("hide");
                    //   app.errorToast("something went wrong please try again");
                })

            }
        }
    }

    function FungetAllSticky() {
        app.request(baseURL + 'getAllSticky').then(result => {
            // $.LoadingOverlay("hide");
            if (result.status === 200) {
                $("#STickyData").html(result.data);
            } else {
                $("#STickyData").html(result.data);
            }
        }).catch(error => {
            console.log(error);
        })
    }

    function deleteSticky(id) {
        let formData = new FormData();
        formData.set("id", id);
        app.request(baseURL + 'UpdateSticky', formData).then(result => {
            // $.LoadingOverlay("hide");
            if (result.status === 200) {
                app.successToast(result.body);
                FungetAllSticky();
            } else {
                app.errorToast(result.body);
                FungetAllSticky();
            }
        }).catch(error => {
            console.log(error);
            // $.LoadingOverlay("hide");
            //   app.errorToast("something went wrong please try again");
        })
    }

    function updateStickyFetch(id, data) {

        var data = atob(data);
        $("#StickyNote").val(data);
        $("#stickydiv").animate({
            scrollTop: $("#StickyNote").position().top
        }, 500);
        $("#stickyID").val(id);

    }

    function goToPayroll(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url("PayrollController/payroll_login") ?>",
            dataType: "json",

            success: function (result) {
                if (result.code === 200) {
                    var email = result.email;
                    var password = result.password;
                    window.location.assign("https://payroll.ecovisrkca.com/Login/rmt_login?user_id1=" + email + "&password1=" + password + "&id=" + id);
                } else {
                    alert("Your email id is not found please login. if you have your login id and password");
                    window.location.assign("https://payroll.ecovisrkca.com");
                }
            },
            error: function (error) {
//                                                                $("#loader12").hide();
                alert("Something went wrong!");
            }
        });
    }
</script>
<script>
    $(document).ready(function () {

        $("#NotesModalView").on('show.bs.modal', function () {
            $(".b").click(function () {
                $(this).toggleClass("b");
                $(this).toggleClass("b-selected");
            });

            $(".carousel-cell").on("click", function () {
                $(".carousel-cell").removeClass("is-selected");
                $(this).addClass("is-selected");
            });

            $("#add_more").on("click", function () {
                var new_card = '<div class="carousel-cell"><textarea class="form-control" id="input_text" rows="10"></textarea><p  class= "n"><div><input type="text" class="form-control" placeholder="Note Name" name="" style="border: none;padding: 3px 1px;width: 72%;display: inline;"><button type="button" name="btn_save" class="btn btn-success btn-sm" style="width: 25%;float:right;margin: 3px;">save</button></div></p></div>';
                // $('.flickity-slider').append(new_card);
                // flkty.flickity( 'append', new_card );
                // flkty.append(new_card);
                // $('.flickity-slider').flickity( 'append', elements )
                var cellElems = [insertNewCell()];
                // console.log(cellElems);

                flkty.insert(cellElems, flkty.slides.length);
                flkty.select(flkty.slides.length - 1);
                trumbwyogeditor(cellCount);
                // insertNewCell();
            });
        })

    });

    const elem = document.querySelector('.carousel');
    const flkty = new Flickity(elem, {
        // options
        cellalign: 'left',
        pageDots: false,
        groupCells: '20%',
        selectedAttraction: 0.03,
        friction: 0.15
    });

    let cellCount = flkty.cells.length;

    function makeCell() {
        cellCount++;
        var cell = document.createElement('div');
        cell.className = 'carousel-cell';
        cell.textContent = cellCount;
        return cell;
    }

    function insertNewCell1(index) {
        cellCount++;
        let template = `<div class="carousel-cell">
            <textarea id="noteBody${cellCount}"></textarea>
            <p class="n">
            <div>
                <input type="text" class="form-control" placeholder="Note Name" id="noteName${cellCount}" name="noteName${cellCount}"
                       style="border: none;padding: 3px 1px;width: 72%;display: inline;">
<input type="hidden" id="file_open_id${cellCount}" name="file_open_id${cellCount}">
                <button type="button" name="btn_save" onclick="saveNotes(${cellCount})" class="btn btn-success btn-sm"
                        style="width: 25%;float:right;margin: 3px;">save
                </button>
            </div>
            </p>
        </div>`;
        let parser = new DOMParser();
        let element = parser.parseFromString(template, "text/html");
        console.log(element.body.childNodes[0])
        //cellCount++;
        return element.body.childNodes[0];
        // flkty.insert([element.body],cellCount);
    }

    function insertNewCell(index) {
        cellCount++;
        let template = `<div class="carousel-cell">
            <textarea class="form-control" id="noteBody${cellCount}" rows="10"></textarea>
            <p class="n">
            <div class="btn-group p-2">
                <input type="text" class="form-control" id="noteName${cellCount}"  name="noteName${cellCount}" placeholder="Name" name="">
                <input type="hidden" id="file_open_id${cellCount}" name="file_open_id${cellCount}">
                <button type="button" name="btn_save" class="btn btn-success btn-sm"  onclick="saveNotes(${cellCount})"
                        style="width: 25%;float:right;margin: 3px;">save
                </button>
            </div>
            </p>
        </div>`;
        let parser = new DOMParser();
        let element = parser.parseFromString(template, "text/html");
        console.log(element.body.childNodes[0])

        return element.body.childNodes[0];
        // flkty.insert([element.body],cellCount);
    }

    function trumbwyogeditor(cellCount) {
        $('#noteBody' + cellCount).trumbowyg({
            btns: [['strong', 'em',], ['insertImage']],
            autogrow: true
        });

    }

    // function saveNotes(count){
    //
    //  formdata = new FormData();
    //  formdata.append('noteName', document.getElementById('noteName'+count).value);
    //  formdata.append('noteBody', document.getElementById('noteBody'+count).value);
    //  formdata.append('file_id', document.getElementById('file_open_id'+count).value);
    //  formdata.append('email', document.getElementById('user_email').value);
    //  $.LoadingOverlay("show");
    //  saveNote(formdata).then(success => {
    //      if (success.status === 200) {
    //          toastr.success(success.body);
    //          $.LoadingOverlay("hide");
    //
    //      } else {
    //          $.LoadingOverlay("hide");
    //          toastr.error(success.body);
    //          toastr.error(success.body);
    //      }
    //  }).catch(error => {
    //      console.log('note save error ', error);
    //      $.LoadingOverlay("hide");
    //  });
    // }
    // function saveNote(formdata) {
    //  return new Promise((resolve, reject) => {
    //      $.ajax({
    //          type: "POST",
    //          url: "https://rmt.ecovisrkca.com/createNotes",
    //          data: formdata,
    //          dataType: "json",
    //          processData: false,
    //          contentType: false,
    //          cache: false,
    //          async: false,
    //          success: function (success) {
    //              resolve(success);
    //          },
    //          error: function (error) {
    //              reject(error);
    //          }
    //      });
    //  });
    // }

</script>
<script> // for 1st label
    let my_notes_count = 0;
    $("#btn_action").click(function(e){
        if(my_notes_count == 0){
            my_notes_count = 1;
            $("#my_notes_commimg").css({"z-index":3});
            $("#my_notes_commimg").animate({left:"0px"},'slow', 'linear');
            $(".action_btn2").hide();
            $(".action_btn3").hide();
        }
        else{
            $("#my_notes_commimg").animate({left:"-250px"},'slow', 'linear',function(){
                $("#my_notes_commimg").css({"z-index":0});
                $(".action_btn2").show();
                $(".action_btn3").show();
            })

            my_notes_count = 0;
        }
    });
</script>
<script> // for 2nd labal
    let my_notes_count_2 = 0;
    $("#btn_action_2").click(function(e){
        if (my_notes_count_2 == 0) {
            my_notes_count_2 = 1;
            $("#my_notes_commimg_2").css({"z-index":3});
            $("#my_notes_commimg_2").animate({left:"0px"},'slow', 'linear');
            $(".action_btn1").hide();
            $(".action_btn3").hide();
        }
        else{

            $("#my_notes_commimg_2").animate({left:"-250px"},'slow', 'linear',function(){
                $("#my_notes_commimg_2").css({"z-index":0});
                $(".action_btn1").show();
                $(".action_btn3").show();
            })
            my_notes_count_2 = 0;
        }
    });
</script>
<script> // for 3rd labal
    let my_notes_count_3 = 3;
    $("#btn_action_3").click(function(e){
        if (my_notes_count_3 == 3) {
            my_notes_count_3 = 4;
            $("#my_notes_commimg_3").css({"z-index":3});
            $("#my_notes_commimg_3").animate({left:"0px","z-index":3},'slow', 'linear');
            $(".action_btn1").hide();
            $(".action_btn2").hide();
        }
        else{

            $("#my_notes_commimg_3").animate({left:"-250px","z-index":0},'slow', 'linear');
            $(".action_btn1").show();
            $(".action_btn2").show();
            my_notes_count_3 = 3;
        }
    })
</script>