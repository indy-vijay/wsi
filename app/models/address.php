<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Address extends Eloquent 
{
    protected $fillable    = array('contact_id','address_1','address_2','city','state','zip','type','is_primary');
    public    $timestamps   = false;

    public static function createAddress($req, $contact_id)
    {
    	self::create(
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

    public static function getAddressForContactId( $contact_id)
    {
        $address =  self::where('contact_id','=',$contact_id)
                           ->get()
                           ->toArray();

        if(count($address) > 0 )
                $address = $address[0];

        return $address;
    }

    public static function updateAddress($req,$contact_id)
    {
        self::where('contact_id','=',$contact_id)
               ->update(array(
                                'address_1' => $req->post('address_1'),
                                'city'  => $req->post('city'),
                                
                       ));
    }

}