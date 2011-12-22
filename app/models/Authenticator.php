<?php

use Nette\Security as NS;


/**
 * Users authenticator.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class Authenticator extends Nette\Object implements NS\IAuthenticator
{
  private $salt = "sůlnadzlato";
  
	public function __construct()
	{
  }
	/**
	 * Performs an authentication
	 * @param  array
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		
    $result = dibi::query('SELECT * FROM `users` WHERE %and', array(
        array('username = %s', mysql_real_escape_string($username)),
        array('passw = %s', md5($password . $this->salt)),
        ));

		if (count($result) != 1) {
			throw new NS\AuthenticationException("Invalid username or password.", self::INVALID_CREDENTIAL);
		}

		$result = dibi::query('SELECT iduser, users.role AS role, roles.role as rolename FROM `users`
                          JOIN `roles` ON users.role = roles.idroles
                          WHERE `username` = %s', $username)->fetch();
                          
    $data = array($username, $result->rolename);

		return new NS\Identity($result->iduser, $result->role, $data);
	}



	/**
	 * Computes salted password hash.
	 * @param  string
	 * @return string
	 */
	public function calculateHash($password)
	{
		return md5($password . str_repeat('*enter any random salt here*', 10));
	}

}
