<div class="one-user-accesories">
	<div id="avat_lat_<?php echo $D->acc_codeuser?>" class="avatar"><a href="<?php echo $C->SITE_URL.$D->acc_username?>"><img onmouseover="userCardLateral(0, 'avat_lat_<?php echo $D->acc_codeuser?>', '<?php echo $D->acc_codeuser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->acc_avatar)?'default.jpg':$D->acc_avatar); ?>" class="rounded"></a></div>
	<div class="infomsg">
    
		<div class="username linkblue">
        	<span onmouseout="ignoreUserCard()" onmouseover="userCardLateral(1, 'nameu_lat_<?php echo $D->acc_codeuser?>', '<?php echo $D->acc_codeuser?>')" id="nameu_lat_<?php echo $D->acc_codeuser?>" class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->acc_username?>"><?php echo $D->acc_name?></a></span>           
        </div>
        
		<div class="txtmsg"><?php echo $D->acc_numphotos==1?$this->lang('profile_more_users_hasphoto', array('#NUM#'=>$D->acc_numphotos)):$this->lang('profile_more_users_hasphotos', array('#NUM#'=>$D->acc_numphotos)); ?></div>
        
    </div>

</div>