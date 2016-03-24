<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Styles extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','brand','styles');
    public    $timestamps   = false;

    public static function getStyles($category_type)
    {

        return self::join('brands','styles.brand','=','brands.brand')
       
                ->where('brand.brand','=','styles.brand')
                ->select('styles.styles')
                ->get();
    }

}