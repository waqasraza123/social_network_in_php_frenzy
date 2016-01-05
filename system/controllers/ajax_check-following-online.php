<?php 
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];
	
	// We are here only if you're logged in
	if (!$this->user->is_logged) {
		echo('0: '.$this->lang('dashboard_no_session'));
		die();
	}
	
	$D->is_logged = 0;
	if ($this->user->is_logged) {
		$D->me = $this->user->info;
		$D->is_logged = 1;
	}

	$this->db2->query('SELECT iduser, lastclick FROM users, relations WHERE active=1 AND iduser=leader AND subscriber='.$D->me->iduser.' ORDER BY lastclick DESC LIMIT 15');
	$cont = 0;
	while($obj = $this->db2->fetch_object()) {
		if( $obj->lastclick < time() - 3*60 ) {
			break;
		}
		$cont = $cont + 1;
	}
	echo('1: '.$cont);
	return;
?>