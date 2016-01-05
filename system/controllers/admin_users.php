<?php
	
	if( !$this->network->id ) {
		$this->redirect('home');
	}
	if( !$this->user->is_logged ) {
		$this->redirect('home');
	}
	
	$db2->query('SELECT 1 FROM users WHERE iduser="'.$this->user->id.'" AND is_network_admin=1 LIMIT 1');
	if( 0 == $db2->num_rows() ) {
		$this->redirect('dashboard');
	}
	
	
	/*************************************************************************/
	// needed before proceeding
	require_once('_all-required-language.php');
	
	$this->load_langfile('global/global.php');	
	$this->load_langfile('inside/admin.php');

	/*************************************************************************/
	
	
	require_once('_all-required-dashboard-admin.php');
	

	/*************************************************************************/
	
	if (!$this->param('u')) {
		$D->totalusers = $this->db2->fetch_field('SELECT count(iduser) FROM users');
			
		$D->npage = 1;
			
		if ($this->param('p')) $D->npage = $this->param('p');
		
		$D->qperpage = 20;
		
		$D->start = ($D->npage - 1) * $D->qperpage;
		
		$D->totalpages = ceil($D->totalusers / $D->qperpage);
		
		$r = $this->db2->fetch_all('SELECT * FROM users LIMIT '.$D->start.','.$D->qperpage);
		
		$D->htmlUsers = '';
		
		ob_start();
		
		foreach($r as $oneUser) {
			$D->f_name = (empty($oneUser->firstname) || empty($oneUser->lastname))?stripslashes($oneUser->username):(stripslashes($oneUser->firstname).' '.stripslashes($oneUser->lastname));
			$D->f_avatar = $oneUser->avatar;
			$D->f_numphotos = $oneUser->num_posts;
			$D->f_username = $oneUser->username;
			$D->f_admin = $oneUser->is_network_admin;
			$D->f_leveladmin = $oneUser->leveladmin;
			$D->f_validated = $oneUser->validated;
			$D->f_auth = $oneUser->auth;
			$this->load_template('__admin-users-one-user.php');
		}
	
		$D->htmlUsers = ob_get_contents();
		ob_end_clean();
		
		unset($r, $oneUser);

		
		$D->optionactive_admin = 3;
		$this->load_template('admin_users.php');
		
	} else {
		
		$D->username = $this->param('u');
		
		$D->npage = 1;
		
		if ($this->param('p')) $D->npage = $this->param('p');
		
		$r = $this->db2->query("SELECT * FROM users WHERE username = '".$D->username."' LIMIT 1");
		
		if (!$obj = $this->db2->fetch_object($r)) {
			$this->redirect($C->SITE_URL.'admin/users');
		} else {
			$D->iduser = $obj->iduser;
			$D->username = $obj->username;
			$D->avatar = $obj->avatar;
			$D->firstname = stripslashes($obj->firstname);
			$D->lastname = stripslashes($obj->lastname);
			$D->email = $obj->email;
			$D->active = $obj->active;
			$D->validated = $obj->validated;
			$D->isadministrador = $obj->is_network_admin;
			$D->f_leveladmin = $obj->leveladmin;
		}
		
		$D->optionactive_admin = 3;
		$this->load_template('admin_users_details.php');

	}
	
	/*************************************************************************/



?>