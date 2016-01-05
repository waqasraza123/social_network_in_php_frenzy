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

	$numitems = 0;
	$query = '';
	
	if (isset($_POST["ni"]) && !empty($_POST["ni"])) $numitems = $this->db1->e($_POST["ni"]);
	if (isset($_POST["q"]) && !empty($_POST["q"])) $query = $this->db1->e($_POST["q"]);
	
	if (!is_numeric($numitems) || $numitems <= 0) { $errored = 1; $txterror .= 'Error. '; }
	if (empty($query)) { $errored = 1; $txterror .= 'Error. '; }
	
	if ($errored == 1) {
		echo('0: '.$txterror);
	} else {
		
		$itemsperpage = $C->NUM_SEARCH_PAGE;
		
		$D->allresults = $this->db2->fetch_all("SELECT DISTINCT idpost FROM trends WHERE trend='".$query."'");
		
		$totalitems = count($D->allresults);
		
		if ($totalitems > 0) {
			
			$idsposts = array();
			foreach($D->allresults as $oneresult) $idsposts[] = $oneresult->idpost;
			
			$r = $this->db2->query('SELECT posts.*, username, firstname, lastname, avatar, users.iduser FROM posts, users WHERE idpost in ('.implode($idsposts,',').') AND posts.iduser=users.iduser ORDER BY posts.whendate DESC LIMIT '.$numitems.','.$itemsperpage);
		
			$numitemsnow = $this->db2->num_rows();
			
			$htmlResults = '';
			
			ob_start();
		
			while( $obj = $this->db2->fetch_object($r) ) {
			
				$D->userName = $obj->username;
				$D->nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
				$D->userAvatar = $obj->avatar;
				$D->isThisUserVerified0 = $this->network->isUserVerified($obj->iduser);
				
				$D->a_date = $obj->whendate;
				
				$D->idpost = $obj->idpost;
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
					ob_start();
					$D->o_comment = stripslashes($onecomment->comment);
					$D->o_username = stripslashes($onecomment->username);
					$D->o_firstname = stripslashes($onecomment->firstname);
					$D->o_lastname = stripslashes($onecomment->lastname);
					$D->o_nameUser = (empty($D->o_firstname) || empty($D->o_lastname))?stripslashes($D->o_username):(stripslashes($D->o_firstname).' '.stripslashes($D->o_lastname));
					$D->o_whendate = $onecomment->whendate;
					$D->o_avatar =  empty($onecomment->avatar)?$C->AVATAR_DEFAULT:$onecomment->avatar;
					$D->o_idcomment = $onecomment->idcomment;
					$D->o_idUser = $onecomment->iduser;
					$D->o_idpost = $D->idpost;
					$D->o_idUserOwner = $D->idUser;
					$D->o_codepost = $D->codepost;
					$this->load_template('__profile-onecomment-post.php');
					$D->htmlcommentspost .= ob_get_contents();
					ob_end_clean();
				}
				unset($onecomment);
				
				$this->load_template('__profile-activity-one-post.php');
				unset($onePost);
			}
			$htmlResults = ob_get_contents();
			ob_end_clean();

		
		
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