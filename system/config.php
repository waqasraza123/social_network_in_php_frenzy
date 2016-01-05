<?php

/** 
 * Configuration file.
 */

	$C	= new stdClass;
	
	$C->INCPATH = dirname(__FILE__).'/';
	chdir( $C->INCPATH );
	
	$C->SITE_URL = 'http://localhost/frenzy/';
	$C->DOMAIN = 'http://localhost';

	// MySQL SETTINGS
	$C->DB_HOST = 'localhost';
	$C->DB_USER = 'root';
	$C->DB_PASS = '';
	$C->DB_NAME = 'frenzy';
	$C->DB_MYEXT = 'mysqli'; // 'mysqli' or 'mysql'	

	
	// Folder of user data
	$C->FOLDER_DATA = "data/";
	
	// Temporary folder
	$C->FOLDER_TMP = "data/tmp/";
	
	// Avatars folder users
	$C->FOLDER_AVATAR = "data/avatars/"; 
	
	$C->AVATAR_DEFAULT = 'default.jpg';
	
	
	/**************************/
	/**************************/
	
	// Sizes for the avatar
	$C->widthAvatar0 = 180;
	$C->widthAvatar1 = 100;
	$C->heightAvatar1 = 100;
	$C->widthAvatar2 = 50;
	$C->heightAvatar2 = 50;
	$C->widthAvatar3 = 26;
	$C->heightAvatar3 = 26;	
	$C->widthAvatar4 = 180;
	$C->heightAvatar4 = 180;
	
	$C->SIZE_IMAGEN_AVATAR = 2 * 1024 * 1024; // 2 MB;
	
	// photos folder users
	$C->FOLDER_PHOTOS = "data/photos/";
	
	$C->SIZE_PHOTO = 5 * 1024 * 1024; // 5 MB;
	
	// Sizes for the photos
	$C->widthPhotoThumbail = 230;
	
	/**************************/
	/**************************/

	// Covers folder users
	$C->FOLDER_COVERS = "data/covers/";
	 
	// Sizes for the avatar
	$C->widthCover1 = 946;
	$C->heightCover1 = 300;
	$C->widthCover2 = 712;
	$C->heightCover2 = 226;
	$C->widthCover3 = 350;
	$C->heightCover3 = 111;

	
	$C->SIZE_IMAGEN_COVER = 5 * 1024 * 1024; // 5 MB;

	/**************************/
	
	// Covers folder users
	$C->FOLDER_BGHOME = "data/bghome/";
	
	/**************************/
	
	//if you want to view page view statistics in administration section set the value to TRUE,
	$C->write_page_view_is_active	= FALSE;

	
	$C->LOGIN_WITH_FACEBOOK = TRUE;
	$C->FB_APPID = '1519630464977310';
	$C->FB_SECRET = 'e99c3a97c691191a11e24503596ced22';
	
	// Settings for Mail
	$C->FromName = '';
	$C->From = '';
	$C->Host = '';
	$C->Port = '';
	$C->UsernameMail = '';
	$C->PasswordMail = '';
	

	// To consider the time zone (in timeago)
	$C->TimeAgoWithZ = TRUE; // in mode local: TRUE; in server: FALSE. Or invert :).

?>