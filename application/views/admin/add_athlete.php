<?php
defined('BASEPATH') or exit('No direct script access allowed');
$id = "";
$user_id = "";
if (isset($this->session->user_session)) {
    $user_id = $this->session->user_session->user_id;
} else {
    redirect(base_url());
}
$this->load->view('_partials/header');
date_default_timezone_set('Asia/Kolkata');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/ui/trumbowyg.min.css" integrity="sha512-nwpMzLYxfwDnu68Rt9PqLqgVtHkIJxEPrlu3PfTfLQKVgBAlTKDmim1JvCGNyNRtyvCx1nNIVBfYm8UZotWd4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="main-content" style="height: 950px">
    <div class="col-lg-12 col-md-12 col-sm-12" style="height: 100%">

        <div class="card chat_scroll card_new" style="
             background-color: #ffffff;height: 100%;
">
            <div class="card-header">

                <h4 style="color: #2C3E50">Events</h4>
                <button class="btn btn-link" type="button" onclick="OpenCreateAthleteEvent()" style="margin-left: auto"><i class="fa fa-plus"></i></button>
            </div>

            <div class="card-body calendar_body" style="background-color: transparent;">
                <div class="col-md-12 mt-5" id='' style="height: 100%!important">
                    <div class="">
                        <table class="table table-bordered" id="Table1" style="    color: black;">
                           <thead>
                           <tr>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Contact Number</th>
                               <th>Location</th>
                               <th>Image</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                            <tbody id="ViewAthlete">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="CreateUpdateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
               <h4> Athlete Details</h4>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body">

                <div class="row">


                    <div class="col-md-12" id="addevendatadiv">
                        <form id="AthleteForm">

                            <input type="hidden" id="updateID" name="updateID">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Athlete Full Name:</label>
                                    <input type="text" id="ath_name" required name="ath_name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Contact Number:</label>
                                    <input type="text" id="ath_contact" required name="ath_contact" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email ID:</label>
                                    <input type="text" id="email_id" required name="email_id" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Location:</label>
                                    <input type="text" id="location" required name="location" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Athlete Image:</label>
                                    <input type="file" id="userfile" required name="userfile[]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Athlete Details:</label>
                                    <textarea required id="editor" name="editor"></textarea>
                                </div>
                            </div>
                            <span id="eventName_Show" ></span>
                            <hr>
                            <div class="section-body">

                            </div>
                            <button class="btn btn-primary" id="saveevbtn" type="button" style="margin-right: auto;float: right"
                                    onclick="addAthleteDetails()">Save
                            </button>

                        </form>
                    </div>
                </div>
                <br>
                <div>

                </div>
            </div>

        </div>


    </div>
</div>
<div id="ViewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4> Athlete Details</h4>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body">

                <div class="row">


                    <div class="col-md-12" id="ImageDIv">

                    </div>
                    <div class="col-md-12" id="DetailsDIv">

                    </div>
                </div>
                <br>
                <div>

                </div>
            </div>

        </div>


    </div>
</div>
<?php $this->load->view('_partials/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js" integrity="sha512-t4CFex/T+ioTF5y0QZnCY9r5fkE8bMf9uoNH2HNSwsiTaMQMO0C9KbKPMvwWNdVaEO51nDL3pAzg4ydjWXaqbg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $( document ).ready(function() {

        getAthleteData();
    });
    $('#editor').trumbowyg();
function OpenCreateAthleteEvent() {
    $("#CreateUpdateModal").modal('show');

}

function getAthleteData() {
    app.request(baseURL + 'ViewAthelet').then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
           $("#ViewAthlete").html(result.data);
           $("#Table1").dataTable();
        } else {
            $("#ViewAthlete").html(result.data);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}
function addAthleteDetails() {
    var form_data = document.getElementById('AthleteForm');
    var formData = new FormData(form_data);
    app.request(baseURL + 'AddAthlete', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#AthleteForm")[0].reset();
            $("#editor").trumbowyg('html','');
            $("#CreateUpdateModal").modal('hide');
            getAthleteData();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}

function deleteAthlete(id) {
    formData=new FormData();
    formData.append('id',id)
    app.request(baseURL + 'DeleteAthelet',formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            getAthleteData();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}

function viewDetails(file,data) {
//ImageDIv
//    DetailsDIv
    $("#ViewModal").modal('show');
    $("#ImageDIv").html(file);
    $("#DetailsDIv").html(data);
}
</script>
