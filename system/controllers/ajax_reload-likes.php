<?php 
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('global/global.php');
	$this->load_langfile('outside/profile.php');
	
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
		
		$itemsperpage = $C->NUM_FAVORITES_PAGE;
		
		$D->u = $this->network->get_user_by_id(intval($iduser));
		
		$totalitems = $this->db2->fetch_field("SELECT count(idlike) FROM likes WHERE iduser=".$D->u->iduser);
		
		$r = $this->db2->query('SELECT idlike, posts.*, username, firstname, lastname, avatar, users.iduser, users.code as ucode FROM likes, posts, users WHERE likes.iduser='.$D->u->iduser.' AND likes.idpost=posts.idpost AND posts.iduser=users.iduser ORDER BY likes.datewhen DESC LIMIT '.$numitems.','.$itemsperpage);
	
		$numitemsnow = $this->db2->num_rows();
		
		$htmlResults = '';
		
		while( $obj = $this->db2->fetch_object($r) ) {
			
			$D->userName = $obj->username;
			$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
			$D->userAvatar = $obj->avatar;
			$D->isThisUserVerified0 = $this->network->isUserVerified($obj->iduser);
			
			$D->a_date = $obj->whendate;
			$D->codeUser = $obj->ucode;
			
			$D->idpost = $obj->idpost;
			
			$D->idpostShared = $D->idpost;
					
			$D->isShare=0;
			if ($obj->typepost=='share') {
				$infop = explode(':',$obj->valueattach);
				$D->idpostShared = $infop[0];
				$D->isShare=1;
			}
			
			$D->codepost = $this->network->getCodePost($D->idpost);
			$onePost = new post($D->codepost);
			$D->idUser = $onePost->iduser;
			$D->typepost = $onePost->typepost;
			$D->numlikes = $onePost->numlikes;
			$D->numcommentstotal = $onePost->numcomments;
			$D->post = stripslashes($onePost->post);
			$D->typepost = $onePost->typepost;
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
	
					$D->htmlpostshare .= $this->load_template('__profile-one-share-post.php', FALSE);//'Share';
				} else {
					$D->idpostShared = $D->idpost;
					$D->htmlpostshare .= $this->load_template('__profile-one-share-post-nofound.php', FALSE);
				}
				unset($onePostSh);
			}
			
			if ($D->isShare == 1) $htmlResults .= $this->load_template('__profile-activity-one-post-shared.php', FALSE);
			else $htmlResults .= $this->load_template('__profile-activity-one-post.php', FALSE);

			unset($onePost);
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