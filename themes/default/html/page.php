<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>

<div id="generalspace">
        
    <div id="container">
    
    	<div id="column1-info"><?php $this->load_template('_verticalmenu-pages.php'); ?></div>
        
        <div id="column2-info">
            
            <div class="boxprof">

				<div class="title"><?php echo $D->txtTitle; ?></div>

                <div class="spaceinfo">
                
                    <div class="mrg20T mrg30B"><?php echo $D->texthtml?></div>
                    
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