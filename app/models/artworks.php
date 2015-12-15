<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Artworks extends Eloquent 
{
  
	protected   $fillable    = array('contact_id','design_name','file_path','preview_image');
    public      $timestamps   = false;

    public static function createArtwork($contact_id, $design_name,$file_path,$preview_image)
    {
    
    return self::insertGetId(array(
            						'contact_id'    => $contact_id,
            						'design_name'   => $design_name,
            						'file_path'     => $file_path,
            						'preview_image' => $preview_image,
                                	)
            				);
    }

}