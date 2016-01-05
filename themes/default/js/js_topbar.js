var openNnotifications = 0;
var openNmessages = 0;

function hideNotifications() {
	$('.area-notification').hide();
	$('.content-info').html('');
	openNnotifications = 0;
	checkNewNotifications();
}

function showNotifications() {
	clearTimeout(stopNotifications);

	$('#iconotifications').attr('src',siteurl + 'themes/' + sitetheme + '/imgs/loadingtop.gif');

	if (openNmessages == 1) hideNotificationsMessages();

	hideSearchTop();

	$('.box-notification').hide();
	
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/get-notifications/r:" + Math.round(Math.random()*1000),
		data: '',
		success: function(resp) {
			switch(resp.charAt(0)) {
				case '0':
					break;
				case '1':
					$('.content-info').html(resp.substring(3));
					$('.area-notification').show();
					$('#iconotifications').attr('src',siteurl + 'themes/' + sitetheme + '/imgs/iconotifications.png');
					$("abbr.timeago").timeago();
					break;
			};				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
	openNnotifications = 1;	
}

function checkNewNotifications() {
	valuecurrent = $('.notification-value').html();
	if (valuecurrent == '') valuecurrent = 0;
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/check-notifications/r:" + Math.round(Math.random()*1000),
		data: '',
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					// If there are no notifications
					numnot = parseInt(resp.substring(3));
					if (numnot <= 0) {
						$('.box-notification').hide();
						$('.notification-value').html(0);
					}
					break;
				case '1':
					// If there are notifications
					numnot = parseInt(resp.substring(3));
					if ( numnot > 0 ) {
						$('.notification-value').html(numnot);
						$('.box-notification').show();
						if (numnot>valuecurrent) {
							if(!document.hasFocus()) {						
								// If the current document title doesn\'t have an alert, add one
								if(document.title.indexOf('[!]') == -1) {
									document.title = "[!] " + document.title;
								}
							}
						}
					}
					break;
				};
				
			stopNotifications = setTimeout(checkNewNotifications, intervalcheckevents);
				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
}



/*************************************************************************/
/*************************************************************************/

function hideNotificationsMessages() {
	$('.area-notification-msg').hide();
	$('.content-info-msg').html('');
	openNmessages = 0;
	checkNewMessages();
}

function showNotificationsMessages() {
	
	clearTimeout(stopNewMessages);
	$('#icomessages').attr('src',siteurl + 'themes/' + sitetheme + '/imgs/loadingtop.gif');

	if (openNnotifications == 1) hideNotifications();

	hideSearchTop();

	$('.box-notification-msg').hide();
	
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/get-notifications-messages/r:" + Math.round(Math.random()*1000),
		data: '',
		success: function(resp) {
			switch(resp.charAt(0)) {
				case '0':
					break;
				case '1':
					$('.content-info-msg').html(resp.substring(3));
					$('.area-notification-msg').show();
					$('#icomessages').attr('src',siteurl + 'themes/' + sitetheme + '/imgs/iconotimessages.png');
					$("abbr.timeago").timeago();
					break;
			};				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
	openNmessages = 1;

}

function checkNewMessages()
{
	valuecurrent = $('.notification-value-msg').html();
	if (valuecurrent == '') valuecurrent = 0;
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/check-newmessages/r:" + Math.round(Math.random()*1000),
		data: '',
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					// If there are no notifications of messages
					numnot = parseInt(resp.substring(3));
					if (numnot <= 0) {
						$('.box-notification-msg').hide();
						$('.notification-value-msg').html(0);
					}
					break;
				case '1':
					// If there are notifications of messages
					numnot = parseInt(resp.substring(3));
					if ( numnot > 0 ) {
						$('.notification-value-msg').html(numnot);
						$('.box-notification-msg').show();
						if (numnot>valuecurrent) {
							if(!document.hasFocus()) {						
								// If the current document title doesn\'t have an alert, add one
								if(document.title.indexOf('[!]') == -1) {
									document.title = "[!] " + document.title;
								}
							}
						}
					}
					break;
				};
				
			stopNewMessages = setTimeout(checkNewMessages, intervalcheckmsg);
				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
}