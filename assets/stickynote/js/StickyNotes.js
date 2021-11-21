$(function () {

    // Advanced demo
    $('#StickyNoteModal').coaStickyNote({
        resizable: true,
        availableThemes: [
            { text: "Yellow", value: "sticky-note-yellow-theme" },
            { text: "Green", value: "sticky-note-green-theme" },
            { text: "Blue", value: "sticky-note-blue-theme" },
            { text: "Pink", value: "sticky-note-pink-theme" },
            { text: "Orange", value: "sticky-note-orange-theme" }],
        notePosition: { top: "100px", left: "50px" },
        noteDimension: { width: "300px", height: "300px" },
        noteText: "New custom note box!",
        noteHeaderText: "Note title!",
        deleteLinkText: "Close",
        startZIndex: 50,
        beforeCreatingNoteBox: function (note) {
            // Want to do any thing here?

        },
        onNoteBoxCreated: function (note) {
            create_new_sticky(note);
            // Let's save it on server
        },
        onNoteBoxHeaderUpdate: function (note) {
            update_sticky(note);
            // Return false, if want to abort the request of header update.
            // Else let's save the updated header text on server, to preserve changes.
        },
        onNoteBoxTextUpdate: function (note) {

            update_sticky(note);
            // We can also show confirm box here. Which is common while deleting some thing!
            // Return false, if want to abort the request of text update.
            // Else let's save the updated note text on server, to preserve changes.

        },
        onNoteBoxDelete: function (note) {
            update_sticky(note,1);
            // Return false, if want to abort the note delete request .
            // Else let's delete the note details from server, to preserve changes.
        },
        onNoteBoxResizeStop: function (note) {
            update_sticky(note);
            // Note box dimension got changed.
            // let's save the updated dimension(width/ height) on server, to preserve changes.
        },
        onNoteBoxDraggingStop: function (note) {
            update_sticky(note);
            // Note box position got changed.
            // let's save the updated position(top/ left) on server, to preserve changes.
        },
        onThemeSelectionChange: function (note) {
            update_sticky(note);
            // Note box theme got changed.
            // let's save the updated theme on server, to preserve changes.
        },
        onMovingNoteBoxOnTop: function (note) {
            update_sticky(note);
            // Note box z-index got changed to be on top of all the notes.
            // let's save the updated the z-index on server, to preserve changes.
        },
    });


});
function getBackEndStickyObject(note) {
    return {
        Title: note.settings.noteHeaderText,
        NoteText: note.settings.noteText,
        PositionTop: note.settings.notePosition.top,
        PositionLeft: note.settings.notePosition.left,
        DimensionWidth: note.settings.noteDimension.width,
        DimensionHeight: note.settings.noteDimension.height,
        ZIndex: note.settings.zIndex,
        OuterCssClass: note.settings.defaultTheme.value,
        Id: note.id,
        Index: note.index
    };
}

function getLocalStickyNoteObject(backEndObj, note) {
    if (note == null) {
        note = {};
        note.settings = {};
        note.settings.notePosition = {};
        note.settings.defaultTheme = {};
        note.settings.noteDimension = {};
    }

    note.settings.noteHeaderText = backEndObj.Title;
    note.settings.noteText = backEndObj.NoteText;
    note.settings.notePosition.top = backEndObj.PositionTop;
    note.settings.notePosition.left = backEndObj.PositionLeft;
    note.settings.noteDimension.width = backEndObj.DimensionWidth;
    note.settings.noteDimension.height = backEndObj.DimensionHeight;
    note.settings.zIndex = backEndObj.ZIndex;
    note.settings.defaultTheme.value = backEndObj.OuterCssClass;
    note.id = backEndObj.Id;
    note.index = backEndObj.index;

    return note;
}
function create_new_sticky(note) {
   var data= getBackEndStickyObject(note);
   console.log(data);
    let formData = new FormData();
    formData.set("data", JSON.stringify(data));
    app.request(baseURL + 'CreateNewSticky', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            app.successToast(result.body);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })

}
function update_sticky(note,id=null) {
    var data= getBackEndStickyObject(note);
    let formData = new FormData();
    formData.set("data", JSON.stringify(data));
    formData.set("id", id);
    app.request(baseURL + 'UpdateSticky', formData).then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
           // app.successToast(result.body);
        } else {
            app.errorToast(result.body);
        }
    }).catch(error => {
        console.log(error);
        // $.LoadingOverlay("hide");
        //   app.errorToast("something went wrong please try again");
    })
}
function get_All_Sticky() {
    app.request(baseURL + 'getAllSticky').then(result => {
        // $.LoadingOverlay("hide");
        if (result.status === 200) {
            var data=result.data;
            var notes = [];
            for (var counter = 0; counter < data.length; counter++) {
                notes.push(getLocalStickyNoteObject(data[counter]));
            }
          //  $('#StickyNoteModal').data('coaStickyNote').loadExistingNotes(notes);
            $('#StickyNoteModal').data('coaStickyNote').loadExistingNotes(notes);


        } else {

        }
    }).catch(error => {
        console.log(error);
    })
}