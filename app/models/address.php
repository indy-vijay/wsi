<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Address extends Eloquent 
{
    protected $fillable    = array('contact_id','address_1','address_2','city','state','zip','type','is_primary');
    public    $timestamps   = false;

    public static function createAddress($req, $contact_id)
    {
    	Address::create(
            					array(
            								'contact_id' => $contact_id,
            								'address_1'  => $req->post('address_1'),
            								'city'       => $req->post('city'),
            								'zip'        => $req->post('zip'),
            								'state'      => $req->post('state'),
            								'type'       => $req->post('B'),
            						)
            				);

    	return true;
    }

}