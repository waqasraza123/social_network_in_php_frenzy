<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_dashboard.js"></script>
<div id="generalspace">
        
    <div id="container">
    
    	<div id="column1-admin"><?php $this->load_template('_verticalmenu-admin.php'); ?></div>
        
        <div id="column2-admin">
		
			<div id="dashboard-admin2">
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                        <div class="title"><?php echo $this->lang('admin_manageuser_subtitle1');?></div>
                        
                        <div class="spaceinfo">
                    
                    		<div class="grey1"><?php echo $this->lang('admin_manageuser_txt1')?></div>
                    
                    		<div id="listusers" class="mrg10T mrg10B">
                    
							<?php echo $D->htmlUsers?>
                                
                            </div>
                    
							<?php if ($D->totalpages > 1) {?>
                            
                            <div id="paginations" class="mrg20T mrg20B">
                            
                            <?php for ($i=1; $i<=$D->totalpages; $i++) { ?>
                            
                                <?php if ($i == $D->npage) {?>
                                <span class="pactive"><?php echo $i?></span>
                                <?php } else { ?>
                                <span class="pnoactive"><a href="<?php echo $C->SITE_URL?>admin/users/p:<?php echo $i?>"><?php echo $i?></a></span>
                                <?php } ?>
                            
                            <?php } ?>
                                
                            </div>
                            
                            <?php } ?>

						</div>
                        
                    </div>
                    
				</div>

            </div>
        
        </div>
        
        <div class="sh"></div>
    
    </div>
            
</div>    

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>