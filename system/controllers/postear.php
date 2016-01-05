<?php
	// We check in which language we will work
	if (isset($_SESSION["DATAGLOBAL"][0]) && !empty($_SESSION["DATAGLOBAL"][0])) $C->LANGUAGE = $_SESSION["DATAGLOBAL"][0];

	$this->load_langfile('inside/dashboard.php');
	$this->load_langfile('global/global.php');

	// We are here only if you're logged in
	if ($this->user->is_logged) {
		
		$errored = 0;
		$txterror = '';
		
		$action=0;
		
		$txtstatus = $txtvalueatach = $txttypeattach = '';
		$typeattach = 0;
		
		if (isset($_POST["newstatus"]) && $_POST["newstatus"]!='') {
			$txtstatus = $this->db1->e(htmlspecialchars($_POST["newstatus"]));
		}
		
		if (isset($_POST["typeattach"]) && $_POST["typeattach"]!=0) {
			$typeattach = $this->db1->e($_POST["typeattach"]);
		}
		
		if (isset($_POST["atach-value"]) && $_POST["atach-value"]!='') {
			$txtvalueatach = $this->db1->e($_POST["atach-value"]);
		}

		$withattach = 0;
		$endtxtatach = '';
		
		$codep = uniqueCode(11, 1, 'posts', 'code');
		
		if ($typeattach == 1 || $typeattach == 2 || $typeattach == 3 || $typeattach == 4 || $typeattach == 5 || $typeattach == 6 || $typeattach == 7 || $typeattach == 8 || $typeattach == 9) {
			
			switch ($typeattach) {
				
				case 1:
					// is photo attached
					$images_post = $_FILES['images_post'];
					$numphotos = count($images_post['name']);
					
					if ($images_post['name'][0]) {	
								
						if ($numphotos > $C->NUM_PHOTOS_POST) {
							$errored = 1;
							$txterror = $this->lang('global_post_txterror1').' '.$C->NUM_PHOTOS_POST;
						} else {
							
							$photos = array();
							$tmp_photos = array();
							
							for ($i = 0; $i < $numphotos; $i++) {
								if ($images_post['size'][$i] > $C->SIZE_PHOTO || $images_post['size'][$i]==0){
									$errored = 1;
									$txterror = $this->lang('global_post_txterror2').': '.$images_post['name'][$i];
									break;
								}
	
								$loadedtype = $images_post['type'][$i];
								if ($loadedtype=="image/jpeg" || $loadedtype=="image/gif" || $loadedtype=="image/png") {
									switch ($loadedtype) {
										case "image/jpeg":
											$extens = '.jpg';
											break;
										case "image/gif":
											$extens = '.gif';		
											break;
										case "image/png":
											$extens = '.png';
											break;
									}
									
								} else {
									$errored = 1;
									$txterror = $this->lang('global_post_txterror3').': '.$images_post['name'][$i];
									break;
								}
								
								$tmp_photos[] = $images_post['tmp_name'][$i];
								$photos[] = $codep.'-'.$i.$extens;
		
							}
							
							if ($errored == 0) {

								foreach($photos as $key => $fname) {
									move_uploaded_file($tmp_photos[$key], '../'.$C->FOLDER_PHOTOS.$fname);
									$thumbnail = new SmartImage('../'.$C->FOLDER_PHOTOS.$fname, true);
									$thumbnail->mycrop($C->widthPhotoThumbail, $C->widthPhotoThumbail, 'center'); 
									$thumbnail->saveImage('../'.$C->FOLDER_PHOTOS.'min1/'.$fname);
									$thumbnail->close();
								}
								unset($mythumb);
								$txttypeattach = 'photo';
							}
	
							$endtxtatach = implode(',', $photos);
	
						}
					}
					break;	

				case 2:
					// is video attached
					if (!empty($txtvalueatach)) {
						if(substr($txtvalueatach, 0, 20) == "https://youtube.com/" || substr($txtvalueatach, 0, 24) == "https://www.youtube.com/" || substr($txtvalueatach, 0, 16) == "www.youtube.com/" || substr($txtvalueatach, 0, 12) == "youtube.com/" || substr($txtvalueatach, 0, 19) == "http://youtube.com/" || substr($txtvalueatach, 0, 23) == "http://www.youtube.com/" || substr($txtvalueatach, 0, 16) == "http://youtu.be/") {
							parse_str(parse_url($txtvalueatach, PHP_URL_QUERY), $my_array_of_vars);
							if(substr($txtvalueatach, 0, 16) == 'http://youtu.be/') {
								$endtxtatach = str_replace('http://youtu.be/', 'yt:', $txtvalueatach);
							} else {
								$endtxtatach = 'yt:'.$my_array_of_vars['v'];
							}
						} elseif(substr($txtvalueatach, 0, 17) == "http://vimeo.com/" || substr($txtvalueatach, 0, 21) == "http://www.vimeo.com/" || substr($txtvalueatach, 0, 18) == "https://vimeo.com/" || substr($txtvalueatach, 0, 22) == "https://www.vimeo.com/" || substr($txtvalueatach, 0, 14) == "www.vimeo.com/" || substr($txtvalueatach, 0, 10) == "vimeo.com/") {
							$endtxtatach = 'vm:'.(int)substr(parse_url($txtvalueatach, PHP_URL_PATH), 1);
						} else {
							$errored = 1;
							$txterror = $this->lang('global_post_txterror4');
						}
						
						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 2;
							$txttypeattach = 'video';
						}
					}
					
					break;	

				case 3:
					if (!empty($txtvalueatach)) {
						if(substr($txtvalueatach, 0, 23) == "https://soundcloud.com/" || substr($txtvalueatach, 0, 27) == "https://www.soundcloud.com/" || substr($txtvalueatach, 0, 22) == "http://soundcloud.com/" || substr($txtvalueatach, 0, 22) == "http://www.soundcloud.com/" || substr($txtvalueatach, 0, 15) == "soundcloud.com/" || substr($txtvalueatach, 0, 19) == "www.soundcloud.com/") {
								$endtxtatach = 'sc:'.parse_url($txtvalueatach, PHP_URL_PATH);
						} else $endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 3;
							$txttypeattach = 'music';
						}
					}
					
					break;
					
				case 4:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 4;
							$txttypeattach = 'map';
						}
					}
					
					break;

				case 5:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 5;
							$txttypeattach = 'visited';
						}
					}
					
					break;
					
				case 6:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 6;
							$txttypeattach = 'food';
						}
					}
					
					break;
					
				case 7:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 7;
							$txttypeattach = 'movie';
						}
					}
					
					break;
					
				case 8:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 8;
							$txttypeattach = 'book';
						}
					}
					
					break;
					
				case 9:

					if (!empty($txtvalueatach)) {
						
						$endtxtatach = $this->db1->e(htmlspecialchars(trim(clearnl($txtvalueatach))));

						if (!empty($endtxtatach)) {
							$withattach = 1;
							$typeattach = 9;
							$txttypeattach = 'game';
						}
					}
					
					break;

			}

		}
		
		if ($errored==0) {
			if (empty($txtstatus) && empty($endtxtatach)) {
				$errored = 1;
				$txterror = $this->lang('global_post_txterror5');
			} else {
				
				$r = $this->db1->query("INSERT INTO posts SET code='".$codep."', iduser=".$this->user->id.", post='".$txtstatus."', typepost='".$txttypeattach."', valueattach='".$endtxtatach."', whendate='".time()."'");
				$idpost = $this->db1->insert_id();
				$this->db1->query('INSERT INTO activities SET iduser='.$this->user->id.', action=3, iditem='.$idpost.', typeitem=1, date="'.time().'"');
				$this->db1->query("UPDATE users SET num_posts=num_posts+1 WHERE iduser=".$this->user->id." LIMIT 1");
				
				preg_match_all('~([#])([^\s#]+)~', str_replace(array('\r', '\n'), ' ', $txtstatus), $matchedHashtags);
				
				if(!empty($matchedHashtags[0])) {
					foreach($matchedHashtags[0] as $match) {
						$hashtag = str_replace('#', '', $match);
						$hashtag = $this->db1->e(($hashtag));
						$this->db1->query("INSERT INTO trends SET iduser=".$this->user->id.", trend='".$hashtag."', idpost=".$idpost.", whendate='".time()."'");
					}
				}

			}
		}
		
		if ($errored==1) {
			$message = '0: '.$txterror;
		} else {
			//now load recent post
			
			$D->userName = $this->user->info->username;
			$D->nameUser = (empty($this->user->info->firstname) || empty($this->user->info->lastname))?$this->user->info->username:($this->user->info->firstname.' '.$this->user->info->lastname);
			$D->userAvatar = $this->user->info->avatar;
			$D->isThisUserVerified0 = $this->network->isUserVerified($this->user->id);
			$D->idUser = $this->user->id;
			$D->liketoUser = 0;

			$D->a_date = time();
			$D->codeUser = $this->user->info->code;
			
			$D->idpost = $idpost;
			$D->codepost = $this->network->getCodePost($D->idpost);
			$onePost = new post($D->codepost);
			$D->typepost = $onePost->typepost;
			$D->numlikes = $onePost->numlikes;
			$D->numcommentstotal = $onePost->numcomments;
			$D->post = stripslashes($onePost->post);
			$D->typepost = $onePost->typepost;
			$D->valueattach = $onePost->valueattach;

			$txtpostreturn = '';
			$txtpostreturn = $this->load_template('__dashboard-activity-one-post.php', FALSE);
			unset($onePost);

			$txtpostreturn = str_replace('<script>','&lt;script&gt;',$txtpostreturn);
			$txtpostreturn = str_replace('</script>','&lt;/script&gt;',$txtpostreturn);
			$message = '1: '.$txtpostreturn;	
		}
	}

?>
<script language="javascript" type="text/javascript">
	window.top.window.endPostear('<?php echo  $this->db1->e($message); ?>');
</script>