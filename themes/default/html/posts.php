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
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_dashboard.js"></script>
<script type="text/javascript" src="<?php echo $C->SITE_URL; ?>themes/<?php echo $C->THEME ?>/js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_profile.js"></script>
<div id="generalspace">
        
    <div id="container">
    
        <div style="position:relative; float:left;">
        
        	<div><?php //$this->load_template('_header-profile.php'); ?></div>

			<div>        
            
                <div id="column1"><?php $this->load_template('_card-in-post.php'); ?></div>
                
                <div id="column2" class="mrg0Ti mrg5Ti">
                
                <?php
                
                if ($D->show_profile == 0) {
                    $this->load_template('_profile-no-show.php');
                } else {
                                
                ?>            
                
                    <div id="profile2"> 
                    	
                        <!--<div class="title"><?php echo $this->lang('profile_posts_title'); ?></div>-->
                        
                        <?php if (!empty($D->htmlResult)) { ?>
                        
                        <div><?php echo $D->htmlResult; ?></div>
        
                        <?php } ?>
        
                    
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