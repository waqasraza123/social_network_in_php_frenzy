<?php
$cadaccion = '';
switch ($D->n_typenotifications) {
	case 1:
		$D->txtaction = $this->lang('global_txt_follow');
		break;	
	case 2:

		$urlpost = $C->SITE_URL.$this->user->info->username.'/posts/'.$D->n_postcode;
		$D->txtaction = $this->lang('global_txt_like').' <span class="linkblue"><a href="'.$urlpost.'">'.$this->lang('global_txt_post').'</a></span>.';
		break;	
	case 3:
		$urlpost = $C->SITE_URL.$this->user->info->username.'/posts/'.$D->n_postcode;
		$D->txtaction = $this->lang('global_txt_comment').' <span class="linkblue"><a href="'.$urlpost.'">'.$this->lang('global_txt_post').'</a></span>.';
		break;	
	case 5:
		$urlpost = $C->SITE_URL.$D->n_username.'/posts/'.$D->n_postcode;
		$D->txtaction = $this->lang('global_txt_shared').' <span class="linkblue"><a href="'.$urlpost.'">'.$this->lang('global_txt_post').'</a></span>.';
		break;				
}
?>
	<div class="itemalertnot">
		<div class="avatar"><a href="<?php echo $C->SITE_URL.$D->n_username?>"><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min3/'.(empty($D->n_avatar)?$C->AVATAR_DEFAULT:$D->n_avatar)?>" class="rounded"></a></div>
		<div class="info">
        	<div class="txtaccion"><span class="linkblue"><a href="<?php echo $C->SITE_URL.$D->n_username?>"><?php echo $D->n_nameUser?></a></span> <?php echo $D->txtaction?></div>

            <div class="txtwhen"><abbr class="timeago" title="<?php echo (date('Y-m-d',$D->n_fdate).'T'.date('H:i:s',$D->n_fdate).($C->TimeAgoWithZ==TRUE?'Z':'')); ?>"><?php echo date($this->lang('global_format_date'),$D->n_fdate);?></abbr></div>
        </div>
        <div class="sh"></div>
	</div>