<?php
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('global/global.php');
	$this->load_langfile('inside/dashboard.php');
	
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
	
	$errored = 0;
	$txterror = '';

	$numitems = $iduser = 0;
	
	if (isset($_POST["ni"]) && !empty($_POST["ni"])) $numitems = $this->db1->e($_POST["ni"]);
	if (isset($_POST["idu"]) && !empty($_POST["idu"])) $iduser = $this->db1->e($_POST["idu"]);
	
	if (!is_numeric($numitems) || $numitems <= 0) { $errored = 1; $txterror .= 'Error. '; }
	if (!is_numeric($iduser) || $iduser <= 0) { $errored = 1; $txterror .= 'Error. '; }
	
	if ($errored == 1) {
		echo('0: '.$txterror);
	} else {
		
		$FILTER_ACTION = ' (action=3 OR action=6) AND ';

		$itemsperpage = $C->NUM_ACTIVITIES_PAGE;
		
		$totalitems = $this->db2->fetch_field('SELECT count(DISTINCT activities.id) FROM relations, activities WHERE '.$FILTER_ACTION.' ((subscriber='.$this->user->id.' AND activities.iduser=leader) OR activities.iduser='.$this->user->id.')');
	
		// first extract the ids of the activities
		$idsactivities = $this->db2->fetch_all('SELECT DISTINCT activities.id FROM relations, activities WHERE '.$FILTER_ACTION.' ((subscriber='.$this->user->id.' AND activities.iduser=leader) OR activities.iduser='.$this->user->id.') ORDER BY activities.date DESC LIMIT '.$numitems.','.$itemsperpage);
	
		
		$theactivities = new stdClass;
	
		foreach($idsactivities as $oneida) $arridsact[] = $oneida->id;
	
		if (count($arridsact)>0) {
			$theactivities = $this->db2->fetch_all('SELECT activities.iduser, action, idresult, iduser2, iditem, date, username, firstname, lastname, avatar, registerdate, users.code as ucode FROM activities, users WHERE (users.iduser=activities.iduser) AND activities.id in('.implode($arridsact,',').') ORDER BY date DESC');
		}
		
		$numitemsnow = count($theactivities);
		
	
		// see if there is "follows" and group the user ids seconds
		$usersseconds = array();
		foreach($theactivities as $oneactivity) {
			if ($oneactivity->action == 1) {
				$usersseconds[] = $oneactivity->iduser2;
			}
		}
		if (count($usersseconds) > 0) $following = $this->db2->fetch_all('SELECT code, iduser, username, firstname, lastname, avatar, num_posts, validated FROM users WHERE iduser in ('.implode($usersseconds,',').')');
		unset($usersseconds);
		/*********************************************************/
	
		$htmlResults = '';
		
		foreach($theactivities as $oneactivity) {
	
			$D->userName = $oneactivity->username;
			$D->nameUser = (empty($oneactivity->firstname) || empty($oneactivity->lastname))?$oneactivity->username:($oneactivity->firstname.' '.$oneactivity->lastname);
			$D->userAvatar = $oneactivity->avatar;
			$D->isThisUserVerified0 = $this->network->isUserVerified($oneactivity->iduser);
			
			switch ($oneactivity->action) {
				case 1:
					//following
					break;
				
				case 2:
					// in case de hability albums
					break;
				
				case 3:
				case 6:
					$D->a_date = $oneactivity->{'date'};
					$D->codeUser = $oneactivity->ucode;
					
					$D->isShare=0;
					if ($oneactivity->action ==3 ) { $D->idpost = $oneactivity->iditem; $D->idpostShared = $oneactivity->iditem; }
					if ($oneactivity->action ==6 ) { $D->idpost = $oneactivity->idresult; $D->idpostShared = $oneactivity->iditem; $D->isShare=1; }
					
					$D->codepost = $this->network->getCodePost($D->idpost);
					$onePost = new post($D->codepost);
					$D->idUser = $onePost->iduser;
					$D->typepost = $onePost->typepost;
					$D->numlikes = $onePost->numlikes;
					$D->numcommentstotal = $onePost->numcomments;
					$D->post = stripslashes($onePost->post);
					$D->valueattach = $onePost->valueattach;
					
					// see if the favorite is for the observer
					$D->liketoUser = 0;
					if ($D->is_logged == 1) {
						if ($onePost->likeOfUser($this->user->id) > 0) $D->liketoUser = 1;
					}
					
					$D->htmlcommentspost = '';
					$D->totalcomments = $onePost->numComments();
					$allcommentspost = $onePost->getComments(0,$C->NUM_COMMENTS_PER_POST);
					$D->numcomments = count($allcommentspost);
					
					$allcommentspost = array_reverse($allcommentspost);	
					
					foreach($allcommentspost as $onecomment){
						$D->o_comment = stripslashes($onecomment->comment);
						$D->o_username = stripslashes($onecomment->username);
						$D->o_firstname = stripslashes($onecomment->firstname);
						$D->o_lastname = stripslashes($onecomment->lastname);
						$D->o_ucode = $onecomment->ucode;
						$D->o_nameUser = (empty($D->o_firstname) || empty($D->o_lastname))?stripslashes($D->o_username):(stripslashes($D->o_firstname).' '.stripslashes($D->o_lastname));
						$D->o_whendate = $onecomment->whendate;
						$D->o_avatar =  empty($onecomment->avatar)?$C->AVATAR_DEFAULT:$onecomment->avatar;
						$D->o_idcomment = $onecomment->idcomment;
						$D->o_idUser = $onecomment->iduser;
						$D->o_idpost = $D->idpost;
						$D->o_idUserOwner = $D->idUser;
						$D->o_codepost = $D->codepost;
						$D->htmlcommentspost .= $this->load_template('__dashboard-onecomment-post.php', FALSE);
					}
					unset($onecomment);
					
					$D->htmlpostshare = '';
					if ($D->isShare == 1) {
	
						$D->codepostSh = $this->network->getCodePost($D->idpostShared);
						$onePostSh = new post($D->codepostSh);
						if (!$onePostSh->error) {
							$D->a_dateSh = $onePostSh->whendate;
							$D->idUserSh = $onePostSh->iduser;
							$D->typepostSh = $onePostSh->typepost;
							$D->postSh = stripslashes($onePostSh->post);
							$D->valueattachSh = $onePostSh->valueattach;
		
		
							$usSh = $this->network->get_user_by_id($D->idUserSh);
							$D->userNameSh = $usSh->username;
							$D->nameUserSh = (empty($usSh->firstname) || empty($usSh->lastname))?$usSh->username:($usSh->firstname.' '.$usSh->lastname);
							$D->codeUserSh = $usSh->code;
							$D->userAvatarSh = $usSh->avatar;					
		
							$D->htmlpostshare .= $this->load_template('__dashboard-one-share-post.php', FALSE);//'Share';
						} else {
							$D->idpostShared = $D->idpost;
							$D->htmlpostshare .= $this->load_template('__dashboard-one-share-post-nofound.php', FALSE);
						}
						unset($onePostSh);
					}
					
					if ($D->isShare == 1) $htmlResults .= $this->load_template('__dashboard-activity-one-post-shared.php', FALSE);
					else $htmlResults .= $this->load_template('__dashboard-activity-one-post.php', FALSE);

					unset($onePost);
					break;				
				case 4:
					//if comment a post
					break;
					
				case 5:
					// If add a post to your favorites
					break;
				
			}
		}

		if ($totalitems <= ($numitemsnow + $numitems) ) {
			echo("2: ".$htmlResults);
			return;
		} else {
			echo("1: ".$htmlResults);
			return;	
		}			
	}
?>