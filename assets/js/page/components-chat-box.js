"use strict";

// var chats = [
//   {
//     text: 'Hi, dude!',
//     position: 'left'
//   },
//   {
//     text: 'Wat?',
//     position: 'right'
//   },
//   {
//     text: 'You wanna know?',
//     position: 'left'
//   },
//   {
//     text: 'Wat?!',
//     position: 'right'
//   },
//   {
//     typing: true,
//     position: 'left'
//   }
// ];
// for(var i = 0; i < chats.length; i++) {
//   var type = 'text';
//   if(chats[i].typing != undefined) type = 'typing';
//   $.chatCtrl('#mychatbox', {
//     text: (chats[i].text != undefined ? chats[i].text : ''),
//     picture: (chats[i].position == 'left' ? '../assets/img/avatar/avatar-1.png' : '../assets/img/avatar/avatar-2.png'),
//     position: 'chat-left',
//     type: type
//   });
// }

// $("#chat-form").submit(function() {
//   var me = $(this);

//   if(me.find('input').val().trim().length > 0) {
//     $.chatCtrl('#mychatbox', {
//       text: me.find('input').val(),
//       picture: '../assets/img/avatar/avatar-2.png',
//     });
//     me.find('input').val('');
//   }
//   return false;
// });
// $('#focusMessageInput').parent().on('keydown', function (event) {
//   //
//      if(event.which == 8)
//     {
//       console.log('text');
//          s = window.getSelection();
//         r = s.getRangeAt(0)
//         el = r.startContainer.parentElement
//         // Check if the current element is the .label
//         if (el.classList.contains('label')) {
//             // Check if we are exactly at the end of the .label element
//             if (r.startOffset == r.endOffset && r.endOffset == el.textContent.length) {
//                 // prevent the default delete behavior
//                 event.preventDefault();
//                 if (el.classList.contains('highlight')) {
//                     // remove the element
//                     el.remove();
//                 } else {
//                     el.classList.add('highlight');
//                 }
//                 return;
//             }
//         }
//     }
//      event.target.querySelectorAll('span.label.highlight').forEach(function(el) { el.classList.remove('highlight');})

// });
function contentEditableFocus(id,focus_id,autority,outblur=null,parentORChild,save_btnclass=null)
{
    var div = document.getElementById(id);
    var divblur = document.getElementById(outblur);
    // div.onclick = function(e) {
    div.contentEditable = true;
    div.focus();
    // this.style.backgroundColor = 'transparent';
    // this.style.border = '0px solid lightgrey';
    // this.style.height = '50px';
    if(autority=='focus' && parentORChild==1)
    {
        getTributedata(id,autority,parentORChild);
    }
    else
    {
        getTributedata(id,autority,parentORChild);
    }

    //  }

    // div.onkeydown = function(e) {
    //     if(e.keyCode==13) {
    //          e.preventDefault();
    //
    //     }

    // }
    $('.fcbtn_hide').hide();
    $(".fcbtn_hide_1").show();
    if(save_btnclass!=null)
    {
        $("."+save_btnclass).show();
        $("#"+save_btnclass+"_1").hide();
    }

    div.onblur=function(e){
        e.preventDefault();
        // console.log('right direction');
        this.style.backgroundColor = 'transparent';
        this.style.border = '';
        this.style.height = '';
        this.contentEditable = false;
        if(autority=='focus'){
            // if(parentORChild!=2)
            // {
            //   updateFocusViewData(focus_id,id);
            // }

        }
        else if(autority=='activity')
        {
            // updateTodayActivityViewData(focus_id,id);
        }
        else if(autority=='task')
        {
            // updateTaskAssignByUViewData(focus_id,id);
        }
    }

}
function getTributedata(id,authority,parentORChild){
    var val='';
    var typeName='';
    var hour='';
    var note='';
    var loadingContent='';
    if(authority=='activity')
    {
        val=getFocusUnderSenior();
        typeName='focus';
        hour=getActivityHours();
        note=getemployeeNotes();
        loadingContent='<div style="padding: 16px">Loading</div>';

    } else if(authority=='event')
    {
        val=getemployeesUnderSenior();
        typeName='employee';
        hour=getActivityHours();
        note=getemployeeNotes();
        loadingContent='<div style="padding: 16px">Loading</div>';
    }
    else
    {
        val=getemployeesUnderSenior();
        note=getemployeeNotes();
        typeName='employee';
    }


    // console.log(val);
    var tributeMultipleTriggers = new Tribute({
        // menuContainer: document.getElementById('content
        collection: [
            {
                values:val
                ,
                selectTemplate: function(item) {
                    if (typeof item === "undefined") return null;
                    if (this.range.isContentEditable(this.current.element)) {

                        return (
                            '<span contenteditable="false" class="label text-info" data-emp_id="'+item.original.value+'" data-type="'+typeName+'">@'
                            +item.original.key +
                            "</span>&#8203;"
                        );
                    }
                    return "@" + item.original.key;
                },
                requireLeadingSpace: false
            },
            {
                // The symbol that starts the lookup
                trigger: "$",
                loadingItemTemplate: loadingContent,
                // The function that gets call on select that retuns the content to insert
                selectTemplate: function(item) {
                    if (this.range.isContentEditable(this.current.element)) {
                        return (
                            '<span contenteditable="false" class="label text-info" data-emp_id="'+item.original.email+'" data-type="hours">$'
                            +item.original.name +
                            "</span>&#8203;"
                        );
                    }

                    return "$" + item.original.name;
                },
                // function retrieving an array of objects
                values: function(_, cb) {
                    setTimeout(() => cb(hour), 1000)
                },
                lookup: "name",

                fillAttr: "name"

            },{
                // The symbol that starts the lookup
                trigger: "#",
                loadingItemTemplate: loadingContent,
                // The function that gets call on select that retuns the content to insert
                selectTemplate: function(item) {
                    if (this.range.isContentEditable(this.current.element)) {
                        return (
                            '<span contenteditable="false" class="label text-info" data-emp_id="'+item.original.value+'" data-type="notes">#'
                            +item.original.key +
                            "</span>&#8203;"
                        );
                    }

                    return "#" + item.original.name;
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
// function contentEditableActivity(id,acti_id)
//     {
//        var div = document.getElementById(id);
//             div.onclick = function(e) {
//                 this.contentEditable = true;
//                 this.focus();
//                 this.style.backgroundColor = 'transparent';
//                 // this.style.border = '1px solid black';
//             }

//             div.onblur = function() {
//                 this.style.backgroundColor = 'transparent';
//                 this.style.border = '';
//                 this.contentEditable = false;
//                 updateTodayActivityViewData(acti_id,id);
//             }
//     }
function myKeyPress(e,ele,autority,id,empDivId,counter,parentId=null){
    var keynum;
    if(window.event) { // IE
        keynum = e.keyCode;
    } else if(e.which){ // Netscape/Firefox/Opera
        keynum = e.which;
    }
    // if(keynum)
    // {
    //   $(".focusTypeMessage").hide();
    // }
    // else
    // {
    //    $(".focusTypeMessage").show();
    // }
    // console.log(keynum);
    // if(e.keyCode==8)
    // {
    // console.log(e.charCode);
    // }


    if(String.fromCharCode(keynum) == '@'){
        // alert(true);
        // $("#"+empDivId).show();
        // if(autority=='child')
        // {
        //    getTributedata(id,autority,2);
        // }

    }else{
        // alert(false)
        $("#todayActivityHours").hide();

        $("#"+empDivId).hide();

        if(e.keyCode==13) {

            window.document.execCommand('insertLineBreak', false, null);
            if(autority=='parent'){
                submitFocusViewdata(ele,'chat-content',id);

            }
            else if(autority=='child'){
                submitChildFocusViewdata(ele,counter,id,parentId);

            }
            else if(autority=='task')
            {
                submitTaskAssignViewData(ele,'chat-content-task-assign');
            }
            else if(autority=='activity')
            {

                $("#todayActivityFocusDiv").hide();
                submitTodaysAtivityViewdate(ele,'chat-content');
            }
            $("#"+empDivId).hide();
            e.preventDefault();
        }
        else
        {
            $("#"+empDivId).hide();
        }

    }

}

function setTextToCurrentPos(id, name,emp_id=null,empDivId=null,typeName=null) {
    // console.log(emp_id);
    // var curPos =document.getElementById("focusMessageInput").selectionStart;
    var el = document.getElementById(id)
    // var range = document.createRange();
    // var sel = window.getSelection();
    // var curPos=sel.rangeCount;
    // var $str = $(el);
    // var strhtml=$str.prop('innerHTML');
    // let text_to_insert = '<span class="label">'+name+'</span>';
    pasteHtmlAtCaret("<span class='label text-info' data-emp_id='"+emp_id+"' data-type='"+typeName+"' contenteditable='false'>"+atob(name)+"</span>&#8203;", el);


    // console.log(empDivId.id);
    // let x = $("#focusMessageInput").val();

    // let text_to_insert = name;
    // $("#focusMessageInput").val(x.slice(0, curPos) + text_to_insert + x.slice(curPos));
    // $("#focusMessageInput").html(strhtml.slice(0, curPos) + text_to_insert + strhtml.slice(curPos));
    $("#"+empDivId.id).hide();
    // $("#taskAEmployeeDiv").hide();
    // $("#todayActivityFocusDiv").hide();
}

function pasteHtmlAtCaret(html, el) {
    var sel, range;
    if (window.getSelection) {
        // IE9 and non-IE
        sel = window.getSelection();
        if (elementContainsSelection(el)) {
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();

                // Range.createContextualFragment() would be useful here but is
                // non-standard and not supported in all browsers (IE9, for one)
                var el = document.createElement("div");
                el.innerHTML = html;
                var frag = document.createDocumentFragment(),
                    node, lastNode;
                while ((node = el.firstChild)) {
                    lastNode = frag.appendChild(node);
                }
                range.insertNode(frag);

                // Preserve the selection
                if (lastNode) {
                    range = range.cloneRange();
                    range.setStartAfter(lastNode);
                    range.collapse(false);
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
            } else if (document.selection && document.selection.type != "Control") {
                // IE < 9
                document.selection.createRange().pasteHTML(html);
            }
        } else {
            setEndOfContenteditable(el);
            pasteHtmlAtCaret(html, el);
        }
    }

}

function setEndOfContenteditable(contentEditableElement) {
    var range, selection;
    if (document.createRange) //Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange(); //Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement); //Select the entire contents of the element with the range
        range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection(); //get the selection object (allows you to change selection)
        selection.removeAllRanges(); //remove any selections already made
        selection.addRange(range); //make the range you have just created the visible selection
    } else if (document.selection) //IE 8 and lower
    {
        range = document.body.createTextRange(); //Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement); //Select the entire contents of the element with the range
        range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
        range.select(); //Select the range (make it the visible selection
    }
}

function elementContainsSelection(el) {
    var sel;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount > 0) {
            for (var i = 0; i < sel.rangeCount; ++i) {
                if (!isOrContains(sel.getRangeAt(i).commonAncestorContainer, el)) {
                    return false;
                }
            }
            return true;
        }
    } else if ((sel = document.selection) && sel.type != "Control") {
        return isOrContains(sel.createRange().parentElement(), el);
    }
    return false;
}

function isOrContains(node, container) {
    while (node) {
        if (node === container) {
            return true;
        }
        node = node.parentNode;
    }
    return false;
}

function submitFocusViewdata(ele=null, classname=null,id=null) {
    // ele=ele.find('br').remove();
    // var $str = $(ele);
    // var strhtml = $str.prop('innerHTML');

    // var strm = strhtml.toString();
    var strhtml='Sample Focus';
    var fcount = $("#newFocusCount").val();
    var provi = $("#whichProfile").val();

    if (strhtml.trim().length > 0) {
        let formData = new FormData();
        formData.set("focus_details", strhtml);
        $.LoadingOverlay("show");
        app.request(baseURL + 'AddFocusView', formData).then(result => {
            $.LoadingOverlay("hide");
            if (result.status === 200) {
                app.successToast(result.body);
                focusViewTask();
                // $("#focusMessageInput").empty();
            } else {
                app.errorToast(result.body);
                // $("#focusMessageInput").empty();
            }
        }).catch(error => {
            console.log(error);
            $.LoadingOverlay("hide");
            // app.errorToast("something went wrong please try again");
        })
    }

}
function updateFocusViewData(focus_id,divId,parent_focus_id=null,parentCounter=null)
{
    var ele=document.getElementById(divId);
    var spans = ele.getElementsByTagName("span");
    let focusTodayChildActArray=[];
    let NoteData=[];
    for(var i=0;i<spans.length;i++)
    {
        if($(spans[i]).attr('data-type')=='employee'){
            focusTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if($(spans[i]).attr('data-type')=='notes'){
            NoteData.push($(spans[i]).attr('data-emp_id'));
        }
    }
    var strhtml=globalRemoveSpanContent(ele);
    // var focus_detail=$("#"+divId).html();
    let formData = new FormData();
    formData.set("focus_id", focus_id);
    formData.set("focus_detail", strhtml);
    formData.set("employee_ids", focusTodayChildActArray);
    formData.set("note_ids", NoteData);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'UpdateFocusView', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            if(parent_focus_id!=null && parentCounter!=null)
            {
                focusChildViewTask(parent_focus_id,parentCounter);
            }
            else
            {
                focusViewTask();
            }

        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    })
}
function updateTodayActivityViewData(focus_id,divId)
{
    var ele=document.getElementById(divId);

    var spans = ele.getElementsByTagName("span");
    // console.log(spans);
    let focusTodayChildActArray=[];
    let hoursTodayChildActArray=[];
    let NoteData=[];
    for(var i=0;i<spans.length;i++)
    {
        // console.log($(spans[i]));
        if($(spans[i]).attr('data-type')=='focus'){
            focusTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if($(spans[i]).attr('data-type')=='hours'){
            hoursTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if($(spans[i]).attr('data-type')=='notes'){
            NoteData.push($(spans[i]).attr('data-emp_id'));
        }
    }
    // console.log(focusTodayChildActArray);
    // console.log(hoursTodayChildActArray);


    var strhtml=globalRemoveSpanContent(ele);

    // console.log(strhtml);
    var focus_detail=$("#"+divId).html();
    let formData = new FormData();
    formData.set("acitivity_id", focus_id);
    formData.set("focus_ids", focusTodayChildActArray);
    formData.set("activity_hr", hoursTodayChildActArray);
    formData.set("activity_detail", strhtml);
    formData.set("note_ids", NoteData);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'updateTodayActivityView', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            todaysViewTask(null);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");

    });

}
$("#chat-form2").submit(function () {
    var me = $(this);
    var fcount = $("#newFocusCount").val();
    var provi = $("#whichProfile").val();
    var time = '29 July';
    fcount++;
    if (me.find('input').val().trim().length > 0) {
        var text_show = focusshowChatText(me.find('input').val(), fcount, provi, time);
        $.chatCtrl('#mychatbox2', {
            text: text_show,
            fcount: fcount,
            provi: provi
            // picture: '../assets/img/avatar/avatar-2.png',
        });
        me.find('input').val('');
    }
    $("#newFocusCount").val(fcount);
    return false;
});

function focusViewTask() {
    let formData = new FormData();
    formData.set("date", $("#todayDate").val());
    formData.set("user_id", $("#whichEmployeeId").val());

    $.LoadingOverlay("show");
    app.request(baseURL + 'GetFocusData', formData).then(result => {
        $.LoadingOverlay("hide");
        var target = $("#mychatbox2");
        target.find('.chat-content').empty();
        if (result.status === 200) {

            var fccount = $("#newFocusCount").val();
            var provi = $("#whichProfile").val();

            var chats=result.data;
            console.log(chats);
            UnderFocusView=result.data;
            var note_data=result.note_data;
            var noteID_data=result.noteID_data;
            let focusArraydata=[];
            for (var i = 0; i < chats.length; i++) {
                console.log(chats[i]);
                var type = 'text';
                fccount++;

                var id_n="a_"+chats[i].id;
                var noteD= note_data[id_n];
                var noteID= noteID_data[id_n];
                focusArraydata.push(focusshowChatText(fccount, provi, chats[i],noteD,noteID));
                // .then(text_show=>{
                //   // console.log(text_show);
                //     $.chatCtrl('#mychatbox2', {
                //         text: text_show,
                //         position: 'chat-left',
                //         type: type,
                //         fcount: fccount,
                //         provi: provi
                //     },'chat-content');
                // });//focusshowChatText(text,counter,senior or employee);

            }
            // console.log(focusArraydata);
            focusArraydata.forEach(i=>{

                i.then(text_show=>{
                    // console.log(text_show);
                    $.chatCtrl('#mychatbox2', {
                        text: text_show,
                        position: 'chat-left',
                        type: type,
                        fcount: fccount,
                        provi: provi
                    },'chat-content');
                });
            });
            $("#newFocusCount").val(fccount);
            // console.log(result.data);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });


}
function formatDateToString(date){
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var today = new Date(date);

    // Show date in "dd-mm-yyyy' format.
    var d = today.getDate();
    var m = months[today.getMonth()];
    // var y = months.getFullYear();
    return d+m;
}

async function focusshowChatText(counter, provi, chats,noteD,noteID) {
    // console.log(chats);
    var my_view = '';
    var provis = $("#whichProfile").val();
    var contentEd = '';
    var parent_id=chats.id;
    var html=chats.focus_details;
    html= html.replaceAll('?','');
    var text=html.trim();
    var notetext="";
    if(noteID !== "undefined"){
        let templatedata='';
        // console.log(chats.id);
        var result= await ShowmodalNotesData(chats.id,noteID);
        // console.log(result);
        if (result.status === 200) {
            templatedata += result.body.map(setNotesTempateNote1).join('');
            notetext = templatedata;
        }
    }
    // console.log(chats.focus_details);
    var time=formatDateToString(chats.created_on);
    my_view=`<div id="popoverFocusComm${counter}" class="d-none chat_scroll" style="height:200px;">
                <button class="btn btn-link button_cross" onclick="$('#popFocusComm${counter}').click()"><i class="fa fa-times"></i></button>
                <form id="focusComment${chats.id}">
                    <div class="commentDiv chat_scroll" id="commentDiv${chats.id}" style="display:block;padding:5px;max-height:150px;">
                        <div class="">
                            <span class="text_class">comment </span>
                            <div class="" style="">
                                <textarea data-container="body" class="form_control" type="text" id="commentTextarea${chats.id}" name="comment" style="min-height:45px;width:100%;" placeholder="Enter Comment..."></textarea>
                                <label for="commentFile${chats.id}">
                                <i class="fa fa-paperclip" style="color:#98a6ad !important;"></i>
                                </label>
                               <input id="commentFile${chats.id}" name="file[]" class="input_cl" type="file" />
                                <button type="button" onclick="addComment('focusComment${chats.id}',${chats.id},'focusShowComment${chats.id}')" class="btn btn-gbtech comment_button ml-2" 
                                    style="line-height: 15px;">save</button>
                            </div>
                        </div>
                    </div>
                </form>
                   <div class="chat_scroll" style="max-height:150px;">
                        <div class="main-card mb-3">
                            <div class="p-1" style="color:#99a2a7;">
                                <span class="card-title">Comments</span>
                                <div id="focusShowComment${chats.id}" class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
             `;
    var dropView=`<div id="popover-form${counter}" class="d-none chat_scroll" style="height:200px;">
                    <button class="btn btn-link button_cross" onclick="$('#subscribe${counter}').click()"><i class="fa fa-times"></i></button>
                    <form class="" role="form" style="padding:10px;">
                        <input type="text" name="attachActivity" id="attachActivity${chats.id}" placeholder="attach activity" class="form-control">
                        <button type="button" onclick="attachFocusToActivity(${chats.id},'subscribe${counter}')" class="btn btn-gbtech comment_button ml-2" 
                                    style="line-height: 15px;">save</button>
                    </form>
                 </div>`;
    if(chats.is_assign==0){
        if(provi==2){
            contentEd = `onclick="contentEditableFocus('fcount${counter}',${chats.id},'focus',null,1,'fcbtn_hide${counter}')"`;
        }
    }
    var userText=``;
    if(chats.is_assign==1)
    {
        userText=getAsssignAppenddata(chats.created_to,'employee');
    }

    text=text+userText+notetext;
    var com_status=`text-danger`;
    if(chats.completion_status==2)
    {
        com_status=`text-success`;
    }
    var collapsed=`<i class="fas fa-angle-double-right ${com_status}" style="padding-top:7px;padding-right:5px;"></i>`;
    var attachActivity=` <button id="subscribe${counter}" type="button" class="btn btn-link btn-sm">
                                      <i class="fa fa-paperclip text-black-50"></i>
                                    </button> `;
    var attachDotes=` <button class="btn btn-link btn-sm" type="button">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   `;
    if(provi==2){
        collapsed=`<i class="fas fa-angle-double-right ${com_status} collapsed" data-toggle="collapse" 
                  data-target="#panel-body-${counter}" onclick="focusChildViewTask(${parent_id},${counter})"
                   aria-expanded="false" style="padding-top:3px;padding-right:5px;"></i>`;
        attachActivity=` <button id="subscribe${counter}" type="button" class="btn btn-link btn-sm" data-toggle="popover" 
                              onclick="showPopver('subscribe${counter}','popover-form${counter}')">
                              <i class="fa fa-paperclip text-black-50"></i>
                            </button>
                             <script>$("#subscribe${counter}").click();</script>
                            ${dropView}`;
        attachDotes=` <button class="btn btn-link btn-sm" type="button" id="dropdownMenubutton${counter}" 
                                  data-toggle="popover" onclick="showPopver('dropdownMenubutton${counter}','dropdownMenubuttonHtml${counter}')">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   <script>$("#dropdownMenubutton${counter}").click();</script>`;
    }



    var element = `<div class="list-group accordion">
                        <a class="list-group-item list-group-item-action flex-column align-items-start"
                       style="padding: 0px;
                                border-radius: unset;
                                box-shadow: 3px 3px 7px 2px rgb(0 0 0 / 12%);
                                background-color: #fbfbfb;
                                color: black!important;">
                            <div class="w-100 justify-content-between list_a_flex">
                              <div class="d-flex w-100">
                              ${collapsed}
                              <div class="col-md-12"  style="padding-left:0px;">
                              
                                <p class=" fchild mb-1 mr-2"  ${contentEd} onkeypress="return event.keyCode != 13;" id="fcount${counter}">
                                
                                 ${text}
                                </p>
                              </div>
                              </div>
                              
                            </div>
                            <div class="d-flex">
                            <div class="col-md-8" ${contentEd}></div>
                            <div class="d-flex justify-content-end row col-md-4" style="margin-top: -15px;">
                             <div>
                                  <button type="button" class="btn btn-link btn-sm fcbtn_hide fcbtn_hide${counter}" style="text-decoration:none;display:none;margin-top:3px;" onclick="updateFocusViewData(${chats.id},'fcount${counter}')"><i style="color: #f8f9fa;margin-left: auto;padding: 2px 7px 4px 7px;background-color: #75b780;border-radius: 7px;">save</i>
                                  </button>
                                </div>
                                <div class="fcbtn_hide_1" id="fcbtn_hide${counter}_1">
                                <small class="text-muted d-flex text_a_flex">
                                  <b style="padding-top:7px;">${time}</b>
                                  <div>
                                  <button id="popFocusComm${counter}" class="btn btn-link btn-sm" data-toggle="popover" 
                                    onclick="showComment(${chats.id},'focusShowComment${chats.id}')" data-focus="false">
                                    <i class="fa fa-comment text-black-50"></i>
                                  </button>
                                  ${my_view}
                                  <script>
                                  $("#popFocusComm${counter}").popover({
                                          title: '',
                                          container: 'body',
                                          placement: 'bottom',
                                          html: true,
                                          content: function() {
                                            console.log('hiiii');
                                                return $('#popoverFocusComm${counter}').html();
                                          }
                                      });
                                      </script>
                                 
                                  </div>
                                  <div>
                                   ${attachActivity}
                                  </div>
                                  <div>
                                 ${attachDotes}
                                  <div class="d-none chat_scroll" style="height:200px;" id="dropdownMenubuttonHtml${counter}">
                                     <button class="btn btn-link button_cross" onclick="$('#dropdownMenubutton${counter}').click()"><i class="fa fa-times"></i></button>
                                    <li class="dropdown-item text-danger text-small" onclick="deleteFocusViewData(${chats.id}),$('#dropdownMenubutton${counter}').click()">
                                      <i class="fa fa-trash"> Deactive</i>
                                    </li>
                                    <li class="dropdown-item text-success text-small" onclick="completeFocus(${chats.id}),$('#dropdownMenubutton${counter}').click()">
                                      <i class="fa fa-check"> Complete</i>
                                    </li>
                                  </div>
                                  </div>
                                </small>
                                </div>
                              </div>
                            </div>
                        </a>

                        <div class="accordion-body collapse focusCollapsed" id="panel-body-${counter}" style="">
                          <div class="focusCollHeight" id="mychatChildbox${counter}">
                            <div class="focusCollBody chat-content-child${counter} chat_scroll" style="overflow-y: auto!important; outline: none;">
                            
                            </div>
                            <div class="focusCollFooter d-flex">
                              
                               <div contenteditable="true" id="focusMessageInput${counter}" 
                                  onclick="getTributedata('focusMessageInput${counter}','focus',2)"
                                 class="form-control chat_scroll" placeholder="Type a focus view..." 
                                 style="height: 50px;">
                               </div>
                               <button type="button" class="btn btn-link   " style="text-decoration: none; margin-top: 3px;" 
                               onclick="submitChildFocusViewdata('focusMessageInput${counter}',${counter},'focusMessageInput${counter}',${parent_id});"><i style="color: #f8f9fa;margin-left: auto;padding: 2px 7px 4px 7px;background-color: #75b780;border-radius: 7px;">save</i>
                                  </button>
                               <input type="hidden" name="newFocusCount" id="newFocusCount${counter}" value="0">
                            </div>
                          </div>
                        </div>

                      </div>`;
    return element;
}
function completeFocus(id)
{
    let formData = new FormData();
    formData.set("focus_id", id);
    $.LoadingOverlay("show");
    app.request(baseURL + 'CompleteFocusView', formData).then(result => {
        $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            focusViewTask();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function deleteFocusViewData(id)
{
    let formData = new FormData();
    formData.set("focus_id", id);
    $.LoadingOverlay("show");
    app.request(baseURL + 'DeleteFocusView', formData).then(result => {
        $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            focusViewTask();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function addComment(form_id,f_id,comment_show)
{
    // var comment=$("#commentTextarea"+f_id).val();
    var comment=$(".popover #commentTextarea"+f_id).val();
    // console.log(comment);
    var form_data = document.getElementById(form_id);
    var formData = new FormData(form_data);
    formData.set("focus_id", f_id);
    formData.set("comment", comment);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'AddFocusComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#"+comment_show).empty();
            showComment(f_id,comment_show);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function showComment(f_id,comment_show)
{
    $("#"+comment_show).empty();
    let formData = new FormData();
    formData.set("focus_id", f_id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'getFocusComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status == 200) {
            // app.successToast(result.body);
            // console.log(result.data);
            var userdata=result.data;
            if(userdata!=undefined){

                $(".popover #"+comment_show).empty();
                var data=``;
                for (var c = 0; c < userdata.length; c++) {
                    // console.log(userdata[c]);
                    var c_file=``;
                    if(userdata[c].file!=null && userdata[c].file!="")
                    {
                        c_file=`
                            <a class="btn btn-link" href="${baseURL + userdata[c].file}" target="_blank" ><i class="fa fa-download"></i></a>`;
                    }

                    data=` <div class="vertical-timeline-item vertical-timeline-element">
                                    <div> <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="fa fa-angle-double-right" style="color: red;margin-left: 2px;"> </i> </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>${userdata[c].comment} ${c_file}</p>

                                        </div>
                                    </div>
                               </div> `;
                    $(".popover #"+comment_show).append(data);
                }
            }

            // var data=showCommentViewData(result.data);

        } else {
            // app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });

}


function todaysViewTask(key) {

    let formData = new FormData();
    formData.set("date", $("#activityDate").val());
    formData.set("user_id", $("#whichEmployeeId").val());
    formData.set("key", key);
    $.LoadingOverlay("show");
    app.request(baseURL + 'GetActivityData', formData).then(result => {
        var target = $("#mychatbox");
        target.find('.chat-content').empty();
        $.LoadingOverlay("hide");
        if (result.status === 200) {
            $("#activityDate").val(result.date_format);
            var fccount = $("#newTodaystaskCount").val();
            var provi = $("#whichProfile").val();
            var chats=result.data;
            var note_data=result.note_data;
            var noteID_data=result.noteID_data;

            for (var i = 0; i < chats.length; i++) {
                var type = 'text';
                fccount++;
                var id_n="a_"+chats[i].id;
                var noteD= note_data[id_n];
                var noteID= noteID_data[id_n];

                toadysshowChatText(fccount, provi, chats[i],noteD,noteID).then(text_show=>{
                    $.chatCtrl('#mychatbox', {
                        text: text_show,
                        position: 'chat-left',
                        type: type,
                        fcount: fccount,
                        provi: provi
                    },'chat-content');
                });//focusshowChatText(text,counter,senior or employee);

            }
            $("#newTodaystaskCount").val(fccount);

            // console.log(result.data);
        } else {
            $("#activityDate").val(result.date_format);
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });

}
function attachFocusToActivity(focus_id,divId)
{
    let focusTodayArray=focus_id;
    var strhtml=$(".popover #attachActivity"+focus_id).val();
    if(strhtml.trim().length > 0) {
        let formData = new FormData();
        formData.set("act_det", strhtml);
        formData.set("focus_id", focusTodayArray);

        $.LoadingOverlay("show");
        app.request(baseURL + 'addTodaysActivity', formData).then(result => {
            $.LoadingOverlay("hide");
            if (result.status === 200) {
                // app.successToast(result.body);
                // focusChildViewTask(parentId,counter);
                $(".popover #attachActivity"+focus_id).val('');
                $('#'+divId).click();
                todaysViewTask();
            } else {
                app.errorToast(result.body);
            }
        }).catch(error => {
            console.log(error);
            $.LoadingOverlay("hide");
            // app.errorToast("something went wrong please try again");
        })
    }else{
        app.errorToast("Please write something...");
    }
}

function submitTodaysAtivityViewdate(ele=null,classname=null) {

    // var spans = ele.getElementsByTagName("span");
    let focusTodayArray=[];
    // for(var i=0;i<spans.length;i++)
    // {
    //   focusTodayArray.push($(spans[i]).attr('data-emp_id'));
    // }
    // console.log(focusTodayArray);
    // var strhtml=globalRemoveSpanContent(ele);
    var strhtml='Sample Activity';
    var fcount=$("#newTodaystaskCount").val();
    var provi=4;
    var time='29 July';
    fcount++;
    if(strhtml.trim().length > 0) {
        let formData = new FormData();
        formData.set("act_det", strhtml);
        formData.set("focus_id", focusTodayArray);

        $('#activityMessageInput').empty();
        $.LoadingOverlay("show");
        app.request(baseURL + 'addTodaysActivity', formData).then(result => {
            $.LoadingOverlay("hide");
            if (result.status === 200) {
                // app.successToast(result.body);
                // focusChildViewTask(parentId,counter);
                todaysViewTask();
            } else {
                app.errorToast(result.body);
            }
        }).catch(error => {
            console.log(error);
            $.LoadingOverlay("hide");
            // app.errorToast("something went wrong please try again");
        })
    }else{
        app.errorToast("Please write something...");
    }
    // $("#newTodaystaskCount").val(fcount);
    // $('.fchild').find('br').remove();
}


async function toadysshowChatText(counter, provi, chats,noteD,noteID) {
    var my_view = '';
    var contentEd = '';
    var startTime=``;
    var endTime=``;
    if(chats.start_time!=null)
    {
        startTime=chats.start_time;
    }
    if(chats.end_time!=null)
    {
        endTime=chats.end_time;
    }
    var html=chats.activity_details;
    html= html.replaceAll('?','');
    var text=html.trim();
    var userText=getAsssignAppenddata(chats.focus_to,'focus');
    // console.log(userText);
    var hourText=getAsssignAppenddata(chats.activity_hours,'hours');
    // console.log(hourText);
    var d = noteD.split(",");
    var notetext="";

    if(noteID !== "undefined"){
        let templatedata='';
        var result= await ShowmodalNotesData(chats.id,noteID);
        if (result.status === 200) {
            templatedata += result.body.map(setNotesTempateNote1).join('');
            notetext = templatedata;
        }
    }

    text=text+userText+hourText+notetext;
    var time=formatDateToString(chats.created_on);
    my_view=`<div id="popoverActivityComm${counter}" class="d-none chat_scroll" style="height:200px;">
                <button class="btn btn-link button_cross" onclick="$('#popActivityComm${counter}').click()"><i class="fa fa-times"></i></button>
                <form id="activityComment${chats.id}">
                    <div class="commentDiv chat_scroll" id="activitycommentDiv${chats.id}" style="max-height:150px;display:block;padding:5px;">
                        <div class="">
                            <span class="text_class">comment </span>
                            <div class="" style="">
                                <textarea data-container="body" class="form_control" type="text" id="activitycommentTextarea${chats.id}" name="comment" style="min-height:45px;width:100%;" placeholder="Enter Comment..."></textarea>
                                <label for="activitycommentFile${chats.id}">
                                <i class="fa fa-paperclip" style="color:#98a6ad !important;"></i>
                                </label>
                                <input id="activitycommentFile${chats.id}" name="file[]" class="input_cl" type="file" />
                                <button type="button" onclick="addActivityComment('activityComment${chats.id}',${chats.id},'activityShowComment${chats.id}')" class="btn btn-gbtech comment_button ml-2" 
                                    style="line-height: 15px;">save</button>
                            </div>
                        </div>
                    </div>
                </form>
                   <div class="chat_scroll" style="max-height:150px;">
                        <div class="main-card mb-3">
                            <div class="p-1" style="color:#99a2a7;">
                                <span class="card-title">Comments</span>
                                <div id="activityShowComment${chats.id}" class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
             `;
    var attachDotes=` <button class="btn btn-link btn-sm" id="todayPopoverBtn${counter}">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   `;
    var deleteBtn=``;
    if(provi==2){
        contentEd = `onclick="contentEditableFocus('tcount${counter}',${chats.id},'activity','tAFD${counter}',1,'tobtn_hide${counter}')"`;
        attachDotes=` <button class="btn btn-link btn-sm" id="todayPopoverBtn${counter}" data-toggle="popover"
                                  onclick="showPopver('todayPopoverBtn${counter}','todayPopoverHtml${counter}')">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   <script>$("#todayPopoverBtn${counter}").click();</script>`;
        deleteBtn=`<button type="button" class="btn btn-link btn-sm" onclick="deleteTodaysActivity(${chats.id})">
                    <i class="fa fa-trash text-black-50"></i></button>`;
    }


    var element = `<div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start" 
                        style="padding: 0px;
                                border-radius: unset;
                                box-shadow: 3px 3px 7px 2px rgb(0 0 0 / 12%);
                                background-color: #fbfbfb;
                                color: black!important;
                                margin-bottom: 10px;">
                            <div class="d-flex w-100 justify-content-between">
                              <div class="d-flex col-md-12" id="tAFD${counter}" ${contentEd}>
                                 <div id="todayActivityChildFocusDiv${counter}" class="chat_scroll" style="height: 100px;display: none; overflow-y: auto!important;padding-top:1px; ">
                                      <input type="text" id="mySearchtodayActivityFocusdata${counter}" class="form-control" placeholder="Search here..." title="Type here">
                                      <ul class="list-group" id="todaysAcitivity-list${counter}">
                                       
                                      </ul>
                                      <script>
                                        $("#mySearchtodayActivityFocusdata${counter}").keyup(function () {
                                              var filter = $(this).val();
                                              $("#todaysAcitivity-list${counter} li").each(function () {
                                                  if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                                                      $(this).hide();
                                                  } else {
                                                      $(this).show()
                                                  }
                                              });
                                          });
                                      </script>
                                </div>
                                 <div id="todayActivityHours${counter}" class="chat_scroll" style="height: 100px;display: none; overflow-y: auto!important;">
                                   <input type="text" id="mySearchtodayActivityHoursdata${counter}" class="form-control" placeholder="Search here..." title="Type here">
                                   <ul class="list-group" id="todaysAcitivityHour-list${counter}">
                                   </ul>
                                   <script>
                                        $("#mySearchtodayActivityHoursdata${counter}").keyup(function () {
                                              var filter = $(this).val();
                                              $("#todaysAcitivityHour-list${counter} li").each(function () {
                                                  if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                                                      $(this).hide();
                                                  } else {
                                                      $(this).show()
                                                  }
                                              });
                                          });
                                      </script>
                                 </div>
                                <p class="w-100 mb-1 fchild" onkeypress="return event.keyCode != 13;" id="tcount${counter}" >
                                 ${text}
                                </p>
                                  
                              </div>
                            
                            </div>
                            <div class="d-flex">
                            <div class="col-md-8" ${contentEd}></div>
                           <div class="d-flex justify-content-end col-md-4" style="margin-top: -15px;">
                            <div class=""><button type="button" class="btn btn-link btn-sm fcbtn_hide tobtn_hide${counter}" style="text-decoration:none;display:none;margin-top:3px;" onclick="updateTodayActivityViewData(${chats.id},'tcount${counter}')"><i style="color: #f8f9fa;margin-left: auto;padding: 2px 7px 4px 7px;background-color: #75b780;border-radius: 7px;">save</i></button></div>
                               <div class="fcbtn_hide_1" id="tobtn_hide${counter}_1">
                                <small class="d-flex text-muted text_a_flex">
                                     <b style="padding-top:9px;">${time}</b>
                                   
                                  <button id="popActivityComm${counter}" class="btn btn-link btn-sm" data-toggle="popover" 
                                    onclick="showActivityComment(${chats.id},'activityShowComment${chats.id}')" data-focus="false">
                                    <i class="fa fa-comment text-black-50"></i>
                                  </button>
                                  ${my_view}
                                  <script>
                                  $("#popActivityComm${counter}").popover({
                                          title: '',
                                          container: 'body',
                                          placement: 'bottom',
                                          html: true, 
                                          content: function() {
                                                return $('#popoverActivityComm${counter}').html();
                                          }
                                      });
                                      </script>
                                 
                                    ${deleteBtn}
                                </small>
                                </div>
                              </div>
                      </div>
                        </a>

                      </div>`;
    return element;
}
function addActivityComment(form_id,f_id,comment_show)
{
    // var comment=$("#commentTextarea"+f_id).val();
    var comment=$(".popover #activitycommentTextarea"+f_id).val();
    // console.log(comment);
    var form_data = document.getElementById(form_id);
    var formData = new FormData(form_data);
    formData.set("activity_id", f_id);
    formData.set("comment", comment);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'AddActivityComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#"+comment_show).empty();
            showActivityComment(f_id,comment_show);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function showActivityComment(f_id,comment_show)
{
    $("#"+comment_show).empty();
    let formData = new FormData();
    formData.set("activity_id", f_id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'getActivityComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status == 200) {
            // app.successToast(result.body);
            // console.log(result.data);
            var userdata=result.data;
            if(userdata!=undefined){

                $(".popover #"+comment_show).empty();
                var data=``;
                for (var c = 0; c < userdata.length; c++) {
                    // console.log(userdata[c]);
                    var c_file=``;
                    if(userdata[c].file!=null && userdata[c].file!="")
                    {
                        c_file=`
                            <a class="btn btn-link" href="${baseURL + userdata[c].file}" target="_blank" ><i class="fa fa-download"></i></a>`;
                    }

                    data=` <div class="vertical-timeline-item vertical-timeline-element">
                                    <div> <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="fa fa-angle-double-right" style="color: red;margin-left: 2px;"> </i> </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>${userdata[c].comment} ${c_file}</p>

                                        </div>
                                    </div>
                               </div> `;
                    $(".popover #"+comment_show).append(data);
                }
            }

            // var data=showCommentViewData(result.data);

        } else {
            // app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });

}
function deleteTodaysActivity(acti_id)
{
    let formData = new FormData();
    formData.set("activity_id", acti_id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'DeleteTodaysActivity', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            todaysViewTask();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function globalRemoveSpanContent(ele)
{
    let ele1=ele.innerHTML;
    // console.log(ele1);

    var $str = $(ele);
    $str.find('span').contents().remove();
    $str.find('span').remove();
    $str.find('br').remove();
    var strhtml = $str.prop('innerHTML');
    // var strm = strhtml.toString();
    strhtml = strhtml.replaceAll('@',"");
    strhtml = strhtml.replaceAll('$',"");
    strhtml = strhtml.replaceAll('#',"");
    ele.innerHTML=ele1;
    return strhtml;
}
function submitChildFocusViewdata(ele1, counter,id,parentId) {
    var data=$("#"+id).html();
    data=data.trim();
    if(data == ""){
        app.errorToast("Write Something.....");
        return;
    }
    var ele=document.getElementById(id);
    var spans = ele.getElementsByTagName("span");
    let focusChildEmpArray=[];
    let NoteData=[];
    for(var i=0;i<spans.length;i++)
    {
        // alert($(spans[i]).attr('data-emp_id'));
        // focusChildEmpArray.push($(spans[i]).attr('data-emp_id'));
        if($(spans[i]).attr('data-type')=='employee'){
            focusChildEmpArray.push($(spans[i]).attr('data-emp_id'));
        }
        if($(spans[i]).attr('data-type')=='notes'){
            NoteData.push($(spans[i]).attr('data-emp_id'));
        }

    }
    // console.log(focusChildEmpArray);
    // console.log(id);
    // $('#'+ele).find('span').contents().remove();
    var strhtml=globalRemoveSpanContent(ele);

    // console.log(strhtml);
    var classname = 'chat-content-child' + counter;
    // console.log(strhtml.replace(/<\/?span[^>]*>/g,""));
    var fcount = $("#newFocusCount" + counter).val();
    var provi = 3;
    var time = '29 July';

    $("#focusEmployeeDiv" + counter).hide();

    let formData = new FormData();
    formData.set("focus_details", strhtml);
    formData.set("userdata", focusChildEmpArray);
    formData.set("parent_focus_id", parentId);
    formData.set("note_ids", NoteData);
    $.LoadingOverlay("show");
    app.request(baseURL + 'AddFocusView', formData).then(result => {
        $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            focusChildViewTask(parentId,counter);

        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });
}

function focusChildViewTask(parentId,counter) {
    let formData = new FormData();
    formData.set("date", $("#todayDate").val());
    formData.set("parentId", parentId);
    var child_id = 'mychatChildbox' + counter;
    $.LoadingOverlay("hide");
    app.request(baseURL + 'GetFocusChildData', formData).then(result => {
        $.LoadingOverlay("hide");

        if (result.status === 200) {
            var target =  $("#"+child_id);
            target.find('.chat-content-child'+counter).html('');
            var fccount = $("#newFocusCount"+counter).val();
            var provi = 1;
            // console.log(result.data);
            var chats=result.data;
            var note_data=result.note_data;
            var noteID_data=result.noteID_data;

            for (var i = 0; i < chats.length; i++) {
                var type = 'text';
                fccount++;
                var id_n="a_"+chats[i].id;
                var noteD= note_data[id_n];
                var noteID= noteID_data[id_n];

                focusshowChildChatText(fccount, provi, chats[i],counter,noteD,noteID).then(text_show=>{
                    $.chatCtrl('#'+child_id, {
                        text: text_show,
                        position: 'chat-left',
                        type: type,
                        fcount: fccount,
                        provi: provi
                    },'chat-content-child'+counter);
                });//focusshowChatText(text,counter,senior or employee);

            }
            $('#focusMessageInput' + counter).empty();
            $("#newFocusCount"+counter).val(fccount);
            // console.log(result.data);
        } else {
            console.log('p');

            var target =  $("#"+child_id);
            target.find('.chat-content-child'+counter).html('');
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    });
}
function getAsssignAppenddata(assign_to,assignType=null,t_id=null)
{
    var userText=``;
    if(assign_to!=null && assign_to!="")
    {
        var users=assign_to;
        users=users.split(',');
        var u_id='';
        var u_name='';

        for(var i=0;i<users.length;i++)
        {
            if(assignType=='hours')
            {
                u_id=users[i];
                u_name=users[i];
            }
            else
            {
                var usernamedata= users[i].split('||');
                if(usernamedata.length>1)
                {
                    u_id=usernamedata[0];
                    u_name=usernamedata[1];
                    u_name= u_name.replaceAll('?','');
                }
            }
            if(assignType=='notes'){
                userText+=`<span class='label text-info' data-emp_id='${t_id}' data-type='${assignType}' 
                contenteditable='false' style="background-color: #ea797e;color: #17a2b8 !important;border-radius: 20px;padding:0px 2px 0px 2px;">#${assign_to}</span>&#8203;`;
            }
            if(u_id!='' && u_name!='')
            {
                if(assignType=='hours')
                {
                    userText+=`<span class='label text-info' data-emp_id='${u_id}' data-type='${assignType}' 
                contenteditable='false' style="background-color: #a3adf5;color: #f8f9fa!important;border-radius: 20px;padding:0px 2px 0px 2px;">$${u_name}</span>&#8203;`;
                }
                else
                {
                    if(assignType=='focus'){
                        u_name= $.trim(u_name);
                        if(u_name.length > 40) {
                            u_name = u_name.substring(0,40) + "...";
                        }else{
                            u_name=u_name;
                        }

                    }else{
                        u_name=u_name;
                    }
                    userText+=`<span class='label text-info' data-emp_id='${u_id}' data-type='${assignType}' 
                contenteditable='false' style="background-color: #6eb9bb;color: #f8f9fa!important;border-radius: 20px;padding:0px 2px 0px 2px;">@${u_name}</span>&#8203;`;
                }

            }

        }

    }
    return userText;
}
async function focusshowChildChatText(counter, provi, chats,parentCounter,noteD,noteID) {
    var html=chats.focus_details;
    html= html.replaceAll('?','');
    var text=html.trim();
    var time=formatDateToString(chats.created_on);
    var userText=getAsssignAppenddata(chats.assign_to,'employee');
    // console.log(userText);
    var d = noteD.split(",");
    var notetext="";

    if(noteID !== "undefined"){
        let templatedata='';
        var result= await ShowmodalNotesData(chats.id,noteID);
        if (result.status === 200) {
            templatedata += result.body.map(setNotesTempateNote1).join('');
            notetext = templatedata;
        }
    }

    text=text+userText+notetext;
    var my_view = `<div class="d-none chat_scroll" style="height:200px;" id="subfocusCommrnHtml${counter}" tabindex="4">
        <button class="btn btn-link button_cross" onclick="$('#subfocusCommrnBtn${counter}').click()">
        <i class="fa fa-times"></i></button>
        <form id="focusComment${chats.id}">
                    <div class="commentDiv chat_scroll" id="commentDiv${chats.id}" style="display:block;padding:5px;max-height:150px;">
                    <div class="">
                    <span class="text_class">comment</span>
                    <div class="ppDiv" style="">
                    <textarea class="form_class" type="text" id="commentTextarea${chats.id}" name="comment" style="min-height:45px;"></textarea>
                    <label for="ccommentFile${chats.id}">
                    <i class="fa fa-paperclip" style="color:#98a6ad !important;"></i>
                    </label>
                    <input id="ccommentFile${chats.id}" name="file[]" class="input_cl" type="file" />
                    <button type="button" onclick="addComment('focusComment${chats.id}',${chats.id},'focusChildShowComment${chats.id}')" class="btn btn-gbtech comment_button ml-2" 
                        style="line-height: 15px;">save</button>
                    </div>
                    </div>
                    </div>
                </form>
            <div class="chat_scroll" style="max-height:150px;">
                        <div class="main-card mb-3">
                            <div class="p-1" style="color:#99a2a7;">
                                <span class="card-title">User Timeline</span>
                                <div id="focusChildShowComment${chats.id}" class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
        </div>`
    ;
    var dropView=`<div id="popover-formchild${counter}" class="d-none chat_scroll" style="height:200px;">
                    <button class="btn btn-link button_cross" onclick="$('#subscribechild${counter}').click()"><i class="fa fa-times"></i></button>
                    <form class="" role="form" style="padding:10px;">
                        <input type="text" name="attachActivity" id="attachActivity${chats.id}" placeholder="attach activity" class="form-control">
                        <button type="button" onclick="attachFocusToActivity(${chats.id},'subscribechild${counter}')" class="btn btn-gbtech comment_button ml-2" 
                                    style="line-height: 15px;">save</button>
                    </form>
                 </div>`;
    var attachActivity=` <button id="subscribechild${counter}" type="button" class="btn btn-link btn-sm" data-toggle="popover" 
                              onclick="showPopver('subscribechild${counter}','popover-formchild${counter}')">
                              <i class="fa fa-paperclip text-black-50"></i>
                            </button>
                             <script>$("#subscribechild${counter}").click();</script>
                            ${dropView}`;
    if(chats.completion_status==2)
    {
        var completion_st=`<button class="btn btn-link text-secondary" type="button">
                                      <i class="fa fa-check"> Completed</i>
                                    </button>`;
    }
    else
    {
        var completion_st=`<button type="button" class="btn btn-link text-success" onclick="completeFocus(${chats.id}),$('#focusChildElipseBtn${counter}').click()">
                                      <i class="fa fa-check"> Complete</i>
                                    </button>`;
    }

    var contentEd = `onclick="contentEditableFocus('fCcount${counter}',${chats.id},'focus',null,2,'fccbtn_hide${counter}')"`;

    var element = `<div class="list-group" id="childFocusDiv${counter}">
                        <a class="list-group-item list-group-item-action flex-column align-items-start" 
                        style="padding:0px;margin-bottom:7px;border-radius:0px;background-color:#97c3f121;
                                 box-shadow: 10px 8px 5px 1px rgb(0 0 0 / 7%);">
                            <div class="d-flex w-100 justify-content-between list_a_flex">
                              <div class="col-md-12 d-flex" ${contentEd}>
                                  <div id="focusChildEmployeeDiv${counter}" class="chat_scroll" style="height: 100px;display: none; overflow-y: auto!important;padding-top:1px; ">
                                      <input type="text" id="mySearchFocusChildBydata${counter}" class="form-control" placeholder="Search here..." title="Type here">
                                      <ul class="list-group" id="focusChild-list${counter}">
                                       
                                      </ul>
                                      <script>
                                        $("#mySearchFocusChildBydata${counter}").keyup(function () {
                                              var filter = $(this).val();
                                              $("#focusChild-list${counter} li").each(function () {
                                                  if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                                                      $(this).hide();
                                                  } else {
                                                      $(this).show()
                                                  }
                                              });
                                          });
                                      </script>
                                  </div>
                                <p class="mb-0 fchild w-100" style="color:black;" onkeypress="return event.keyCode != 13;" id="fCcount${counter}">
                                 ${text}
                                </p>
                              
                              </div>
                              

                              <div class="d-flex justify-content-end">
                                <div>
                                  <button type="button" class="btn btn-link btn-sm fcbtn_hide fccbtn_hide${counter}" style="text-decoration:none;display:none;margin-top:3px;" onclick="updateFocusViewData(${chats.id},'fCcount${counter}',${chats.parent_focus_id},${parentCounter})"><i style="color: #f8f9fa;margin-left: auto;padding: 2px 7px 4px 7px;background-color: #75b780;border-radius: 7px;">save</i>
                                  </button>
                                </div>
                                 <div class="fcbtn_hide_1" id="fccbtn_hide${counter}_1">
                                <small class="d-flex text-muted text_a_flex">
                                   <b style="padding-top:3px;">${time}</b>
                                  <div>
                                   <button class="btn btn-link btn-sm" data-html="true" data-toggle="popover" id="subfocusCommrnBtn${counter}" 
                                   onclick="showComment(${chats.id},'focusChildShowComment${chats.id}')">
                                    <i class="fa fa-comment text-black-50"></i>
                                  </button>
                                  <script> 
                                  $("#subfocusCommrnBtn${counter}").popover({
                                          title: '',
                                          container: 'body',
                                          placement: 'bottom',
                                          html: true, 
                                          content: function() {
                                                return $('#subfocusCommrnHtml${counter}').html();
                                          }
                                      });
                                  </script>
                                  ${my_view}
                                  </div>
                                   <div>
                                   ${attachActivity}
                                  </div>
                                  <div>
                                  <button class="btn btn-link btn-sm" id="focusChildElipseBtn${counter}" data-toggle="popover" 
                                  onclick="showPopver('focusChildElipseBtn${counter}','focusChildElipseHtml${counter}')">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   <script>$("#focusChildElipseBtn${counter}").click();</script>
                                  <div class="d-none chat_scroll" style="height:200px;" id="focusChildElipseHtml${counter}">
                                    <button class="btn btn-link button_cross" onclick="$('#focusChildElipseBtn${counter}').click()"><i class="fa fa-times"></i></button>
                                    <button class="btn btn-link text-danger" onclick="$('#focusChildElipseBtn${counter}').click(),deleteChildFocusDiv(${chats.id},${chats.parent_focus_id},${parentCounter})">
                                    <i class="fa fa-times"></i> Delete</button>

                                    ${completion_st}
                                  </div>
                                  </div>
                                  
                                </small>
                                </div>
                              </div>
                            </div>
                            <small class="text-muted"></small>
                        </a>

                      </div>`;
    return element;
}

function deleteChildFocusDiv(id,parent_id,parentCounter) {
    let formData = new FormData();
    formData.set("focus_id", id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'DeleteFocusView', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            focusChildViewTask(parent_id,parentCounter);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}

function submitTaskAssignViewData(ele=null, classname=null) {

    //  var spans = ele.getElementsByTagName("span");
    let taskAssignEmpArray=[];
    // for(var i=0;i<spans.length;i++)
    // {
    //   // alert($(spans[i]).attr('data-emp_id'));
    //   taskAssignEmpArray.push($(spans[i]).attr('data-emp_id'));
    // }

    // var strhtml=globalRemoveSpanContent(ele);
    // for(var i=0;i<spans.length;i++)
    // {
    //   focusTodayArray.push($(spans[i]).attr('data-emp_id'));
    // }
    // console.log(focusTodayArray);
    // var strhtml=globalRemoveSpanContent(ele);
    var strhtml='Sample Task';
    if (strhtml.trim().length > 0) {
        let formData = new FormData();
        formData.set("task_details", strhtml);
        formData.set("userdata1", taskAssignEmpArray);
        $.LoadingOverlay("show");
        app.request(baseURL + 'AddTaskAssignByU', formData).then(result => {
            $.LoadingOverlay("hide");
            if (result.status === 200) {
                app.successToast(result.body);
                // focusChildViewTask(parentId,counter);
                taskAssignByUViewdata();
            } else {
                app.errorToast(result.body);
            }
        }).catch(error => {
            console.log(error);
            $.LoadingOverlay("hide");
            app.errorToast("something went wrong please try again");
        });
    }

}
function taskAssignByUViewdata()
{

    let formData = new FormData();
    formData.set("user_id", $("#whichEmployeeId").val());
    var child_id = 'mytaskAssignBox';
    $.LoadingOverlay("show");
    app.request(baseURL + 'getTaskAssignBYEmployee', formData).then(result => {
        $.LoadingOverlay("hide");
        var target =  $("#"+child_id);
        target.find('.chat-content-task-assign').empty('');

        if (result.status === 200) {

            var fccount = $("#newTaskAssignCount").val();
            var provi = $("#whichProfile").val();
            // console.log(result.data);
            var chats=result.data;
            var note_data=result.note_data;
            var noteID_data=result.noteID_data;

            for (var i = 0; i < chats.length; i++) {
                var type = 'text';
                fccount++;
                var id_n="a_"+chats[i].id;
                var noteD= note_data[id_n];
                var noteID= noteID_data[id_n];

                taskAssignhowChatText(fccount, provi, chats[i],noteD,noteID).then(text_show=>{
                    $.chatCtrl('#'+child_id, {
                        text: text_show,
                        position: 'chat-left',
                        type: type,
                        fcount: fccount,
                        provi: provi
                    },'chat-content-task-assign');
                });//focusshowChatText(text,counter,senior or employee);


            }
            $('#taskAMessageInput').empty();
            $("#newTaskAssignCount").val(fccount);
            // console.log(result.data);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });
}
async function taskAssignhowChatText(counter, provi, chats,noteD,noteID) {


    var html=chats.task_details;
    html= html.replaceAll('?','');
    var text=html.trim();

    var time=formatDateToString(chats.created_on);
    var userText=getAsssignAppenddata(chats.assign_to,'employee');
    var d = noteD.split(",");
    var notetext="";

    if(noteID !== "undefined"){
        // var p = noteID.split(",");
        // // getAsssignAppenddata(index,'notes');
        // $(d).each(function( index ) {
        //     //console.log(p[index]);
        //     notetext = notetext +" "+ getAsssignAppenddata(d[index],'notes',p[index]); ;
        // });
        let templatedata='';
        var result= await ShowmodalNotesData(chats.id,noteID);
        if (result.status === 200) {
            templatedata += result.body.map(setNotesTempateNote1).join('');

            notetext = templatedata;
        }
    }

    text=text+userText+notetext;
    var contentEd=``;
    var attachDotes=``;
    if(provi==2){
        contentEd = `onclick="contentEditableFocus('tAcount${counter}',${chats.id},'task',null,1,'tabtn_hide${counter}')"`;
        attachDotes=`<button class="btn btn-link btn-sm" id="taskAssignByElipseBtn${counter}" data-toggle="popover" 
                                  onclick="showPopver('taskAssignByElipseBtn${counter}','taskAssignByElipseHtml${counter}')">
                                    <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                                  </button>
                                   <script>$("#taskAssignByElipseBtn${counter}").click();</script>`;
    }
    //  var my_view = '';

    var my_view = `<div class="d-none chat_scroll" style="height:200px;" id="taskByCommrnHtml${counter}" tabindex="4">
        <button class="btn btn-link button_cross" onclick="$('#taskByCommrnBtn${counter}').click()">
        <i class="fa fa-times"></i></button>
       
        <form id="taskByComment${chats.id}">
                    <div class="commentDiv chat_scroll" id="taskBycommentDiv${chats.id}" style="display:block;padding:5px;max-height:150px;">
                    <div class="">
                    <span class="text_class">comment</span>
                    <div class="ppDiv" style="">
                    <textarea class="form_class" type="text" id="taskTocommentTextarea${chats.id}" name="comment" style="min-height:45px;"></textarea>
                    <label for="taskBycommentFile${chats.id}">
                    <i class="fa fa-paperclip" style="color:#98a6ad !important;"></i>
                    </label>
                    <input id="taskBycommentFile${chats.id}" name="file[]" class="input_cl" type="file" />
                    <button type="button" onclick="addTaskToComment('taskByComment${chats.id}',${chats.id},'taskByShowComment${chats.id}')" class="btn btn-gbtech comment_button ml-2" 
                        style="line-height: 15px;">save</button>
                    </div>
                    </div>
                    </div>
                </form>
            <div class="chat_scroll" style="max-height:150px;">
                        <div class="main-card mb-3">
                            <div class="p-1" style="color:#99a2a7;">
                                <span class="card-title">User Comments</span>
                                <div id="taskByShowComment${chats.id}" class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
        </div>`
    ;
    var com_status=`text-danger`;
    if(chats.completion_status==2)
    {
        com_status=`text-success`;
    }
    let notepad="";
    // if(noteID !==""){
    //      notepad=` <button class="btn btn-link btn-sm" data-html="true" data-toggle="popover" id="taskByNotesBtn${counter}"
    //                                onclick="ShowmodalNotesData(${chats.id},'${noteID}')">
    //                                 <i class="fa fa-tasks text-black-50"></i>
    //                               </button>`
    // }


    var collapsed=`<i class="fas fa-angle-double-right ${com_status}" style="padding-top:7px;padding-right:5px;"></i>`;
    var element = `
                 <div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start" 
                        style="padding: 0px;
                                border-radius: unset;
                                box-shadow: 3px 3px 7px 2px rgb(0 0 0 / 12%);
                                background-color: #fbfbfb;
                                color: black!important;
                                margin-bottom: 10px;">
                            <div class="d-flex w-100 justify-content-between">
                             
                              <div class="d-flex col-md-12" id="taskAssignData${counter}" ${contentEd}>
                                 ${collapsed}

                              
                                <p class="mb-1 fchild " onkeypress="return event.keyCode != 13;" id="tAcount${counter}" style="width:100%;">
                                 ${text}
                                </p>
                              </div>
                             
                            </div>
                            <div class="d-flex">
                            <div class="col-md-8" ${contentEd}></div>

                            <div class="d-flex justify-content-end col-md-4" style="margin-top: -15px;">
                             <div class=""><button type="button" class="btn btn-link btn-sm fcbtn_hide tabtn_hide${counter}" style="text-decoration:none;display:none;margin-top:3px;"><i style="color: #f8f9fa;margin-left: auto;padding: 2px 7px 4px 7px;background-color: #75b780;border-radius: 7px;" onclick="updateTaskAssignByUViewData(${chats.id},'tAcount${counter}')">save</i></button></div>
                                 <div class="fcbtn_hide_1" id="tabtn_hide${counter}_1">
                                <small class="d-flex text-muted text_a_flex">
                                     <b style="padding-top:3px;">${time}</b>
                                  <button class="btn btn-link btn-sm" data-html="true" data-toggle="popover" id="taskByCommrnBtn${counter}" 
                                   onclick="showTaskToComment(${chats.id},'taskByShowComment${chats.id}')">
                                    <i class="fa fa-comment text-black-50"></i>
                                  </button>
                                  ${notepad}                                  
                                 
                                  <script> 
                                  $("#taskByCommrnBtn${counter}").popover({
                                          title: '',
                                          container: 'body',
                                          placement: 'bottom',
                                          html: true, 
                                          content: function() {
                                                return $('#taskByCommrnHtml${counter}').html();
                                          }
                                      });
                                  </script>
                                  ${my_view}
                                  <div>
                                  ${attachDotes}
                                  
                                  <div class="d-none chat_scroll" style="height:150px;" id="taskAssignByElipseHtml${counter}">
                                    <button class="btn btn-link button_cross" onclick="$('#taskAssignByElipseBtn${counter}').click()"><i class="fa fa-times"></i></button>
                                    
                                     <li class="dropdown-item text-danger text-small" onclick="$('#taskAssignByElipseBtn${counter}').click(),deleteTaskAssignByUView(${chats.id})">
                                      <i class="fa fa-trash"> Delete</i>
                                    </li>
                                     <li class="dropdown-item text-primary text-small" onclick="openNoteModal(${chats.id})">
                                      <i class="fa fa-file"> Notes</i>
                                    </li>
                                   <li class="dropdown-item text-danger text-small" >
                                      
                                    </li>
                                  </div>
                                  </div>                                  
                                </small>
                                </div>
                              </div>
                        </div>
                        </a>

                      </div>`;
    return element;
}

async function ShowmodalNotesData(taskid,noteid){

    let template = '';
    let formData = new FormData();
    formData.set("id", noteid);
    return await app.request( 'https://rmt.ecovisrkca.com/getNotesByIds', formData);

}
function closeModal() {
    $("#NotesTask").modal("hide");
    $(".save_btn").addClass('d-none');
}
function setNotesTempateNote1(object, index) {
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

        // return `<div class="align-items-baseline d-flex files" file-id="4" onclick="openNote('${ nameArray[nameArray.length - 1]}','${object.note_file}','${basePath}'),closeModal()">
        //                         <span class="file_icon mr-2"><i class="far fa-file-alt add_new_notepad"></i></span>
        //                         <p class="file_name ml-2 pl-1" style="font-weight: 600;">${ nameArray[nameArray.length - 1]}</p>
        //                     </div>`;
        userText+=`<span class='label text-info' data-emp_id='${object.note_file}' data-type='notes' 
                contenteditable='false' file-id="4" onclick="openNote('${ nameArray[nameArray.length - 1]}','${object.note_file}','${basePath}')" style="cursor:pointer;background-color: #6c757d;
    border-radius: 20px;color: #f8f9fa !important;padding:1px 5px 3px 5px;">#${ nameArray[nameArray.length - 1]}</span> &#8203;`;
        //  userText+=`<span class='label text-info' data-emp_id='${object.note_file}' data-type='notes'
        //             contenteditable='false' file-id="4" style="cursor:pointer;background-color: #6c757d;
        // border-radius: 20px;color: #f8f9fa !important;padding:0px 2px 0px 2px;">#${ nameArray[nameArray.length - 1]}</span> &#8203;`;
    }
    return userText;

}


function openNoteModal(id){
    $("#NotesModalView").modal();
}
function updateTaskAssignByUViewData(focus_id,divId)
{
    var ele=document.getElementById(divId);

    var spans = ele.getElementsByTagName("span");
    // console.log(spans);
    let focusTodayChildActArray=[];
    let NoteData=[];
    // let hoursTodayChildActArray=[];
    for(var i=0;i<spans.length;i++)
    {
        // console.log($(spans[i]));
        if($(spans[i]).attr('data-type')=='employee'){
            focusTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        }
        if($(spans[i]).attr('data-type')=='notes'){
            NoteData.push($(spans[i]).attr('data-emp_id'));
        }
        // if($(spans[i]).attr('data-type')=='hours'){
        //     hoursTodayChildActArray.push($(spans[i]).attr('data-emp_id'));
        // }
    }
    // console.log(focusTodayChildActArray);
    // console.log(hoursTodayChildActArray);


    var strhtml=globalRemoveSpanContent(ele);

    // var focus_detail=$("#"+divId).html();
    let formData = new FormData();
    formData.set("task_id", focus_id);
    formData.set("task_detail", strhtml);
    formData.set("employee_ids", focusTodayChildActArray);
    formData.set("note_ids", NoteData);
    // formData.set("activity_hr", hoursTodayChildActArray);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'updateTaskAssignByUView', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            taskAssignByUViewdata();

        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    })
}
function deleteTaskAssignByUView(id) {
    let formData = new FormData();
    formData.set("task_id", id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'deleteTaskAssignByUView', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            taskAssignByUViewdata();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function taskAssignToUviewData()
{
    //  let formData = new FormData();
    // formData.set("date", $("#todayDate").val());
    // formData.set("user_id", $("#whichEmployeeId").val());
    // $.LoadingOverlay("show");
    //  app.request(baseURL + 'getTaskAssignToEmployee', formData).then(result => {
    //     $.LoadingOverlay("hide");
    //      $("#taskAssignToU").empty();
    //      if (result.status === 200) {

    //             // console.log(result.data);
    //             var chats=result.data;
    //             for (var i = 0; i < chats.length; i++) {

    //                 var text_show = taskAssignToUChatText(chats[i]);//focusshowChatText(text,counter,senior or employee);
    //                 // console.log(text_show);
    //                $("#taskAssignToU").append(text_show);
    //             }


    //         } else {
    //         app.errorToast(result.body);
    //     }
    //      }).catch(error => {
    //     console.log(error);
    //     $.LoadingOverlay("hide");
    //     // app.errorToast("something went wrong please try again");
    // });
    let formData = new FormData();
    formData.set("date", $("#todayDate").val());
    formData.set("user_id", $("#whichEmployeeId").val());
    $.LoadingOverlay("show");
    app.request(baseURL + 'getTaskAssignToEmployee', formData).then(result => {
        $.LoadingOverlay("hide");
        var target =  $("#mytaskAssignBox");
        target.find('.chat-content-task-given').empty();
        if (result.status === 200) {

            var fccount = $("#newTaskGivenCount").val();
            var provi = $("#whichProfile").val();
            // console.log(result.data);
            var chats=result.data;
            for (var i = 0; i < chats.length; i++) {
                var type = 'text';
                fccount++;

                var text_show = taskAssignToUChatText(fccount, provi, chats[i]);//focusshowChatText(text,counter,senior or employee);

                $.chatCtrl('#mytaskAssignBox', {
                    text: text_show,
                    position: 'chat-left',
                    type: type,
                    fcount: fccount,
                    provi: provi
                },'chat-content-task-given');
            }
            $("#newTaskGivenCount").val(fccount);
            // console.log(result.data);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        // console.log(error);
        $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });
}
function taskAssignToUChatText(counter,provi,chats)
{
    // console.log(chats);
    var html=chats.task_details;
    html= html.replaceAll('?','');
    var text=html.trim();
    var time=formatDateToString(chats.created_on);
    var userText=getAsssignAppenddata(chats.assign_by,'employee');

    var my_view = `<div class="d-none chat_scroll" style="height:200px;" id="taskToCommrnHtml${counter}" tabindex="4">
        <button class="btn btn-link button_cross" onclick="$('#taskToCommrnBtn${counter}').click()">
        <i class="fa fa-times"></i></button>
        <form id="taskToComment${chats.id}">
                    <div class="commentDiv chat_scroll" id="taskTocommentDiv${chats.id}" style="display:block;padding:5px;max-height:150px;">
                    <div class="">
                    <span class="text_class">comment</span>
                    <div class="ppDiv" style="">
                    <textarea class="form_class" type="text" id="taskTocommentTextarea${chats.id}" name="comment" style="min-height:45px;"></textarea>
                    <label for="taskTocommentFile${chats.id}">
                    <i class="fa fa-paperclip" style="color:#98a6ad !important;"></i>
                    </label>
                    <input id="taskTocommentFile${chats.id}" name="file[]" class="input_cl" type="file" />
                    <button type="button" onclick="addTaskToComment('taskToComment${chats.id}',${chats.id},'taskToShowComment${chats.id}')" class="btn btn-gbtech comment_button ml-2" 
                        style="line-height: 15px;">save</button>
                    </div>
                    </div>
                    </div>
                </form>
            <div class="chat_scroll" style="max-height:150px;">
                        <div class="main-card mb-3">
                            <div class="p-1" style="color:#99a2a7;">
                                <span class="card-title">User Comments</span>
                                <div id="taskToShowComment${chats.id}" class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
        </div>`
    ;
    var attachDotes=``;
    if(provi==2)
    {
        attachDotes=` <button class="btn btn-link btn-sm" id="taskAssignToElipseBtn${counter}" data-toggle="popover" 
                      onclick="showPopver('taskAssignToElipseBtn${counter}','taskAssignToElipseHtml${counter}')">
                        <i class="fa fa-fa fa-ellipsis-v text-info"></i>
                      </button>`;
    }
    var com_status=`text-danger`;
    if(chats.completion_status==2)
    {
        com_status=`text-success`;
    }
    var collapsed=`<i class="fas fa-angle-double-right ${com_status}" style="padding-top:7px;padding-right:5px;"></i>`;
    var data=`    <div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start" 
                        style="padding: 0px;
                                border-radius: unset;
                                box-shadow: 3px 3px 7px 2px rgb(0 0 0 / 12%);
                                background-color: #fbfbfb;
                                color: black!important;
                                margin-bottom: 10px;">
                            <div class="w-100 justify-content-between list_a_flex">
                              <div class="col-md-10 d-flex" id="taskGivenData${counter}">
                               
                                ${collapsed}
                                <p class="mb-1 fchild" id="tGcount${counter}">
                                 ${text+userText}
                                </p>
                              </div>
                              <div class="d-flex justify-content-between list_b_flex">
                                <small class="d-flex text-muted text_a_flex">
                                     <b>${time}</b>
                                <button class="btn btn-link btn-sm" data-html="true" data-toggle="popover" id="taskToCommrnBtn${counter}" 
                                   onclick="showTaskToComment(${chats.id},'taskToShowComment${chats.id}')">
                                    <i class="fa fa-comment text-black-50"></i>
                                  </button>
                                  <script> 
                                  $("#taskToCommrnBtn${counter}").popover({
                                          title: '',
                                          container: 'body',
                                          placement: 'bottom',
                                          html: true, 
                                          content: function() {
                                                return $('#taskToCommrnHtml${counter}').html();
                                          }
                                      });
                                  </script>
                                  ${my_view}
                                  <div>
                                  ${attachDotes}
                                 
                                   <script>$("#taskAssignToElipseBtn${counter}").click();</script>
                                  <div class="d-none chat_scroll" style="height:200px;" id="taskAssignToElipseHtml${counter}">
                                    <button class="btn btn-link button_cross" onclick="$('#taskAssignToElipseBtn${counter}').click()"><i class="fa fa-times"></i></button>
                                    
                                    <li class="dropdown-item text-success text-small" onclick="completeTask(${chats.id}),$('#taskAssignToElipseBtn${counter}').click()">
                                      <i class="fa fa-check"> Complete</i>
                                    </li>
                                  </div>
                                 
                                  </div>                                  
                                </small>
                              </div>
                            </div>
                            <small class="text-muted"></small>
                        </a>

                      </div>`;
    return data;
}
function addTaskToComment(form_id,f_id,comment_show)
{
    // var comment=$("#commentTextarea"+f_id).val();
    var comment=$(".popover #taskTocommentTextarea"+f_id).val();
    // console.log(comment);
    var form_data = document.getElementById(form_id);
    var formData = new FormData(form_data);
    formData.set("task_id", f_id);
    formData.set("comment", comment);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'AddTaskToComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            $("#"+comment_show).empty();
            showTaskToComment(f_id,comment_show);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
function showTaskToComment(f_id,comment_show)
{
    $("#"+comment_show).empty();
    let formData = new FormData();
    formData.set("task_id", f_id);
    // $.LoadingOverlay("show");
    app.request(baseURL + 'getTaskToComment', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status == 200) {
            // app.successToast(result.body);
            // console.log(result.data);
            var userdata=result.data;
            if(userdata!=undefined){

                $(".popover #"+comment_show).empty();
                var data=``;
                for (var c = 0; c < userdata.length; c++) {
                    // console.log(userdata[c]);
                    var c_file=``;
                    if(userdata[c].file!=null && userdata[c].file!="")
                    {
                        c_file=`
                            <a class="btn btn-link" href="${baseURL + userdata[c].file}" target="_blank" ><i class="fa fa-download"></i></a>`;
                    }

                    data=` <div class="vertical-timeline-item vertical-timeline-element">
                                    <div> <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="fa fa-angle-double-right" style="color: red;margin-left: 2px;"> </i> </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>${userdata[c].comment} ${c_file}</p>

                                        </div>
                                    </div>
                               </div> `;
                    $(".popover #"+comment_show).append(data);
                }
            }

            // var data=showCommentViewData(result.data);

        } else {
            // app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        // app.errorToast("something went wrong please try again");
    });

}
function completeTask(id)
{
    let formData = new FormData();
    formData.set("task_id", id);
    $.LoadingOverlay("show");
    app.request(baseURL + 'CompleteTaskView', formData).then(result => {
        $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
            taskAssignToUviewData();
            taskAssignByUViewdata();
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        $.LoadingOverlay("hide");
        app.errorToast("something went wrong please try again");
    });
}
