<?php
use Nette\Application\UI,
	Nette\Security as NS;
/**
 * Homepage presenter.
 *
 * @author  Duke
 * @package ToDo list
 */

/**
 * Homepage Presenter
 *
 * @package ToDo list
 * @subpackage presenters
 */
class AdminPresenter extends BasePresenter
{
  protected function getRole($user)
	{

		if($user->isInRole('1')){
			$result = dibi::query('SELECT role FROM `roles` WHERE idroles = %i', 1)->fetch();
		}elseif($user->isInRole('2')){
			$result = dibi::query('SELECT role FROM `roles` WHERE idroles = %i', 2)->fetch();
		}else{
			$result = dibi::query('SELECT role FROM `roles` WHERE idroles = %i', 0)->fetch();
		}

		return $result->role;

  }

/**
 * Function puts variables into template
 */
  public function renderDefault()
	{
	  $this->template->description =  "Semestrální práce pro WA1.";
	  $this->template->keywords =  "kruzimic, fel, čvut, java, programováni, php, html, css, js, ajax";
	  $this->template->title =  "ToDo-list";
	  $this->template->robots =  "index,follow";
	
    $session = $this->getSession('session');
  
		if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getRole($this->getUser()) . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
