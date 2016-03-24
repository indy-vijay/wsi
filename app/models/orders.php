<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Orders extends Eloquent 
{

	protected $fillable    = array('contact_id','date_completed','date_due','event_name','event_date','category','type','delivery_type','for_event','in_hands_date','status','old','downloaded');

    // public    $timestamps   = false;

	public static function getOrdersForCustomer($contact_id)
	{
		return  self::where('contact_id','=',$contact_id)
                                          ->get()
                                          ->toArray();
         
	}

	public static function createOrder($req,$contact_id)
	{
        
        $in_hands_date = null;

        if( null != $req->post('in_hands_date')){

            $in_hands_date = Carbon::createFromFormat('m-d-Y',$req->post('in_hands_date'));
            $in_hands_date = $in_hands_date->format('Y-m-d') ;

        }

		return self::insertGetId(
            					array(
            								'contact_id'       => $contact_id,
            								'date_completed'   => $req->post('date_completed'),
            								'delivery_type'    => $req->post('delivery_type'),
            								'category'         => $req->post('category'),
            								'type'             => $req->post('type'),
            								'for_event'        => $req->post('for_event'),
            								'in_hands_date'    => $in_hands_date,
            								'status'           => 'QR',
                                            'created_at'       => Carbon::now(),
                                            'old'              => 0,
                                            'downloaded'       => 1
            						)
            				);
   	
	}

    public static function getOrder($order_id, $contact_id = NULL)
    {
        $query = self::query();
        $query = $query->where('order_id',$order_id);

        if($contact_id)
            $query = $query->where('contact_id',$contact_id);

        return $query->get()
                        ->toArray();   
    }

    public static function artworks($order_id)
    {

    return self::join('order_artworks','orders.order_id','=','order_artworks.order_id')
                ->join('artworks','order_artworks.artwork_id','=','artworks.artwork_id')
                //->join('artwork_placement','orders.order_id','=','artwork_placement.order_id')
                ->where('order_artworks.order_id','=',$order_id)
                ->select('artworks.design_name', 'artworks.file_path','artworks.artwork_id')
                //->select('artworks.design_name', 'artworks.file_path','artworks.artwork_id','artwork_placement.artwork_placement')
                ->get();
        // return self::join('order_artworks','orders.order_id','=','order_artworks.order_id')
        //         ->join('artworks','order_artworks.artwork_id','=','artworks.artwork_id')
        //         ->where('order_artworks.order_id','=',$order_id)
        //         ->select('artworks.design_name', 'artworks.file_path','artworks.artwork_id')
        //         ->get();
    }

     public static function artwork_placement($order_id)
    {

    return self::join('artwork_placement','orders.order_id','=','artwork_placement.order_id')
                
                ->where('artwork_placement.order_id','=',$order_id)
                ->select('artwork_placement.artwork_placement')
                ->get();
     }

    

}