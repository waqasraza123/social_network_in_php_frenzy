<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>
<script>
var txtloading = '<?php echo $this->lang('global_txtloading'); ?>';
var txtclose = '<?php echo $this->lang('global_txtclose'); ?>';
var txtnext = '<?php echo $this->lang('global_txt_next'); ?>';
var txtprevious = '<?php echo $this->lang('global_txt_prev'); ?>';
var txtof = '<?php echo $this->lang('global_txt_of'); ?>';
var txtloading = '<?php echo $this->lang('global_txtloading'); ?>';
var msgnocomment = '<?php echo $this->lang('global_msg_txtwithoutcomment');?>';
var txt_norequest = '<?php echo $this->lang('global_txt_no_request') ?>';
</script>
<script type="text/javascript" src="<?php echo $C->SITE_URL; ?>themes/<?php echo $C->THEME ?>/js/jquery.magnific-popup.js"></script>
<div id="generalspace">
        
    <div id="container">
    
        <div style="position:relative; float:left;">
        
        	<div><?php $this->load_template('_header-profile.php'); ?></div>

			<div>
    
                <div id="column1"><?php $this->load_template('_verticalmenu.php'); ?></div>
                
                <div id="column2">
                <?php
                
                if ($D->show_profile == 0) {
                    $this->load_template('_profile-no-show.php');
                } else {
                                
                ?>            
                
                    <div id="profile2">
                    
                    	<div class="boxprof">
                        
                            <div class="title"><?php echo $this->lang('profile_userinfo_title'); ?></div>
                            
                            <div class="spaceinfo">
                            
                                <div class="subtitle"><?php echo $this->lang('profile_userinfo_subtitle1'); ?></div>
                                <div class="mrg10T"><?php echo $D->aboutme?></div>
                
                                <div class="subtitle mrg20T"><?php echo $this->lang('profile_userinfo_subtitle2'); ?></div>
                                <div class="mrg10T"><?php echo $D->gender; ?></div>
                
                                <div class="subtitle mrg20T"><?php echo $this->lang('profile_userinfo_subtitle3'); ?></div>
                                <div class="mrg10T"><?php echo $D->birth; ?></div>
                
                                <div class="subtitle mrg20T"><?php echo $this->lang('profile_userinfo_subtitle4'); ?></div>
                                <div class="mrg10T"><?php echo $D->location; ?></div>

							</div>

						</div>                    
                    
                    </div>
                    
                <?php } ?>
                </div>
        
        	</div>
            
        </div>
        
        <div id="divseparator" class="sh"></div>
        
        <div id="column3"><?php $this->load_template('_accessories.php'); ?></div>
        
        <div class="sh"></div>
    
    </div>
            
</div>

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>