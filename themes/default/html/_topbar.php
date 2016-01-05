<?php

if ($D->is_logged == 1) {
	$txtuser = '';
	if (empty($D->me->firstname)) $txtuser = $D->me->username;
	else $txtuser = $D->me->firstname;
	
	if (empty($D->me->avatar)) $txtavatar = 'default.jpg';
	else $txtavatar = $D->me->avatar;
}
?>
<script type="text/javascript" src="<?php $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_search.js"></script>
<div id="topbar-inside">
    <div id="area1" <?php echo ((isset($D->is_home)&&$D->is_home==TRUE)?'style="float:none"':'')?>>
    	<a href="<?php echo $C->SITE_URL?>">
        <div id="isotipo"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/isotipo.png" class="rounded3"></div>
        <div id="logo"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/logo.png"></div>
        </a>
        
        <div id="boxsearch" <?php echo ((isset($D->is_home)&&$D->is_home==TRUE)?'style="float:right"':'')?>><input name="topsearch" type="text" class="form-control" id="topsearch" placeholder="<?php echo $this->lang('global_txt_search');?>" title="<?php echo $this->lang('global_txt_search');?>"></div>
        <div class="sh"></div>
    </div>
    
    <?php if ($D->is_logged == 1) { ?>
    
    <div id="area2">
    	<div id="infouser">
        	
        	<a href="<?php echo $C->SITE_URL.$D->me->username;?>" title="<?php echo $this->lang('global_tmenu_opc_profile');?>">
            <img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.$txtavatar?>" id="imgavatar"/>
            <span id="txtusername"><?php echo "My Profile"?></span>
            </a>
            <div class="sh"></div>
        </div>

		<div id="txthometop"><a href="<?php echo $C->SITE_URL?>"><span><?php echo $this->lang('global_tmenu_opc_home')?></span></a></div>
        
        
    	<div id="icodashtop">
        	<div id="icohometop">
            <a href="<?php echo $C->SITE_URL;?>"><span class="icotop" title="<?php echo $this->lang('global_tmenu_opc_dashboard');?>">Logout</span></a>
            </div>
            
            <div>
            <span class="icotop hand" id="linkshownotmsg" title="<?php echo $this->lang('global_tmenu_opc_messages');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/iconotimessages.png" id="icomessages"><span class="box-notification-msg"><span class="notification-value-msg"></span></span></span>
            </div>
            
            <div>
            <span class="icotop hand" id="linkshownot" title="<?php echo $this->lang('global_tmenu_opc_notifications');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/iconotifications.png" id="iconotifications"><span class="box-notification"><span class="notification-value"></span></span></span>
            </div>
            
            <div>
            <a href="<?php echo $C->SITE_URL.'logout';?>"><span class="icotop" title="<?php echo $this->lang('global_tmenu_opc_logout');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icologout.png"></span></a>
            </div>
        </div>
    	<div class="sh"></div>
        
    </div>
    
   
    
    <div class="area-notification">
    	<div class="content-notification">
    		
            <div class="content-info"></div>
            <div class="areamore"><div class="morenotifications linkblue2"><a href="<?php echo $C->SITE_URL?>dashboard/mynotifications"><?php echo $this->lang('global_txt_allnotifications')?></a></div></div>
        </div>
    </div>
    
    <div class="area-notification-msg">
    	<div class="content-notification-msg">
    		
            <div class="content-info-msg"></div>
            <div class="areamore"><div class="morenotifications linkblue2"><a href="<?php echo $C->SITE_URL?>dashboard/mymessages"><?php echo $this->lang('global_txt_allmessages')?></a></div></div>
        </div>
    </div>

    
<script type="text/javascript" src="<?php $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_topbar.js"></script>
<script>
	//$("#topsearch").on('keyup', topSearch);
	
	var intervalcheckevents = <?php echo $C->INTERVAL_NOTIFICATIONS_EVENTS?>;
	checkNewNotifications();
	
	var intervalcheckmsg = <?php echo $C->INTERVAL_NOTIFICATIONS_MSGS?>;
	checkNewMessages();
    
</script>

    
    <?php } else { 
	
	if (isset($D->is_home)&&$D->is_home==TRUE) {}else{
	
	?>

    <div id="area2">

    	<div id="icodashtop">
            <a href="<?php echo $C->SITE_URL?>"><span class="icotop" title="<?php echo $this->lang('global_tmenu_opc_register');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icoregister.png"></span></a>
        </div>
    	<div class="sh"></div>
        
    </div>
 
    <?php
	}
	
	 } ?>

    <div class="sh"></div>
    
</div>



<div class="sh"></div>
<script>
	$("#topsearch").on('keyup', topSearch);
	
	$('#linkshownotmsg').click(function(e){
		e.stopPropagation();
		if (openNmessages == 0) showNotificationsMessages();
		else hideNotificationsMessages();
	});

	$('#linkshownot').click(function(e){
		e.stopPropagation();
		if (openNnotifications == 0) showNotifications();
		else hideNotifications();
	});

</script>