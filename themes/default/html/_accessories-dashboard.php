<div id="dashboard3">
    
	<?php if (!empty($D->useraccesories)) {?>

	<div id="spaceUserAccesories">

        <div>
        
            <div class="uatitle"><?php echo $this->lang('dashboard_more_users'); ?></div>
            
            <div id="useraccesories"><?php echo $D->useraccesories?></div>
            <div class="linkblue linkmore"><a href="<?php echo $C->SITE_URL?>directory/people"><?php echo $this->lang('dashboard_more_users_linkviewmore')?></a></div>            
    
        </div>

	</div>
    
    <?php }?>
    
    
	<?php if (!empty($D->adsDashboard1)) { ?>
	<div class="mrg20B centered">
		<span><?php echo stripslashes($D->adsDashboard1) ?></span>
    </div>
    <?php } ?>

	<?php if (!empty($D->adsDashboard2)) { ?>
	<div class="mrg20B centered">
		<span><?php echo stripslashes($D->adsDashboard2) ?></span>
    </div>
    <?php } ?>

</div>