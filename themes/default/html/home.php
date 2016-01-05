<?php
$this->load_template('_home-header.php');
$this->load_template('_top.php');
?>
<style>
html{ overflow: hidden; }
</style>
<script src="<?php echo $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_login.js"></script>
<script src="<?php echo $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/js_register.js"></script>
<script src="<?php echo $C->SITE_URL ?>themes/<?php echo $C->THEME ?>/js/md5.js"></script>
<div id="backhome">
    <div class="theimg" id="theimg3"></div>
    <div class="theimg" id="theimg2"></div>
    <div class="theimg" id="theimg1"></div>
</div>
<div class="sh"></div>
<div id="sectionLogin">
	<div id="container">
    	
		<div class="centered"><img src="<?php echo $C->SITE_URL.'themes/'.$C->THEME?>/imgs/logo-home.png"></div>
        <div id="boxHome">
            <div id="topmsg" class="centered">
                <div id="line01"><?php echo $this->lang('home_msg_line1')?></div>
            </div>
            <div id="areabotton" class="centered">
            	<a href="<?php echo $D->fb_loginUrl; ?>" class="undecorated"><div class="bfb btlog"><?php echo $this->lang('home_msg_btfb')?></div></a>
                <div class="beml btlog mrg20T"><?php echo $this->lang('home_msg_bteml')?></div>
                <div class="beml btlog mrg20T"><span id="lnklogin" class="hand"><?php echo "Login";?></span></div>
            </div>
        </div>
        <!--<div class="sign_up_page_right_side" style="float:right;">
		<p class="sign_up_page_right_side_headline">End Semester Project</p>
		<p><span class="sign_up_page_right_side_headline_second">Developed By</span><br/><span class="sign_up_page_right_side_content">Waqas Raza<br />Faran Shahid<br />Jahanzaib Ahmed<br />Adeen-ur-Rehman</span></p>
		</div>-->
        <div id="tryLogin">

            <div id="arealogin">
            	<div id="xarealg" style="float:right; cursor:pointer; color:#FFF; font-weight:bold; text-shadow:0 0 10px #000;">x</div>
            	<div class="titlelogin mrg20B"><?php echo $this->lang('home_f_login_tl'); ?></div>
                <form id="formlogin" name="formlogin" method="post">
                <div class="pdn10R"><input type="text" name="usernamel" id="usernamel" class="form-control" placeholder="<?php echo $this->lang('home_f_login_un')?>"></div>
                <div class="pdn10R mrg10T"><input type="password" name="passwordl" id="passwordl" class="form-control" placeholder="<?php echo $this->lang('home_f_login_pw')?>"></div>
                <div id="errorlogin" class="alert-error mrg10T pdn10 centered hide"></div>
                <div class="mrg10T">
                    <div class="fleft"><button id="btlogin" name="btlogin" type="submit" class="btn btn-sky"><?php echo $this->lang('home_f_login_bt')?></button></div>
                    <div id="linkrecovery" class="fright mrg10T white mrg5T hand"><?php echo $this->lang('home_f_recovery_txtlink')?></div>
                    <div class="sh"></div>
                </div>
                </form>
            </div>
            
            <div id="arearecovery" class="hide">
            	<div id="xarearec" style="float:right; cursor:pointer; color:#FFF; font-weight:bold; text-shadow:0 0 10px #000;">x</div>
            	<div class="titlerecv mrg20B"><?php echo $this->lang('home_f_recovery_txtlink'); ?></div>
                <form id="formrecovery" name="formrecovery" method="post">
                <div class="pdn10R"><input type="text" name="emailrecovery" id="emailrecovery" class="form-control" placeholder="<?php echo $this->lang('home_f_recovery_inputemail')?>"></div>
                <div id="errorrecovery" class="alert-error mrg10T pdn10 centered hide"></div>
                <div id="okrecovery" class="alert-success mrg10T pdn10 centered hide"></div>
                <div class="mrg10T">
                    <div><button id="btrecovery" name="btrecovery" type="submit" class="btn btn-orange"><?php echo $this->lang('home_f_recovery_brecovery')?></button></div>
                    
                    <div class="sh"></div>
                </div>
                </form>
            </div>

        </div>
        
        <div id="tryRegister">

            <div id="areasignup">
            	<div id="xareasgnu" style="float:right; cursor:pointer; color:#FFF; font-weight:bold; text-shadow:0 0 10px #000;">x</div>
                <div class="titlesignup mrg10B"><?php echo $this->lang('home_f_signup_tl');?></div>
                <form id="formregister" name="formregister" method="post">
                <div class="pdn10R"><input type="text" name="email" id="email" class="form-control" placeholder="Your Email address"></div>
                <div class="pdn10R mrg10T"><input type="text" name="usernamer" id="usernamer" class="form-control" placeholder="user name for login i.e steve123"></div>
                <div class="pdn10R mrg10T"><input type="password" name="passwordr" id="passwordr" class="form-control" placeholder="<?php echo $this->lang('home_f_signup_pw')?>"></div>
                <div class="mrg10T">
                    <?php echo getCaptcha()?>
                    <div><input type="text" name="captcha" id="captcha" class="form-control width50c" placeholder="write sum of <?php echo $C->ctcha1?> + <?php echo $C->ctcha2?>"></div>
                    <div class="sh"></div>
                </div>
                <div id="errorsignup" class="alert-error mrg10T pdn10 centered hide"></div>
                <div class="mrg10T">
                    <div><button id="btsignup" name="btsignup" type="submit" class="btn btn-green"><?php echo $this->lang('home_f_signup_bt')?></button></div>
                    
                    <div class="sh"></div>
                </div>
                </form>
            </div>
            
            <div id="registerok" class="hide"></div>
			

        </div>
        
        
    </div>
    
</div>


<script>
	img1 = 'url(<?php echo $C->SITE_URL.$C->FOLDER_BGHOME.$C->BGHOME01?>)';
	img2 = 'url(<?php echo $C->SITE_URL.$C->FOLDER_BGHOME.$C->BGHOME02?>)';
	img3 = 'url(<?php echo $C->SITE_URL.$C->FOLDER_BGHOME.$C->BGHOME03?>)';

	widthWindow = $(window).width();
	var styles1 = {
      'background-image': img1,
      'width': '100%',
	  'display': 'none',
	  'z-index': 2,
    };
	var styles2 = {
      'background-image': img2,
      'width': '100%',
	  'display': 'none',
	  'z-index': 3,
    };
	var styles3 = {
      'background-image': img3,
      'width': '100%',
	  'display': 'none',
	  'z-index': 4,
    };

    $('#theimg1').css(styles1);
    $('#theimg2').css(styles2);
    $('#theimg3').css(styles3);
	
	$(window).resize(function(){
		$('#theimg1, #theimg2, #theimg3').css('width','100%');
		//$('#theimg1, #theimg2, #theimg3').css('height',$(window).height());
	});
	
	var posIniBGraph = 3;
	var posEndBGraph = 1;
	function animatedBGhome(){
		$('#theimg' + posIniBGraph).animate({opacity:0},1000,function(){ $(this).css('display','none'); });
		if (posIniBGraph - 1 < posEndBGraph) posIniBGraph = 3;
		else posIniBGraph = posIniBGraph - 1;
		$('#theimg' + posIniBGraph).css('display','block');
		$('#theimg' + posIniBGraph).animate({opacity:1},1000);
		
		timerAnimated = setTimeout(animatedBGhome, 5000);	
	}
	
	animatedBGhome();

	$("#lnklogin").click(function(){
		$('#boxHome').slideUp('slow', function(){
			$('#tryLogin').slideDown('slow');
		});
		return false;
	});	

	$("#xarealg").click(function(){
		$('#tryLogin').slideUp('slow', function(){
			$('#boxHome').slideDown('slow');
		});
		return false;
	});	
	
	$('#xarearec').click(function(){
		$('#arearecovery').slideUp('slow', function(){
			$('#arealogin').slideDown('slow');
		});
		return false;
	})
	
	$(".beml").click(function(){
		$('#boxHome').slideUp('slow', function(){
			$('#tryRegister').slideDown('slow');
		});
		return false;
	});	
	
	$("#xareasgnu").click(function(){
		$('#tryRegister').slideUp('slow', function(){
			$('#boxHome').slideDown('slow');
		});
		return false;
	});
	
	var rtxterror1 = '<?php echo $this->lang('home_f_signup_error1')?>';
	var rtxterror2 = '<?php echo $this->lang('home_f_signup_error2')?>';
	var rtxterror3 = '<?php echo $this->lang('home_f_signup_error3')?>';
	var rtxterror4 = '<?php echo $this->lang('home_f_signup_error4')?>';
	var rtxterror5 = '<?php echo $this->lang('home_f_signup_error8')?>';
	$('#btsignup').click(function(){
		actionRegister('#btsignup', '#errorsignup', '#areasignup', '#registerok');
		return false;
	})	
	
	var ltxterror1 = '<?php echo $this->lang('home_f_login_error1')?>';
	var ltxterror2 = '<?php echo $this->lang('home_f_login_error2')?>';
	var ltxterror3 = '<?php echo $this->lang('home_f_login_error3')?>';
	var ltxterror4 = '<?php echo $this->lang('home_f_login_error4')?>';
	var txtconnerror = '<?php echo $this->lang('home_f_txtconnerror')?>';
	$('#btlogin').click(function(){
		actionLogin('#btlogin', '#errorlogin');
		return false;
	})
	
	$('#linkrecovery').click(function(){
		$('#arealogin').slideUp('slow', function(){
			$('#arearecovery').slideDown('slow');
		});
		return false;
	})
	
	var recvtxterror1 = '<?php echo $this->lang('home_f_recovery_error1')?>';
	$('#btrecovery').click(function(){
		actionRecovery('#btrecovery', '#errorrecovery', '#okrecovery');
		return false;
	})	

</script>
<div id="container">
<?php
$this->load_template('_home-foot.php');
?>
</div>
<?php
$this->load_template('_footer.php');
?>