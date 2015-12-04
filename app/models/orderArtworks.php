<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderArtworks extends Eloquent 
{
	public $table = 'order_artworks';

	protected $fillable    = array('order_id','artwork_id');

    public    $timestamps   = false;

    public static function getOrderArtworks($order_id)
    {
    	return self::where('order_id', '=' ,$order_id)
    				->get()
    				->toArray();
    }

    
}