<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Colors extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','styles_id','color');
    public    $timestamps   = false;

    public function scopeName($query, $id)
    {
        return $query->where('id',$id)
                        ->select('color')
                        ->first()
                        ->toArray()['color'];
    }

    public function scopeSelectedColor($query, $style)
    {
        return $query->where('style',$style);

    }
}