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

		$r = $this->db2->query("SELECT DISTINCT trend FROM trends WHERE trend like '%".$squery."%' LIMIT 0,".$C->NUM_RESULT_SEARCH_TOP);
	
		$D->htmlTrends = '';
		ob_start();
	
		while( $obj = $this->db2->fetch_object($r) ) {
			$D->g = $obj;
			$this->load_template('__search-top-one-trend.php');
		}
		
		$D->htmlTrends = ob_get_contents();
		ob_end_clean();
		
		unset($r, $obj);
		
		if (empty($D->htmlTrends)) {
			$D->htmlTrends = '<div class="centered pdn10 txtsize01">'.$this->lang('global_search_noresult').'</div>';
		}
		
		$cadreturn = '<div id="contentSearch">';
		$cadreturn .= '<div id="resultsSearch">';
		$cadreturn .= $D->htmlTrends;
		$cadreturn .= '</div>';
		$cadreturn .= '</div>';
		
		echo $cadreturn;
	}
?>