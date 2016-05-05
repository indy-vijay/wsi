<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Brands extends Eloquent
{
    // public $table = 'brands';
    protected $fillable = array('id', 'brands_id', 'product_type');
    public $timestamps = false;

    public function scopeCategoryBrands($query, $category_type)
    {
        return $query->where('product_type', '=', $category_type);
                        

    }

    public function scopeName($query, $id)
    {
        return $query->where('id',$id)
                        ->select('brand')
                        ->first()
                        ->toArray()['brand'];
    }

    public function styles()
    {
        return $this->hasMany('\Styles');
    }

    public function scopeCategoryBrandsSelected($query, $category_type,$brand)
    {
       return $query->where('product_type', '=', $category_type)
                    ->where('brand', $brand);
    }

    public function scopeGetIdByName($query, $brand)
    {
        return $query->where('brand', $brand)
                        ->select('id')
                        ->get();
    }

}
