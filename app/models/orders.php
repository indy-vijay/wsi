<?php
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Orders extends Eloquent
{

    protected $fillable = array('contact_id', 'date_completed', 'date_due', 'event_name', 'event_date', 'category', 'type', 'delivery_type', 'for_event', 'in_hands_date', 'status', 'old', 'downloaded','order_notes');

    // public    $timestamps   = false;

    public function scopeGetOrdersForCustomer($query,$contact_id)
    {
        return $query->where('contact_id', '=', $contact_id)
            ->where('status','!=','A')
            ->get()
            ->toArray();

    }

    public function scopeCreateOrder($query, $req, $contact_id, $status = 'A')
    {

        $in_hands_date = null;
        if (null != $req->post('in_hands_date')) {

            $in_hands_date = Carbon::createFromFormat('m-d-Y', $req->post('in_hands_date'));
            $in_hands_date = $in_hands_date->format('Y-m-d');

        }

        $event_date = null;
        if (null != $req->post('event_date')) {

            $event_date = Carbon::createFromFormat('m-d-Y', $req->post('event_date'));
            $event_date = $event_date->format('Y-m-d');

        }
  
        return $query->insertGetId(
            array(
                'contact_id' => $contact_id,
                'date_completed' => $req->post('date_completed'),
                'delivery_type' => $req->post('delivery_type'),
                'category' => $req->post('category'),
                'type' => $req->post('type'),
                'for_event' => $req->post('for_event'),
                'event_name' => $req->post('event_name'),
                'event_date' => $event_date,
                'in_hands_date' => $in_hands_date,
                'status' => $status,
                'created_at' => Carbon::now(),
                'old' => 0,
                'downloaded' => 1,
                'order_notes' => $req->post('order_notes'),
            )
        );

    }

    public function scopeGetOrder($query, $order_id, $contact_id = null)
    {
        $query = $query->where('order_id', $order_id);

        if ($contact_id) {
            $query = $query->where('contact_id', $contact_id);
        }

        return $query->get()
            ->toArray();
    }

    public function scopeSetStatus($query,$order_id, $status = 'QR')
    {
        return $query->where('order_id', $order_id)
                      ->update(['status'=>$status]);
    }
    
    public static function artworks($order_id)
    {

        return self::join('order_artworks', 'orders.order_id', '=', 'order_artworks.order_id')
            ->join('artworks', 'order_artworks.artwork_id', '=', 'artworks.artwork_id')
        //->join('artwork_placement','orders.order_id','=','artwork_placement.order_id')
            ->where('order_artworks.order_id', '=', $order_id)
            ->select('artworks.design_name', 'artworks.file_path', 'artworks.artwork_id')
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

        return self::join('artwork_placement', 'orders.order_id', '=', 'artwork_placement.order_id')

            ->where('artwork_placement.order_id', '=', $order_id)
            ->select('artwork_placement.artwork_placement','artwork_placement.artwork_id')
            ->get();
    }

}
