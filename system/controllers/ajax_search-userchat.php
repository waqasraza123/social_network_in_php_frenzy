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
	
	$squery = '';

	if (isset($_POST["q"]) && !empty($_POST["q"])) $squery = $this->db1->e($_POST["q"]);
	
	if (empty($squery)) { $errored = 1; $txterror .= 'Error'; }

	if ($errored == 1) {
		$cadreturn = $txterror;
		echo($cadreturn);
	} else {

		// Search in following
		$this->db2->query("SELECT avatar, username, lastname, firstname, lastclick FROM users, relations WHERE active=1 AND iduser=leader AND subscriber=".$D->me->iduser." AND ( username like '%".$squery."%' OR firstname like '%".$squery."%' OR lastname like '%".$squery."%') ORDER BY lastclick DESC LIMIT 15");
	
		
		$D->html_useronline = '';
		while($obj = $this->db2->fetch_object()) {
			$D->isonline = 1;
			if( $obj->lastclick < time() - 3*60 ) {
				$D->isonline = 0;
			}
			$D->username = $obj->username;
			$D->avatar = $obj->avatar;
			$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
			$D->html_useronline .= $this->load_template('__one-user-boxchat.php',FALSE);
		}
		
		// Search in follower
		if (empty($D->html_useronline)) {
			
			$this->db2->query("SELECT avatar, username, lastname, firstname, lastclick FROM users, relations WHERE active=1 AND iduser=subscriber AND leader=".$D->me->iduser." AND ( username like '%".$squery."%' OR firstname like '%".$squery."%' OR lastname like '%".$squery."%') ORDER BY lastclick DESC LIMIT 15");
		
			
			$D->html_useronline = '';
			while($obj = $this->db2->fetch_object()) {
				$D->isonline = 1;
				if( $obj->lastclick < time() - 3*60 ) {
					$D->isonline = 0;
				}
				$D->username = $obj->username;
				$D->avatar = $obj->avatar;
				$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
				$D->html_useronline .= $this->load_template('__one-user-boxchat.php',FALSE);
			}
			
			// Search in other
			if (!empty($D->html_useronline)) {
				$D->html_useronline = '<div class="bold centered" style="font-size:10px; margin:0 0 5px; color:#666;">'.$this->lang('global_box_chat_txt_in_followers').'</div>' . $D->html_useronline;
			} else {
			
				$this->db2->query("SELECT avatar, username, lastname, firstname, lastclick FROM users WHERE active=1 AND iduser<>".$D->me->iduser." AND ( username like '%".$squery."%' OR firstname like '%".$squery."%' OR lastname like '%".$squery."%') ORDER BY lastclick DESC LIMIT 15");
			
				
				$D->html_useronline = '';
				while($obj = $this->db2->fetch_object()) {
					$D->isonline = 1;
					if( $obj->lastclick < time() - 3*60 ) {
						$D->isonline = 0;
					}
					$D->username = $obj->username;
					$D->avatar = $obj->avatar;
					$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
					$D->html_useronline .= $this->load_template('__one-user-boxchat.php',FALSE);
				}
				
				if (!empty($D->html_useronline)) {
					$D->html_useronline = '<div class="bold centered" style="font-size:10px; margin:0 0 5px; color:#666;">'.$this->lang('global_box_chat_txt_in_others').'</div>' . $D->html_useronline;
				} else {

				}
				
			}
			
		}		
		
		
		
		if (empty($D->html_useronline)) {
			echo('1: <div class="centered mrg20T">'.$this->lang('global_box_chat_txt_no_result_search').'</div>');
			return;		
		} else {
			echo('1: '.$D->html_useronline);
			return;		
		}
	
	}

?>