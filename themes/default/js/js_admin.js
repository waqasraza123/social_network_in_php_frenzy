function validateUsername(username)
{
	if (username == '') return false;
	if (username.lenght < 6 && username.lenght > 15) return false;
	
	pattern = /^[A-Za-z0-9][A-Za-z0-9_]{5,14}$/; //Allow only lowercase letters, digits and the underscore (except in the first position). With a minimum of 6 characters (1+5), and a maximum of 15 (1+14).
	if (username.match(pattern)) return true;
	return false;
}

/**********************************************************************/

function updateAdsBasic(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	adsbasic1=$.trim($('#adsbasic1').val());

	adsbasic2=$.trim($('#adsbasic2').val());
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-adsbasic/r:' + Math.round(Math.random()*1000),
		data: 'todo=1&adsb1=' + encodeURIComponent(adsbasic1) + '&adsb2=' + encodeURIComponent(adsbasic2),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updateLanguage(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	language=$.trim($('#language').val());
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-language/r:' + Math.round(Math.random()*1000),
		data: 'l=' + language,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/

function updateTheme(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	theme=$.trim($('#theme').val());
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-theme/r:' + Math.round(Math.random()*1000),
		data: 't=' + theme,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/

function updateStatus(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	mstatus = $('#mstatus').val();
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
		data: 'todo=1&st=' + mstatus + '&uid=' + uidd,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/


function updateValidated(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	mvalidated = $('#mvalidated').val();
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
		data: 'todo=4&mv=' + mvalidated + '&uid=' + uidd,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/


function updateInfoUser(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');
	
	uemail = $.trim($('#uemail').val());
	if (!emailvalidate(uemail)) {
		openandclose(diverror,uinfo_msg01,1700);		
		$('#uemail').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000); 
		return;
	}
	
	uusername = $.trim($('#uusername').val());
	if (!validateUsername(uusername)) {
		openandclose(diverror,uinfo_msg02,1700);		
		$('#uusername').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000); 
		return;
	}

	ufirstname = $.trim($('#ufirstname').val());
	/*if (ufirstname == '') {
		$('#ufirstname').val(ufirstname);
		openandclose(diverror,uinfo_msg03,1700);
		$('#ufirstname').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
		return;
	}*/

	ulastname = $.trim($('#ulastname').val());
	/*if (ulastname == '') {
		$('#ulastname').val(ulastname);
		openandclose(diverror,uinfo_msg04,1700);
		$('#ulastname').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
		return;
	}
	*/
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
		data: 'todo=5&ue=' + uemail + '&uid=' + uidd + '&uu=' + uusername + '&ufn=' + encodeURIComponent(ufirstname) + '&uln=' + encodeURIComponent(ulastname),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/

function updatePass(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	npassw = $('#npassw').val();
	if (npassw == '') {
		openandclose(diverror,pass_msg1,1700);
		$('#npassw').focus();
		setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2000);
		return;
	}
	
	npassw2 = $('#npassw2').val();
	if (npassw2 == '') {
		openandclose(diverror,pass_msg2,1700);
		$('#npassw2').focus();
		setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2000);
		return;
	}
	
	if (npassw != npassw2) {
		openandclose(diverror,pass_msg3,1700);
		$('#npassw2').focus();
		setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2000);
		return;
	}

	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
		data: 'todo=6&np=' + CryptoJS.MD5(npassw) + '&uid=' + uidd,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					$('#npassw').val('');
					$('#npassw2').val('');
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 					
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/


function updateLevel(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	level=$('#level').val();
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
		data: 'todo=2&lv=' + level + '&uid=' + uidd,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax		
}

/**********************************************************************/

function deleteUser(diverror,divok,bsubmit)
{
	
	if (confirm(msgalert)) {	
	
		$(bsubmit).attr('disabled','true');
		
		$.ajax({
			type: 'POST',
			url: siteurl + 'ajax/admin-details/r:' + Math.round(Math.random()*1000),
			data: 'todo=3&uid=' + uidd,
			success: function(resp){
				switch(resp.charAt(0)){
					case '0':
						openandclose(diverror,resp.substring(3),2000);
						setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
						break;
					case '1':
						self.location = siteurl + 'admin/users';
						break;
				}
			},
			error: function(){
				openandclose(diverror,admin_norequest,2000);
				setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
			} //end error
		}); // end ajax		
		
	}
}

/**********************************************************************/

function updateGeneral(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');
	
	titlesite=$.trim($('#titlesite').val());
	if (titlesite == '') {
		$('#titlesite').val(titlesite);
		openandclose(diverror,txt_error1,1700);
		$('#titlesite').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
		return;
	}
	
	descsite=$.trim($('#descsite').val());
	if (descsite == '') {
		$('#descsite').val(descsite);
		openandclose(diverror,txt_error2,1700);
		$('#descsite').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
		return;
	}
	
	keywsite=$.trim($('#keywsite').val());
	if (keywsite == '') {
		$('#keywsite').val(keywsite);
		openandclose(diverror,txt_error3,1700);
		$('#keywsite').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
		return;
	}

	protected = $('#protected').val();

	language = $('#language').val();
	
	spages = $('#spages').val();
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-general/r:' + Math.round(Math.random()*1000),
		data: 'todo=1&ts=' + encodeURIComponent(titlesite) + '&ds=' + encodeURIComponent(descsite) + '&ks=' + encodeURIComponent(keywsite) + '&prt=' + protected + '&lng=' + language + '&spg=' + spages,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updateUserNotficactions(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	notievents = $('#notievents').val();
	notieventsinterval = $('#notieventsinterval').val();

	notimsg = $('#notimsg').val();
	notieventsintervalmsg = $('#notieventsintervalmsg').val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-general/r:' + Math.round(Math.random()*1000),
		data: 'todo=2&ne=' + notievents + '&ine=' + notieventsinterval + '&nm=' + notimsg + '&inm=' + notieventsintervalmsg,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updateUserChats(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	numchatstart = $('#numchatstart').val();
	intervalmsgchat = $('#intervalmsgchat').val();
	chatemoticons = $('#chatemoticons').val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-general/r:' + Math.round(Math.random()*1000),
		data: 'todo=3&ncs=' + numchatstart + '&imc=' + intervalmsgchat + '&ce=' + chatemoticons,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updatePosts(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	numphotospost = $('#numphotospost').val();
	numcommentsperpost = $('#numcommentsperpost').val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-general/r:' + Math.round(Math.random()*1000),
		data: 'todo=5&npp=' + numphotospost + '&ncpp=' + numcommentsperpost,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updateShowItems(diverror,divok,bsubmit)
{
	$(bsubmit).attr('disabled','true');

	numactivities = $('#numactivities').val();
	numfollowers = $('#numfollowers').val();
	numfollowing = $('#numfollowing').val();
	numnotifications = $('#numnotifications').val();
	numitemmsg = $('#numitemmsg').val();
	numfavorites = $('#numfavorites').val();
	numsearch = $('#numsearch').val();
	numcomments = $('#numcomments').val();

	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-general/r:' + Math.round(Math.random()*1000),
		data: 'todo=4&na=' + numactivities + '&nfs=' + numfollowers + '&nfg=' + numfollowing + '&nn=' + numnotifications + '&nim=' + numitemmsg + '&nf=' + numfavorites + '&ns=' + numsearch + '&nc=' + numcomments,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}

/**********************************************************************/

function updatePages(diverror, divok, bsubmit, page)
{
	$(bsubmit).attr('disabled','true');
	
	if (page == 1) {
		txtabout=$.trim($('#txtabout').val());
		if (txtabout == '') {
			$('#txtabout').val(txtabout);
			openandclose(diverror,admin_txt_error,1700);
			$('#txtabout').focus();
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
			return;
		}
		txtdata = '&txtpage=' + encodeURIComponent(txtabout);
	}

	if (page == 2) {
		txtprivacy=$.trim($('#txtprivacy').val());
		if (txtprivacy == '') {
			$('#txtprivacy').val(txtprivacy);
			openandclose(diverror,admin_txt_error,1700);
			$('#txtprivacy').focus();
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
			return;
		}
		txtdata = '&txtpage=' + encodeURIComponent(txtprivacy);
	}
	
	if (page == 3) {
		txttermsofuse=$.trim($('#txttermsofuse').val());
		if (txttermsofuse == '') {
			$('#txttermsofuse').val(txttermsofuse);
			openandclose(diverror,admin_txt_error,1700);
			$('#txttermsofuse').focus();
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
			return;
		}
		txtdata = '&txtpage=' + encodeURIComponent(txttermsofuse);
	}
	
	if (page == 4) {
		txtdisclaimer=$.trim($('#txtdisclaimer').val());
		if (txtdisclaimer == '') {
			$('#txtdisclaimer').val(txtdisclaimer);
			openandclose(diverror,admin_txt_error,1700);
			$('#txtdisclaimer').focus();
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
			return;
		}
		txtdata = '&txtpage=' + encodeURIComponent(txtdisclaimer);
	}
	
	if (page == 5) {
		txtcontact=$.trim($('#txtcontact').val());
		if (txtcontact == '') {
			$('#txtcontact').val(txtcontact);
			openandclose(diverror,admin_txt_error,1700);
			$('#txtcontact').focus();
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2000);
			return;
		}
		txtdata = '&txtpage=' + encodeURIComponent(txtcontact);
	}
	
	
	$.ajax({
		type: 'POST',
		url: siteurl + 'ajax/admin-pages/r:' + Math.round(Math.random()*1000),
		data: 'todo=' + page + txtdata,
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					openandclose(diverror,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
				case '1':
					openandclose(divok,resp.substring(3),2000);
					setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
					break;
			}
		},
		error: function(){
			openandclose(diverror,admin_norequest,2000);
			setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 3000); 
		} //end error
	}); // end ajax	
	
}
