<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Customers extends Eloquent 
{
	protected $fillable    = array('first_name','last_name','company_name','status');
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

		self::where('contact_id', $contact_id)
            		->update(array('username' => $contact_id));

        return $contact_id;
	}

	public static function getCustomerLogin($req)
	{
		//change password to md5 hasing later
	 	return self::select(['contact_id','status'])
	 						   ->where('username','=',$req->post('username'))
	 						   ->where('password','=',$req->post('password'))
	 						   ->get()
	 						   ->toArray();
	}

	public static function getCustomer($contact_id)
	{
		$customer =   self::where('contact_id','=',$contact_id)
                    							       ->get()
                           								->toArray();

        if(count($customer) > 0 )
                $customer = $customer[0];  

        return $customer;
	}

	public static function updateCustomer($req,$contact_id)
	{
		self::where('contact_id','=',$contact_id)
			   ->update(array(
			   					'first_name'    => $req->post('first_name'),
			   					'last_name'     => $req->post('last_name'),
			   					'company_name'  => $req->post('company_name')
			   		   ));
	}

}