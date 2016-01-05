<div id="activity_<?php echo $D->codepost?>" class="oneactivity">
	<div class="oaheader">
    	<div class="avatar"><a href="<?php echo $C->SITE_URL.$D->u->username?>"><img onmouseover="userCard(0, 'activity_<?php echo $D->codepost?>', '<?php echo $D->codeUser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->u->avatar)?$C->AVATAR_DEFAULT:$D->u->avatar)?>" class="rounded"></a></div>
        <div class="info">
        	<div class="iuser"><span class="linkblue2"onmouseout="ignoreUserCard()" onmouseover="userCard(1, 'activity_<?php echo $D->codepost?>', '<?php echo $D->codeUser?>')"><a href="<?php echo $C->SITE_URL.$D->u->username?>"><?php echo $D->nameUser?></a></span></div>
        	<div class="idate"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->f_date).'T'.date('H:i:s',$D->f_date).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->f_date);?></abbr></div>
        </div>
        <div class="sh"></div>	
    </div>
    
	<div class="oabody">
    	<div class="space01"><?php echo $D->txtaction?></div>
    	<div class="space02">
        	<span class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->f_username?>"><?php echo $D->f_name?></a></span>
        </div>
    	<div class="space03"><a href="<?php echo $C->SITE_URL.$D->f_username?>"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min1/'.(empty($D->f_avatar)?$C->AVATAR_DEFAULT:$D->f_avatar)?>" class="rounded"></a></div>
    	<div class="space04 mrg10B"><span class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->f_username?>/photos"><?php echo ($D->f_numphotos==1?$this->lang('profile_activities_hasphoto', array('#NUM#'=>$D->f_numphotos)):$this->lang('profile_activities_hasphotos', array('#NUM#'=>$D->f_numphotos)))?></a></span></div>
    </div>
</div>