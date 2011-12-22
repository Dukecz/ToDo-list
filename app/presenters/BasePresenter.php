<?php

/**
 * Base class for all application presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
/**
 * Function that creates menu that depends on login status
 *
 * @param boolean $isLogged user login status
 */
  protected function makeMenu($isLogged)
	{
    if(!$isLogged){
    $this->template->menuItems = array(
            'Domů' => 'Homepage:',
            'Registrace' => 'Registration:',
            );
    }else{
    $this->template->menuItems = array(
            'Domů' => 'Homepage:',
            'Nastavení' => 'Settings:',
            'Odhlášení' => 'Logout:',
            );
			if($this->getUser()->isInRole('2')){
    		$this->template->menuItems = array(
            'Domů' => 'Homepage:',
            'Nastavení' => 'Settings:',
						'Administrace' => 'Admin:',
            'Odhlášení' => 'Logout:',
            );
			}
    }
  }  
}
