<?php 
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('inside/dashboard.php');
	$this->load_langfile('global/global.php');

	$errored = 0;
	$txterror = '';


	$coduser = '';
	
	if (isset($_POST["c"]) && $_POST["c"]!='') $coduser = $this->db1->e($_POST["c"]);
	
	if (empty($coduser)) { $errored = 1; $txterror .= 'Error. '; }		
	
	if ($errored == 1) {
		echo('0: '.$txterror);
	} else {

		$obj = $this->db1->fetch("SELECT * FROM users WHERE code='".$coduser."' LIMIT 1");
		$D->cover = $obj->cover;
		$D->avatar = $obj->avatar;
		$D->isUserVerified = $obj->validated;
		$D->username = $obj->username;
		$D->num_posts = $obj->num_posts;
		$D->num_followers = $obj->num_followers;
		$D->num_following = $obj->num_following;
		$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
		$txtreturn = $this->load_template('__userCard.php', FALSE);	
		if (empty($obj->cover)) echo('2: '.$txtreturn);
		else echo('1: '.$txtreturn);
		return;
	
	}
?>