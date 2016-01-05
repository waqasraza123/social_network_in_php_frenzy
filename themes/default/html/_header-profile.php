        	<div id="headerProfile">

				<?php if (!empty($D->u->cover)) { ?>

               	
                <div id="coverProfile" style="background-position: center; background-image: url(<?php echo $C->SITE_URL.$C->FOLDER_COVERS?>min1/<?php echo $D->u->cover?>);">
                	<div>
	                    <a href="<?php echo $C->SITE_URL.$C->FOLDER_COVERS.$D->u->cover?>" id="coverProfilePhoto"><div class="coverBorder"></div></a>
                    </div>
                    <div class="nameProfile">
                    
                    	<?php if ($D->he_follows_me) { ?><div style="line-height:20px;"><span class="hefollows"><?php echo $this->lang('profile_infobasic_followsyou'); ?></span></div><?php } ?>
                        
                        <div>

							<?php if ($D->isUserVerified == 1) { ?><div style="float:right; margin-left:10px; "><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png" title="<?php echo $this->lang('profile_infobasic_title_validated')?>"></div><?php } ?>
    
                            <a href="<?php echo $C->SITE_URL.$D->u->username?>" class="undecorated"><div id="txtnameprofile"><?php echo $D->nameUser ?></div></a>
                        
                        </div>

                    </div>
                </div>
                

				<?php } else { ?>

                <div id="withoutCover">
                
                	<div class="nameProfile nameWithoutCover">
                    
                    	<?php if ($D->he_follows_me) { ?><div style="line-height:20px;"><span class="hefollows"><?php echo $this->lang('profile_infobasic_followsyou'); ?></span></div><?php } ?>
                        
                        <div>

							<?php if ($D->isUserVerified == 1) { ?><div style="float:right; margin-left:10px; "><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/userverified.png" title="<?php echo $this->lang('profile_infobasic_title_validated')?>"></div><?php } ?>
    
                            <a href="<?php echo $C->SITE_URL.$D->u->username?>" class="undecorated"><span id="txtnameprofile"><?php echo $D->nameUser ?></span></a>

						</div>
                        
                    </div>
                </div>

                <?php } ?>
                
                <div id="infoProfile">
                	<div class="infoBar">
                        <div class="opcsBar">
                        	<a href="<?php echo $C->SITE_URL.$D->u->username?>" class="opcOne undecorated">
                            <div id="numposts" class="basic-number"><?php echo $D->u->num_posts; ?></div>
                            <div class="txtminitop basic-text"><?php echo ($D->u->num_posts==1?$this->lang('profile_infobasic_photo'):$this->lang('profile_infobasic_photos'))?></div>
                            <div class="icominitop"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icomenuactivity20.png" title="<?php echo ($D->u->num_posts==1?$this->lang('profile_infobasic_photo'):$this->lang('profile_infobasic_photos'))?>"></div>
                            </a>
                            <a href="<?php echo $C->SITE_URL.$D->u->username?>/following" class="opcOne undecorated">
                            <div id="numfollowing" class="basic-number"><?php echo $D->u->num_following; ?></div>
                            <div class="txtminitop basic-text"><?php echo ($D->u->num_following==1?$this->lang('profile_infobasic_following'):$this->lang('profile_infobasic_following'))?></div>
                            <div class="icominitop"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icodashboardfollowing.png" title="<?php echo ($D->u->num_following==1?$this->lang('profile_infobasic_following'):$this->lang('profile_infobasic_following'))?>"></div>
                            </a>
                            <a href="<?php echo $C->SITE_URL.$D->u->username?>/followers" class="opcOne undecorated">
                            <div id="numfollowers" class="basic-number"><?php echo $D->u->num_followers; ?></div>
                            <div class="txtminitop basic-text"><?php echo ($D->u->num_followers==1?$this->lang('profile_infobasic_follower'):$this->lang('profile_infobasic_followers'))?></div>
							<div class="icominitop"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icodashboardfollower.png" title="<?php echo ($D->u->num_followers==1?$this->lang('profile_infobasic_follower'):$this->lang('profile_infobasic_followers'))?>"></div>
                            </a>
                            <span class="opcOne undecorated">
                            <?php $this->load_template('__bfollow.php'); ?>
                            </span>
                        	<div class="sh"></div>
                        </div>
	                	<div class="sh"></div>
                    </div>
                    <div id="avatarProfile">
                    	<?php if (empty($D->u->avatar)) {?>

                    	<span class="thumbPhoto thumbWithoutCover"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR?>min4/default.jpg" class="imgPhoto imgWithoutCover"></span>

                        <?php } else { ?>

                    	<a id="avatarProfilePhoto" href="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'origins/'.$D->u->avatar?>" class="thumbPhoto thumbWithoutCover"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR?>min4/<?php echo $D->u->avatar?>" class="imgPhoto imgWithoutCover"></a>
                        
                        <?php } ?>
                    </div>
                </div>

            </div>
<script>    
	$("#avatarProfilePhoto").magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
		verticalFit: false
		}
	});
	
	$("#coverProfilePhoto").magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
		verticalFit: false
		}
	});
</script>