<div id="comment_post_<?php echo $D->o_idcomment?>" class="onecomment">
	<?php if ($D->o_idUser == $this->user->id) { ?>
	<div id="bdeletecomment_<?php echo $D->o_idcomment?>" class="hand delete">x</div>
    <?php } ?>
    <div class="avatar"><a href="<?php echo $C->SITE_URL.$D->o_username?>"><img onmouseout="ignoreUserCard()" onmouseover="userCard(2, 'comment_post_<?php echo $D->o_idcomment?>', '<?php echo $D->o_ucode?>')" src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min2/'.$D->o_avatar?>" class="rounded"></a></div>
    <div class="info">
        <div class="user"><span class="linkblue2" onmouseout="ignoreUserCard()" onmouseover="userCard(3, 'comment_post_<?php echo $D->o_idcomment?>', '<?php echo $D->o_ucode?>')"><a href="<?php echo $C->SITE_URL.$D->o_username?>"><?php echo $D->o_nameUser?></a></span></div>
        <div class="message"><?php echo analyzeMessage($D->o_comment)?></div>
        <div class="whend"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->o_whendate).'T'.date('H:i:s',$D->o_whendate).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->o_whendate);?></abbr></div>
    </div>
    
</div>
<script>
	$("#bdeletecomment_<?php echo $D->o_idcomment?>").on("click",function(){
		deletecomment(<?php echo $D->o_idcomment?>, <?php echo $D->o_idpost?>, <?php echo $D->o_idUserOwner?>, '<?php echo $D->o_codepost?>');
		return false;
	});
</script>