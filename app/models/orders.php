<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Orders extends Eloquent 
{

	public static function getOrdersForCustomer($contact_id)
	{
		return  self::where('contact_id','=',$contact_id)
                                          ->get()
                                          ->toArray();
         
	}

}