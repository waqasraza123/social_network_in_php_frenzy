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
	
	//We load the user's following
	$D->totalfollowing = $this->db2->fetch_field('SELECT count(iduser) FROM users, relations WHERE iduser=leader AND subscriber='.$this->user->id);
	
	$r = $this->db2->query('SELECT iduser, code, firstname, lastname, username, avatar, num_posts, num_followers, num_following, validated FROM users, relations WHERE iduser=leader AND subscriber='.$this->user->id.' ORDER BY rltdate DESC LIMIT 0,'.$C->NUM_FOLLOWING_PAGE);

	$D->numfollowing = $this->db2->num_rows();
	
	$D->htmlFollowing = '';
	
	while( $obj = $this->db2->fetch_object($r) ) {
		$D->isThisUserVerified = $obj->validated==1?TRUE:FALSE;
		$D->f_name = (empty($obj->firstname) || empty($obj->lastname))?stripslashes($obj->username):(stripslashes($obj->firstname).' '.stripslashes($obj->lastname));
		$D->f_codeuser = $obj->code;
		$D->f_avatar = $obj->avatar;
		$D->f_numphotos = $obj->num_posts;
		$D->f_username = $obj->username;
		$D->htmlFollowing .= $this->load_template('__dashboard-one-following.php', FALSE);
	}
	
	unset($r, $obj);

	/*************************************************************************/

	$D->optionactive = 7;
	$this->load_template('dashboard-following.php');
?>