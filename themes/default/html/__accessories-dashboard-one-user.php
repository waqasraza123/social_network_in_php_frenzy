<div class="one-user-accesories">
	<div id="avat_lat_<?php echo $D->accd_codeuser?>" class="avatar"><a href="<?php echo $C->SITE_URL.$D->accd_username?>"><img onmouseover="userCardLateral(0, 'avat_lat_<?php echo $D->accd_codeuser?>', '<?php echo $D->accd_codeuser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->accd_avatar)?'default.jpg':$D->accd_avatar); ?>" class="rounded"></a></div>
	<div class="infomsg">
    
		<div class="username linkblue">
        	<spann onmouseout="ignoreUserCard()" onmouseover="userCardLateral(1, 'nameu_lat_<?php echo $D->accd_codeuser?>', '<?php echo $D->accd_codeuser?>')" id="nameu_lat_<?php echo $D->accd_codeuser?>" class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->accd_username?>"><?php echo $D->accd_name?></a></span>           
        </div>
        
		<div class="txtmsg"><?php echo $D->accd_numphotos==1?$this->lang('dashboard_more_users_hasphoto', array('#NUM#'=>$D->accd_numphotos)):$this->lang('dashboard_more_users_hasphotos', array('#NUM#'=>$D->accd_numphotos)); ?></div>
        
    </div>

</div>