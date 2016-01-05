<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>
<script>
var txtloading = '<?php echo $this->lang('global_txtloading'); ?>';
var txtclose = '<?php echo $this->lang('global_txtclose'); ?>';
var txtnext = '<?php echo $this->lang('global_txt_next'); ?>';
var txtprevious = '<?php echo $this->lang('global_txt_prev'); ?>';
var txtof = '<?php echo $this->lang('global_txt_of'); ?>';
var txtloading = '<?php echo $this->lang('global_txtloading'); ?>';
var msgnocomment = '<?php echo $this->lang('global_msg_txtwithoutcomment');?>';
var txt_norequest = '<?php echo $this->lang('global_txt_no_request') ?>';
</script>
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_profile_chat.js"></script>
<script type="text/javascript" src="<?php echo $C->SITE_URL; ?>themes/<?php echo $C->THEME ?>/js/jquery.magnific-popup.js"></script>
<div id="generalspace">
        
    <div id="container">
    
        <div style="position:relative; float:left;">
        
        	<div><?php $this->load_template('_header-profile.php'); ?></div>

			<div>
    
                <div id="column1"><?php $this->load_template('_verticalmenu.php'); ?></div>
                
                <div id="column2">
                <?php
                
                if ($D->show_profile == 0) {
                    $this->load_template('_profile-no-show.php');
                } else {
                                
                ?>            
                
                    <div id="profile2">
                    	<a href="#chat" id="chat"></a>
                    
                        <div class="title spaceWhite"><?php echo $this->lang('profile_messages_title'); ?></div>
                        
                        <div class="boxchat">
                          <div class="chatheader">
                                <div class="ico"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/icochat.png"></div>
                                <div class="info">
                                    <div class="iuser"><?php echo $D->nameUser?></div>
                                </div>
                                <div class="sh"></div>	
                            </div>
        
                            <?php if ($D->is_my_profile) { ?>
                            <div class="chatbodyno">
                              <div class="spacemsgno"><?php echo $this->lang('profile_messages_notavailable');?></div>
                            </div>
                            <?php } elseif($D->is_logged==0) {?>
                            <div class="chatbodyno">
                              <div class="spacemsgno"><?php echo $this->lang('profile_messages_notlogin');?></div>
                            </div>
                            <?php } else { ?>
                            
        
                            
                            <div class="chatbody">
        
                                <?php if ($D->totalmsgchat>$C->CHAT_NUM_MSG_START) { ?>
                                <div class="loadmorechat">
                                    <span id="linkmore" class="hand onlyblue"><?php echo $this->lang('profile_messages_viewmore')?></span>
                                    <span id="morepreload" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/imgs/preload.gif" /></span>
                                    <input name="numitems" type="hidden" id="numitems" value="<?php echo $D->nummsgchat?>" />
                                </div>
                                <script type="text/javascript">
                                var uid = <?php echo $D->u->iduser ?>;
                                var itemperpage = <?php echo $C->CHAT_NUM_MSG_START ?>;
                                $('#linkmore').click(function(){
                                    reload_msgchat()
                                    return false;
                                });
                                </script>
                                <?php } ?>
                            
                                <div class="txtchats"><?php echo $D->htmlChat; ?></div>
                                
                            </div>
                            
                            <div class="entertxt">
                                <input type="text" name="inputchat" id="inputchat" placeholder="<?php echo $this->lang('profile_messages_placeholderchat');?>"  />
                                <input name="uid" type="hidden" id="uid" value="<?php echo $D->u->iduser ?>" />
                                
                                <?php if ($C->CHAT_WITH_EMOTICONS) { ?>
                                <div id="showspace" style="padding:7px 0px 4px;"><span title="<?php echo $this->lang('global_post_emoticons_msgshow')?>" id="linkShow" class="hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME?>/imgs/icoshowemoticons.png"></span></div>
                                <div id="closespace" class="hide"><div class="fright"><span title="<?php echo $this->lang('global_post_emoticons_msgclose')?>" id="linkclose" class="hand">x</span></div></div>
                                <div class="sh"></div>
                                <div id="emoticonsspace" class="emoticons-space"><?php echo genSpaceEmoticons('inputchat'); ?></div>
                                <?php } else { ?>
                                <div class="mrg10B"></div>
                                <?php } ?>
                                
                            </div>
                            
                            <script type="text/javascript" src="<?php $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_messageschat.js"></script>
                            
                            <script type="text/javascript">
                            $(".chatbody").scrollTop($(".chatbody")[0].scrollHeight);
                            var msg_norequest = '<?php echo $this->lang('global_txt_no_request');?>';
                            var intervalrefreshchat = <?php echo $C->CHAT_INTERVAL_REFRESH?>;
                            checkNewMsgChat();
                            
                            <?php if ($C->CHAT_WITH_EMOTICONS) { ?>
                            $('#linkShow').click(function() {
                                $("#showspace").hide();
                                $("#closespace").show();
                                $("#emoticonsspace").show();
                            });
                            
                            $('#linkclose').click(function() {
                                $("#closespace").hide();
                                $("#emoticonsspace").hide();
                                $("#showspace").show();
                            });
                            <?php } ?>
        
                            </script>
                            
                            
                            
                            <?php } ?>
                            
                        </div>
                    
                    
                    </div>
                    
                <?php } ?>
                </div>
        
        	</div>
            
        </div>
        
        <div id="divseparator" class="sh"></div>
        
        <div id="column3"><?php $this->load_template('_accessories.php'); ?></div>
        
        <div class="sh"></div>
    
    </div>
            
</div>

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>