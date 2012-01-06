<?php

use Nette\Security as NS;

/**
 * Users authenticator
 *
 * @author Michal Kruzik
 * @version 1.0
 */
class Authenticator extends Nette\Object implements NS\IAuthenticator {

    /**
     * Salt for passwords
     * 
     * @var type string
     */
    private $salt = "sůlnadzlato";

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * Performs an authentication
     * 
     * @param  array $credentials array of credetials
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials) {
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
                          WHERE username = %s', $username)->fetch();

        $data = array($username, $result->rolename);

        return new NS\Identity($result->iduser, $result->role, $data);
    }

}
