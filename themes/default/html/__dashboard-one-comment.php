<div id="comment_post_<?php echo $D->g->idcomment?>" class="onecomment">

	<div id="bdeletecomment_<?php echo $D->g->idcomment?>" class="hand delete">x</div>

    <div class="avatar"><a href="<?php echo $C->SITE_URL.$D->username?>"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->avatar)?$C->AVATAR_DEFAULT:$D->avatar)?>" class="rounded"></a></div>
    <div class="info">
        <div class="user"><span class="linkblue2"><a href="<?php echo $C->SITE_URL.$D->username?>"><?php echo $D->nameUser?></a></span></div>
        <div class="message"><?php echo analyzeMessage($D->g->comment)?> - <span class="linkblue txtsize00"><a href="<?php echo $C->SITE_URL.$D->g->username.'/posts/'.$D->g->pcode?>"><?php echo $this->lang('dashboard_mycomments_txtviewpost');?></a></span></div>
        <div class="whend"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->g->whendate).'T'.date('H:i:s',$D->g->whendate).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->g->whendate);?></abbr></div>
    </div>
    
</div>
<script>
	$("#bdeletecomment_<?php echo $D->g->idcomment?>").on("click",function(){
		deletecomment(<?php echo $D->g->idcomment?>, <?php echo $D->g->pidpost?>, <?php echo $D->g->piduser?>, '<?php echo $D->g->pcode?>');
		return false;
	});
</script>