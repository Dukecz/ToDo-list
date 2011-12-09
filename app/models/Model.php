<?php


/**
 * Model base class.
 */
class Model extends Nette\Object
{

	public function __construct()
	{
	}



	public function createAuthenticatorService()
	{
		return new Authenticator();
	}

}
