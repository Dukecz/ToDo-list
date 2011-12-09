<?php


/**
 * Model base class.
 */
class Model extends Nette\Object
{
  private static $db;
  
	public function __construct()
	{
	}
    

  public function getDb() {
        if (self::$db == NULL) {
            self::$db = new DibiConnection(Environment::getConfig('database'));
        }

        return self::$db;
    }


	public function createAuthenticatorService()
	{
		return new Authenticator();
	}

}
