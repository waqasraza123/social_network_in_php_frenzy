<div class="oneuserchat">
	<div id="avat_<?php echo $D->f_codeuser?>" class="avatar"><a href="<?php echo $C->SITE_URL.$D->f_username?>/messages"><img onmouseover="userCardGeneric(0, 'avat_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->f_avatar)?'default.jpg':$D->f_avatar); ?>" class="rounded"></a></div>
    <div class="info">
    	<div class="name">
        	<span onmouseout="ignoreUserCard()" onmouseover="userCardGeneric(1, 'nameu_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" id="nameu_<?php echo $D->f_codeuser?>" class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->f_username?>/messages"><?php echo $D->f_name?></a></span>
			<?php if ($D->isThisUserVerified) { ?>
            <span><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/userverified.png"></span>
            <?php } ?>
        </div>
        <div class="moreinfo"><?php echo $D->f_lastmessage; ?></div>
        <div class="datewhen"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->f_date).'T'.date('H:i:s',$D->f_date).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->f_date);?></abbr></div>
    </div>
    <div class="sh"></div>
	
</div>