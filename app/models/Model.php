<?php

/**
 * Model base class
 * 
 * @author Michal Kruzik
 * @version 1.0
 */
class Model extends Nette\Object {

    /**
     * Static database variable
     * 
     * @var DibiConnection database connection 
     */
    private static $db;

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * Returns current connection or creates new one (as singleton)
     * 
     * @return DibiConnection 
     */
    public function getDb() {
        if (self::$db == NULL) {
            self::$db = new DibiConnection(Environment::getConfig('database'));
        }
        return self::$db;
    }

    /**
     * Constructor of Authenticator
     * 
     * @return Authenticator 
     */
    public function createAuthenticatorService() {
        return new Authenticator();
    }

}
