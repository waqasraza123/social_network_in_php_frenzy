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
	
	// We see how many notifications are for this user
	$D->totalnotifications = $this->db2->fetch_field('SELECT count(idnotification) FROM notifications WHERE to_user_id='.$this->user->id);
	
	// We extract the notifications	
	$r = $this->db2->query('SELECT notif_type, notif_object_id, username, firstname, lastname, avatar, date, users.code as ucode, idresult FROM notifications, users WHERE users.iduser=from_user_id AND to_user_id='.$this->user->id.' ORDER BY date DESC LIMIT '.$C->NUM_NOTIFICATIONS_PAGE);
	
	$D->numnotifications = $this->db2->num_rows();

	$D->htmlNotifications = '';

	while( $obj = $this->db2->fetch_object($r) ) {
		$D->n_nameUser = (empty($obj->firstname) || empty($obj->lastname))?$obj->username:($obj->firstname.' '.$obj->lastname);
		$D->n_username = $obj->username;
		$D->f_codeuser = $obj->ucode;
		$D->n_avatar = $obj->avatar;
		$D->n_fdate = $obj->{'date'};
		$D->n_idpost = $obj->notif_object_id;
		$D->n_typenotifications = $obj->notif_type;
		
		if ($obj->notif_type==5) {
			$D->n_postcode = $this->network->getCodePost($obj->idresult);
		} else {
			$D->n_postcode = $this->network->getCodePost($D->n_idpost);
		}
		
		$D->htmlNotifications .= $this->load_template('__dashboard-one-notification.php', FALSE);
	}
	
	unset($r, $obj);
	
	
	/*************************************************************************/

	$D->optionactive = 0;
	$this->load_template('dashboard-mynotifications.php');
?>