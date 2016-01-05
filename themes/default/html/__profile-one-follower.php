<div class="onefollower">
	<div id="avat_<?php echo $D->f_codeuser?>" class="avatar"><a href="<?php echo $C->SITE_URL.$D->f_username?>"><img onmouseover="userCardGeneric(0, 'avat_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->f_avatar)?'default.jpg':$D->f_avatar); ?>" class="rounded8"></a></div>
    <div class="info">
    	<div class="name">
        	<span onmouseout="ignoreUserCard()" onmouseover="userCardGeneric(1, 'nameu_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" id="nameu_<?php echo $D->f_codeuser?>" class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->f_username?>"><?php echo $D->f_name?></a></span>
			<?php if ($D->isThisUserVerified) { ?>
            <span><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png"></span>
            <?php } ?>        
        </div>
        <div class="moreinfo"><?php echo $D->f_numphotos==1?$this->lang('profile_followers_hasphoto', array('#NUM#'=>$D->f_numphotos)):$this->lang('profile_followers_hasphotos', array('#NUM#'=>$D->f_numphotos)); ?></div>
    </div>
    <div class="sh"></div>
	
</div>