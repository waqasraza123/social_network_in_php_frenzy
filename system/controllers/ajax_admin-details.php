<?php 
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('inside/admin.php');

	// We are here only if you're logged in
	if (!$this->user->is_logged || !$this->user->info->is_network_admin) {
		echo('0: '.$this->lang('admin_no_session'));
		die();
	}
	
	$errored = 0;
	$txterror = '';
	
	$action=0;
	
	if (isset($_POST["todo"]) && $_POST["todo"] != '') $action = $this->db1->e($_POST["todo"]);
	if (!is_numeric($action)) {
		$errored = 1;
		$txterror .= 'Error. ';
		echo('0: '.$caderror);
		die();
	}
	
	if ($action == 1)	{
		$status = -1;
		$uid = 0;
		if (isset($_POST["st"]) && $_POST["st"]!='') $status = $this->db1->e($_POST["st"]);
		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if ($status == -1) { $errored = 1; $txterror .= 'Error... '; }
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
	}
	
	if ($action == 2)	{
		$level = -1;
		$uid = 0;
		if (isset($_POST["lv"]) && $_POST["lv"]!='') $level = $this->db1->e($_POST["lv"]);
		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if ($level == -1) { $errored = 1; $txterror .= 'Error... '; }
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
		
		if ($level==1) {
			$levelnivel = 1;
		} else {
			$levelnivel = 0;
		}
	}
	
	if ($action == 3)	{
		$uid = 0;

		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
	}
	
	if ($action == 4)	{
		$mvalidated = -1;
		$uid = 0;
		if (isset($_POST["mv"]) && $_POST["mv"]!='') $mvalidated = $this->db1->e($_POST["mv"]);
		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if ($mvalidated == -1) { $errored = 1; $txterror .= 'Error... '; }
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
	}


	if ($action == 5)	{
		$uemail = $uusername = $ufirstname = $lastname = '';
		$uid = 0;
		if (isset($_POST["ue"]) && $_POST["ue"]!='') $uemail = $this->db1->e($_POST["ue"]);
		if (isset($_POST["uu"]) && $_POST["uu"]!='') $uusername = $this->db1->e($_POST["uu"]);
		if (isset($_POST["ufn"]) && $_POST["ufn"]!='') $ufirstname = $this->db1->e($_POST["ufn"]);
		if (isset($_POST["uln"]) && $_POST["uln"]!='') $lastname = $this->db1->e($_POST["uln"]);
		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if (empty($uemail)) { $errored = 1; $txterror .= 'Error... '; }
		if (empty($uusername)) { $errored = 1; $txterror .= 'Error... '; }
/*		if (empty($ufirstname)) { $errored = 1; $txterror .= 'Error... '; }
		if (empty($lastname)) { $errored = 1; $txterror .= 'Error... '; }*/
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
	}	

	if ($action == 6)	{
		$npass = '';
		$uid = 0;
		
		if (isset($_POST["np"]) && $_POST["np"]!='') $npass = $this->db1->e($_POST["np"]);
		if (isset($_POST["uid"]) && $_POST["uid"]!='') $uid = $this->db1->e($_POST["uid"]);
		
		if (empty($npass)) { $errored = 1; $txterror .= 'Error... '; }
		if ($uid == 0) { $errored = 1; $txterror .= 'Error... '; }
	}	
	
	if ($errored == 1) {
		echo('0: '.$txterror);
	} else {
		
		if ($action == 1) {		

			$this->db1->query("UPDATE users SET active=".$status." WHERE iduser=".$uid." LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;
		
		}
		
		if ($action == 2) {		

			$this->db1->query("UPDATE users SET leveladmin=".$levelnivel.", is_network_admin=".$level." WHERE iduser=".$uid." LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;
		
		}
		
		if ($action == 3) {
			
			// look for the ids of albums
			$allposts = $this->network->getPostsUser($uid);
			
			foreach ($allposts as $onepost) {
				$onepost = new post($onepost->code);
				$onepost->deletePost();
				unset($onepost);
			}
			
			$this->db1->query("DELETE FROM activities WHERE iduser=".$uid);
			$this->db1->query("DELETE FROM chat WHERE id_from=".$uid." OR id_to=".$uid);
			
			/*****************/

			$r = $this->db2->fetch_all('SELECT idpost FROM comments WHERE iduser='.$uid);
			foreach($r as $oneitem) {
				$this->db1->query("UPDATE posts SET numcomments=numcomments-1 WHERE idpost=".$oneitem->idpost);
			}			
			$this->db1->query("DELETE FROM comments WHERE iduser=".$uid);
			
			/**************/
			
			$r = $this->db2->fetch_all('SELECT idpost FROM likes WHERE iduser='.$uid);
			foreach($r as $oneitem) {
				$this->db1->query("UPDATE posts SET numlikes=numlikes-1 WHERE idpost=".$oneitem->idpost);
			}			
			$this->db1->query("DELETE FROM likes WHERE iduser=".$uid);
			
			/**************/
			
			$this->db1->query("DELETE FROM notifications WHERE from_user_id=".$uid." OR to_user_id=".$uid);
			
			/**************/
			
			$r = $this->db2->fetch_all('SELECT leader FROM relations WHERE subscriber='.$uid);
			foreach($r as $oneitem) {
				$this->db1->query("UPDATE users SET num_followers=num_followers-1 WHERE iduser=".$oneitem->leader);
			}			
			$r = $this->db2->fetch_all('SELECT subscriber FROM relations WHERE leader='.$uid);
			foreach($r as $oneitem) {
				$this->db1->query("UPDATE users SET num_following=num_following-1 WHERE iduser=".$oneitem->subscriber);
			}			
			$this->db1->query("DELETE FROM relations WHERE leader=".$uid." OR subscriber=".$uid);
			
			/**************/
			
			$this->db1->query("DELETE FROM users_pageviews WHERE iduser=".$uid);
			$this->db1->query("DELETE FROM users WHERE iduser=".$uid);			

			echo('1: Ok');
			return;
		
		}
		
		if ($action == 4) {		

			$this->db1->query("UPDATE users SET validated=".$mvalidated." WHERE iduser=".$uid." LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;
		
		}
		
		if ($action == 5) {	
			//	check if someone is using this email
			$r = $this->db1->query("SELECT iduser FROM users WHERE iduser<>".$uid." AND email='".$uemail."' LIMIT 1");
			if ($this->db1->num_rows($r) > 0) {
				$errored = 1;
				$txterror = $this->lang('admin_manageuser_txt_error5');
				echo("0: ".$txterror); return; die();
			}

			//	check if someone is using the username
			$r = $this->db1->query("SELECT iduser FROM users WHERE iduser<>".$uid." AND username='".$uusername."' LIMIT 1");
			if ($this->db1->num_rows($r) > 0) {
				$errored = 1;
				$txterror = $this->lang('admin_manageuser_txt_error4');
				echo("0: ".$txterror); return; die();
			}

			$this->db1->query("UPDATE users SET email='".$uemail."', username='".$uusername."', firstname='".$ufirstname."', lastname='".$lastname."' WHERE iduser=".$uid." LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;
		
		}		
		
		if ($action == 6) {
			
			$salt = md5(uniqid(rand(),true));
			$hash = hash('sha512', $salt.$npass);
			$this->db1->query("UPDATE users SET password='".$hash."', salt='".$salt."' WHERE iduser=".$uid." LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;

		}
		
		
	}

?>