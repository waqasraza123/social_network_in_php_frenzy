	$('#spacefoll01').click(function(e){
		clearInterval(timerCheckFO);
		e.stopPropagation();
		$('#spacefoll01').css('display','none');
		$('#spacefoll02').show();
		$('#bfpreload').show();
		boxfollowOpen = 1;
		$('#inputsf').focus();
		
		checkFollowingOnline2();
		
	});

	$('#barfollow').click(function(e){
		clearInterval(timerCheckFO2);
		e.stopPropagation();
		$('#spacefoll02').css('display','none');
		$('#spacefoll01').show();
		boxfollowOpen = 0;
		$('#inputsf').val('');
		$('#itemsfollows').val('');
		checkFollowingOnline();		
	});
	
	$('#inputsf').click(function(e){
		e.stopPropagation();
	});
	
	$('html').on('click', function(){
		if (boxfollowOpen==1) {
			$('#spacefoll02').css('display','none');
			$('#spacefoll01').show();
			boxfollowOpen = 0;
			$('#inputsf').val('');
			$('#itemsfollows').val('');
			clearInterval(timerCheckFO2);
			checkFollowingOnline();
		}
	});
	
	$("#inputsf").on('keyup', searchUserBox);
	
	checkFollowingOnline();