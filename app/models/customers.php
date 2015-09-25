<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Customers extends Eloquent 
{
	protected $fillable    = array('first_name','last_name','company_name');
	public    $timestamps   = false;

	public static function createCustomer($req)
	{
		$contact_id =   self::insertGetId(
    							array( 
    										'first_name'   => $req->post('first_name'),
    										'last_name'    => $req->post('last_name'),
    										'company_name' => $req->post('company_name'),

    										)
    	                       );

		Customers::where('contact_id', $contact_id)
            		->update(array('username' => $contact_id));

        return $contact_id;
	}
}