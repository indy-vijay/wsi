<?php 
namespace Controller;

class Session
{
	public static function setToken()
	{
		$_SESSION['token'] = uniqid();
		return $_SESSION['token'];
	}

	public static function getToken()
	{

		return isset($_SESSION['token']) ? $_SESSION['token'] : false ;
	}

	public static function unsetToken()
	{
		unset($_SESSION['token']);
	}

	public static function validateSubmission($req)
	{
		$valid = ($req->isPost() && self::getToken() && $req->post('token') == self::getToken() ) ? true : false;
		self::unsetToken();
		return $valid;
	}

	public static function setPendingOrder($order_id)
	{
	 	$_SESSION['unconfirmed_order_id'] = $order_id;
	}

	public static function getPendingOrder()
	{
	 	return  isset($_SESSION['unconfirmed_order_id']) ? $_SESSION['unconfirmed_order_id'] : false ;
	}

	public static function unsetPendingOrder()
	{
	 	unset($_SESSION['unconfirmed_order_id']);
	}
}