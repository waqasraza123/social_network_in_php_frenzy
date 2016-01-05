<?php

if (isset($_GET['error'])) { $this->redirect($C->SITE_URL); }

require 'connect/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $C->FB_APPID,
  'secret' => $C->FB_SECRET,
));


// Get User ID
$D->fb_user = $facebook->getUser();        

if ($D->fb_user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $D->fb_user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $D->fb_user = null;
  }
} 

if ($D->fb_user) {
	$D->fb_logoutUrl = $facebook->getLogoutUrl();

	if (isset($_GET['code'])) {
		$fb_email = $D->fb_user_profile['email'];
		  
		$usersimple = $this->db1->fetch_field("SELECT iduser FROM users WHERE email='".$fb_email."' AND auth=''");
		if ($usersimple) {
			$D->msg_alert = 'The email that this facebook account is using is already registered';
			session_destroy();
		} else {
			$r = $this->db1->query("SELECT username FROM users WHERE email='".$fb_email."' AND auth='facebook'");
			if (!($obj = $db2->fetch_object($r))) {
				$code = uniqueCode(11, 1, 'users', 'code');
				$fb_pass = getCode(10,1);
				
				$salt = md5(uniqid(rand(), true));
				$hash = hash('sha512', $salt.$fb_pass);
				$ip	= $this->db1->escape( ip2long($_SERVER['REMOTE_ADDR']) );
				
				$fb_id = $D->fb_user_profile['id'];
				$fb_first_name = $this->db1->e($D->fb_user_profile['first_name']);
				$fb_last_name = $this->db1->e($D->fb_user_profile['last_name']);
				$fb_gender = $D->fb_user_profile['gender'];
				$fb_username = $D->fb_user_profile['name'];
				$fb_username = str_replace(' ','',$fb_username);
				$fb_username = str_replace('.','',$fb_username);
				
				//if the username does not work, use your email
				if (!validateUsername($fb_username)) {
					$newUser = explode('@',$fb_email);
					$fb_username = str_replace('.','',$newUser[0]);
					$fb_username = str_replace('-','',$fb_username);
					$lenun = strlen($fb_username);
					if (strlen($fb_username)<6) $fb_username = $fb_username . getCode(6-$lenun,1);
				}
				
				$numu = $this->db1->fetch_field("SELECT count(iduser) FROM users WHERE username='".$fb_username."'");
				if ($numu != 0) $fb_username = $fb_username.''.($numu + 1);
				
				$fb_username = $this->db1->e($fb_username);				
				
				$gender = 0;
				if ($fb_gender == 'male') $gender = 1;
				if ($fb_gender == 'female') $gender = 2;
				
				$r = $this->db1->query("INSERT INTO users SET code='".$code."', password='" . $hash . "', salt='" . $salt . "', auth='facebook', username='".$fb_username."', auth_id='".$fb_id."', firstname='".$fb_first_name."', lastname='".$fb_last_name."', email='".$fb_email."', registerdate='" . time() . "', ipregister='" . $ip . "', gender=".$gender);
			} else {
				$fb_username = $obj->username;
			}
			$this->user->loginfb($fb_username);
			$this->redirect($C->SITE_URL);
		}
	}
  
} else {
  $D->fb_statusUrl = $facebook->getLoginStatusUrl();
  $D->fb_loginUrl = $facebook->getLoginUrl(array('scope'=>'email'));
} 
?>