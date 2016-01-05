<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>

<div id="generalspace">
        
    <div id="container">
    
    	<div class="centered" style="padding-top:30px;">
    
            <div class="txtsize11 mrg20T"><?php echo $this->lang('global_reset_title')?></div>
            
            <?php if ($D->status == 0) { ?>
            
            <div class="txtsize04 mrg20T mrg20B"><?php echo $this->lang('global_reset_status0')?></div>
            
            <?php } ?>
            
            
            <?php if ($D->status == 1) { ?>
            
            <div class="txtsize04 mrg20T mrg20B"><?php echo $this->lang('global_reset_status1')?></div>
            
            <?php } ?>
            
            
            <?php if ($D->status == 2) { ?>
            
            <div class="txtsize02 mrg20T"><?php echo $this->lang('global_reset_status2')?></div>
            
            <div class="txtsize01 bold mrg20T"><?php echo $this->lang('global_reset_username')?></div>
            <div class="txtsize00 mrg10T"><?php echo $D->username?></div>
            <div class="txtsize01 bold mrg20T"><?php echo $this->lang('global_reset_password')?></div>
            <div class="txtsize00 mrg10T mrg20B"><?php echo $D->newpass?></div>
            
            <?php } ?>
        
        </div>
    
    </div>
            
</div>

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>