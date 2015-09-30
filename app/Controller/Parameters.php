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
						);

	public static function getParameters($property)
	{	
			return self::${$property};
	}
}