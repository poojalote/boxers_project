function notifyMe(title,body,link_onclick=undefined,close_var=undefined,silent_var=false) {
	
    if (!window.Notification) {
        console.log('Browser does not support notifications.');
    } else {
        // check if permission is already granted
        if (Notification.permission === 'granted') {
			
            // show notification here
           	var shouldRequireInteraction= true;
                    // show notification here
					var dts = Math.floor(Date.now());
					var title=title;
					var options = {
      body: body,
	  timestamp: dts,
      requireInteraction: true,
	  silent: silent_var //true if you want notification silent
  }
                    var notify = new Notification('Hi there!', options);
					if(link_onclick != undefined)
					{
					notify.onclick = function(event) {
				    event.preventDefault(); // prevent the browser from focusing the Notification's tab
					window.open(link_onclick, '_blank');
                    }
					}
if(close_var != undefined)
{
notify.onclose = close_var;	
}	
// notify.onclose = function(event) {
 // alert("close");

// }
				
        } else {
            // request permission from user
            notification_not_on();
        }
    }
}

function notification_not_on()
{
	Notification.requestPermission().then(function (p) {
                if (p === 'granted') {
					var shouldRequireInteraction= true;
                    // show notification here
					
                } else {
                    console.log('User blocked notifications.');
                }
            }).catch(function (err) {
                console.error(err);
            });
}

