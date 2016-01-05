<div class="one-user-directory">

	<div id="avat_<?php echo $D->f_codeuser?>" class="avatar">
    	<a href="<?php echo $C->SITE_URL.$D->f_username?>">
        	<img onmouseover="userCardGeneric(0, 'avat_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->f_avatar)?'default.jpg':$D->f_avatar); ?>" class="rounded">            
			<?php if ($D->isThisUserVerified) { ?>
            <div style="position:absolute; left:0px; top:0px;">
            	<img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png">
            </div>
            <?php } ?>       
		</a>
	</div>
    
	<div class="infomsg">
    
		<div class="username linkblue">
        	<span onmouseout="ignoreUserCard()" onmouseover="userCardGeneric(1, 'nameu_<?php echo $D->f_codeuser?>', '<?php echo $D->f_codeuser?>')" id="nameu_<?php echo $D->f_codeuser?>" class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->f_username?>"><?php echo $D->f_name?></a></span>    

        </div>
        
		<div class="txtmsg"><?php echo $D->f_numphotos==1?$this->lang('global_txt_directory_hasphoto', array('#NUM#'=>$D->f_numphotos)):$this->lang('global_txt_directory_hasphotos', array('#NUM#'=>$D->f_numphotos)); ?></div>
        
    </div>

</div>