<?php 
namespace Controller;

use \Artworks as ArtworksModel;
use \Artworksplacements as ArtworksplacementsModel;




class Artwork extends \SlimController\SlimController
{
	public static $thumbExtension = '.jpg';

	public static function uploadTempArtwork($req)
	{
		
		 $files['url'] = '';
		 $files['placement'] ='';
		 if($req->isPost() && !empty( $_FILES ) )
		//if( strtolower( $_SERVER[ 'REQUEST_METHOD' ] ) == 'post' && !empty( $_FILES ) )
		{
			foreach( $_FILES[ 'artwork_image' ][ 'tmp_name' ] as $index => $tmpName )
			{
				if( !empty( $_FILES[ 'artwork_image' ][ 'error' ][ $index ] ) )
				{
            	return false; 
       			}
	        	// check whether it's not empty, and whether it indeed is an uploaded file
            	if( !empty( $tmpName ) && is_uploaded_file( $tmpName ) )
            	{
            	$fileName    = uniqid() . str_replace(" ","",$_FILES['artwork_image']['name'][ $index ]);
            	$fileNameWithPath = ARTWORK_UPLOAD_PATH_TEMP .$fileName;
             	move_uploaded_file( $tmpName, $fileNameWithPath ); // move to new location perhaps?
            	$files['url'][] = $fileNameWithPath;
            	$files['placement'][] = $_POST['placement'][$index];
            	$thumb = getFileNameWithoutExtension($fileName) . '.jpg';
            	Image::executeCommandThumbnailCreate(ARTWORK_FETCH_REL_PATH . $fileName.'[0]',ARTWORK_THUMB_REL_PATH . $thumb);
        		}
        		
    	}


	}
	if(isset($_POST['fileNameWithPath']))
		{
		foreach ($_POST['fileNameWithPath'] as $fileName) {
   				 $files['url'][] = $fileName;
   				}
   		}
   	if(isset($_POST['placementUploaded']))
		{			
   		foreach ($_POST['placementUploaded'] as $placements) {
   			 	$files['placement'][] = $placements;
   				}

   		}
    	return $files;

}

	public static function createArtwork($req,$order_id)
	{
		$artwork_id      = 0;
		$files['artworkUploaded'] = $req->post('fileNameWithPath');
		$files['placement'] = $req->post('placementUploaded');
		if(count($files['artworkUploaded']) == 0)
			return [];
		
		foreach ($files['artworkUploaded'] as $num => $artworkUploaded) {
			if( strlen($artworkUploaded) > 0 && file_exists($artworkUploaded) ){
			//move the file	
				$design_name   = basename($artworkUploaded);
				$preview_image = $artworkUploaded; //dummy, remove this with proper info
				$newFileName   = basename($artworkUploaded);
			 
				if(copy($artworkUploaded,  ARTWORK_UPLOAD_PATH . $newFileName)){
			
					$artwork_id = ArtworksModel::createArtwork(Login::isLoggedIn() , $design_name,$artworkUploaded,$preview_image);
					$artwork_id_array[] =$artwork_id;
					$placement_id_array[] = ArtworksplacementsModel::createArtworkPlacement($order_id,$artwork_id,$files['placement'][$num]);
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
		}

		return $artwork_id_array;
	}

	public static function getThumbPathForFile($fileNameWithPath)
	{

		//if(file_exists($fileNameWithPath))
		//	return ARTWORK_THUMB_PATH . getFileNameWithoutExtension($fileNameWithPath).Artwork::$thumbExtension;
		return false;
	}

}