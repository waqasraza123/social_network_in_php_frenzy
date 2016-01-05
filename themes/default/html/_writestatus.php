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
<script type="text/javascript" src="<?php echo $C->SITE_URL; ?>themes/<?php echo $C->THEME; ?>/js/jquery.magnific-popup.js"></script>

				<div id="titleupdate"><?php echo $this->lang('global_post_txtstatus');?></div>
                
                <div class="divpointbox"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/pointbox.png" class="pointbox"></div>
                
				<div class="boxstatus">
                    <form id="newpost" name="form" action="<?php echo $C->SITE_URL?>postear" method="POST" enctype="multipart/form-data" target="my_iframe">
                    
                    <div class="oabody">
                    	<div><textarea id="newstatus" placeholder="<?php echo $this->lang('global_post_txtplaceholder')?>" name="newstatus"></textarea></div>
                        
                        <div id="showspace" style="padding-bottom:4px;"><span title="<?php echo $this->lang('global_post_emoticons_msgshow')?>" id="linkShow" class="hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME?>/imgs/icoshowemoticons.png"></span></div>
                        <div id="closespace" class="hide"><div class="fright"><span title="<?php echo $this->lang('global_post_emoticons_msgclose')?>" id="linkclose" class="hand">x</span></div></div>
                        <div class="sh"></div>
						<div id="emoticonsspace" class="emoticons-space"><?php echo genSpaceEmoticons('newstatus'); ?></div>
                    
                    </div>
                    
                    <div class="selected-files"><span id="num-files">0</span> <?php echo $this->lang('global_post_txtimgselected')?></div>
					<div class="additional-info"><input type="text" name="atach-value" id="atach-value" placeholder="" /></div>
                    
                    <div id="msgerror" class="redbox2"></div>
                    
                    <div class="accesories fleft">
                    
                   	  <span class="bimage hand"><input name="images_post[]" id="files_post" size="27" type="file" class="inputimage" title="<?php echo $this->lang('global_post_txttitleimage');?>" multiple /><input name="typeattach" type="hidden" id="typeattach" value="0"></span>
                    	
                      <span id="bvideo" class="mrg10L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachvideo.png" title="<?php echo $this->lang('global_post_txttitlevideo');?>"></span>
                      
                      <span id="bmusic" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachmusic.png" title="<?php echo $this->lang('global_post_txttitlemusic');?>"></span>
                      
                      <span id="bmap" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachmap.png" title="<?php echo $this->lang('global_post_txttitlemap');?>"></span>
                      
                      <span id="bvisited" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachvisited.png" title="<?php echo $this->lang('global_post_txttitlevisited');?>"></span>
                      
                      <span id="bfood" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachfood.png" title="<?php echo $this->lang('global_post_txttitlefood');?>"></span>
                      
                      <span id="bmovie" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachmovie.png" title="<?php echo $this->lang('global_post_txttitlemovie');?>"></span>
                      
                      <span id="bbook" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachbook.png" title="<?php echo $this->lang('global_post_txttitlebook');?>"></span>
                      
                      <span id="bgame" class="mrg5L hand"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/icoattachgame.png" title="<?php echo $this->lang('global_post_txttitlegame');?>"></span>
                      
                    </div>
                    
                    <div class="accesories fright">
                    	<span id="iloader" class="hide"><img src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME; ?>/imgs/preload.gif"></span>
                    	<span id="bpostear" class="bpost hand"><?php echo $this->lang('global_post_txtbpost');?></span>
                    </div>
                    
                    <div class="sh"></div>
                    <iframe id="iframe_postear" name="iframe_postear" src="" style="display: none"></iframe>
                    </form>
                    
                    <script>					
					$('#bpostear').click(function(){
						document.getElementById("newpost").target = "iframe_postear";
						document.getElementById("newpost").submit();
						document.getElementById("bpostear").style.display = "none";
						document.getElementById("iloader").style.display = "block";						
					});
					
					function endPostear(resp){
						switch (resp.charAt(0)) {
							case '0':
								openandclose('#msgerror',resp.substring(3),1700);
								break;
							case '1':
							
								cadreturn = resp.substring(3);
								cadreturn = cadreturn.replace('&lt;script&gt;','<script>');
								cadreturn = cadreturn.replace('&lt;/script&gt;','<\/script>');
								$('#recent-content').prepend(cadreturn);
								document.getElementById("newpost").reset();
								document.getElementById("newstatus").style.height = "42px";
								document.getElementById("num-files").innerHTML = "0";
		
								$('.additional-info').hide('slow');
								
								if ($('#linkShow').is (':hidden')) {
									$("#closespace").hide();
									$("#emoticonsspace").hide();
									$("#showspace").show();	
								}
								
								$('#bvideo').addClass('icobselected').siblings().removeClass('icobselected');
								$('#bvideo').removeClass('icobselected');
								
								$("abbr.timeago").timeago();
								
								break;
						}

						document.getElementById("iloader").style.display = "none";
						document.getElementById("bpostear").style.display = "block";

						return true;   
					}
					
					$('#bvideo').click(function() {
						$('#bvideo').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('2');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharevideo')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bmusic').click(function() {
						$('#bmusic').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('3');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharemusic')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bmap').click(function() {
						$('#bmap').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('4');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharemap')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bvisited').click(function() {
						$('#bvisited').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('5');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharevisited')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bfood').click(function() {
						$('#bfood').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('6');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharefood')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bmovie').click(function() {
						$('#bmovie').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('7');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharemovie')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bbook').click(function() {
						$('#bbook').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('8');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharebook')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#bgame').click(function() {
						$('#bgame').addClass('icobselected').siblings().removeClass('icobselected');
						$('#typeattach').val('9');
						$('#atach-value').val('');
						$('#atach-value').attr('Placeholder', '<?php echo $this->lang('global_post_txtsharegame')?>');
						$('#files_post').val('');
						$('.additional-info').show('slow');
						$('.selected-files').hide('slow', function(){
							$('#num-files').text(0);
						});
						$('#atach-value').focus();
					});
					
					$('#files_post').click(function() {						
						$('#typeattach').val('1');
						$('#atach-value').val('');
						$('.additional-info').hide('slow');
						$('.selected-files').show('slow');
					});
					
					$(':file').change(function () {
						$('#num-files').text(this.files.length);
					});
					
					$('#newpost').submit(function() {
						return false;
					});
					

					$('#newstatus').keyup(function(){
						$(this).height(0);
						$(this).height(this.scrollHeight);		
					});
					
					
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

					</script>
                    
                
                </div>
                
                <div id="recent-content"></div>