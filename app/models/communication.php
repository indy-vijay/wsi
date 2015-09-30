<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Communication extends Eloquent 
{
	protected $fillable    = array('contact_id','home_phone','mobile','fax','website','email','sms_text','sms_active','is_primary');
	public    $timestamps   = false;

	public static function createCommunication($req,$contact_id)
	{
		self::create(
            					array(
            								'contact_id' => $contact_id,
            								'email'      => $req->post('email'),
            								'home_phone' => $req->post('home_phone'),
            								'mobile'     => $req->post('mobile'),
            								'fax'        => $req->post('fax'),

            						)
            			    );
		return true;
	}

     public static function checkEmailExists($email)
     {
        return self::where('email','=',$email)->count();
     }

     public static function getCommunicationForContactId($contact_id)
     {
        $communication =   self::where('contact_id','=',$contact_id)
                                                          ->get()
                                                          ->toArray();

        if(count($communication) > 0 )
                $communication = $communication[0];

        return $communication;
     }

    public static function updateCommunication($req,$contact_id)
    {
        self::where('contact_id','=',$contact_id)
               ->update(array(
                                'email' => $req->post('email'),
                                'email_alternate'  => $req->post('email_alternate'),
                                'home_phone'  => $req->post('home_phone'),
                                'mobile'  => $req->post('mobile'),
                                'fax'  => $req->post('fax'),
                                'fax'  => $req->post('fax')
                                
                       ));
    }
}