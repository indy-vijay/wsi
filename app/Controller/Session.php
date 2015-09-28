<?php 
namespace Controller;

class Session
{
	public static function setToken()
	{
		return $_SESSION['token'] = uniqid();
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
}