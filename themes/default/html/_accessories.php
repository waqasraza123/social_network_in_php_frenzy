<div id="profile03">

	<?php if (!empty($D->useraccesories)) {?>

	<div id="spaceUserAccesories">

        <div>
        
            <div class="uatitle"><?php echo $this->lang('profile_more_users'); ?></div>
            
            <div id="useraccesories"><?php echo $D->useraccesories?></div>
            <div class="linkblue linkmore"><a href="<?php echo $C->SITE_URL?>directory/people"><?php echo $this->lang('profile_more_users_linkviewmore')?></a></div>            
    
        </div>

	</div>
    
    <?php }?>
    
	<?php if (!empty($D->adsProfile1)) { ?>
	<div class="mrg20B centered">
		<span><?php echo stripslashes($D->adsProfile1) ?></span>
    </div>
    <?php } ?>

	<?php if (!empty($D->adsProfile2)) { ?>
	<div class="mrg20B centered">
		<span><?php echo stripslashes($D->adsProfile2) ?></span>
    </div>
    <?php } ?>

</div>