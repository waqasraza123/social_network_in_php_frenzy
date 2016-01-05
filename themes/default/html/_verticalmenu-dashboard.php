<?php

if ($D->is_logged == 1) {
	$txtuser = '';
	if (empty($D->me->firstname)) $txtuser = $D->me->username;
	else $txtuser = $D->me->firstname . ' ' .$D->me->lastname;
	
	if (empty($D->me->avatar)) $txtavatar = 'default.jpg';
	else $txtavatar = $D->me->avatar;
}
?>
<div id="dashboard1">

  <div id="boxmenu">

 <div class="sign_up_page_right_side" style="float:right;">
		<div class="vertical_left_bar_heading_box"><p class="vertical_left_bar_heading">End Semester Project</p>
		<p><span class="vertical_left_bar_heading_second">Developed By<hr></span></div><br/><span class="vertical_left_bar_heading_content">Waqas Raza<br />Faran Shahid<br />Jahanzaib<br />Adeen</span><br/><br/><a href="http://www.techtweet.org/contact-us/" target="_blank">Contact Admin</a></p>
		</div>
	</div>

</div>