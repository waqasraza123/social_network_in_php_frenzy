<a href="<?php echo $C->SITE_URL.$D->username?>" class="undecorated">

<?php if (!empty($D->cover)) { ?>

<div onmouseover="keepCardVisible()" id="userCard">
	<div class="ucover" style="background-image: url(<?php echo $C->SITE_URL.$C->FOLDER_COVERS?>min3/<?php echo $D->cover?>);"></div>
    <div>
    	<div class="uavatar"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min1/'.(empty($D->avatar)?$C->AVATAR_DEFAULT:$D->avatar)?>"></div>
        <div>
        	<?php if ($D->isUserVerified == 1) { ?><div style="float:right; margin-right:5px; margin-top:4px; "><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png"></div><?php } ?>
    		<div class="uname"><?php echo $D->nameUser?></div>
            <div class="sh"></div>
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold txtsize01"><?php echo $D->num_posts?></span> <span class="actions">POSTS</span></span>
        <span class="grey1"> &#8226; </span>
    	<span><span class="bold txtsize01"><?php echo $D->num_followers?></span> <span class="actions">FOLLOWERS</span></span>
        <span class="grey1"> &#8226; </span>
    	<span><span class="bold txtsize01"><?php echo $D->num_following?></span> <span class="actions">FOLLOWING</span></span>
    </div>
	<div class="sh"></div>
</div>

<?php } else { ?>


<div onmouseover="keepCardVisible()" id="userCardNoCover">
	<div class="ucover"></div>
    <div>
    	<div class="uavatar"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min1/'.(empty($D->avatar)?$C->AVATAR_DEFAULT:$D->avatar)?>"></div>
        <div>
        	<?php if ($D->isUserVerified == 1) { ?><div style="float:right; margin-right:5px; margin-top:4px; "><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png"></div><?php } ?>
    		<div class="uname"><?php echo $D->nameUser?></div>
            <div class="sh"></div>
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold txtsize01"><?php echo $D->num_posts?></span> <span class="actions">POSTS</span></span>
        <span class="grey1"> &#8226; </span>
    	<span><span class="bold txtsize01"><?php echo $D->num_followers?></span> <span class="actions">FOLLOWERS</span></span>
        <span class="grey1"> &#8226; </span>
    	<span><span class="bold txtsize01"><?php echo $D->num_following?></span> <span class="actions">FOLLOWING</span></span>
    </div>
	<div class="sh"></div>
</div>


<?php } ?>
</a>