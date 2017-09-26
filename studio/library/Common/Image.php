<?php
	Class Image{
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
		
		function __construct() {

		}
	
//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
		
		public  static function showPicture($basename,$formats,$path,$nopic_file){
			$result = "";
		
			foreach($formats as $i=>$ext){
				if (file_exists($path.$basename.".".$ext)) {
					$result = $path.$basename.".".$ext;
					break;
				}
			}
			
			if($result == "")
				return $nopic_file;
			else
				return $result;
		}
		
		public  static function clearFile($basename,$formats,$path){
			$result = "";
		
			foreach($formats as $i=>$ext){
				if (file_exists($path.$basename.".".$ext)) {
					$result = $path.$basename.".".$ext;
					if(!unlink($result))
						return false;
				}
			}
			
			return true;
		}
		
		public static function moveFile($oldname,$newname, $ext, $oldpath, $newpath ){
			if (!file_exists($oldpath.$oldname.".".$ext)) {
				return false;
			}

			if (!is_dir($newpath)) {
				if(!mkdir($newpath))
					return false;
			}	
				
			if (copy($oldpath.$oldname.".".$ext, $newpath.$newname.".".$ext)) {
				if(!unlink($oldpath.$oldname.".".$ext))
					return false;
			}else
				return false;
				
			return true;
		}
		
	}

?>