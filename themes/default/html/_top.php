
	<div id="top-inside">
        <div id="top-inside-block">
            <div id="container">
            
				<?php
					if (isset($D->is_home)&&$D->is_home==TRUE) {
                		$this->load_template('_topbar-home.php');
					} else {
						$this->load_template('_topbar.php');			
					}
				?>
                  
            </div>
        
        </div>
    
    </div>
    <div id="search-container"></div>
    <div id="user-card"></div>
    
<script>
$(document).ready(function(){

	if ($(window).height()>=400) {
		barfixed = {
			'position':'fixed',
			'top':'0',
			'left':'0',
			'right':'0',
			'z-index':'300'	
		}
		$('#top-inside').css(barfixed);
	
		$('#search-container').css("position", "fixed");
		$('#search-container').css("top", $('#top-inside').height()-5 + "px");
		$('.area-notification-msg').css("position", "fixed");
		$('.area-notification-msg').css("top", $('#top-inside').height() + "px");
		$('.area-notification').css("position", "fixed");
		$('.area-notification').css("top", $('#top-inside').height() + "px");
	}
	
	$(window).resize(function(){
		
		<?php if (!(isset($D->is_home)&&$D->is_home==TRUE)) { ?>
		
		rightSearch = $('#boxsearch').position();
		$('#search-container').css('left',rightSearch.left);
		
		<?php } ?>
		
	})
	
	$('html').on('click', function(){

		<?php if (!(isset($D->is_home)&&$D->is_home==TRUE)) { ?>

		$('#search-container').hide();
		
		<?php if (isset($D->is_logged) && $D->is_logged == 1) { ?>

		if (openNmessages == 1) hideNotificationsMessages();
	
		if (openNnotifications == 1) hideNotifications();

		<?php } ?>

		<?php } ?>
		
	});
	
	$('#user-card').mouseleave(function() {
		$('#user-card').hide();
	});
		
});
</script>

<?php if (isset($D->is_logged) && $D->is_logged==1) { ?>

<div id="spacefoll">
	<div id="spacefoll01" class="hand">
        <img src="<?php echo $C->SITE_URL.'themes/'.$C->THEME.'/imgs/icofollbottom.png'?>">
        <span class="txtfollbot"><?php echo $this->lang('global_box_chat_txt_title')?> (<span id="numfo">0</span>)</span>
    </div>
    <div id="spacefoll02">
    	<div id="barfollow">
        	<div id="titlebar"><?php echo $this->lang('global_box_chat_txt_title_open')?></div>
        </div>
        <div id="contentf">
        	<div id="bfpreload" class="centered hide"><img src="<?php echo $C->SITE_URL.'themes/'.$C->THEME.'/imgs/preload.gif'?>"></div>
            <div id="itemsfollows" class="hide"></div>
        </div>
    	
        <div id="searchf">
        	<div id="contentinput">
        	<input type="text" id="inputsf" name="inputsf" autocomplete="off" placeholder="<?php echo $this->lang('global_box_chat_txt_search')?>">
            </div>
        </div>
    </div>
</div>
<script>
	var norequest = '<?php echo $this->lang('global_txt_no_request');?>';
	var boxfollowOpen = 0;	
</script>
<script type="text/javascript" src="<?php $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_following-online.js"></script>
<?php } ?>
