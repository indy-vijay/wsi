<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Brands extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','brand','product_type');
    public    $timestamps   = false;

    public static function getBrands($category_type)
    {
        return self::where('product_type', '=' ,$category_type)
                    ->get()
                    ->toArray();
    }

}