<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>

<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_dashboard.js"></script>

<div id="generalspace">

    <div id="container">
    
    	<div id="column1"><?php $this->load_template('_verticalmenu-dashboard.php'); ?></div>
        
        <div id="column2">
		
            <div id="dashboard2">
            

				<?php $this->load_template('_writestatus.php');?>
                
				
                <?php if (!empty($D->htmlResult)) { ?>
                
                
                
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
					var idu = <?php echo $this->user->id ?>;
					var itemperpage = <?php echo $C->NUM_ACTIVITIES_PAGE ?>;
                    $('#bmore').click(function(){
                        reloadinfo('activities');
                        return false;
                    });
                </script>
        
                <?php } ?>
                
                
                <?php } else {?>
                
                <div><?php $this->load_template('__dashboard-welcome.php');?></div>
                
                <?php } ?>

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