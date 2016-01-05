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
	
	//We load the user's followers
	$D->totalfollowers = $this->db2->fetch_field('SELECT count(iduser) FROM users, relations WHERE iduser=subscriber AND leader='.$this->user->id);
	
	$r = $this->db2->query('SELECT iduser, code, firstname, lastname, username, avatar, num_posts, num_followers, num_following, validated FROM users, relations WHERE iduser=subscriber AND leader='.$this->user->id.' ORDER BY rltdate DESC LIMIT 0,'.$C->NUM_FOLLOWERS_PAGE);

	$D->numfollower = $this->db2->num_rows();

	$D->htmlFollowers = '';
	
	while( $obj = $this->db2->fetch_object($r) ) {
		$D->isThisUserVerified = $obj->validated==1?TRUE:FALSE;
		$D->f_name = (empty($obj->firstname) || empty($obj->lastname))?stripslashes($obj->username):(stripslashes($obj->firstname).' '.stripslashes($obj->lastname));
		$D->f_codeuser = $obj->code;
		$D->f_avatar = $obj->avatar;
		$D->f_numphotos = $obj->num_posts;
		$D->f_username = $obj->username;
		$D->htmlFollowers .= $this->load_template('__dashboard-one-follower.php', FALSE);
	}
	
	unset($r, $obj);	
	
	/*************************************************************************/


	$D->optionactive = 6;
	$this->load_template('dashboard-followers.php');
?>