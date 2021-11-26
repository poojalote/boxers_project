$( document ).ready(function() {
    LoadCalendar();

});
function LoadCalendar() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'timeGridWeek,timeGridDay,dayGridMonth'
        },

        initialView: 'dayGridMonth',
        editable: true,
        displayEventTime: false,
        dayMaxEvents: true, // when too many events in a day, show the popover
        events: function (fetchInfo, successCallback, failureCallback) {
            app.request(baseURL + 'GetEventData').then(result => {
                // $.LoadingOverlay("hide");
                if (result.status == 200) {
                    var data = result.data;
                    console.log(data)

                    successCallback(data);

                } else {
                    console.log('a');
                }
            }).catch(error => {
                console.log(error);
                // $.LoadingOverlay("hide");
                // app.errorToast("something went wrong please try again11");
            })
            //  callback(data);
        }, eventTextColor: "black", eventOverlap: false,

        dateClick: function (info) {


                getModalCalendarClick(info.dateStr);

        },eventClick: function(info) {
            var d=info.event;
            console.log('pppp');
            console.log(d);
            var  created_by =info.event.extendedProps.createdBy;
            if(d.id !=  ""){
                console.log(d.id);
                var date = convertDate(info);
                getEventBydate(d.id);
            }
            // change the border color just for fun
            info.el.style.borderColor = 'red';
        }

    });

    calendar.render();
}


async function getEventDetailsByID(id,master_id,date,created_by){
    $.LoadingOverlay("show");
    $('#ViewCalendarModal').modal('show');
    $("#textAreaEg").hide();
    $("#h6addev").hide();
    $("#showeventdetails").show();

  //  $('#calendarDate').html("Meeting Schedule");
    $('#EventBy').show();
    $('#EventBy').html("");
    $('#EventBy').html("Schedule By:" +created_by);
    //$("#addevendatadiv").hide();
    let formData = new FormData();
    formData.set("id", id);
    formData.set("master_id", master_id);
    app.request(baseURL + 'GetEventByid',formData).then(async result => {
        // $.LoadingOverlay("hide");
        if (result.status == 200) {
            $("#showeventdetails").show();
            $('#t_div1').css('display','flex');
            $("#event_id").val(id);
            var note_id=result.note_id;
            var is_created=result.is_created;
            if(is_created == 1){
                $("#deleteButton").show();
            }else{
                $("#deleteButton").hide();
            }
            var notetext="";
            var userText=getAsssignAppenddata(result.user_id,'employee');
            if(note_id !== "undefined"){

                let templatedata='';
                var result1= await ShowmodalNotesData(id=1,note_id);
                if (result1.status === 200) {
                    templatedata += result1.body.map(setNotesTempateNote2).join('');
                    notetext = templatedata;
                    console.log(notetext);
                }
            }
            $("#master_event_id").val(master_id);
            $("#eventName_Show").html("<i class='fa fa-calendar'></i><b> "+result.eventName +"</b>"+userText+ notetext);
            var resultAgenda=result.resultAgenda;
            var cnt=2;
            $("#agendaUL").html('');
            $("#textAreaEg").hide();

            $(resultAgenda).each(function(i){
                if(i == 0){
                    $("#updateID").val(resultAgenda[i].event_id)
                    $("#addeventAgenda1").val(resultAgenda[i].agenda_bullet);
                    $("#addeventAgenda1").hide();
                    $('#del_li_btn1').show();
                    $("#agendaspan1").html(resultAgenda[i].agenda_bullet);
                }else{
                    addAgendatolocal(resultAgenda[i].agenda_bullet,cnt);
                }

                cnt++;
            });
            if(resultAgenda.length < 2)
            {
                $('#del_li_btn1').hide();
            }
            $.LoadingOverlay("hide");


        } else {
            $.LoadingOverlay("hide");
            console.log('a');
        }
    }).catch(error => {
        $.LoadingOverlay("hide");
        console.log(error);
        // $.LoadingOverlay("hide");
        //app.errorToast("something went wrong please try again11");
    })
}
function setNotesTempateNote2(object, index) {
    var userText='';
    if (object.file_path !== null) {
        let nameArray = object.file_path.split('/');
        let n = '';
        if (nameArray.length > 3) {
            n = nameArray[nameArray.length - 2];
        } else {
            n = nameArray[nameArray.length - 1];
        }
        var  basePath = nameArray.slice(0, nameArray.length - 1).join('/');
        let date = new Date(object.modify_at);
        userText+=`<span class='label text-info' data-emp_id='${object.note_file}' data-type='notes'
                    contenteditable='false' file-id="4" onclick="openNote('${ nameArray[nameArray.length - 1]}','${object.note_file}','${basePath}')" style="cursor:pointer;background-color: #6c757d;
        border-radius: 20px;color: #f8f9fa !important;padding:0px 2px 0px 2px;">#${ nameArray[nameArray.length - 1]}</span> &#8203;`;

    }
    return userText;

}


function getModalCalendarClick(date) {
    $("#event_name").val("");
    $("#event_loc").val("");
    $("#event_starttime").val("");
    $("#event_endtime").val("");
    $("#updateID").val("");
    $('#editor').trumbowyg("html","");
    $('#ViewCalendarModal').modal('show');
    $("#Og_date").val(date);
    datearr = date.split('T');
    $('#calendarDate').html("Add Event ("+date+")");

    var date = convertDate(datearr[0]);
  //  getEventBydate(date);
}

function getEventBydate(id) {
    $('#ViewCalendarModal').modal('show');
    let formData = new FormData();
    formData.set("id", id);

    app.request(baseURL + 'GetEventByDate', formData).then(result => {
        // $.LoadingOverlay("hide");
        $("#event_name").val("");
        $("#event_loc").val("");
        $("#event_starttime").val("");
        $("#event_endtime").val("");
        $("#updateID").val("");
        $('#editor').trumbowyg("html","");
        if (result.status == 200) {

            var data = result.data;
            console.log(data);
            $("#event_name").val(data.event_name);
            $("#event_loc").val(data.location);
            $("#event_starttime").val(data.start_time);
            $("#event_endtime").val(data.end_time);
            $("#updateID").val(data.id);
            $('#editor').trumbowyg('html',data.event_description);
            $('#calendarDate').html("Update Event");
        } else {
            console.log('a');
        }
    }).catch(error => {
        //  console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again11");
    })

}

function tConvert(time1) {
    // Check correct time format and split into components
    var time = time1.split(":"),
        h = +time[0],
        p;

    if (h > 12) {
        h -= 12;
        p = "pm";
    } else {
        h = h || 12;
        p = "am";
    }

    return t = h + ":" + time[1] + p; // return adjusted time or original string
}



function AddMissingPunch() {
    var form_data = document.getElementById('missing_punch_form');
    var srtaddress=$("#srtaddress").val();
    var longaddress=$("#longaddress").val();
    var formData = new FormData(form_data);
    formData.append('longaddress', longaddress);
    formData.append('srtaddress', srtaddress);
    app.request(baseURL + 'AddMissingPunch', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.message === 'success') {
            app.successToast(result.body);
            $("#missing_punch_form")[0].reset();
            $('#add_regatt').toggle();
            $('#mycard-collapse').toggle();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })


}

function addEventPayroll() {
    var form_data = document.getElementById('EventForm');
    var formData = new FormData(form_data);
    app.request(baseURL + 'AddEvent', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#EventForm")[0].reset();
            $("#ViewCalendarModal").modal('hide');
            LoadCalendar();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}

function deleteEvent() {
    var updateID=$("#updateID").val();
    var formData = new FormData();
    formData.set("updateID", updateID);
    if (confirm('Are you sure You want to delete ?')) {
        app.request(baseURL + 'deleteEventFun', formData).then(result => {
            // $.LoadingOverlay("hide");
            if (result.status === 200) {
                app.successToast(result.body);
                $("#ViewCalendarModal").modal('hide');
                LoadCalendar();
            } else {
                app.errorToast(result.body);
            }
        }).catch(error => {
            console.log(error);
            // $.LoadingOverlay("hide");
            //   app.errorToast("something went wrong please try again");
        });
    }else{

    }
}

function addEventPayroll2(data) {


    var strhtml = globalRemoveSpanContent(ele);

    //var form_data = document.getElementById('add_eventForm');
    var formData = new FormData();
    formData.set("data", data);
    app.request(baseURL + 'AddEventPayroll', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#add_eventForm")[0].reset();
            LoadCalendar();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}

function convertDate(inputFormat) {
    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }

    var d = new Date(inputFormat)
    return [ d.getFullYear(), pad(d.getMonth() + 1),pad(d.getDate())].join('-')
}



function load_data() {

    if (navigator.geolocation) {
        var aa = navigator.geolocation.getCurrentPosition(showPosition, showError);

    } else {
        alert("Geolocation is not supported by this browser.");
    }

}

function showPosition(position) {

    var x = document.getElementById("location_data");
    var lat = position.coords.latitude;
    var longi = position.coords.longitude;

    $('#latlng').val(position.coords.latitude + ',' + position.coords.longitude)
    // alert(lat);
    // alert(longi);
    x.innerHTML = "<input type='hidden' id='latitude_live' name='latitude_live' value='" + lat + "' > " +
        "<input type='hidden' id='longitude_live' name='longitude_live' value='" + longi + "' > ";
    var latitude_live = document.getElementById("latitude_live").value;
    var longitude_live = document.getElementById("longitude_live").value;

    if (latitude_live !== "") {
        // $("#gps_div").hide();

    } else {
        $("#gps_div").show();
    }
    initMap(latitude_live, longitude_live);
    $.ajax({
        url: baseURL+'PayrollController/check_location',
        type: "POST",
        data: {latitude_live: lat, longitude_live: longi},
        success: function (success) {
            success = JSON.parse(success);
            if (success.message == 'inside') {
                $("#loc_sts").html(' Inside')
            } else {
                $("#loc_sts").html(' Outside')


            }
            initMap(latitude_live,longitude_live);
        },
    });
}

function initMap(la, lg) {

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: {lat: la, lng: lg}
    });
    const geocoder = new google.maps.Geocoder();
    const infowindow = new google.maps.InfoWindow();
    geocodeLatLng(geocoder, map, infowindow);

}

function geocodeLatLng(geocoder, map, infowindow) {
    const input = document.getElementById("latlng").value;
    const latlngStr = input.split(",", 2);
    const latlng = {
        lat: parseFloat(latlngStr[0]),
        lng: parseFloat(latlngStr[1])
    };
    geocoder.geocode({location: latlng}, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                map.setZoom(11);
                const marker = new google.maps.Marker({
                    position: latlng,
                    map: map
                });
                console.log(results[0]);
                var add = results[0]['address_components'];
                var address = '';
                var longaddress = '';
                for (i = 3; i < add.length; i++) {
                    // console.log(add[i]['long_name']);
                    address += add[i]['long_name'] + ',';
                    longaddress += add[i]['long_name'] + ',';
                }
                console.log(longaddress);
                // $('#address').empty();
                //$('#address').append(address);
                // $('#longaddress').empty();
                $('#longaddress').val(longaddress);
                localStorage.setItem("LognAddr",longaddress);//LognAddr shortAddr
                //  $('#shortaddress').empty();
                console.log(results[0]['address_components'][0]['long_name'] + ',' +
                    results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name']);
                $('#srtaddress').empty();
                var shortAddr=results[0]['address_components'][0]['long_name'] + ',' +
                    results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name'];
                localStorage.setItem("shortAddr",shortAddr);
                $('#srtaddress').val(results[0]['address_components'][0]['long_name'] + ',' +
                    results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name']);


                // $('#shortaddress').append(results[0]['address_components'][0]['long_name'] + ',' +
                //     results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name'] + ',' + address);

                // $('#address').empty();
                //$('#address').append(address);
                // $('#longaddress1').empty();
                //$('#longaddress1').val(longaddress);
                // $('#shortaddress1').empty();
                //  $('#srtaddress1').empty();
                //   $('#srtaddress1').val(results[0]['address_components'][0]['long_name'] + ',' +
                //       results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name']);

                // $('#shortaddress1').append(results[0]['address_components'][0]['long_name'] + ',' +
                //     results[0]['address_components'][1]['long_name'] + ',' + results[0]['address_components'][2]['long_name'] + ',' + address);
                // infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            } else {
                window.alert("No results found");
            }
        } else {
            window.alert("Geocoder failed due to: " + status);
        }
    });
}

function showError(error) {

    switch (error.code) {
        case error.PERMISSION_DENIED:

            alert("User denied the request for Geolocation. Please on GPS.");
            $("#gps_div").show();

            var x = document.getElementById("location_data");
            x.innerHTML = "<input type='hidden' id='latitude_live' name='latitude_live' value='0' > " +
                "<input type='hidden' id='longitude_live' name='longitude_live' value='0' > ";
            var y = document.getElementById("msg");

            y.innerHTML = "<h5>You have denied the request for Geolocation.Please allow or on the GPS else you will not be able to login/logout.</h5>";

            break;
        case error.POSITION_UNAVAILABLE:

            alert("Location information is unavailable.");
            $("#gps_div").show();
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            $("#gps_div").show();
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            $("#gps_div").show();
            break;
    }
}

function addEVData() {
    var data = $('#textAreaEg').html();
    var ele = document.getElementById("textAreaEg");
    var spans = ele.getElementsByTagName("span");
    // console.log(spans);
    let focusTodayChildActArray = [];
    let hoursTodayChildActArray = [];
    let notesArray = [];
    for (var i = 0; i < spans.length; i++) {
        // console.log($(spans[i]));
        if ($(spans[i]).attr('data-type') == 'employee') {
            focusTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if ($(spans[i]).attr('data-type') == 'hours') {
            hoursTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if ($(spans[i]).attr('data-type') == 'notes') {
            notesArray.push($(spans[i]).attr('data-emp_id'));
        }
    }
    console.log(focusTodayChildActArray);
    var strhtml = globalRemoveSpanContent(ele);
    var form_data = document.getElementById('EventForm');
    var formData = new FormData(form_data);
    formData.set("data", strhtml);
    formData.set("focusTodayChildActArray", focusTodayChildActArray);
    formData.set("hoursTodayChildActArray", hoursTodayChildActArray);
    formData.set("notesArray", notesArray);
    formData.set("Og_date", $("#Og_date").val());
    app.request(baseURL + 'AddEventPayroll', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#textAreaEg").html("");
            var user_id = $("#whichEmployeeUserId").val();
            var date = convertDate($("#Og_date").val());
            $("#ViewCalendarModal").modal('hide');
            //getEventBydate(user_id, date);

            LoadCalendar();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    });
}
