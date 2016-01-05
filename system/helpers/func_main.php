<?php


/** 
 * Main functions that are used in the application.
 */

	function __autoload($class_name)
	{
		global $C;
		require_once( $C->INCPATH.'classes/class_'.$class_name.'.php' );
	}
		
	function validateUrl($url)
	{
		if (!preg_match('/^(http|https):\/\/((([a-z0-9.-]+\.)+[a-z]{2,4})|([0-9\.]{1,4}){4})(\/([a-zA-Z?-?0-9-_\?\:%\.\?\!\=\+\&\/\#\~\;\,\@]+)?)?$/', $url))
			return FALSE;
		else return TRUE;
	}
	
	//function that checks if a URL is or is not "http"
	function fitsUrl($url) 
	{
		
		if( ! preg_match('/^(ftp|http|https):\/\//', $url) ) {
			$url = 'http://'.$url;
		}
	
		if( !validateUrl($url) ) return FALSE;
		
		return $url;
	}
	
	// function that returns the code of a YouTube video
	function getCodeYoutube($url, $lencodyt)
	{
		if( preg_match('/^http(s)?\:\/\/(www\.|de\.)?youtu\.be\/([a-z0-9-\_]{3,})/i', $url, $resultado) ) {
			$codeyt = $resultado[3];
			if (strlen($codeyt)!=$lencodyt) return FALSE;
			else return $codeyt;
		}
		if( preg_match('/^http(s)?\:\/\/(www\.|de\.)?youtube\.com\/watch\?(feature\=player\_embedded&)?v\=([a-z0-9-\_]{3,})/i', $url, $resultado) ) {
			$codeyt = $resultado[4];
			if (strlen($codeyt)!=$lencodyt) return FALSE;
			else return $codeyt;
		}
		return FALSE;
	}
	
	function emailValid($e)
	{
		return preg_match('/^[a-zA-Z0-9._%-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z]{2,4}$/u', $e);
	}
	
	
	// Function that checks if a code is already registered in a table
	function verifyCode($code, $table, $field)
	{			
		$mibdx2 = $GLOBALS["db2"];
		
		// check whether the code is being used
		$rx2 = $mibdx2->query("SELECT ".$field." FROM ".$table." WHERE ".$field."='".$code."' LIMIT 1");
		$numusers = $mibdx2->num_rows($rx2);

		if ($numusers==0) return FALSE;
		else return TRUE;			
	}
	
	//*************************************************************************
	// Function that returns a random string.
	// $numcharacters: number of letters returned string will.
	// $withrepeated: if 0 returns a string with no letters repeated. 
	// $withrepeated: if 1 returns a string with repeated letters.
	function getCode($numcharacters,$withrepeated)
	{
		$code = '';
		$characters = "0123456789abcdfghjkmnpqrstvwxyzBCDFGHJKMNPQRSTVWXYZ";
		$i = 0;
		while ($i < $numcharacters) {
			$char = substr($characters, mt_rand(0, strlen($characters)-1), 1);	
			if ($withrepeated == 1) {
				$code .= $char;
				$i += 1;			
			} else {
				if(!strstr($code,$char)) {
					$code .= $char;
					$i += 1;
				}
			}
		}
		return $code;
	}
	//*************************************************************************

	// Function that seeks a 11 digit code that is not registered in a table.
	function uniqueCode($numcharacters, $withrepeated, $table, $field)
	{
		$code = getCode($numcharacters, $withrepeated);
		while (verifyCode($code, $table, $field)) {	
			$code = getCode(11, 1);
		}
		return $code;
	}
	//*************************************************************************
	
	function dateago($thetime)
	{
		global $page;
		//if (empty($thetime)) return $page->lang('global_time_end',array('#TXTEND#'=>'1 '.$page->lang('global_time_sec'))); 
		$today = time();    
		$datediff = abs($today - $thetime);
		if ($datediff <= 0) $datediff = 1;
		$txtago = '';
		$years = floor($datediff / (365*60*60*24));  
		$months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
		$days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
		$hours= floor($datediff/3600);  
		$minutes= floor($datediff/60);  
		$seconds= floor($datediff);  
		//year checker  
		if( $txtago == '' ) {  
			if( $years > 1 ) $txtago = $years.' '.$page->lang('global_time_yeas');  
			elseif( $years == 1 ) $txtago = $years.' '.$page->lang('global_time_yea');  
		}  
		//month checker  
		if( $txtago == '') {  
			if( $months > 1 ) $txtago = $months.' '.$page->lang('global_time_mons');  
			elseif( $months == 1 ) $txtago = $months.' '.$page->lang('global_time_mon');  
		}  
		//month checker  
		if( $txtago == '') {  
			if( $days > 1 ) $txtago = $days.' '.$page->lang('global_time_days');
			elseif( $days == 1 ) $txtago = $days.' '.$page->lang('global_time_day');  
		}  
		//hour checker  
		if( $txtago == '' ) {  
			if( $hours > 1 ) $txtago = $hours.' '.$page->lang('global_time_hous');  
			elseif( $hours == 1 ) $txtago = $hours.' '.$page->lang('global_time_hou');  
		}  
		//minutes checker  
		if( $txtago == '') {  
			if( $minutes > 1 ) $txtago = $minutes.' '.$page->lang('global_time_mins');
			elseif( $minutes == 1 ) $txtago = $minutes.' '.$page->lang('global_time_min');
		}  
		//seconds checker  
		if( $txtago == '') {  
			if( $seconds > 1 ) $txtago = $seconds.' '.$page->lang('global_time_secs');
			elseif( $seconds == 1 ) $txtago = $seconds.' '.$page->lang('global_time_sec');
		}  
		return $page->lang('global_time_end',array('#TXTEND#'=>$txtago));
	}
	
	//*************************************************************************
	
	function analyzeMessage($txtmsg) {
		global $C;
		// Parse any @mentions or links
		
		$analyzedText = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#(\w+)/u'), array('<a href="$1" target="_blank" rel="nofollow" class="linkblue">$1</a>', '$1<span class="linkblue3"><a href="'.$C->SITE_URL.'$2">@$2</a></span>', '$1<span class="linkblue3"><a href="'.$C->SITE_URL.'search/t%%%$2">#$2</a></span>'), ($txtmsg));
		
		
		// Define smiles
		$emoticons = array(
			':-)'	=> 'regular.png',
			':)'	=> 'regular.png',
			':-D'	=> 'teeth.png',
			':d'	=> 'teeth.png',
			':D'	=> 'teeth.png',
			':-O'	=> 'omg.png',
			':o'	=> 'omg.png',
			':O'	=> 'omg.png',
			':-P'	=> 'tongue.png',
			':p'	=> 'tongue.png',
			':P'	=> 'tongue.png',
			';-)'	=> 'wink.png',
			';)'	=> 'wink.png',
			':(('	=> 'cry.png',
			':-('	=> 'sad.png',
			':('	=> 'sad.png',
			':-S'	=> 'confused.png',
			':s'	=> 'confused.png',
			':S'	=> 'confused.png',
			':-|'	=> 'what.png',
			':|'	=> 'what.png',
			':-$'	=> 'red.png',
			':$'	=> 'red.png',
			'(H)'	=> 'shades.png',
			'(h)'	=> 'shades.png',
			':-@'	=> 'angry.png',
			':@'	=> 'angry.png',
			'(A)'	=> 'angel.png',
			'(a)'	=> 'angel.png',
			'(6)'	=> 'devil.png',
			':-#'	=> 'dumb.png',
			'8o|'	=> 'growl.png',
			'8-|'	=> 'nerd.png',
			'^o)'	=> 'sarcastic.png',
			':-*'	=> 'secret.png',
			'+o('	=> 'sick.png',
			':^)'	=> 'noknow.png',
			'*-)'	=> 'pensive.png',
			'8-)'	=> 'eyesrolled.png',
			'|-)'	=> 'sleepy.png',
			'(C)'	=> 'coffee.png',
			'(c)'	=> 'coffee.png',
			'(Y)'	=> 'thumbs_up.png',
			'(y)'	=> 'thumbs_up.png',
			'(n)'	=> 'thumbs_down.png',
			'(N)'	=> 'thumbs_down.png',
			'(B)'	=> 'beer_mug.png',
			'(b)'	=> 'beer_mug.png',
			'(D)'	=> 'martini.png',
			'(d)'	=> 'martini.png',
			'(X)'	=> 'girl.png',
			'(x)'	=> 'girl.png',
			'(Z)'	=> 'guy.png',
			'(z)'	=> 'guy.png',
			'({)'	=> 'guy_hug.png',
			'(})'	=> 'girl_hug.png',
			':-['	=> 'bat.png',
			':['	=> 'bat.png',
			'(^)'	=> 'cake.png',
			'(L)'	=> 'heart.png',
			'(l)'	=> 'heart.png',
			'(U)'	=> 'broken_heart.png',
			'(u)'	=> 'broken_heart.png',
			'(K)'	=> 'kiss.png',
			'(k)'	=> 'kiss.png',
			'(G)'	=> 'present.png',
			'(g)'	=> 'present.png',
			'(F)'	=> 'rose.png',
			'(f)'	=> 'rose.png',
			'(W)'	=> 'wilted_rose.png',
			'(w)'	=> 'wilted_rose.png',
			'(p)'	=> 'camera.png',
			'(P)'	=> 'camera.png',
			'(~)'	=> 'film.png',
			'(@)'	=> 'cat.png',
			'(dg)'	=> 'dog.png',
			'(T)'	=> 'phone.png',
			'(t)'	=> 'phone.png',
			'(I)'	=> 'lightbulb.png',
			'(i)'	=> 'lightbulb.png',
			'(8)'	=> 'note.png',
			'(S)'	=> 'moon.png',
			'(*)'	=> 'star.png',
			'(e)'	=> 'envelope.png',
			'(E)'	=> 'envelope.png',
			'(o)'	=> 'clock.png',
			'(O)'	=> 'clock.png',
			'(sn)'	=> 'scargot.png',
			'(pl)'	=> 'dish.png',
			'(||)'	=> 'bowl.png',
			'(pi)'	=> 'pizza.png',
			'(so)'	=> 'ball.png',
			'(au)'	=> 'car.png',
			'(um)'	=> 'umb.png',
			'(ip)'	=> 'isla.png',
			'(co)'	=> 'pc.png',
			'(mp)'	=> 'cel.png',
			'(mo)'	=> 'money.png',
		);
		
		foreach($emoticons as $emoticons => $img) {
			$analyzedText = str_replace($emoticons, '<img src="'.$C->SITE_URL.'themes/default/imgs/emotics/'.$img.'" height="16" width="16" />', $analyzedText);
		}
		
		$analyzedText = str_replace('%%%', ':', $analyzedText);

		return str_replace(PHP_EOL, '<br/>',stripslashes($analyzedText));
	}
	
	//*************************************************************************
	
	function str_cut($str, $mx)
	{
		return mb_strlen($str)>$mx ? mb_substr($str, 0, $mx-1).'...' : $str;
	}
	
	//*************************************************************************
	
	function getCaptcha()
	{
		global $C;
		$Valor1 = rand(1,9);
		$Valor2 = rand(1,9);
		$_SESSION['captchasum'] = $Valor1 + $Valor2 ;
		$C->ctcha1 = $Valor1;
		$C->ctcha2 = $Valor2;
	}
	
	//*************************************************************************
	
	function clearnl($msg)
	{
		return preg_replace("/(\r?\n){2,}/", "\n\n", $msg);
	}
	
	//*************************************************************************
	
 	function send_mail( $from, $to, $subject, $body ) {
		$headers = '';
		$headers .= "From: $from\n";
		$headers .= "Return-Path: $from\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "Date: " . date('r', time()) . "\n";
		
	
		mail( $to, $subject , $body, $headers );
	}
	
	
	function send_mail_phpmailer($target, $subject, $message)
	{
		require("class.phpmailer.php");
		global $C;
		$mymail = new PHPMailer();
		$mybody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Email from '.$C->FromName.'</title>
		</head><body>';
		$mybody .= $message;
		$mybody .= '</body></html>';
		
		$mymail->From = $C->From;
		$mymail->FromName = $C->FromName;
		$mymail->Host = $C->Host;
		$mymail->Port = $C->Port;
		$mymail->Mailer = 'smtp';
		$mymail->AddAddress($target);
		$mymail->Subject = $subject;
		$mymail->Body = $mybody;
		$mymail->SMTPAuth = "true";
		$mymail->Username = $C->UsernameMail;
		$mymail->Password = $C->PasswordMail;
		
		$mymail->IsHTML(true);    
		
		if(!$mymail->Send()) return FALSE;
		else return TRUE;
	}

	function genSpaceEmoticons($divspace) {
		global $C;
		
		// Define smiles
		$emoticons = array(
			':-)'	=> 'regular.png',
			':-D'	=> 'teeth.png',
			':-O'	=> 'omg.png',
			':-P'	=> 'tongue.png',
			';-)'	=> 'wink.png',
			':(('	=> 'cry.png',
			':-('	=> 'sad.png',
			':-S'	=> 'confused.png',
			':-|'	=> 'what.png',
			':-$'	=> 'red.png',
			'(H)'	=> 'shades.png',
			':-@'	=> 'angry.png',
			'(A)'	=> 'angel.png',
			'(6)'	=> 'devil.png',
			':-#'	=> 'dumb.png',
			'8o|'	=> 'growl.png',
			'8-|'	=> 'nerd.png',
			'^o)'	=> 'sarcastic.png',
			':-*'	=> 'secret.png',
			'+o('	=> 'sick.png',
			':^)'	=> 'noknow.png',
			'*-)'	=> 'pensive.png',
			'8-)'	=> 'eyesrolled.png',
			'|-)'	=> 'sleepy.png',
			'(C)'	=> 'coffee.png',
			'(Y)'	=> 'thumbs_up.png',
			'(N)'	=> 'thumbs_down.png',
			'(B)'	=> 'beer_mug.png',
			'(D)'	=> 'martini.png',
			'(X)'	=> 'girl.png',
			'(Z)'	=> 'guy.png',
			'({)'	=> 'guy_hug.png',
			'(})'	=> 'girl_hug.png',
			':-['	=> 'bat.png',
			'(^)'	=> 'cake.png',
			'(L)'	=> 'heart.png',
			'(U)'	=> 'broken_heart.png',
			'(K)'	=> 'kiss.png',
			'(G)'	=> 'present.png',
			'(F)'	=> 'rose.png',
			'(W)'	=> 'wilted_rose.png',
			'(P)'	=> 'camera.png',
			'(~)'	=> 'film.png',
			'(@)'	=> 'cat.png',
			'(dg)'	=> 'dog.png',
			'(T)'	=> 'phone.png',
			'(I)'	=> 'lightbulb.png',
			'(8)'	=> 'note.png',
			'(S)'	=> 'moon.png',
			'(*)'	=> 'star.png',
			'(E)'	=> 'envelope.png',
			'(O)'	=> 'clock.png',
			'(sn)'	=> 'scargot.png',
			'(pl)'	=> 'dish.png',
			'(||)'	=> 'bowl.png',
			'(pi)'	=> 'pizza.png',
			'(so)'	=> 'ball.png',
			'(au)'	=> 'car.png',
			'(um)'	=> 'umb.png',
			'(ip)'	=> 'isla.png',
			'(co)'	=> 'pc.png',
			'(mp)'	=> 'cel.png',
			'(mo)'	=> 'money.png',
		);

		$txtEmoticons = '';
		foreach($emoticons as $emoticons => $img) {
			$txtEmoticons .= '<span class="onesmile"><img onclick="insertEmoticon(\''.$divspace.'\', \''.$emoticons.'\');" class="hand" title="'.$emoticons.'" src="'.$C->SITE_URL.'themes/default/imgs/emotics/'.$img.'" height="16" width="16" /></span>';
		}
		return $txtEmoticons;
	}
	
	function analyzeMessageChat($txtmsg) {
		global $C;
		// Parse any @mentions or links
		
		$analyzedText = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#(\w+)/u'), array('<a href="$1" target="_blank" rel="nofollow" class="linkblue">$1</a>', '$1<span class="linkblue3"><a href="'.$C->SITE_URL.'$2">@$2</a></span>', '$1<span class="linkblue3"><a href="'.$C->SITE_URL.'search/t%%%$2">#$2</a></span>'), ($txtmsg));
		
		
		// Define smiles
		$emoticons = array(
			':-)'	=> 'regular.png',
			':)'	=> 'regular.png',
			':-D'	=> 'teeth.png',
			':d'	=> 'teeth.png',
			':D'	=> 'teeth.png',
			':-O'	=> 'omg.png',
			':o'	=> 'omg.png',
			':O'	=> 'omg.png',
			':-P'	=> 'tongue.png',
			':p'	=> 'tongue.png',
			':P'	=> 'tongue.png',
			';-)'	=> 'wink.png',
			';)'	=> 'wink.png',
			':(('	=> 'cry.png',
			':-('	=> 'sad.png',
			':('	=> 'sad.png',
			':-S'	=> 'confused.png',
			':s'	=> 'confused.png',
			':S'	=> 'confused.png',
			':-|'	=> 'what.png',
			':|'	=> 'what.png',
			':-$'	=> 'red.png',
			':$'	=> 'red.png',
			'(H)'	=> 'shades.png',
			'(h)'	=> 'shades.png',
			':-@'	=> 'angry.png',
			':@'	=> 'angry.png',
			'(A)'	=> 'angel.png',
			'(a)'	=> 'angel.png',
			'(6)'	=> 'devil.png',
			':-#'	=> 'dumb.png',
			'8o|'	=> 'growl.png',
			'8-|'	=> 'nerd.png',
			'^o)'	=> 'sarcastic.png',
			':-*'	=> 'secret.png',
			'+o('	=> 'sick.png',
			':^)'	=> 'noknow.png',
			'*-)'	=> 'pensive.png',
			'8-)'	=> 'eyesrolled.png',
			'|-)'	=> 'sleepy.png',
			'(C)'	=> 'coffee.png',
			'(c)'	=> 'coffee.png',
			'(Y)'	=> 'thumbs_up.png',
			'(y)'	=> 'thumbs_up.png',
			'(n)'	=> 'thumbs_down.png',
			'(N)'	=> 'thumbs_down.png',
			'(B)'	=> 'beer_mug.png',
			'(b)'	=> 'beer_mug.png',
			'(D)'	=> 'martini.png',
			'(d)'	=> 'martini.png',
			'(X)'	=> 'girl.png',
			'(x)'	=> 'girl.png',
			'(Z)'	=> 'guy.png',
			'(z)'	=> 'guy.png',
			'({)'	=> 'guy_hug.png',
			'(})'	=> 'girl_hug.png',
			':-['	=> 'bat.png',
			':['	=> 'bat.png',
			'(^)'	=> 'cake.png',
			'(L)'	=> 'heart.png',
			'(l)'	=> 'heart.png',
			'(U)'	=> 'broken_heart.png',
			'(u)'	=> 'broken_heart.png',
			'(K)'	=> 'kiss.png',
			'(k)'	=> 'kiss.png',
			'(G)'	=> 'present.png',
			'(g)'	=> 'present.png',
			'(F)'	=> 'rose.png',
			'(f)'	=> 'rose.png',
			'(W)'	=> 'wilted_rose.png',
			'(w)'	=> 'wilted_rose.png',
			'(p)'	=> 'camera.png',
			'(P)'	=> 'camera.png',
			'(~)'	=> 'film.png',
			'(@)'	=> 'cat.png',
			'(dg)'	=> 'dog.png',
			'(T)'	=> 'phone.png',
			'(t)'	=> 'phone.png',
			'(I)'	=> 'lightbulb.png',
			'(i)'	=> 'lightbulb.png',
			'(8)'	=> 'note.png',
			'(S)'	=> 'moon.png',
			'(*)'	=> 'star.png',
			'(e)'	=> 'envelope.png',
			'(E)'	=> 'envelope.png',
			'(o)'	=> 'clock.png',
			'(O)'	=> 'clock.png',
			'(sn)'	=> 'scargot.png',
			'(pl)'	=> 'dish.png',
			'(||)'	=> 'bowl.png',
			'(pi)'	=> 'pizza.png',
			'(so)'	=> 'ball.png',
			'(au)'	=> 'car.png',
			'(um)'	=> 'umb.png',
			'(ip)'	=> 'isla.png',
			'(co)'	=> 'pc.png',
			'(mp)'	=> 'cel.png',
			'(mo)'	=> 'money.png',
		);
		
		if ($C->CHAT_WITH_EMOTICONS) {
			foreach($emoticons as $emoticons => $img) {
				$analyzedText = str_replace($emoticons, '<img src="'.$C->SITE_URL.'themes/default/imgs/emotics/'.$img.'" height="16" width="16" />', $analyzedText);
			}
		}
		
		$analyzedText = str_replace('%%%', ':', $analyzedText);

		return stripslashes($analyzedText);
	}
	
	/*************************************/
	/*************************************/
	
	/*** Update v1.2 ***/
	
	function validateUsername($username) { 
		if (ereg("^[A-Za-z0-9][A-Za-z0-9_]{5,14}$", $username)) return true; 
		else return false; 
	}
	
	/*** end Update v1.2 ***/



	
?>