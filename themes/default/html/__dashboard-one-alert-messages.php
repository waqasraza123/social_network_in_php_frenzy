<div class="one-alert-msg-container">
	<div class="avatar"><a href="<?php echo $C->SITE_URL.$D->username?>/messages"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->avatar)?'default.jpg':$D->avatar); ?>" class="rounded"></a></div>
	<div class="infomsg">
		<div class="username linkblue"><a href="<?php echo $C->SITE_URL.$D->username?>/messages"><?php echo $D->uname?></a></div>
		<div class="txtmsg"><?php echo $D->message?></div>
		<div class="dateago"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->dateago).'T'.date('H:i:s',$D->dateago).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->dateago);?></abbr></div>        
    </div>

</div>