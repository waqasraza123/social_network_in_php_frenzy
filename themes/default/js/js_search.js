
function topSearch()
{
	if(typeof hideNotificationsMessages == 'function') {
		hideNotificationsMessages();
	}
	if(typeof hideNotifications == 'function') {
		hideNotifications();
	}
	
	var query = $('#topsearch').val();
	
	if(query == '#') {
		return false;
	}
	
	if(query.indexOf('#') === -1) {
		var urladic = '';

		$('#topsearch').keypress(function(x) {
			if (x.keyCode == 13) {
				query = $(this).val();
				if (query != this.defaultValue){
					document.location = siteurl + 'directory/people/q:' + escape(query.replace(' ','+'));
				}
			}
		});

	} else {
		var urladic = '-tag';
		
		$('#topsearch').keypress(function(x) {
			if (x.keyCode == 13) {
				query = $(this).val();
				if (query != this.defaultValue){
					document.location = siteurl + 'search/t:' + escape(query.replace('#',''));
				}
			}
		});
		
	}
	
	// If no letters remove the div not helpful
	if (query == '') {
		var milliseconds = 0;
	} else {
		contentSearch = '<div id="contentSearch"><div id="resultSearch"><div id="loadingSearch"><img src="' + siteurl + 'themes/' + sitetheme + '/imgs/loading.gif"></div></div></div>';
		$('#search-container').html(contentSearch);
		
		$('#search-container').show();
		
		var milliseconds = 250;
	}
	
	// It took us a few milliseconds so that more letters are entered to the consultation
	setTimeout(function() {
		if(query == $('#topsearch').val()) {
			if($.trim(query) == '') {
				$("#search-container").hide();
				$("#contentSearch").remove();
			} else {
				$.ajax({
					type: 'POST',
					url: siteurl + "ajax/searchtop-inside" + urladic + "/r:" + Math.round(Math.random()*1000),
					data: 'q=' + query.replace('#',''),
					success: function(resp) {
						//alert(resp);
						$("#search-container").html(resp).show();
					},
					error: function(){
						alert('Error'); 
					} //end error
				}); // end ajax
			}
		}
	}, milliseconds);
}

function hideSearchTop() {
	$("#search-container").hide();
}
