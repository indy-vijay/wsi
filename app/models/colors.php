<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Colors extends Eloquent 
{
    // public $table = 'brands';
	protected $fillable    = array('id','styles_id','color');
    public    $timestamps   = false;


}