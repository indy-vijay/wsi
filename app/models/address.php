<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Address extends Eloquent 
{
    protected $fillable    = array('contact_id','address_1','address_2','city','state','zip','type','is_primary');
    public    $timestamps   = false;
}