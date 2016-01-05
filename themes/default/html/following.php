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
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_profile.js"></script>
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
                        
                        <div class="title"><?php echo $this->lang('profile_following_title'); ?></div>
                        
                           	<div class="spaceinfo">
                        
								<?php if ($D->numfollowing == 0) { ?>
                                
                                <div class="centered mrg20T mrg30B txtsize00"><?php echo $this->lang('profile_following_nofollowing'); ?></div>
                                
                                <?php } else { ?>
                                
                                <div><?php echo $D->htmlFollowing?></div>
                                
                                
                                
                                <?php if ($D->totalfollowing>$C->NUM_FOLLOWING_PAGE) { ?>
                                
                                <div id="moreitems"></div>
                                
                                <div><input name="numitems" type="hidden" id="numitems" value="<?php echo $D->numfollowing?>" /></div>
                                
                                <div id="moreitemsbar" class="mrg20T mrg10B">
                                    <div class="centered">
                                        <span id="bmore" class="bgrey2 rounded"><?php echo $this->lang('global_txt_moreitems')?></span>
                                        <span id="morepreload" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/preload.gif" /></span>
                                    </div>
                                </div>
                                <script>
                                    var idu = <?php echo $D->u->iduser ?>;
                                    var itemperpage = <?php echo $C->NUM_FOLLOWING_PAGE ?>;
                                    var txt_norequest = '<?php echo $this->lang('global_txt_no_request') ?>';
                                    $('#bmore').click(function(){
                                        reloadinfo('following')
                                        return false;
                                    });
                                </script>
                        
                                <?php } ?>
                            
                                <?php } ?>
                        
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