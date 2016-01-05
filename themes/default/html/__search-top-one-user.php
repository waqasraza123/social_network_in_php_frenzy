<a href="<?php echo $C->SITE_URL.$D->g->username?>" class="undecorated">
<div class="oneresult">
	<div style="padding:10px 10px 0px 10px">
        <div class="photo"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->g->avatar)?$C->AVATAR_DEFAULT:$D->g->avatar)?>"></div>
        <div class="info">
        <?php $nameUser = (empty($D->g->firstname) || empty($D->g->lastname))?stripslashes($D->g->username):(stripslashes($D->g->firstname).' '.stripslashes($D->g->lastname));?>
            <div class="title"><span class="link"><?php echo($nameUser)?></span></div>
            <div class="numposts"><?php echo $D->g->num_posts?> <?php echo($D->g->num_posts==1?$this->lang('global_txt_search_post'):$this->lang('global_txt_search_posts'))?></div>
        </div>
        <div class="sh"></div>
    </div>
</div>
</a>