
<div id="footsite-home">
	<div id="container" class="centered">
		<div id="foot-home-in">
    		<div class="mrg10T mrg10B">
				
                <span class="linkwhite txtshadow pdn10R"><a href="<?php echo $C->SITE_URL?>directory/people"><?php echo($this->lang('global_pagesmenu_opc_people'))?></a></span>
            
				<?php if ($C->SHOW_MENU_PAGES) { ?>
                <?php $this->load_template('__pagesmenu-home.php');?>
                
                <?php } ?>
            
                <?php if ($C->SHOW_MENU_LANGUAJE) { ?>
                <?php $this->load_template('__languagemenu-home.php');?>
                
                <?php } ?>
            </div>
    
            <div id="foot-right" class="mrg10T">&copy; <?php echo date('Y'); ?> - <?php echo $C->SITE_TITLE; ?></div>
            
            <div class="sh"></div>

    	</div>
	</div>
</div>
<?php if (isset($D->msg_alert) && !empty($D->msg_alert)) {?>
<script>
	alert('<?php echo $D->msg_alert?>')
</script>
<?php } ?>