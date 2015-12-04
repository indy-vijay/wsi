<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderLine extends Eloquent 
{
	public $table = 'order_lines';

	protected $fillable    = array('order_id','product_id','order_notes','desc','brand','style','color','qty' ,'qty_youth_xs','qty_youth_s','qty_youth_m','qty_youth_l','qty_youth_xl','qty_adult_xs','qty_adult_s','qty_adult_m','qty_adult_l','qty_adult_xl','qty_adult_2xl','qty_adult_3xl','qty_adult_4xl','qty_adult_5xl','qty_adult_6xl','total_pieces');

    public    $timestamps   = false;

    public static function getOrderLines($order_id)
    {
    	return self::where('order_id', '=' ,$order_id)
    				->get()
    				->toArray();
    }
}