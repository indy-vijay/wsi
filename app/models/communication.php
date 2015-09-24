<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Communication extends Eloquent 
{
	protected $fillable    = array('contact_id','home_phone','mobile','fax','website','email','sms_text','sms_active','is_primary');
	public    $timestamps   = false;
}