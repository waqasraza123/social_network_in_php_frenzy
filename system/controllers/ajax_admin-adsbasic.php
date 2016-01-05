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

	// Evaluate personal data
	if ($action == 1)	{

		$adsb1 = $adsb2 = '';
		
		if (isset($_POST["adsb1"]) && !empty($_POST["adsb1"])) $adsb1 = $this->db1->e(trim($_POST["adsb1"]));
		if (isset($_POST["adsb2"]) && !empty($_POST["adsb2"])) $adsb2 = $this->db1->e(trim($_POST["adsb2"]));
		
	}

	
	if ($errored == 1) {
		echo('0: '.$txterror);
	} else {

		if ($action == 1) {	
			$this->db1->query("UPDATE ads SET adsource='".$adsb1."' WHERE code='adsbasic1' LIMIT 1");
			$this->db1->query("UPDATE ads SET adsource='".$adsb2."' WHERE code='adsbasic2' LIMIT 1");
			$txtreturn = $this->lang('admin_txt_msgok');
			echo('1: '.$txtreturn);
			return;
		}
	
	}
?>