<?php
	if( !$this->user->is_logged ) {
		$this->redirect('home');
	}
	
	/*************************************************************************/
	// needed before proceeding
	require_once('_all-required-language.php');
	
	$this->load_langfile('global/global.php');	
	$this->load_langfile('inside/dashboard.php');

	/*************************************************************************/
	
	require_once('_all-required-dashboard.php');

	/*************************************************************************/
	
	//We load the likes
	$D->totallikes = $this->db2->fetch_field('SELECT count(idlike) FROM likes WHERE iduser='.$this->user->id);
	
	$r = $this->db2->query('SELECT idlike, posts.*, username, firstname, lastname, avatar, users.iduser, users.code as ucode FROM likes, posts, users WHERE likes.iduser='.$this->user->id.' AND likes.idpost=posts.idpost AND posts.iduser=users.iduser ORDER BY likes.datewhen DESC LIMIT 0,'.$C->NUM_FAVORITES_PAGE);

	$D->numitems = $this->db2->num_rows();

	$D->htmlLikes = '';
	
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

				$D->htmlpostshare .= $this->load_template('__dashboard-one-share-post.php', FALSE);//'Share';
			} else {
				$D->idpostShared = $D->idpost;
				$D->htmlpostshare .= $this->load_template('__dashboard-one-share-post-nofound.php', FALSE);
			}
			unset($onePostSh);
		}
		
		if ($D->isShare == 1) $D->htmlLikes .= $this->load_template('__dashboard-activity-one-post-shared.php', FALSE);
		else $D->htmlLikes .= $this->load_template('__dashboard-activity-one-post.php', FALSE);

		unset($onePost);
	}
	
	unset($r, $obj);	

	/*************************************************************************/

	$D->optionactive = 4;
	$this->load_template('dashboard-mylikes.php');
?>