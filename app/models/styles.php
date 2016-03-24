<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Styles extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','brands_id','styles');
    public    $timestamps   = false;

    public function colors()
    {
        return $this->hasMany('\Colors');
    }
}