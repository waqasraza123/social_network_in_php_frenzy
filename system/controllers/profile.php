<?php

	if( !$this->network->id ) {
		$this->redirect('home');
	}
	
	// We check if the site is open to all
	if ($C->PROTECT_OUTSIDE_PAGES && !$this->user->is_logged) {
		$this->redirect('home');
	}
	
	// Obtain user data profile
	$D->u = $this->network->get_user_by_id(intval($this->params->iduser));
	if( !$D->u ) {
		$this->redirect('dashboard');
	}
	
	/*************************************************************************/
	// needed before proceeding
	require_once('_all-required-language.php');
	
	/*************************************************************************/

	$this->load_langfile('global/global.php');	
	$this->load_langfile('outside/profile.php');

	/*************************************************************************/

	// needed before proceeding
	require_once('_all-required-profile.php');
	
	/*************************************************************************/

	// If allowed, it loaded data required for this section
	if ($D->show_profile==1) {
		
		$FILTER_ACTION = ' (action=3 OR action=6) AND ';

		$D->totalactivities = $this->db2->fetch_field('SELECT count(id) FROM activities WHERE '.$FILTER_ACTION.' iduser='.$D->u->iduser);

		$theactivities = $this->db2->fetch_all('SELECT activities.iduser, iduser2, action, idresult, iditem, date, username, firstname, lastname, avatar, users.code as ucode FROM activities, users WHERE '.$FILTER_ACTION.' ((users.iduser=activities.iduser) AND activities.iduser='.$D->u->iduser.') ORDER BY date DESC LIMIT 0,'.$C->NUM_ACTIVITIES_PAGE);

		$D->numactivities = count($theactivities);
		
		$D->nameUser = (empty($D->u->firstname) || empty($D->u->lastname))?$D->u->username:($D->u->firstname.' '.$D->u->lastname);
		 
		// see if there are "follows" and we group the user ids seconds
		$secondsids = array();
		foreach($theactivities as $oneactivity) {
			if ($oneactivity->action == 1 && $oneactivity->iduser2 != 0) $secondsids[] = $oneactivity->iduser2;
		}
		
		if (count($secondsids) > 0) {
			$following = $this->db2->fetch_all('SELECT iduser, username, firstname, lastname, avatar, num_posts, validated FROM users WHERE iduser in ('.implode($secondsids,',').')');
		}
		/////////
		
		$D->htmlResult = '';
		
		foreach($theactivities as $theactivity) {
			
			$D->userName = $theactivity->username;
			$D->nameUser = (empty($theactivity->firstname) || empty($theactivity->lastname))?$theactivity->username:($theactivity->firstname.' '.$theactivity->lastname);
			$D->userAvatar = $theactivity->avatar;
			$D->isThisUserVerified0 = $this->network->isUserVerified($theactivity->iduser);
			
			switch ($theactivity->action) {
				case 1:
					//following
					break;
				
				case 2:
					// in case de hability albums
					break;
				
				case 3:
				case 6:
					$D->a_date = $theactivity->{'date'};
					$D->codeUser = $theactivity->ucode;
					
					$D->idpost = $theactivity->iditem;

					$D->isShare=0;
					if ($theactivity->action ==3 ) { $D->idpost = $theactivity->iditem; $D->idpostShared = $theactivity->iditem; }
					if ($theactivity->action ==6 ) { $D->idpost = $theactivity->idresult; $D->idpostShared = $theactivity->iditem; $D->isShare=1; }
					
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
						$D->htmlcommentspost .= $this->load_template('__profile-onecomment-post.php', FALSE);
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

					if ($D->isShare == 1) $D->htmlResult .= $this->load_template('__profile-activity-one-post-shared.php', FALSE);
					else $D->htmlResult .= $this->load_template('__profile-activity-one-post.php', FALSE);

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
		
		//ponemos el dia de registro del perfil
		if ($D->totalactivities<=$C->NUM_ACTIVITIES_PAGE) $D->htmlResult .= $this->load_template('__profile-info-register.php', FALSE);
		///////////////////////////////////////

	}

	/*************************************************************************/

	$D->page_title = $D->nameUser.' - '.$this->lang('profile_activities_title').' - '.$C->SITE_TITLE;
	
	$D->optionactive = 1;	
	$this->load_template('profile.php');
?>