<?php 
namespace Controller;

class Parameters extends \SlimController\SlimController
{

	protected static $orderStatus = array(
							'OA' =>   'Order Approved',
							'SO' =>   'Stock Ordered',
							'AA' =>   'Artwork Approved',
						    'SR' =>   'Stock Recieved',
						    'OP' =>   'On Press',
						    'P'  =>   'Printed',
						    'D'  =>   'Delivered',
						    'QR' =>   'Quote Requested'
						);

	protected static $orderCategory = array(
						   'SP'  => 'Screen Printing',
						   'E'   => 'Embroidery',
						   'PI'  => 'Promotional Items'
					    );

	protected static $deliveryType = array(
						   'LD'  => 'Local Delivery',
						   'WC'  => 'Will Call / Pick Up',
						   'S'   => 'Shipping'
						);

	public static function getParameters($property)
	{	
			return self::${$property};
	}
}