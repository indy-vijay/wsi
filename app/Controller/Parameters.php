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
						    'QR' =>   'Quote Requested',
						    'A'  =>   'Abandoned'	
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

	protected static $placementPosition = array(
						   'F'  => 'Front',
						   'B'  => 'Back',
						   'L'  => 'Logo',
						   'LB' => 'Logo BAck',
						   'PF' => 'Promotional Front',
						   'PB' => 'Promotional Back'
						);

	protected static $orderCategoryPlacement = array(
							'SP' => array('F','B'),
                			'E' => array('L','LB'),
                			'PI' => array('PF','PB')	
                			);



	public static function getParameters($property)
	{	
			return self::${$property};
	}
	public static function getOrderCategoryPlacement($category_type)
	{
			$orderCategoryPlacement = self::${'orderCategoryPlacement'};
			foreach ($orderCategoryPlacement as $orderCategoryPlacement_category_type => $placement_array) {
				if($orderCategoryPlacement_category_type == $category_type)
				{
					foreach ($placement_array as $placementPosition ) {
						$placementPosition_array = self::${'placementPosition'};
						foreach ($placementPosition_array as $shortcode => $position) {
							if($shortcode == $placementPosition)
							$p[] = array($shortcode => $position) ;
						}
					
					}
			
				}
			}
			return $p;
	}
}