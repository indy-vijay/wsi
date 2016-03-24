<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Brands extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','brands_id','product_type');
    public    $timestamps   = false;

    public function scopeCategoryBrands($query, $category_type)
    {
        return $query->where('product_type', '=' ,$category_type);
                    
    }

    public function styles()
    {
    	return $this->hasMany('\Styles');
    }

}