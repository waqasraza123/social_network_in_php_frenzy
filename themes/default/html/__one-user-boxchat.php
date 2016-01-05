<a href="<?php echo $C->SITE_URL.$D->username?>/messages#chat" class="undecorated">
<div class="oneUserFChat hand">
	<?php if ($D->isonline == 1) { ?>
	<div style="float:right; margin:8px 5px 0 5px; font-size:0; "><img src="<?php echo $C->SITE_URL.'themes/'.$C->THEME.'/imgs/icoonline.png'?>"></div>
    <?php } ?>
	<div style="float:left; font-size:0; "><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->avatar)?'default.jpg':$D->avatar); ?>"></div>
    <div style="margin:0 0 0 35px; line-height:22px; " class="ellipsis"><?php echo $D->nameUser?></div>
	<div class="sh"></div>
</div>
</a>