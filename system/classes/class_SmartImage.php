<?php

class SmartImage {
	/**
	 * Source file (path)
	 */
	private $src;

	/**
	 * GD image's identifier
	 */
	private $gdID;

	/**
	 * Image info
	 */
	private $info;

	/**
	 * Initialize image
	 *
	 * @param string $src
   * @param boolean $big
	 * @return SmartImage
	 */
	public function SmartImage($src, $bigImageSize=false) {
    // In case of very big images (more than 1Mb)
    if ($bigImageSize)
      $this->setMemoryForBigImage($src);
    
	// set data
	$this->src = $src;
	$this->info = getimagesize($src);
	
    // open file
	if ( $this->info[2] == 2 )		$this->gdID = imagecreatefromjpeg($this->src);
	elseif ( $this->info[2] == 1 )	$this->gdID = imagecreatefromgif($this->src);
	elseif ( $this->info[2] == 3 ) 	$this->gdID = imagecreatefrompng($this->src);
	
	}
  
  /**
   * Set memory in case of very big images (more than 1Mb)
   * new SmartImage($src, true) to activate this function
   * Works with (PHP 4 >= 4.3.2, PHP 5) if compiled with --enable-memory-limit
   *   or PHP>=5.2.1
   * Thanks to Andrvm and to Bascunan for this feature
   */
	private function setMemoryForBigImage($filename) {
    $imageInfo    = getimagesize($filename);
	  $memoryNeeded = round(($imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + Pow(2, 16)) * 1.65);
	   
	  $memoryLimit = (int) ini_get('memory_limit')*1048576;
	
	  if ((memory_get_usage() + $memoryNeeded) > $memoryLimit) {
		 ini_set('memory_limit', ceil((memory_get_usage() + $memoryNeeded + $memoryLimit)/1048576).'M');
		 return (true);
    }
	  else return(false);
	}

	/**
	 * Save the image on filesystem
	 *
	 * @param string $destination
	 * @param integer 0-100 $jpegQuality
	 */
	public function saveImage($destination, $jpegQuality = 100) {
		$this->outPutImage($destination, $jpegQuality);
	}

	/**
	 * Output an image
	 * accessible throught printImage() and saveImage()
	 *
	 * @param unknown_type $dest
	 * @param unknown_type $jpegQuality
	 */
	private function outPutImage($dest = '', $jpegQuality = 100) {
		$size = $this->info;
		$im = $this->gdID;
		// select mime
		if (!empty($dest))
			list($size['mime'], $size[2]) = $this->findMime($dest);
		
		// if output set headers
		if (empty($dest))	header('Content-Type: ' . $size['mime']);
		
		// output image
		if( $size[2] == 2 )			imagejpeg($im, $dest, $jpegQuality);
		elseif ( $size[2] == 1 )	imagegif($im, $dest);
		elseif ( $size[2] == 3 )	imagepng($im, $dest);
	}

	/**
	 * Mime type for a file
	 *
	 * @param string $file
	 * @return string
	 */
	private function findMime($file) {
		$file .= ".";
		$bit = explode(".", $file);
		$ext = $bit[count($bit)-2];
		if ($ext == 'jpg')		return array('image/jpeg', 2);
		elseif ($ext == 'jpeg')	return array('image/jpeg', 2);
		elseif ($ext == 'gif')	return array('image/gif', 1);
		elseif ($ext == 'png')	return array('image/png', 3);
		else return array('image/jpeg', 2);
	}

	/**
	 * Get the GD identifier
	 *
	 * @return GD Identifier
	 */
	public function getGDid() {
		return $this->gdID;
	}
  
	/**
	 * Get actual Image Size
	 *
	 * @return array('x' = integer, 'y' = integer)
	 */
	public function getSize() {
    $size = $this->info;
		return array('x' => $size[0], 'y' => $size[1]);
	}
	
	/**
	 * Set GD identifier
	 *
	 * @param GD Identifier $value
	 */
	public function setGDid($value) {
		$this->gdID = $value;
	}

	/**
	 * Free memory
	 */
	public function close() {
		@imagedestroy($this->gdID);
	}
	
	/**
	 * Update info class's variable
	 */
	private function updateInfo() {
		$info = $this->info;
		$im = $this->gdID;
		
		$info[0] = imagesx($im);
		$info[1] = imagesy($im);
		
		$this->info = $info;
	}
	
	function myresize($value, $prop){
		
		$size = $this->info;
		$im = $this->gdID;
		$newwidth = $size[0];
		$newheight = $size[1];
	
		//---Determinar la propiedad a redimensionar y la propiedad opuesta
		$prop_value = ($prop == 'width') ? $newwidth : $newheight;
		$prop_versus = ($prop == 'width') ? $newheight : $newwidth;
		
		//---Determinar el valor opuesto a la propiedad a redimensionar
		$pcent = $value / $prop_value;
		$value_versus = $prop_versus * $pcent;
		
		//---Crear la imagen dependiendo de la propiedad a variar
		$image = ($prop == 'width') ? imagecreatetruecolor($value, $value_versus) : imagecreatetruecolor($value_versus, $value);
		
		//---Hacer una copia de la imagen dependiendo de la propiedad a variar
		switch($prop){
		
			case 'width':
				$result = imagecopyresampled($image, $im, 0, 0, 0, 0, $value, $value_versus, $newwidth, $newheight);
				break;
			
			case 'height':
				$result = imagecopyresampled($image, $im, 0, 0, 0, 0, $value_versus, $value, $newwidth, $newheight);
				break;
	
		}
	
		//---Actualizar la imagen y sus dimensiones
		$this->gdID = $image;
		$this->updateInfo();

		return $result;
	
	}	
	
	function mycrop($width, $height, $pos='center') {
		
		$size = $this->info;
		$im = $this->gdID;
		$o_wd = $size[0];
		$o_ht = $size[1];		
		
		if( ($o_wd/$width) < ($o_ht/$height))
		{
			$t_wd = $width;
			$t_ht = round($o_ht * $t_wd / $o_wd);
			
		}
		if(($o_wd/$width) > ($o_ht/$height))
		{
			$t_ht = $height;
			$t_wd = round($o_wd * $t_ht / $o_ht);
		}
		if(($o_wd/$width) == ($o_ht/$height))
		{
			$t_wd = $width;
			$t_ht = $height;
		}
		

		$image =  imageCreateTrueColor($t_wd, $t_ht);
		imagecopyresampled ($image, $im, 0, 0, 0, 0, $t_wd, $t_ht, $o_wd, $o_ht);
		
		$image2 =  imageCreateTrueColor($width, $height);

		switch($pos){
		
			case 'center':
				$cropStartX = ( $t_wd / 2) - ( $width /2 );
				$cropStartY = ( $t_ht/ 2) - ( $height/2 );  
				break;
			
			case 'left':
				$cropStartX = 0;
				$cropStartY = ( $t_ht/ 2) - ( $height/2 );  
				break;
			
			case 'right':
				$cropStartX = $t_wd - $width;
				$cropStartY = ( $t_ht/ 2) - ( $height/2 );
				break;
			
			case 'top':
				$cropStartX = ( $t_wd / 2) - ( $width /2 );
				$cropStartY = 0;
				break;
			
			case 'bottom':
				$cropStartX = ( $t_wd / 2) - ( $width /2 );
				$cropStartY = $t_ht - $height; 
				break;		
		}

			
		$result = imagecopyresampled($image2, $image, 0, 0,$cropStartX, $cropStartY, $width, $height, $width, $height);

		//---Actualizar la imagen y sus dimensiones
		$this->gdID = $image2;
		$this->updateInfo();

		return $result;
		
	}
  
}

?>