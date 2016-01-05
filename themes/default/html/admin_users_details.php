<?php
$this->load_template('_header.php');
$this->load_template('_top.php');
?>
<script type="text/javascript" src="<?php echo $C->SITE_URL?>themes/<?php echo $C->THEME ?>/js/js_admin.js"></script>
<script type="text/javascript" src="<?php echo $C->SITE_URL; ?>themes/<?php echo $C->THEME ?>/js/md5.js"></script>
<div id="generalspace">
        
    <div id="container">
    
    	<div id="column1-admin"><?php $this->load_template('_verticalmenu-admin.php'); ?></div>
        
        <div id="column2-admin">
		
			<div id="dashboard-admin2">
                
                <div id="linkback" class="mrg10B linkblue">&laquo; <a href="<?php echo $C->SITE_URL?>admin/users/p:<?php echo $D->npage?>"><?php echo $this->lang('admin_manageuser_linkback')?></a></div>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                            <div class="title"><?php echo $this->lang('admin_manageuser_subtitle2');?></div>
                            
                            <div class="spaceinfo">                 
                            
                            	<div id="userdetails">
                            
                                    <div>
                                    	<span><img src="<?php echo $C->SITE_URL.$C->FOLDER_AVATAR.'min1/'.(empty($D->avatar)?'default.jpg':$D->avatar); ?>" class="rounded"></span>
                                    </div>
                                    
					                <?php if (($D->f_leveladmin<$D->me->leveladmin || $D->iduser == $D->me->iduser) || (!$D->isadministrador)) { ?>
                                    

									<div class="editareax">
                                            
                                        <div id="form05" class="mrg10B">
                                        
                                            <form id="form5" name="form1" method="post" action="">
                                            <div class="mrg10T grey1"><?php echo $this->lang('admin_manageuser_txt_email')?></div>
                                            <div><input name="uemail" type="text" id="uemail" value="<?php echo $D->email?>" class="boxinput withbox" /></div>
                                            <div class="mrg10T grey1"><?php echo $this->lang('admin_manageuser_txt_username')?></div>
                                            <div><input name="uusername" type="text" id="uusername" value="<?php echo $D->username?>" class="boxinput withbox" /></div>
                                            <div class="mrg10T grey1"><?php echo $this->lang('admin_manageuser_txt_firstname')?></div>
                                            <div><input name="ufirstname" type="text" id="ufirstname" value="<?php echo $D->firstname?>" class="boxinput withbox" /></div>
                                            <div class="mrg10T grey1"><?php echo $this->lang('admin_manageuser_txt_lastname')?></div>
                                            <div><input name="ulastname" type="text" id="ulastname" value="<?php echo $D->lastname?>" class="boxinput withbox" /></div>

                                                                
                                            <div id="msgerror5" class="redbox"></div>
                                            <div id="msgok5" class="yellowbox"></div>
                                            <div class="mrg10T">
                                            <input type="submit" name="bsave5" id="bsave5" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                                            </div>
                                            
                                            </form>
                                            
                                        </div>
                                        
                                    </div>

                                    
                                    <?php } else { ?>

                                    
                                    <div class="mrg10T">
                                        <span class="grey1"><?php echo $this->lang('admin_manageuser_username')?>:</span> <span class="txtsize00"><?php echo $D->username?></span>
                                    </div>
                                    
                                    <div class="mrg10T">
                                        <span class="grey1"><?php echo $this->lang('admin_manageuser_firstname')?>:</span> <span class="txtsize00"><?php echo $D->firstname?></span>
                                    </div>
                                    
                                    <div class="mrg10T">
                                        <span class="grey1"><?php echo $this->lang('admin_manageuser_lastname')?>:</span> <span class="txtsize00"><?php echo $D->lastname?></span>
                                    </div>
                                    
                                    <?php } ?>
                                
                            	</div>
                            
                            </div>
                        
                    </div>
                    
				</div>


                <?php if (($D->f_leveladmin<$D->me->leveladmin || $D->iduser == $D->me->iduser) || (!$D->isadministrador)) { ?>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                        <div class="title"><?php echo $this->lang('admin_manageuser_pass_subtitle6');?></div>
                        
                        <div class="spaceinfo">
                            
                            <div id="form06" class="mrg10B">
                            
                              <form id="formpassword" name="formvalidated" method="post" action="">

                                <div class="grey1"><?php echo $this->lang('admin_manageuser_pass_txt_newpass')?></div>
                                <div><input name="npassw" type="password" id="npassw" class="boxinput withbox" /></div>
                                <div class="mrg10T grey1"><?php echo $this->lang('admin_manageuser_pass_txt_reenternewpass')?></div>
                                <div><input name="npassw2" type="password" id="npassw2" class="boxinput withbox" /></div>                                                    
                                <div id="msgerror6" class="redbox"></div>
                                <div id="msgok6" class="yellowbox"></div>
                                <div class="mrg10T mrg5B">
                                <input type="submit" name="bsave6" id="bsave6" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                                </div>
                                
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                        <div class="title"><?php echo $this->lang('admin_manageuser_txtvalidated');?></div>
                        
                        <div class="spaceinfo">
                            
                            <div id="form04" class="mrg10B">
                            
                              <form id="formvalidated" name="formvalidated" method="post" action="">
                                <div class="grey1"><?php echo $this->lang('admin_manageuser_txtvalidated_msg')?></div>
                                <div class="mrg5T">
                                <select name="mvalidated" id="mvalidated" class="combobox">
                                    <option value="1" <?php echo(1==$D->validated?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_txtisvalidated')?></option>
                                    <option value="0" <?php echo(0==$D->validated?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_txtisnotvalidated')?></option>
                                </select>
                                </div>
                                                    
                                <div id="msgerror4" class="redbox"></div>
                                <div id="msgok4" class="yellowbox"></div>
                                <div class="mrg10T mrg5B">
                                <input type="submit" name="bsave4" id="bsave4" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                                </div>
                                
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <?php } ?>
                
                <?php if ($D->f_leveladmin<$D->me->leveladmin && $D->iduser != $D->me->iduser) { ?>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
	                    <div class="title"><?php echo $this->lang('admin_manageuser_subtitle3');?></div>
                        
                        <div class="spaceinfo">                
                    
		                    <div id="form01" class="mrg10B">
                    
                      <form id="formstatus" name="formstatus" method="post" action="">
                        <div class="grey1"><?php echo $this->lang('admin_manageuser_txtuserstatus')?></div>
                        <div class="mrg5T">
                        <select name="mstatus" id="mstatus" class="combobox">
                        	<option value="1" <?php echo(1==$D->active?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_active')?></option>
                            <option value="0" <?php echo(0==$D->active?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_inactive')?></option>
                        </select>
                        </div>
                                            
                        <div id="msgerror1" class="redbox"></div>
                        <div id="msgok1" class="yellowbox"></div>
                        <div class="mrg10T mrg5B">
                        <input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                        </div>
                        
                        </form>
                        
                    </div>
                    
                    	</div>
                        
                    </div>
                    
                </div>
                
                <?php } ?>
                
                <?php if ($D->me->leveladmin>1 && $D->iduser != $D->me->iduser) { ?>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                        <div class="title"><?php echo $this->lang('admin_manageuser_subtitle4');?></div>

						<div class="spaceinfo">
                            
                            <div id="form02" class="mrg10B">
                            
                              <form id="formlevel" name="formlevel" method="post" action="">
                                <div class="grey1"><?php echo $this->lang('admin_manageuser_txtleveluser')?></div>
                                <div class="mrg5T">
                                <select name="level" id="level" class="combobox">
                                    <option value="1" <?php echo(1==$D->isadministrador?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_isadministrator')?></option>
                                    <option value="0" <?php echo(0==$D->isadministrador?'selected="selected"':'')?>><?php echo $this->lang('admin_manageuser_notadministrator')?></option>
                                </select>
                                </div>
                                                    
                                <div id="msgerror2" class="redbox"></div>
                                <div id="msgok2" class="yellowbox"></div>
                                <div class="mrg10T mrg5B">
                                <input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('admin_txt_bsave')?>" class="bblue hand"/>
                                </div>
                                
                                </form>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <?php } ?>

                <?php if ($D->f_leveladmin<$D->me->leveladmin && $D->iduser != $D->me->iduser) { ?>
                
                <div class="editarea">
                
                	<div class="boxdash">
                
                        <div class="title"><?php echo $this->lang('admin_manageuser_subtitle5');?></div>
                        
                        <div class="spaceinfo">
                        
                        	<div id="form03" class="mrg10B">
                        
                          <form id="formdelete" name="formdelete" method="post" action="">
                            <div class="grey1"><?php echo $this->lang('admin_manageuser_txtdelete')?></div>
                                                
                            <div id="msgerror3" class="redbox"></div>
                            <div id="msgok3" class="yellowbox"></div>
                            <div class="mrg10T mrg5B">
                            <input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('admin_manageuser_bdelete')?>" class="bred hand"/>
                            
                            </div>
                            
                            </form>
                            
                        </div>
                        
                        </div>
                        
                    </div>

                    
                </div>
                
                <?php } ?>

            </div>
        
        
        </div>
        
        <div class="sh"></div>
    
    </div>
            
</div> 

<script>
	var admin_norequest = '<?php echo $this->lang('admin_no_request');?>';
	var uidd = <?php echo $D->iduser?>;
	
	$('#bsave1').click(function(){
		updateStatus('#msgerror1','#msgok1','#bsave1');
		return false;
	});
	
	$('#bsave2').click(function(){
		updateLevel('#msgerror2','#msgok2','#bsave2');
		return false;
	});
	
	var msgalert = '<?php echo $this->lang('admin_manageuser_txtalert');?>';
	var ppage = <?php echo $D->npage?>;
	$('#bsave3').click(function(){
		deleteUser('#msgerror3','#msgok3','#bsave3');
		return false;
	});
	
	$('#bsave4').click(function(){
		updateValidated('#msgerror4','#msgok4','#bsave4');
		return false;
	});

	var uinfo_msg01 = '<?php echo $this->lang('admin_manageuser_txt_error1');?>';
	var uinfo_msg02 = '<?php echo $this->lang('admin_manageuser_txt_error2');?>';
	var uinfo_msg03 = '<?php echo $this->lang('admin_manageuser_txt_error6');?>';
	var uinfo_msg04 = '<?php echo $this->lang('admin_manageuser_txt_error7');?>';
	$('#bsave5').click(function(){
		updateInfoUser('#msgerror5','#msgok5','#bsave5');
		return false;
	});


	var pass_msg1 = '<?php echo $this->lang('admin_manageuser_pass_txt_msg1');?>';
	var pass_msg2 = '<?php echo $this->lang('admin_manageuser_pass_txt_msg2');?>';
	var pass_msg3 = '<?php echo $this->lang('admin_manageuser_pass_txt_msg3');?>';
	$('#bsave6').click(function(){
		updatePass('#msgerror6','#msgok6','#bsave6');
		return false;
	});


</script>      

<?php
$this->load_template('_foot.php');
$this->load_template('_footer.php');
?>