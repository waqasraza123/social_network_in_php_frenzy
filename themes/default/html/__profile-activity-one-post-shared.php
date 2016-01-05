<div id="activity_<?php echo $D->codepost?>" class="oneactivity">
	<div class="oaheader">
    	<?php if ($D->idUser == $this->user->id) { ?>
    	<div id="bdelete_<?php echo $D->codepost?>" style="float:right; text-align:right; height:10px; width:10px;" class="hand"><span title="<?php echo $this->lang('global_msg_txtdeletemsg')?>">x</span></div>
        <?php } ?>
        
    	<div class="avatar"><a href="<?php echo $C->SITE_URL.$D->userName?>"><img onmouseover="userCard(0, 'activity_<?php echo $D->codepost?>', '<?php echo $D->codeUser?>')" onmouseout="ignoreUserCard()" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($D->userAvatar)?$C->AVATAR_DEFAULT:$D->userAvatar)?>" class="rounded"></a></div>
        <div class="info">
               
            <div class="iuser">
                <span class="linkblue2" onmouseout="ignoreUserCard()" onmouseover="userCard(1, 'activity_<?php echo $D->codepost?>', '<?php echo $D->codeUser?>')"><a href="<?php echo $C->SITE_URL.$D->userName?>"><?php echo $D->nameUser?></a></span> <span class="nobold"><?php echo $this->lang('global_txt_shared_a_post')?></span>
            </div>
            <div class="idate"><a href="<?php echo $C->SITE_URL.$D->userName.'/posts/'.$D->codepost?>"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->a_date).'T'.date('H:i:s',$D->a_date).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->a_date);?></abbr></a></div>

        </div>

        <div class="sh"></div>	
        
    </div>
    
	<div class="oabody">
    	<div class="space05"><?php echo analyzeMessage($D->post)?></div>
        
        <div class="mrg20B"><?php echo $D->htmlpostshare; ?></div>

    </div>
    
    
<div class="spacebottom">
    
    <?php if ($D->is_logged == 1) { ?>
    
	<div id="shareok_<?php echo $D->codepost?>" class="pdn10 centered hide"></div>
    
	<div id="share_<?php echo $D->codepost?>" class="hide pdn10">
    	<div class="areacomments">
            <form name="formshare_<?php echo $D->codepost?>" method="post" action="">
            <div><textarea name="txtshare_<?php echo $D->codepost?>" id="txtshare_<?php echo $D->codepost?>" class="boxinput" placeholder="<?php echo $this->lang('global_share_writesomething')?>"></textarea></div>
            <div id="msgerrorshare_<?php echo $D->codepost?>" class="redbox"></div>
            <div id="iloadershare_<?php echo $D->codepost?>" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload.gif"></div>
            <div id="areabshare_<?php echo $D->codepost?>">
            	<span><input type="submit" name="bsaveshare_<?php echo $D->codepost?>" id="bsaveshare_<?php echo $D->codepost?>" value="<?php echo $this->lang('global_share_bsave')?>" class="bblue hand"></span> <span id="bcancelshare_<?php echo $D->codepost?>" class="onlyblue hand"><?php echo $this->lang('global_share_bcancel')?></span>
            </div>

            </form>
        </div>
    
    </div>
    
    <div id="accesories_<?php echo $D->codepost?>" class="accesories">
    	<div id="msgerror1_<?php echo $D->codepost?>" class="redbox"></div>
        <div>
            <div class="fleft">
                <span id="arealike_<?php echo $D->codepost?>">
                    <span id="iloaderlike_<?php echo $D->codepost?>" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload.gif"></span>
                    <span id="llike_<?php echo $D->codepost?>" class="onlyblue hand <?php echo($D->liketoUser==0?'':'hide');?>"><?php echo $this->lang('global_msg_txtlike')?></span>
                    <span id="lulike_<?php echo $D->codepost?>" class="onlyblue hand <?php echo($D->liketoUser==1?'':'hide');?>"><?php echo $this->lang('global_msg_txtunlike')?></span>
                </span>
                
                <span id="lcomment_<?php echo $D->codepost?>" class="mrg10L onlyblue hand"><?php echo $this->lang('global_msg_txtcomment')?></span>
                
                <span id="lshare_<?php echo $D->codepost?>" class="mrg10L onlyblue hand"><?php echo $this->lang('global_msg_txtshare')?></span>
            </div>
            
            <div class="fright">
                <span><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icofav.png"> <span id="numlikes_<?php echo $D->codepost?>"><?php echo($D->numlikes)?></span></span>
                <span class="mrg10L"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icocomment.png"> <span id="numcomments_<?php echo $D->codepost?>"><?php echo($D->numcommentstotal)?></span></span>
            </div>
            <div class="sh"></div>
        </div>
    </div>
    <?php } else { ?>
    <div class="accesories">
    	<span><?php echo $this->lang('global_msg_nonlogin'); ?></span>
    </div>
    <?php } ?>
    
	<?php if (!empty($D->htmlcommentspost)) { ?>

		<?php if ($D->totalcomments>$C->NUM_COMMENTS_PER_POST) { ?>
        <div class="loadmorecomment_<?php echo $D->codepost?> arealinkmorecomment">
            <span id="linkmore_<?php echo $D->codepost?>" class="hand onlyblue"><?php echo $this->lang('global_comment_txtmorecomment')?></span>
            <span id="morepreload_<?php echo $D->codepost?>" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload.gif" /></span>
            <input name="numitems_<?php echo $D->codepost?>" type="hidden" id="numitems_<?php echo $D->codepost?>" value="<?php echo $D->numcomments?>" />
        </div>
        <script type="text/javascript">
        $('#linkmore_<?php echo $D->codepost?>').on("click", function(){
            reload_comments('<?php echo $D->codepost?>', <?php echo $C->NUM_COMMENTS_PER_POST ?>)
            return false;
        });
        </script>
        <?php } ?>
        
		<div id="thelistcomments_<?php echo $D->codepost?>" class="listcomments"><?php echo $D->htmlcommentspost; ?></div>
    
    <?php } ?>
    
    <?php if ($D->is_logged == 1) { ?>
    <div id="replies_<?php echo $D->codepost?>" style="padding:0 10px 0 10px;" class="listcomments"></div>
    
	<div class="areacomments">
        <div class="avatar"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.(empty($this->user->info->avatar)?$C->AVATAR_DEFAULT:$this->user->info->avatar)?>" class="rounded"></div>
        <div class="areainput">
            <form name="form1_<?php echo $D->codepost?>" method="post" action="">
            <div><textarea name="comment_<?php echo $D->codepost?>" id="comment_<?php echo $D->codepost?>" class="boxinput" placeholder="<?php echo $this->lang('global_comment_txtleave')?>"></textarea></div>
            <div id="msgerror2_<?php echo $D->codepost?>" class="redbox"></div>
            <div>
            	<span id="iloader_<?php echo $D->codepost?>" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload.gif"></span>
            	<span id="bcomment_<?php echo $D->codepost?>" class="hide"><input type="submit" name="bsavecomm_<?php echo $D->codepost?>" id="bsavecomm_<?php echo $D->codepost?>" value="<?php echo $this->lang('global_comment_txtbsave')?>" class="bblue hand"></span>              
            </div>

            </form>
        </div>
    </div>
    <?php } ?>
   
   
</div>   
    
    
</div>
<script>
	$(".gallery_<?php echo $D->codepost?>").magnificPopup({
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
		verticalFit: false
	  }
	}); 
	
	<?php if ($D->is_logged == 1) { ?>
	$("#comment_<?php echo $D->codepost?>").keyup(function(){
		$(this).height(0);
		$(this).height(this.scrollHeight);		
	});
	
	$("#comment_<?php echo $D->codepost?>, #lcomment_<?php echo $D->codepost?>").on("click",function(){
		$("#comment_<?php echo $D->codepost?>").focus();
		$("#bcomment_<?php echo $D->codepost?>").fadeIn("slow");
		return false;		
	});
	
	$("#bsavecomm_<?php echo $D->codepost?>").on("click",function(){
		commentpost('<?php echo $D->codepost?>', <?php echo $D->idpost?>, <?php echo $D->idUser?>);
		return false;
	});
	
	$("#llike_<?php echo $D->codepost?>").on("click",function(){
		likepost('<?php echo $D->codepost?>', <?php echo $D->idpost?>, <?php echo $D->idUser?>)
		return false;
	});
	
	$("#lulike_<?php echo $D->codepost?>").on("click",function(){
		unlikepost('<?php echo $D->codepost?>', <?php echo $D->idpost?>, <?php echo $D->idUser?>);
		return false;
	});
	
	$("#lshare_<?php echo $D->codepost?>").on("click",function(){
		$('#accesories_<?php echo $D->codepost?>').slideUp('low',function(){
			$('#share_<?php echo $D->codepost?>').slideDown('low');
		});
		return false;
	});
	
	$("#bcancelshare_<?php echo $D->codepost?>").on("click",function(){
		$('#share_<?php echo $D->codepost?>').slideUp('low',function(){
			$('#accesories_<?php echo $D->codepost?>').slideDown('low');
		});
		return false;
	});

	$("#bsaveshare_<?php echo $D->codepost?>").on("click",function(){
		sharepost('<?php echo $D->codepost?>', <?php echo $D->idpostShared?>, <?php echo $D->idUser?>);
		return false;
	});

	
	$("#bdelete_<?php echo $D->codepost?>").on("click",function(){
		deletepost('<?php echo $D->codepost?>');
		return false;
	});
	<?php } ?>

</script>