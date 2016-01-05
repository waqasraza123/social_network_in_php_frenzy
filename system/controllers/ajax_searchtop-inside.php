<?php
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('global/global.php');
	
	$errored = 0;
	$txterror = '';
	
	$squery = '';

	if (isset($_POST["q"]) && !empty($_POST["q"])) $squery = $this->db1->e($_POST["q"]);

	if (empty($squery)) { $errored = 1; $txterror .= '<div class="centered pdn10 txtsize01">'.$this->lang('global_search_qshort').'</div>'; }

	if ($errored == 1) {
		$cadreturn = '<div id="contentSearch"><div id="resultsSearch">' . $txterror . '</div></div>';
		echo($cadreturn);
	} else {

		$totalresult = $this->db2->fetch_field("SELECT count(iduser) FROM users WHERE username like '%".$squery."%' OR firstname like '%".$squery."%' OR lastname like '%".$squery."%'");

		$r = $this->db2->query("SELECT code, username, firstname, lastname, num_posts, avatar FROM users WHERE username like '%".$squery."%' OR firstname like '%".$squery."%' OR lastname like '%".$squery."%' ORDER BY iduser DESC LIMIT 0,".$C->NUM_RESULT_SEARCH_TOP);
		
		$itemsnow = $this->db2->num_rows();
	
		$D->htmlUsers = '';
		ob_start();
	
		while( $obj = $this->db2->fetch_object($r) ) {
			$D->g = $obj;
			$this->load_template('__search-top-one-user.php');
		}
		
		$D->htmlUsers = ob_get_contents();
		ob_end_clean();
		
		unset($r, $obj);
		
		if (empty($D->htmlUsers)) {
			$D->htmlUsers = '<div class="centered pdn10 txtsize01">'.$this->lang('global_search_noresult').'</div>';
			$D->more = '';
		} else {
			$D->more = '<div class="centered" style="border-top: 1px solid #EAEAEA; padding:10px 0px; background-color:#F4F4F4;"><span class="link bold"><a href="'.$C->SITE_URL.'directory/people/q:'.$squery.'">'.$this->lang('global_search_moreresults').'</a></div>';		
		}
		
		$cadreturn = '<div id="contentSearch">';
		$cadreturn .= '<div id="resultsSearch">';
		$cadreturn .= $D->htmlUsers;
		if ($totalresult>$itemsnow) $cadreturn .= $D->more;
		$cadreturn .= '</div>';
		$cadreturn .= '</div>';
		
		echo $cadreturn;
	}
?>