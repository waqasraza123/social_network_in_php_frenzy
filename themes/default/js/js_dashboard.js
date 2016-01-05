function reloadinfo(thatthing)
{

	$('#bmore').hide();
	$('#morepreload').show();
		
	numitems = $('#numitems').val();
	
	switch (thatthing) {
		case 'followers':
			urltarget = 'ajax/reload-followers-dashboard/r:';
			break;
		case 'following':
			urltarget = 'ajax/reload-following-dashboard/r:';
			break;
		case 'videos':
			urltarget = 'ajax/reload-videos-dashboard/r:';
			break;
		case 'likes':
			urltarget = 'ajax/reload-likes-dashboard/r:';
			break;
		case 'comments':
			urltarget = 'ajax/reload-comments-dashboard/r:';
			break;
		case 'activities':
			urltarget = 'ajax/reload-activities-dashboard/r:';
			break;
		case 'notifications':
			urltarget = 'ajax/reload-notifications-dashboard/r:';
			break;
		case 'messages':
			urltarget = 'ajax/reload-messages-dashboard/r:';
			break;
		case 'posts':
			urltarget = 'ajax/reload-posts-dashboard/r:';
			break;
		case 'photos':
			urltarget = 'ajax/reload-photos-dashboard/r:';
			break;
	}

	$.ajax({
		type: 'POST',
		url: siteurl + urltarget + Math.round(Math.random()*1000),
		data: 'ni=' + numitems + '&idu=' + idu,
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					alert(h.substring(3));
					$('#morepreload').hide();
					$('#bmore').show();
					break;
				
				case '1':
					cad = h.substring(3);
					$('#moreitems').append(cad);
					$('#numitems').val(parseInt($('#numitems').val()) + parseInt(itemperpage));

					$('#morepreload').hide();
					$('#bmore').show();
					$("abbr.timeago").timeago();
					break;
					
				case '2':
					cad = h.substring(3);
					$('#moreitems').append(cad);
					$('#moreitemsbar').hide();
					//$('#numitems').val(parseInt($('#numitems').val()) + parseInt(itemperpage));
					$("abbr.timeago").timeago();
					break;
			}
		},
		error: function(){
			alert(txt_norequest);
			$('#morepreload').hide();
			$('#bmore').show();
		} //end error
	}); // end ajax
}


/***********************************************************************/

function reload_comments(codepost, itemperpage)
{
	$('#linkmore_' + codepost).hide();
	$('#morepreload_' + codepost).show();
	
	numitems = $('#numitems_' + codepost).val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/reload-comments-post/r:' + Math.round(Math.random()*1000),
		data: 'ni=' + numitems + '&cp=' + codepost,
		success: function(h){
			switch(h.charAt(0)){
				case '0':
					alert(h.substring(3));
					$('#morepreload_' + codepost).hide();
					$('#linkmore_' + codepost).show();
					break;
				
				case '1':
					cad = h.substring(3);
					
					$('#thelistcomments_' + codepost).prepend(cad);
					
					$('#numitems_' + codepost).val(parseInt(numitems) + parseInt(itemperpage));
					
					$('#morepreload_' + codepost).hide();
					$('#linkmore_' + codepost).show();
					$("abbr.timeago").timeago();
					break;
					
				case '2':
					cad = h.substring(3);
					$('#thelistcomments_' + codepost).prepend(cad);
					$('.loadmorecomment_' + codepost).hide();
					$("abbr.timeago").timeago();
					break;
			}
		},
		error: function(){
			alert(txt_norequest);
			$('#morepreload_' + codepost).hide();
			$('#linkmore_' + codepost).show();
		} //end error
	}); // end ajax
}

/***********************************************************************/

function deletecomment(idcom, idp, idowner, codep) {
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=5&ic=' + idcom + '&ip=' + idp + '&io=' + idowner,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					alert(resp.substring(3));
					break;

				case '1':
					$('#numcomments_' + codep).html(parseInt($('#numcomments_' + codep).html()) - 1);
					$("#comment_post_" + idcom).fadeOut(500, function() { $("#comment_post_" + idcom).remove(); });
					break;
			}
		},
		error: function(){
			alert(txt_norequest);
		} //end error
	}); // end ajax
}

/***********************************************************************/

function commentpost(codep, idp, iu) {
	$("#bsavecomm_" + codep).hide();
	$("#iloader_" + codep).show();
	
	comment = $.trim($('#comment_' + codep).val());
	if (comment == '') {
		$('#comment_' + codep).val(comment);
		openandclose('#msgerror2_' + codep, msgnocomment, 1700);
		$('#comment_' + codep).focus();
		$("#bsavecomm_" + codep).show();
		$("#iloader_" + codep).hide();
		return;
	}

	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=4&ip=' + idp + '&iu=' + iu + '&cp=' + codep + '&c=' + encodeURIComponent(comment),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose('#msgerror2_' + codep, resp.substring(3), 1700);
					$("#bsavecomm_" + codep).show();
					$("#iloader_" + codep).hide();
					break;
				
				case '1':
					$('#comment_' + codep).val('');
					$('#numcomments_' + codep).html(parseInt($('#numcomments_' + codep).html()) + 1);
					$('#replies_' + codep).append(resp.substring(3));
					$("#bsavecomm_" + codep).show();
					$("#iloader_" + codep).hide();
					$("abbr.timeago").timeago();
					break;
			}
		},
		error: function(){
			openandclose('#msgerror2_' + codep, txt_norequest, 1700);
			$("#bsavecomm_" + codep).show();
			$("#iloader_" + codep).hide();
		} //end error
	}); // end ajax
}

/***********************************************************************/

function likepost(codep, idp, iu) {
	$("#llike_" + codep).hide();
	$("#iloaderlike_" + codep).show();

	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=1&ip=' + idp + '&iu=' + iu,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose('#msgerror1_' + codep, resp.substring(3), 1700);
					$("#iloaderlike_" + codep).hide();
					$("#llike_" + codep).show();
					break;
				
				case '1':
					$('#numlikes_' + codep).html(parseInt($('#numlikes_' + codep).html()) + 1);
					$("#iloaderlike_" + codep).hide();
					$("#llike_" + codep).hide();
					$("#lulike_" + codep).show();
					break;
			}
		},
		error: function(){
			openandclose('#msgerror1_' + codep, txt_norequest, 1700);
			$("#iloaderlike_" + codep).hide();
			$("#llike_" + codep).show();
		} //end error
	}); // end ajax
}

/***********************************************************************/

function unlikepost(codep, idp, iu) {
	$("#lulike_" + codep).hide();
	$("#iloaderlike_" + codep).show();
	
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=2&ip=' + idp + '&iu=' + iu,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose('#msgerror1_' + codep, resp.substring(3),1700);
					$("#iloaderlike_" + codep).hide();
					$("#lulike_" + codep).show();
					break;
				
				case '1':
					$('#numlikes_' + codep).html(parseInt($('#numlikes_' + codep).html()) - 1);
					$("#iloaderlike_" + codep).hide();
					$("#lulike_" + codep).hide();
					$("#llike_" + codep).show();
					break;
			}
		},
		error: function(){
			openandclose('#msgerror1_' + codep, txt_norequest, 1700);
			$("#iloaderlike_" + codep).hide();
			$("#lulike_" + codep).show();
		} //end error
	}); // end ajax
}

/***********************************************************************/

function deletepost(codep) {
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=3&cp=' + codep,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					alert(resp.substring(3));
					break;

				case '1':
					$("#activity_" + codep).fadeOut(500, function() { $("#activity_" + codep).remove(); });
					$('#numposts').html(parseInt($('#numposts').html()) - 1);
					break;
			}
		},
		error: function(){
			alert(txt_norequest);
		} //end error
	}); // end ajax
}


/***********************************************************************/

function sharepost(codep, idp, iu) {
	$("#areabshare_" + codep).hide();
	$("#iloadershare_" + codep).show();
	
	txtshare = $.trim($('#txtshare_' + codep).val());

	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/posts/r:" + Math.round(Math.random()*1000),
		data: 'todo=6&ip=' + idp + '&iu=' + iu + '&cp=' + codep + '&tsh=' + encodeURIComponent(txtshare),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose('#msgerrorshare_' + codep, resp.substring(3), 1700);
					$("#areabshare_" + codep).show();
					$("#iloadershare_" + codep).hide();
					break;				
				case '1':
					$("#shareok_" + codep).html(resp.substring(3));
					$("#share_" + codep).slideUp('low',function(){
						$("#shareok_" + codep).slideDown('low');
					});
					setTimeout(function(){
						$("#shareok_" + codep).slideUp('low',function(){
							$("#accesories_" + codep).slideDown('low');
							$('#txtshare_' + codep).val('');
							$("#areabshare_" + codep).show();
							$("#iloadershare_" + codep).hide();
						});
					}, 3000);
					break;
			}
		},
		error: function(){
			openandclose('#msgerrorshare_' + codep, txt_norequest, 1700);
			$("#areabshare_" + codep).show();
			$("#iloadershare_" + codep).hide();
		} //end error
	}); // end ajax

}

/***********************************************************************/