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


<div class="main-content" style="height: 950px">
    <div class="col-lg-12 col-md-12 col-sm-12" style="height: 100%">

        <div class="card chat_scroll card_new" style="
             background-color: #ffffff;height: 100%;
">
            <div class="card-header">

                <h4>Events</h4>

            </div>

            <div class="card-body calendar_body" style="background-color: transparent;">




                <div class="col-md-12" id='calendar-container' style="height: 100%!important">
                    <div id='calendar' style="    max-width: 100%;max-height: 100%;"></div>
                </div>
                <!-- <div class="fc-overflow">
                  <div id="myEvent" class="fc fc-unthemed fc-ltr"></div>

                </div> -->
            </div>
        </div>
    </div>
</div>

    <div id="ViewCalendarModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title badge-info" id="calendarDate"
                      style="padding: 3px;line-height: 1;border-radius: 8px;"></span>


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


                        <div class="col-md-12" id="addevendatadiv">
                            <form id="EventForm">
                                <input type="hidden" id="Og_date" name="Og_date" value="">
                                <input type="hidden" id="updateID" name="updateID">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event Name:</label>
                                        <input type="text" id="event_name" required name="event_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event Location:</label>
                                        <input type="text" id="event_loc" required name="event_loc" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event Start Time:</label>
                                        <input type="time" id="event_starttime" required name="event_starttime" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event End Time:</label>
                                        <input type="time" id="event_endtime" required name="event_endtime" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event Image:</label>
                                        <input type="file" id="userfile" required name="userfile[]" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Event Details:</label>
                                        <textarea required id="editor" name="editor"></textarea>
                                    </div>
                                </div>
                                <span id="eventName_Show" ></span>
                                <hr>
                                <div class="section-body">

                                </div>
                                <button type="button" class="btn btn-danger" title="Delete Event" id="deleteButton" style="margin-left:10px;margin-right: auto;float: right" onclick="deleteEvent()">
                                    Delete
                                </button>
                                <button class="btn btn-primary" id="saveevbtn" type="button" style="margin-right: auto;float: right"
                                        onclick="addEventPayroll()">Save
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

<?php $this->load->view('_partials/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js" integrity="sha512-t4CFex/T+ioTF5y0QZnCY9r5fkE8bMf9uoNH2HNSwsiTaMQMO0C9KbKPMvwWNdVaEO51nDL3pAzg4ydjWXaqbg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('#editor').trumbowyg();

</script>
