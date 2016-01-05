<?php
	
	class network
	{
		public $id;
		public $info;
		public $is_private;
		public $is_public;
		
		public function __construct()
		{
			$this->id	= FALSE;
			$this->C	= new stdClass;
			$this->info	= new stdClass;
			$this->db1		= & $GLOBALS['db1'];
			$this->db2		= & $GLOBALS['db2'];
		}

		public function load()
		{
			if( $this->id ) {
				return FALSE;
			}
			$this->load_network_settings();
			$this->info	= (object) array(
				'id'	=> 1,
			);
			$this->is_private	= FALSE;
			$this->is_public	= TRUE;
			$this->id	= $this->info->id;
			return $this->id;
		}

		public function load_network_settings()
		{
			$db	= &$this->db1;
			$r	= $db->query('SELECT * FROM settings', FALSE);
			while($obj = $db->fetch_object($r)) {
				$this->C->{$obj->word}	= stripslashes($obj->value);
			}
			
			global $C;
			foreach($this->C as $k=>$v) {
				$C->$k	= & $this->C->$k;
			}
			
			if( !isset($C->SITE_TITLE) || empty($C->SITE_TITLE) ) {
				$C->SITE_TITLE	= 'phpWolves';
			}
			$C->OUTSIDE_SITE_TITLE	= $C->SITE_TITLE;
		}

		public function get_user_by_username($uname, $force_refresh=FALSE, $return_id=FALSE)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			if( empty($uname) ) {
				return FALSE;
			}

			$uid	= FALSE;
			$r	= $this->db2->query('SELECT iduser FROM users WHERE username="'.$this->db2->e($uname).'" LIMIT 1', FALSE);
			if( $o = $this->db2->fetch_object($r) ) {
				$uid	= intval($o->iduser);
				return $return_id ? $uid : $this->get_user_by_id($uid);
			}
			return FALSE;
		}

		public function get_user_by_email($email, $force_refresh=FALSE, $return_id=FALSE)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			if( ! is_valid_email($email) ) {
				return FALSE;
			}

			$uid	= FALSE;
			$r	= $this->db2->query('SELECT iduser FROM users WHERE email="'.$this->db2->escape($email).'" LIMIT 1', FALSE);
			if( $o = $this->db2->fetch_object($r) ) {
				$uid	= intval($o->iduser);
				return $return_id ? $uid : $this->get_user_by_id($uid);
			}

			return FALSE;
		}

		public function get_user_by_id($uid, $force_refresh=FALSE)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			$uid	= intval($uid);
			if( 0 == $uid ) {
				return FALSE;
			}

			$r	= $this->db2->query('SELECT * FROM users WHERE iduser="'.$uid.'" LIMIT 1', FALSE);
			if ($o = $this->db2->fetch_object($r)) {
				$o->active		= intval($o->active);
				$o->firstname	= stripslashes($o->firstname);
				$o->lastname	= stripslashes($o->lastname);
				$o->aboutme	= stripslashes($o->aboutme);
				$o->codecountry	= stripslashes($o->codecountry);
				$o->city	= stripslashes($o->city);
				$o->idregion	= intval($o->idregion);
				$o->network_id	= $this->id;
				$o->user_details	= FALSE;
				return $o;
			}

			return FALSE;
		}

		public function get_ads($code)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			return $this->db2->fetch_field('SELECT adsource FROM ads WHERE code="'.$code.'" LIMIT 1');
		}
		
		// Check if $uid1 is a follower of $uid2
		public function verifies_follower($uid1, $uid2)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			$uid1 = intval($uid1);
			if( 0 == $uid1 ) {
				return FALSE;
			}

			$uid2 = intval($uid2);
			if( 0 == $uid2 ) {
				return FALSE;
			}

			return $this->db2->fetch_field('SELECT idrelation FROM relations WHERE leader='.$uid2.' AND subscriber='.$uid1);
		}

		public function get_user_follows($uid, $type = FALSE)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			$uid = intval($uid);
			if( 0 == $uid ) {
				return FALSE;
			}

			$data = new stdClass;
			$data->followers = array();
			$data->follow_users = array();
			
			if( ($type && $type == 'hisfollowers') || ($type === FALSE) ){
				$r	= $this->db2->query('SELECT suscriber FROM relations WHERE leader="'.$uid.'" ORDER BY idrelation DESC', FALSE);
				while($o = $this->db2->fetch_object($r)) {
					$data->followers[intval($o->suscriber)]	= 1;
				}
			}
			if( ($type && $type == 'hefollows') || ($type === FALSE) ){
				$r	= $this->db2->query('SELECT leader FROM relations WHERE suscriber="'.$uid.'" ORDER BY idrelation DESC', FALSE);
				while($o = $this->db2->fetch_object($r)) {
					$data->follow_users[intval($o->leader)]	= 2;
				}
			}
			return $data;
		}

		public function get_country($codecountry)
		{
			return $this->db2->fetch_field('SELECT country FROM country WHERE code="'.$codecountry.'" LIMIT 1');
		}

		public function get_region($idregion)
		{
			return $this->db2->fetch_field('SELECT region FROM country_region WHERE idregion='.$idregion.' LIMIT 1');
		}

		public function isUserVerified($uid)
		{
			if( ! $this->id ) {
				return FALSE;
			}
			$uid = intval($uid);
			if( 0 == $uid ) {
				return FALSE;
			}

			$r	= $this->db2->query('SELECT validated FROM users WHERE iduser="'.$uid.'" LIMIT 1', FALSE);
			if ($o = $this->db2->fetch_object($r)) {
				if ($o->validated==1) return TRUE;
			}
			return FALSE;
		}

		public function getUserAleat($total, $exclude=0, $privacy=-1)
		{
			if ($privacy==-1) $r = $this->db2->fetch_all('SELECT * FROM users WHERE active=1 AND iduser<>'.$exclude.' ORDER BY RAND() LIMIT '.$total);
			else $r = $this->db2->fetch_all('SELECT * FROM users WHERE active=1 AND privacy='.$privacy.' AND iduser<>'.$exclude.' ORDER BY RAND() LIMIT '.$total);
			return $r;
		}

		public function getPostsUser($iduser)
		{
			$r = $this->db2->fetch_all('SELECT idpost, code FROM posts WHERE iduser='.$iduser);
			return $r;
		}


		public function getCodePost($idp)
		{
			$idp = intval($idp);
			if( 0 == $idp ) return FALSE;
			return $this->db2->fetch_field('SELECT code FROM posts WHERE idpost='.$idp.' LIMIT 1');
		}

		
		public function verifiedPost($code, $idu)
		{
			$code = $this->db2->e($code);
			if (strlen($code) != 11) return FALSE;
			$idu = intval($idu);
			if( 0 == $idu ) return FALSE;
			return $this->db2->fetch_field('SELECT idpost FROM posts WHERE code="'.$code.'" AND iduser='.$idu.' LIMIT 1');
		}

		public function getComment($idc)
		{
			$idc = intval($idc);
			if( 0 == $idc ) return FALSE;
			return $this->db2->fetch_field('SELECT comment FROM comments WHERE idcomment='.$idc.' LIMIT 1');
		}

		public function getUsername($idu)
		{
			$idu = intval($idu);
			if( 0 == $idu ) return FALSE;
			return $this->db2->fetch_field('SELECT username FROM users WHERE iduser='.$idu.' LIMIT 1');
		}

		public function getNumNotifications($idu)
		{
			$idu = intval($idu);
			if( 0 == $idu ) return FALSE;
			return $this->db2->fetch_field('SELECT num_notifications FROM users WHERE iduser='.$idu.' LIMIT 1');
		}

		
		public function getUsersAleatHome($quantity=8)
		{
			$r = $this->db2->fetch_all("SELECT * FROM users WHERE active=1 AND avatar<>'' ORDER BY RAND() LIMIT ".$quantity);
			return $r;			
		}	


		public function getTrendsTopic($quantity=10)
		{
			global $C;
			$timenow = time();
			$timeoneday = time() - 86400000 * $C->NUM_DAYS_TRENDS;
			$r = $this->db2->fetch_all("SELECT COUNT( DISTINCT iduser ) total, trend FROM trends WHERE whendate < '".$timenow."' AND whendate > '".$timeoneday."' && trend <> '' GROUP BY trend ORDER BY total DESC LIMIT ".$quantity);
			return $r;			
		}	
			
		public function idOwnerPost($idpost)
		{
			$idp = intval($idpost);
			if( 0 == $idp ) return FALSE;
			return $this->db2->fetch_field('SELECT iduser FROM posts WHERE idpost='.$idp.' LIMIT 1');
		}
	
		
	}
	
?>