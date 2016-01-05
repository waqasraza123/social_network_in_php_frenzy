<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_admin.js"></script>
<div id="generalspace">
        
    <div id="container">
    
    	<div id="column1-admin"><?php $this->load_template('_verticalmenu-admin.php'); ?></div>
        
        <div id="column2-admin">
		
            <div id="dashboard-admin2">
                
                <div class="editarea">
                	
                    <div class="boxdash">
                
	                    <div class="title"><?php echo $this->lang('admin_ads_title');?></div>
                        
                        <div class="spaceinfo">
                    
							
                            
                            <div id="form01" class="mrg20B">
                            
                                <form id="formads1" name="formads1" method="post" action="">
                                <div class="mrg10T grey1"><?php echo $this->lang('admin_ads_subtitle1')?></div>
                                <div>
                                <textarea name="adsbasic1" rows="6" class="boxinput withbox" id="adsbasic1"><?php echo stripslashes($D->adsbasic1)?></textarea>
                                </div>
                                <div class="mrg10T grey1"><?php echo $this->lang('admin_ads_subtitle2')?></div>
                                <div>
                                <textarea name="adsbasic2" rows="6" class="boxinput withbox" id="adsbasic2"><?php echo stripslashes($D->adsbasic2)?></textarea>
                                </div>
                                                    
                                <div id="msgerror1" class="redbox"></div>
                                <div id="msgok1" class="yellowbox"></div>
                                <div class="mrg10T mrg5B">
                                <input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                                </div>
                                
                                </form>
                                
                            </div>
                            
                    
                    	</div>
                        
                    </div>
                    
				</div>

            </div>
        
        
        </div>
        
        <div class="sh"></div>
    
    </div>
            
</div> 

<script>
	var admin_norequest = '<?php echo $this->lang('admin_no_request');?>';
	
	$('#bsave1').click(function(){
		updateAdsBasic('#msgerror1','#msgok1','#bsave1');
		return false;
	});	
</script> 

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>