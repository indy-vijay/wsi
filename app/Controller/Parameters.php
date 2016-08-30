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
						    'A'  =>   'Abandoned',
						    'IP' =>   'In Process'	
						);

	protected static $orderCategory = array(
						   'SP'  => 'Screen Printing',
						   'E'   => 'Embroidery',
						   'PI'  => 'Promotional Items'
					    );

	protected static $deliveryType = array(
						   'D'    => 'Deliver',
						   'PU'   => 'Pick Up',
						   'UPS'  => 'U.P.S',
						   'FE'   => 'FedEx'	
						);

	protected static $placementPosition = array(
						   'F'  => 'Front',
						   'B'  => 'Back',
						   'L'  => 'Logo',
						   'LB' => 'Logo Back',
						   'PF' => 'Promotional Front',
						   'PB' => 'Promotional Back',
						   'LC' => 'Left chest',
						   'RC' => 'Right chest',
						   'LS' => 'Left sleeve',
						   'RS' => 'Right sleeve',
						   'NN' => 'Nape of neck',
						   'HF' => 'Hat front',
						   'HB' => 'Hat back',
						   'LH' => 'Left side of hat',
						   'RH' => 'Right side of hat',
						   'RF' => 'Right cuff',
						   'LF' => 'Left cuff',
						   'FF' => 'Full front',
						   'FB' => 'Full back',

						);

	protected static $orderCategoryPlacement = array(
							'SP' => array('F','B'),
                			'E' => array('L','LB','LC','RC','LS','RS','NN','HF','HB','LH','RH','RF','LF','FF','FB'),
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