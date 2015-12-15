<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Artworksplacements extends Eloquent 
{
    public $table = 'artwork_placement';
	protected $fillable    = array('order_id','artwork_id','artwork_placement');
    public    $timestamps   = false;

    public static function createArtworkPlacement($order_id, $artwork_id,$placement)
    {
    return self::insertGetId(array(
                                       'order_id'    => $order_id,
            					       'artwork_id'   => $artwork_id,
            						   'artwork_placement'     => $placement,
            					  )
            				);
    }

}