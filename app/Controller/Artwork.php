<?php 
namespace Controller;

use \Artworks as ArtworksModel;

class Artwork extends \SlimController\SlimController
{
	public static $thumbExtension = '.jpg';

	public static function uploadTempArtwork()
	{
		if ( count($_FILES) == 1 && isset( $_FILES['artwork']) ){

				if($_FILES['artwork']['error'] != 0){
					//log the error
				}
				else{

					$fileTmpPath = $_FILES['artwork']['tmp_name'];
					$fileName    = uniqid() . str_replace(" ","",$_FILES['artwork']['name']);
					$fileNameWithPath = ARTWORK_UPLOAD_PATH_TEMP .$fileName;
					move_uploaded_file( $fileTmpPath, $fileNameWithPath);
					$thumb = getFileNameWithoutExtension($fileName) . '.jpg';
					Image::executeCommandThumbnailCreate(ARTWORK_FETCH_REL_PATH . $fileName.'[0]',ARTWORK_THUMB_REL_PATH . $thumb);
					return $fileNameWithPath;
				}
			}
	}

	public static function createArtwork($req)
	{
		$artwork_id      = 0;
		$artworkUploaded = $req->post('fileNameWithPath');

		if( strlen($artworkUploaded) > 0 && file_exists($artworkUploaded) ){
			//move the file	
			$design_name   = basename($artworkUploaded);
			$preview_image = $artworkUploaded; //dummy, remove this with proper info
			$newFileName   = basename($artworkUploaded);

			if(copy($artworkUploaded,  ARTWORK_UPLOAD_PATH . $newFileName)){
			
				$artwork_id = ArtworksModel::createArtwork(Login::isLoggedIn() , $design_name, $artworkUploaded,$preview_image);
				
			}
			else{
				//Log the file copy error
				// echo "Error copying " . $artworkUploaded . " to " . ARTWORK_UPLOAD_PATH . $newFileName;
			}
		}
		else{
			 //Log the file not found error
			 // echo "File not found " .  $artworkUploaded ;die;
		}

		return $artwork_id;
	}

	public static function getThumbPathForFile($fileNameWithPath)
	{
		if(file_exists($fileNameWithPath))
			return ARTWORK_THUMB_PATH . getFileNameWithoutExtension($fileNameWithPath).Artwork::$thumbExtension;

		return false;
	}

}