<?php

class post
{
	public $id;
	public $error = FALSE;
	
	public function __construct($code, $mini = FALSE)
	{
		$this->db1 = & $GLOBALS['db1'];
		$this->db2 = & $GLOBALS['db2'];
		
		$code = $this->db2->e($code);
		
		if (strlen($code)!=11) {
			$this->error = TRUE;
			return;				
		}
		
		if ($mini == FALSE) {
		
			$r	= $this->db2->query('SELECT * FROM posts WHERE code="'.$code.'" LIMIT 1', FALSE);
			
			if( ! $o = $this->db2->fetch_object($r) ) {
				$this->error = TRUE;
				return;
			}
			
			$this->id = $o->idpost;
			$this->code = $o->code;
			$this->iduser = $o->iduser;
			$this->post = stripslashes($o->post);
			$this->whendate = $o->whendate;
			$this->numcomments = $o->numcomments;
			$this->numlikes = $o->numlikes;
			$this->typepost = $o->typepost;
			$this->valueattach = $o->valueattach;
			
		} else {
			
			$r	= $this->db2->query('SELECT idpost, iduser, post FROM posts WHERE code="'.$code.'" LIMIT 1', FALSE);
			if( ! $o = $this->db2->fetch_object($r) ) {
				$this->error = TRUE;
				return;
			}
			
			$this->id = $o->idpost;
			$this->iduser = $o->iduser;
			$this->post = stripslashes($o->post);		
		}
		return TRUE;
	}
	
	private function _deleteComments()
	{
		// Here we remove the comments on this post
		$allcomments = $this->db2->fetch_all('SELECT iduser FROM comments WHERE idpost='.$this->id);
		
		foreach ($allcomments as $onecomments) {
			$this->db2->query('UPDATE users SET num_comments=num_comments-1 WHERE iduser='.$onecomments->iduser.' LIMIT 1');
		}
		$this->db2->query('DELETE FROM comments WHERE idpost='.$this->id);
		/************************************************/		
	}
	
	private function _deleteLikes()
	{
		// Here we remove the favorites this post
		$alllikes = $this->db2->fetch_all('SELECT iduser FROM likes WHERE idpost='.$this->id);
		foreach($alllikes as $onelike) {
			$this->db2->query('UPDATE users SET num_likes=num_likes-1 WHERE iduser='.$onelike->iduser.' LIMIT 1');
		}
		$this->db2->query('DELETE FROM likes WHERE idpost='.$this->id);
		/************************************************/	
	}
	
	private function _deleteActivities()
	{
		// Here we remove the "activities" made in this post. The posts diferentes to 6 (no shared)
		$this->db2->query('DELETE FROM activities WHERE iditem='.$this->id.' AND typeitem=1 AND action<>6');
		if ($this->typepost == 'share') $this->db2->query('DELETE FROM activities WHERE idresult='.$this->id.' AND typeitem=1 AND iduser='.$this->iduser);
		/************************************************/
	}
	
	private function _deleteNotifications()
	{
		// Here we remove the "notifications" made in this post
		$this->db2->query('DELETE FROM notifications WHERE notif_object_id='.$this->id.' AND notif_object_type=1');
		if ($this->typepost == 'share') $this->db2->query('DELETE FROM notifications WHERE idresult='.$this->id.' AND notif_object_type=1');
		/************************************************/
	}
	
	private function _deleteTrending()
	{
		// Here we remove the "activities" made in this post
		$this->db2->query('DELETE FROM trends WHERE idpost='.$this->id);
		/************************************************/
	}
	
	private function _deletePhotos()
	{
		global $C;
		// Now remove the photos
		if ($this->typepost=='photo') {
			$photosPost = explode(',', $this->valueattach);
			$numphotos = count($photosPost);
			if ($numphotos>0) {
				$raiz = '../';
				$folderphoto = $C->FOLDER_PHOTOS;
				$folderphotomini = $C->FOLDER_PHOTOS.'/min1/';
				foreach($photosPost as $onephoto) {
					if (file_exists($raiz.$folderphoto.$onephoto)) unlink($raiz.$folderphoto.$onephoto);
					if (file_exists($raiz.$folderphotomini.$onephoto)) unlink($raiz.$folderphotomini.$onephoto);
				}			
			}			
		}
	}

	public function deletePost()
	{
		$this->db2->query('DELETE FROM posts WHERE idpost='.$this->id.' AND iduser='.$this->iduser.' LIMIT 1');
		$this->db2->query('UPDATE users SET num_posts=num_posts-1 WHERE iduser='.$this->iduser.' LIMIT 1');
		
		if ($this->typepost == 'share') {
			$infop = explode(':',$this->valueattach);
			if ($this->iduser != intval($infop[1])) $this->db2->query('UPDATE posts SET numshares=numshares-1 WHERE idpost='.$infop[0].' LIMIT 1');
		}
		
		$this->_deleteComments();
		$this->_deleteLikes();
		$this->_deleteActivities();
		$this->_deleteNotifications();
		$this->_deleteTrending();
		$this->_deletePhotos();
	}
	
	public function deleteAccesoriesPost()
	{
		$this->_deleteComments();
		$this->_deleteLikes();
		$this->_deleteActivities();
		$this->_deleteNotifications();
		$this->_deleteTrending();
		$this->_deletePhotos();
	}
	
	public function likeOfUser($iduser)
	{
		$r	= $this->db2->fetch_field('SELECT idlike FROM likes WHERE iduser='.$iduser.' AND idpost='.$this->id.' LIMIT 1');
		return $r;
	}
	
	public function numComments()
	{
		return $this->numcomments;
	}
	
	public function getAllComments()
	{
		$r = $this->db2->fetch_all('SELECT idcomment, comments.whendate, comment, comments.iduser, username, firstname, lastname, avatar FROM comments, users WHERE users.iduser=comments.iduser AND idpost='.$this->id.' ORDER BY comments.whendate ASC');
		return $r;
	}
	
	public function getComments($start, $quantity)
	{
		$r = $this->db2->fetch_all('SELECT idcomment, comments.whendate, comment, comments.iduser, username, firstname, lastname, avatar, idpost, users.code as ucode FROM comments, users WHERE users.iduser=comments.iduser AND idpost='.$this->id.' ORDER BY comments.whendate DESC LIMIT '.$start.','.$quantity);
		return $r;
	}
	
}
?>