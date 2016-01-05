<div class="sh"></div><div class="sh"></div>
<div id="footsite">

    <div id="container" class="centered">
    
    	<?php if ($C->SHOW_MENU_PAGES) { ?>
    	<div><?php $this->load_template('__pagesmenu.php');?></div>

        <?php } ?>

    
    	<?php if ($C->SHOW_MENU_LANGUAJE) { ?>
    	<div><?php $this->load_template('__languagemenu.php');?></div>

        <?php } ?>

        
		<?php if ($D->i_am_network_admin) { ?>
        <div class="mrg10T mrg10B spacing01 linkgreyshadow"><a href="<?php echo $C->SITE_URL?>admin"><?php echo $this->lang('global_msg_menuadmin');?></a></div>
	
        <?php } ?>
        
        <div id="foot-right-i">&copy; <?php echo date('Y'); ?> - <?php echo $C->SITE_TITLE; ?></div>
        
        <div class="sh"></div>
        
    </div>


</div>

<script>	

	// When the window is focused
	$(window).focus(function() {
		// If the currentTitle has the (!) notification, then remove it
		if(document.title.indexOf('[!]') >= 0) {
			document.title = document.title.replace('[!] ', '');
		}
	});
</script>