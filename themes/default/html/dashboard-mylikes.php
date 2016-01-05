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
<div id="generalspace">
        
    <div id="container">
    
    	<div id="column1"><?php $this->load_template('_verticalmenu-dashboard.php'); ?></div>
        
        <div id="column2">
		
			<div id="dashboard2">
            
            	<div id="mylikes">
                    
                    <?php if ($D->numitems == 0) { ?>
                    
                    <div class="boxdash">
                    
                        <div class="title"><?php echo $this->lang('dashboard_mylikes_title'); ?></div>
                        
                        <div class="spaceinfo">
                        
                        	<div class="mrg20T txtsize00 centered mrg30B"><?php echo $this->lang('dashboard_mylikes_nolikes'); ?></div>
                            
                        </div>
                    
                    </div>
                    
                    <?php } else { ?>
                    
                    <div class="title spaceWhite"><?php echo $this->lang('dashboard_mylikes_title'); ?></div>
                    
                    <div class="mrg20T"><?php echo $D->htmlLikes?></div>
                    
                    <?php if ($D->totallikes>$C->NUM_FAVORITES_PAGE) { ?>
                    
                    <div id="moreitems"></div>
                    
                    <div class="sh"></div>
                    
                    <div><input name="numitems" type="hidden" id="numitems" value="<?php echo $D->numitems?>" /></div>
                    
                    <div id="moreitemsbar" class="mrg30T mrg10B">
                        <div class="centered">
                            <span id="bmore" class="bwhite rounded"><?php echo $this->lang('global_txt_morestories')?></span>
                            <span id="morepreload" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/preload.gif" /></span>
                        </div>
                    </div>
                    <script>
                        var idu = <?php echo $this->user->id ?>;
                        var itemperpage = <?php echo $C->NUM_FAVORITES_PAGE ?>;
                        var txt_norequest = '<?php echo $this->lang('global_txt_no_request') ?>';
                        $('#bmore').click(function(){
                            reloadinfo('likes')
                            return false;
                        });
                    </script>
            
                    <?php } ?>
                    
                    
                
                    <?php } ?>
                    
                </div>

            </div>
        
        
        </div>
        
        <div id="divseparator" class="sh"></div>
        
        <div id="column3"><?php $this->load_template('_accessories-dashboard.php'); ?></div>
        
        <div class="sh"></div>
    
    </div>
            
</div>    

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>