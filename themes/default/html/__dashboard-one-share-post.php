
<div id="activity_<?php echo $D->codepostSh.$D->idpost?>" class="oneactivity">
	<div class="oaheader">
        
    	<div class="avatar" ><a href="<?php echo $C->SITE_URL.$D->userNameSh?>"><img onmouseover="userCard(0, 'activity_<?php echo $D->codepostSh.$D->idpost?>', '<?php echo $D->codeUserSh?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->userAvatarSh)?$C->AVATAR_DEFAULT:$D->userAvatarSh)?>" class="rounded"></a></div>
        <div class="info">
               
            <div class="iuser">
                <span class="linkblue2" onmouseout="ignoreUserCard()" onmouseover="userCard(1, 'activity_<?php echo $D->codepostSh.$D->idpost?>', '<?php echo $D->codeUserSh?>')"><a href="<?php echo $C->SITE_URL.$D->userNameSh?>"><?php echo $D->nameUserSh?></a></span>

            </div>
            <div class="idate"><a href="<?php echo $C->SITE_URL.$D->userNameSh.'/posts/'.$D->codepostSh?>"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->a_dateSh).'T'.date('H:i:s',$D->a_dateSh).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->a_dateSh);?></abbr></a></div>
            
        </div>
        <div class="sh"></div>	
        
    </div>
    
	<div class="oabody">
    	<div class="space05"><?php echo analyzeMessage($D->postSh)?></div>
        
        <?php if (!empty($D->typepostSh)) {
				
				$cadattach = '';
				if ($D->typepostSh=='photo') {
					
					$cadattach .= '<div class="gallerySh_'.$D->codepostSh.$D->idpost.'">';
					$photosPost = explode(',', $D->valueattachSh);
					$numphotos = count($photosPost);
					
					if ($numphotos < 3) {
						// for one photo
						if ($numphotos == 1) {
							$cadattach .= '<div style="width:95%; text-align:center; padding:0 10px 10px 0;"><div><a href="'.$C->SITE_URL.$C->FOLDER_PHOTOS.$photosPost[0].'"><img src="'.$C->SITE_URL.$C->FOLDER_PHOTOS.'min1/'.$photosPost[0].'"></a></div></div>';
						}
						
						// for two photos
						if ($numphotos == 2) {
							$cadattach .= '<div style="width:49%; float:left;"><div style="text-align:right;"><a href="'.$C->SITE_URL.$C->FOLDER_PHOTOS.$photosPost[0].'"><img src="'.$C->SITE_URL.$C->FOLDER_PHOTOS.'min1/'.$photosPost[0].'"></a></div></div>';
							$cadattach .= '<div style="width:49%; float:right;"><div style="text-align:left; padding:0 10px 10px 0;"><a href="'.$C->SITE_URL.$C->FOLDER_PHOTOS.$photosPost[1].'"><img src="'.$C->SITE_URL.$C->FOLDER_PHOTOS.'min1/'.$photosPost[1].'"></a></div></div>';
						}
						
					} else {
					
						// for more than 3 photos 
						foreach($photosPost as $onephoto) {
							$cadattach .= '<div style="width:33.3%; float:left;"><div style="padding:0 10px 10px 0;"><a href="'.$C->SITE_URL.$C->FOLDER_PHOTOS.$onephoto.'"><img src="'.$C->SITE_URL.$C->FOLDER_PHOTOS.'min1/'.$onephoto.'"></a></div></div>';
						}

					}
					$cadattach .= '</div>';
					
				}
				
				if ($D->typepostSh=='video') {
					
					$cadattach = ''; 

					if(substr($D->valueattachSh, 0, 3) == 'yt:') {
						$cadattach .= '<div style="padding:0 10px 20px 0;"><div class="blackvideo"><div class="interno"><iframe width="100%" height="315" src="http://www.youtube.com/embed/'.str_replace('yt:', '', $D->valueattachSh).'" frameborder="0" allowfullscreen></iframe></div></div></div>';
					} elseif(substr($D->valueattachSh, 0, 3) == 'vm:') {
						$cadattach .= '<div style="padding:0 10px 20px 0;"><div class="blackvideo"><div class="interno"><iframe width="100%" height="315" src="http://player.vimeo.com/video/'.str_replace('vm:', '', $D->valueattachSh).'" frameborder="0" allowfullscreen></iframe></div></div></div>';
					}
					
				}
				
				if ($D->typepostSh=='music') {
					
					$cadattach = '';
					
					$count = explode('/', $D->valueattachSh);
					if(count($count) <= 2 || strpos($D->valueattachSh, 'users/') !== false) $height = '380';
					else $height = '120';

					if(substr($D->valueattachSh, 0, 3) == 'sc:') {
						$cadattach .= '<div style="padding:0px 10px 10px 0px;"><iframe width="100%" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https://soundcloud.com'.str_replace('sc:', '', $D->valueattachSh).'"></iframe></div>';
					} else {
						$cadattach .= '<div style="padding:0px 0px 10px;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icomusic.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_ilistened').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';

					}					
					
				}
				
				if ($D->typepostSh=='map') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div style="font-size:13px; color:#999">'.$D->valueattachSh.'</div><div><img src="https://maps.googleapis.com/maps/api/staticmap?center='.$D->valueattachSh.'&zoom=13&size=714x180&maptype=roadmap&markers=color:red%7C'.$D->valueattachSh.'&sensor=false&scale=2&visual_refresh=true" /></div></div>';			
					
				}
				
				if ($D->typepostSh=='visited') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icovisited.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_ivisited').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';				
					
				}
				
				if ($D->typepostSh=='food') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icofood.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_iateat').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';				
					
				}
				
				if ($D->typepostSh=='movie') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icomovie.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_iwatched').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';				
					
				}
				
				if ($D->typepostSh=='book') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icobook.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_iread').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';				
					
				}
				
				if ($D->typepostSh=='game') {
					
					$cadattach = '';

					$cadattach .= '<div style="padding:0 10px 20px 0;"><div><img src="'.$C->SITE_URL.'themes/'.$C->THEME.'/imgs/icogame.png"></div><div style="font-size:13px; color:#999">'.$this->lang('global_post_txt_iplayed').'</div><div style="font-size:16px; font-weight:bold; word-wrap: break-word;">'.$D->valueattachSh.'</div></div>';				
					
				}
			
		?>
    	<div class="space06 mrg10T">
        	<?php echo $cadattach?>
            <div class="sh"></div>
        </div>
        <?php } ?>

    </div>    
</div>
<script>
	$(".gallerySh_<?php echo $D->codepostSh.$D->idpost?>").magnificPopup({
	  delegate: "a",
	  type: "image",
	  tLoading: txtloading + " #%curr%...",
	  mainClass: "mfp-img-mobile",
	  gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	  },
	  image: {
		tError: "<a href=\"%url%\">The image #%curr%</a> could not be loaded.",
		verticalFit: true
	  }
	}); 
</script>