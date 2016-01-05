function emailvalidate(e)
{
	var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;
	return b.test(e);
}

/***********************************************************************/

function htmlEntities(str)
{
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

/***********************************************************************/

function validatedate(a) {
 strExpReg = /^(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])(\d{4}))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))$/;
 return strExpReg.test(a);
}

/***********************************************************************/

function maxLong(txt, maxlong, divtxtcount)
{
	var in_value, out_value; 
	if (txt.value.length > maxlong) {
		in_value = txt.value; 
		out_value = in_value.substring(0, maxlong); 
		txt.value = out_value;
		missingletters = maxlong - txt.value.length;
		$('#' + divtxtcount).html(missingletters);	
		return false; 
	} 
	missingletters = maxlong - txt.value.length;
	$('#' + divtxtcount).html(missingletters);  
	return true; 
}

/***********************************************************************/

function opendiv(thediv,message)
{
	$(thediv).html(message);
	$(thediv).slideDown("slow");
}

/***********************************************************************/

var divactive='';
function openandclose(thediv,message,thetime)
{
	$(thediv).html(message);
	$(thediv).slideDown("slow", function(){
		divactive=thediv;
		delayactive=setTimeout(closediv,thetime);
	});	
}

/***********************************************************************/

function closediv()
{
	$(divactive).slideUp("slow", function(){
		clearTimeout(delayactive);
	});
}

/***********************************************************************/

function transformTextarea()
{
	$('body').on('keyup', 'textarea', function(){
		$(this).height(0);
		$(this).height(this.scrollHeight);
	});
}

/*************************************/

function insertEmoticon(areaText, stringEmo) {
	var item_dom = document.getElementsByName(areaText)[0];
	if (document.selection) {
		item_dom.focus();
		sel = document.selection.createRange();
		sel.text = ' ' + stringEmo + ' ';
		return;
	}
	
	if (item_dom.selectionStart || item_dom.selectionStart == "0") {
		var t_start = item_dom.selectionStart;
		var t_end = item_dom.selectionEnd;
		var val_start = item_dom.value.substring(0, t_start);
		var val_end = item_dom.value.substring(t_end, item_dom.value.length);
		item_dom.value = val_start + ' ' + stringEmo + ' ' + val_end;
	} else item_dom.value += ' ' + stringEmo + ' ';
	
	item_dom.focus(); 
}

/*************************************/

var delayCard, delayCard2;
function keepCardVisible() {
	clearInterval(delayCard2);
}

function ignoreUserCard() {
	
	clearInterval(delayCard);
	
	delayCard2 = setInterval(function() {
		$('#user-card').hide();
		clearInterval(delayCard2);	
	},700);
	
}

function userCard(posi, divitem, ucode) {

	clearInterval(delayCard2);
	delayCard = setInterval(function() {

		margintop = 10;
		
		heightAvat1 = 42;
		heightName1 = 17;
		heightAvat2 = 35;
		heightName2 = 14;
		
		topDiv = $('#' + divitem).offset().top;
		leftDiv = $('#' + divitem).offset().left;

		heightCard = 180;
		heightCardnoCover = 125;
	
		u = topDiv > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
		//uw = leftDiv > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
		
		if (u == 'n') {
	
			utopini = margintop + topDiv  + 10;

			if (posi == 0) { utopini = utopini + heightAvat1; }
			if (posi == 1) { utopini = utopini + heightName1; }
			if (posi == 2) { utopini = utopini + heightAvat2; }
			if (posi == 3) { utopini = utopini + heightName2; }
			
			utopCard = utopini;
			utopCardnoCover = utopini;
			
		} else {
			
			utopini = margintop + topDiv - 40;
			
			utopCard = utopini - heightCard;
			utopCardnoCover = utopini - heightCardnoCover;
			
		}
		
		if (posi == 0 || posi == 2) { leftDiv = leftDiv - 10; }
		if (posi == 1 || posi == 3) { leftDiv = leftDiv + 50; }

		if ($('#container').width()<=300) {
			if (posi == 0 || posi == 2) { leftDiv = leftDiv - 20; }
			if (posi == 1 || posi == 3) { leftDiv = leftDiv - 70; }
		} else if ($('#container').width()<=768) {
			//here actions		
		}
	
		$('#user-card').show();
		$('#user-card').html('<div class="prelod"><img src="' + siteurl + '/themes/' + sitetheme + '/imgs/preload.gif"></div>');
	
		var pos = {
			top: utopini + 'px',
			left: leftDiv + 'px'
		};
		
		$('#user-card').css(pos);
	
		$.ajax({
			type: 'POST',
			url: siteurl + 'ajax/user-card/r:' + Math.round(Math.random()*1000),
			data: 'c=' + ucode,
			success: function(resp){
				switch(resp.charAt(0)){
					case '0':
						$('#user-card').html(resp.substring(3));
						break;
					case '1':
						//with cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCard + 'px',
						$('#user-card').css('top',unewtop);
						break;
					case '2':
						// without cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCardnoCover + 'px',
						$('#user-card').css('top',unewtop);
						break;
				}
			},
			error: function(){
				$('#user-card').html(norequest);
			} //end error
		}); // end ajax	

		clearInterval(delayCard);

	}, 700);

}

/*************************************/

function userCardGeneric(posi, divitem, ucode) {

	clearInterval(delayCard2);
	delayCard = setInterval(function() {

		margintop = 10;
		
		heightAvat1 = 42;
		heightName1 = 17;
		heightAvat2 = 35;
		heightName2 = 14;
		
		topDiv = $('#' + divitem).offset().top;
		leftDiv = $('#' + divitem).offset().left;

		heightCard = 180;
		heightCardnoCover = 125;
	
		u = topDiv > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
		uw = leftDiv > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
		
		if (u == 'n') {
	
			utopini = margintop + topDiv  + 10;

			if (posi == 0) { utopini = utopini + heightAvat1; }
			if (posi == 1) { utopini = utopini + heightName1; }
			if (posi == 2) { utopini = utopini + heightAvat2; }
			if (posi == 3) { utopini = utopini + heightName2; }
			
			utopCard = utopini;
			utopCardnoCover = utopini;
			
		} else {
			
			utopini = margintop + topDiv - 40;
			
			utopCard = utopini - heightCard;
			utopCardnoCover = utopini - heightCardnoCover;
			
		}
		
		if (posi == 0 || posi == 2) { leftDiv = leftDiv/* - 10*/; }
		if (posi == 1 || posi == 3) { leftDiv = leftDiv/* + 50*/; }

		if ($('#container').width()<=300) {
			if (posi == 0 || posi == 2) { leftDiv = leftDiv - 20; }
			if (posi == 1 || posi == 3) { leftDiv = leftDiv - 70; }
		} else if ($('#container').width()<=768) {
			//here actions		
		}
	
		$('#user-card').show();
		$('#user-card').html('<div class="prelod"><img src="' + siteurl + '/themes/' + sitetheme + '/imgs/preload.gif"></div>');
	
		var pos = {
			top: utopini + 'px',
			left: leftDiv + 'px'
		};
		
		$('#user-card').css(pos);
	
		$.ajax({
			type: 'POST',
			url: siteurl + 'ajax/user-card/r:' + Math.round(Math.random()*1000),
			data: 'c=' + ucode,
			success: function(resp){
				switch(resp.charAt(0)){
					case '0':
						$('#user-card').html(resp.substring(3));
						break;
					case '1':
						//with cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCard + 'px',
						$('#user-card').css('top',unewtop);
						break;
					case '2':
						// without cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCardnoCover + 'px',
						$('#user-card').css('top',unewtop);
						break;
				}
			},
			error: function(){
				$('#user-card').html(norequest);
			} //end error
		}); // end ajax	

		clearInterval(delayCard);

	}, 700);

}

/*************************************/

function userCardLateral(posi, divitem, ucode) {

	clearInterval(delayCard2);
	delayCard = setInterval(function() {
		
		widthCard = 350;

		margintop = 10;
		
		heightAvat1 = 42;
		heightName1 = 17;
		heightAvat2 = 35;
		heightName2 = 14;
		
		topDiv = $('#' + divitem).offset().top;
		leftDiv = $('#' + divitem).offset().left;

		heightCard = 180;
		heightCardnoCover = 125;
	
		u = topDiv > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
		//uw = leftDiv > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
		
		if (u == 'n') {
	
			utopini = margintop + topDiv  + 10;

			if (posi == 0) { utopini = utopini + heightAvat1; }
			if (posi == 1) { utopini = utopini + heightName1; }
			if (posi == 2) { utopini = utopini + heightAvat2; }
			if (posi == 3) { utopini = utopini + heightName2; }
			
			utopCard = utopini;
			utopCardnoCover = utopini;
			
		} else {
			
			utopini = margintop + topDiv - 40;
			
			utopCard = utopini - heightCard;
			utopCardnoCover = utopini - heightCardnoCover;
			
		}
		
		if (posi == 0 || posi == 2) { leftDiv = leftDiv; }
		if (posi == 1 || posi == 3) { leftDiv = leftDiv; }

		if ($('#container').width()<=300) {
			if (posi == 0 || posi == 2) { leftDiv = leftDiv - 20; }
			if (posi == 1 || posi == 3) { leftDiv = leftDiv - 10; }
		} else if ($('#container').width()<=768) {
			//here actions		
		}
		
		if ($('#container').width()>=768) {
			utopini = topDiv;
			utopCard = topDiv;
			utopCardnoCover = topDiv;
			leftDiv = leftDiv - widthCard - 10;
			if (u == 's') {
				utopCard = topDiv - 100;
				utopCardnoCover = topDiv - 100;
			}
			if (u == 'n') {
				heightWindowsMiddle = $(window).height() / 2;
				
				if (heightWindowsMiddle < 210) {
					heightDisp = 210 - heightWindowsMiddle;
					utopCard = topDiv - heightDisp;
				}
			}
		} else {
			// other actions.
		}
	
		$('#user-card').show();
		$('#user-card').html('<div class="prelod"><img src="' + siteurl + '/themes/' + sitetheme + '/imgs/preload.gif"></div>');
	
		var pos = {
			top: utopini + 'px',
			left: leftDiv + 'px'
		};
		
		$('#user-card').css(pos);
	
		$.ajax({
			type: 'POST',
			url: siteurl + 'ajax/user-card/r:' + Math.round(Math.random()*1000),
			data: 'c=' + ucode,
			success: function(resp){
				switch(resp.charAt(0)){
					case '0':
						$('#user-card').html(resp.substring(3));
						break;
					case '1':
						//with cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCard + 'px',
						$('#user-card').css('top',unewtop);
						break;
					case '2':
						// without cover
						$('#user-card').html(resp.substring(3));
						unewtop = utopCardnoCover + 'px',
						$('#user-card').css('top',unewtop);
						break;
				}
			},
			error: function(){
				$('#user-card').html(norequest);
			} //end error
		}); // end ajax	

		clearInterval(delayCard);

	}, 700);

}

/*************************************/

var timerCheckFO;
function checkFollowingOnline() {
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/check-following-online/r:" + Math.round(Math.random()*1000),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					break;
				case '1':
					$('#numfo').html(resp.substring(3));
					break;
			};
				
			timerCheckFO = setTimeout(checkFollowingOnline, 10000);
				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
}

/*************************************/

var timerCheckFO2;
function checkFollowingOnline2() {
	$.ajax({
		type: 'POST',
		url: siteurl + "ajax/load-followchat/r:" + Math.round(Math.random()*1000),
		success: function(resp){
			switch(resp.charAt(0)){
				case '0':
					$('#bfpreload').hide();
					$('#itemsfollows').html(resp.substring(3));
					$('#itemsfollows').show();
				case '1':
					$('#bfpreload').hide();
					$('#itemsfollows').html(resp.substring(3));
					$('#itemsfollows').show();
					break;
			};
				
			timerCheckFO2 = setTimeout(checkFollowingOnline2, 10000);
				
		},
		error: function(){
			//alert(msg_norequest);
		} //end error
	}); // end ajax	
}

/*************************************/

function searchUserBox(){
	
	clearInterval(timerCheckFO2);
	
	var query = $('#inputsf').val();

	// If no letters remove the div not helpful
	if (query == '') {
		checkFollowingOnline2();
		var milliseconds = 0;
	} else {
		clearInterval(timerCheckFO2);
		$('#bfpreload').show();
		var milliseconds = 250;
	}
	
	// It took us a few milliseconds so that more letters are entered to the consultation
	setTimeout(function() {
		if(query == $('#inputsf').val()) {
			if($.trim(query) == '') {
				//checkFollowingOnline2();
			} else {
				$.ajax({
					type: 'POST',
					url: siteurl + "ajax/search-userchat/r:" + Math.round(Math.random()*1000),
					data: 'q=' + query,
					success: function(resp) {
						$('#bfpreload').hide();
						$('#itemsfollows').html(resp.substring(3));
						$('#itemsfollows').show();
					},
					error: function(){
						//alert('Error'); 
					} //end error
				}); // end ajax
			}
		}
	}, milliseconds);
	
}

/*************************************/

/*===========================================================*/
/*	Preloader 
/*===========================================================*/	

//<![CDATA[
	$(window).load(function() { // makes sure the whole site is loaded
		$("#status").fadeOut(); // will first fade out the loading animation
		$("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
	})
//]]>

$("[id*=iloader]").html('<img class="hide" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload_small.gif">');