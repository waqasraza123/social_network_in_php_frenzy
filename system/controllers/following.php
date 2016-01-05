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

		//We load the user's following
		$D->totalfollowing = $this->db2->fetch_field('SELECT count(iduser) FROM users, relations WHERE iduser=leader AND subscriber='.$D->u->iduser);
		
		$r = $this->db2->query('SELECT iduser, code, firstname, lastname, username, avatar, num_posts, num_followers, num_following, validated FROM users, relations WHERE iduser=leader AND subscriber='.$D->u->iduser.' ORDER BY rltdate DESC LIMIT 0,'.$C->NUM_FOLLOWING_PAGE);

		$D->numfollowing = $this->db2->num_rows();

		$D->htmlFollowing = '';
		
		while( $obj = $this->db2->fetch_object($r) ) {
			$D->isThisUserVerified = $obj->validated==1?TRUE:FALSE;
			$D->f_name = (empty($obj->firstname) || empty($obj->lastname))?stripslashes($obj->username):(stripslashes($obj->firstname).' '.stripslashes($obj->lastname));
			$D->f_codeuser = $obj->code;
			$D->f_avatar = $obj->avatar;
			$D->f_numphotos = $obj->num_posts;
			$D->f_username = $obj->username;
			$D->htmlFollowing .= $this->load_template('__profile-one-following.php', FALSE);
		}
		
		unset($r, $obj);
	}

	/*************************************************************************/
	
	$D->page_title = $D->nameUser.' - '.$this->lang('profile_following_title').' - '.$C->SITE_TITLE;
	
	$D->optionactive = 0;

	$this->load_template('following.php');
?>