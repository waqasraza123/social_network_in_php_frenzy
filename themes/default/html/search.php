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
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_search-tag.js"></script>
<div id="generalspace">
        
    <div id="container">

    	<div id="column1">
        
			<div class="spaceWhite">
            
                <div id="liststrends">
                    <div class="ellipsis txtsize01 bold mrg10B centered"><?php echo $this->lang('global_txt_title-trending')?></div>
                    <?php if (!empty($D->trendsTopic)) {?>
                        <?php echo $D->trendsTopic;?>
                    <?php } else { ?>
                    <div class="mrg20T"><?php echo $this->lang('global_txt_notrending')?></div>
                    <?php } ?>
                </div>
                
            </div>
            
        </div>
        
        <div id="column2">
        
        	<div id="profile2">
            
                    
				<?php if ($D->errorsearch == 1) { ?>

                <div class="boxprof">
            
                    <div class="title"><?php echo $this->lang('global_txt_hashtag'); ?> <span class="bold">#<?php echo $D->query?></span></div>

                    <div class="spaceinfo">
                        
                        <div class="msgerrorSearchT"><?php echo $D->msgerror ?></div>
                        
                    </div>
                </div>
                
                <?php } else { ?>
                
    
                <?php if (empty($D->htmlResult)) {?>

                <div class="boxprof">
            
                    <div class="title"><?php echo $this->lang('global_txt_hashtag'); ?> <span class="bold">#<?php echo $D->query?></span></div>

                    <div class="spaceinfo">
                        
                        <div class="msgerrorSearchT"><?php echo $this->lang('global_search_noresult'); ?></div>
                        
                    </div>
                </div>
                
                <?php } else { ?>
                
                	<div class="spaceWhite centered">
                    	<div class="title"><?php echo $this->lang('global_txt_hashtag'); ?> <span class="bold">#<?php echo $D->query?></span></div>
    				</div>
                    
                    <div><?php echo $D->htmlResult; ?></div>
                    
                    
                    <?php if ($D->totalactivities > $C->NUM_ACTIVITIES_PAGE) { ?>
                    
                    <div id="moreitems"></div>
                    
                    <div><input name="numitems" type="hidden" id="numitems" value="<?php echo $D->numactivities?>" /></div>
                    
                    <div id="moreitemsbar" class="mrg30T mrg10B">
                        <div class="centered">
                            <span id="bmore" class="bwhite rounded"><?php echo $this->lang('global_txt_morestories')?></span>
                            <span id="morepreload" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/preload.gif" /></span>
                        </div>
                    </div>
                    <script>
                        var itemperpage = <?php echo $C->NUM_ACTIVITIES_PAGE ?>;
                        var txt_norequest = '<?php echo $this->lang('global_txt_no_request') ?>';
                        $('#bmore').click(function(){
                            reloadinfo_search('<?php echo $D->query?>');
                            return false;
                        });
                    </script>
            
                    <?php } ?> 
                    
                  <?php } ?>
                
                <?php } //end else error ?>
            
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