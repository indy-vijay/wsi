<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Customers extends Eloquent 
{
	protected $fillable    = array('first_name','last_name','company_name');
	public    $timestamps   = false;
}