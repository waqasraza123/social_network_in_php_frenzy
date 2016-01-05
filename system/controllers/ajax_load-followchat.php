<?php 
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('global/global.php');
	
	// We are here only if you're logged in
	if (!$this->user->is_logged) {
		echo('0: '.$this->lang('dashboard_no_session'));
		die();
	}
	
	$D->is_logged = 0;
	if ($this->user->is_logged) {
		$D->me = $this->user->info;
		$D->is_logged = 1;
	}

	$this->db2->query('SELECT avatar, username, lastname, firstname, lastclick FROM users, relations WHERE active=1 AND iduser=leader AND subscriber='.$D->me->iduser.' ORDER BY lastclick DESC LIMIT 15');

	$D->html_useronline = '';
	while($obj = $this->db2->fetch_object()) {
		if( $obj->lastclick < time() - 3*60 ) {
			break;
		}
		$D->username = $obj->username;
		$D->avatar = $obj->avatar;
		$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
		$D->html_useronline .= $this->load_template('__one-user-online.php',FALSE);
		//$data[]	= array('username' => $obj->username, 'avatar' => ((empty($obj->avatar))? $GLOBALS['C']->DEF_AVATAR_USER : $obj->avatar));
	}
	if (empty($D->html_useronline)) {
		echo('1: <p class="centered mrg20T">'.$this->lang('global_box_chat_txt_no_user').'</p>');
		return;		
	} else {
		echo('1: '.$D->html_useronline);
		return;		
	}

?>