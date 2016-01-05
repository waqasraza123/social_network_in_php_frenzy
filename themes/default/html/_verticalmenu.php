<div id="profile01">

    <div id="menuprofile">
    
    	<div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/activity">
            <div class="menuoptionp <?php echo($D->optionactive==1?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_activity');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomenuactivity20.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_activity');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
        <div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/photos">
            <div class="menuoptionp <?php echo($D->optionactive==2?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_photos');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomyphotos.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_photos');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
        <div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/videos">
            <div class="menuoptionp <?php echo($D->optionactive==6?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_videos');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomyvideos.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_videos');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
        <div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/likes">
            <div class="menuoptionp <?php echo($D->optionactive==3?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_favorites');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomenufavorites20.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_favorites');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
        <div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/messages">
            <div class="menuoptionp <?php echo($D->optionactive==5?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_messages');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomessages.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_messages');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
        <div class="menuglobalp">
            <a href="<?php echo $C->SITE_URL.$D->u->username?>/info">
            <div class="menuoptionp <?php echo($D->optionactive==4?'actp':'inactp')?>">
                <div class="icopcp"><span title="<?php echo $this->lang('profile_vmenu_opc_userinformation');?>"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icomenuinfo20.png"></span></div>
                <div class="txtopcp"><?php echo $this->lang('profile_vmenu_opc_userinformation');?></div>
                <div class="sh"></div>
            </div>
            <div class="sh"></div>
            </a>
        </div>
        
    </div>

</div>