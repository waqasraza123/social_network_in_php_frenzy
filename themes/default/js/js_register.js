function validateUsername(username)
{
	if (username == '') return false;
	if (username.lenght < 6 && username.lenght > 15) return false;
	
	pattern = /^[A-Za-z0-9][A-Za-z0-9_]{5,14}$/; //Allow only lowercase letters, digits and the underscore (except in the first position). With a minimum of 6 characters (1+5), and a maximum of 15 (1+14).
	if (username.match(pattern)) return true;
	return false;
}

/*************************************************/

function actionRegister(btregister, diverror, divcurrent, divok)
{
	$(btregister).attr('disabled','true');

	email = $.trim($('#email').val());
	if (!emailvalidate(email)) {
		openandclose(diverror,rtxterror1,1700);		
		$('#email').focus();
		setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		return;
	}

	usernamer = $.trim($('#usernamer').val());
	if (!validateUsername(usernamer)) {
		openandclose(diverror,rtxterror2,1700);		
		$('#usernamer').focus();
		setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		return;
	}
	
	passwordr=$('#passwordr').val();
	if (passwordr == '') {
		openandclose(diverror,rtxterror3,1700);		
		$('#passwordr').focus();
		setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		return;
	}
	
	if (passwordr.length < 6 || passwordr.length > 15) {
		openandclose(diverror,rtxterror4,1700);
		$(passwordr).focus();
		setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		return;
	}
	
	captcha=$('#captcha').val();
	if (captcha == '') {
		openandclose(diverror,rtxterror5,1700);		
		$('#captcha').focus();
		setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		return;
	}
	
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/register/r:" + Math.round(Math.random()*1000),
		data: 'em=' + email + '&un=' + usernamer + '&pw=' + CryptoJS.MD5(passwordr) + '&cpt=' + captcha,
		success: function(resp) {
			switch (resp.charAt(0)) {
				case '0':
					openandclose(diverror,resp.substring(3),1700)
					setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000);
					break;
				case '1':
					location.href = siteurl + "dashboard";
					break;
			}
		},
		error: function() {
			openandclose(diverror,txtconnerror,1700)
			setTimeout(function() {$(btregister).removeAttr('disabled');}, 2000); 
		} //end error

	}); // end ajax	
}