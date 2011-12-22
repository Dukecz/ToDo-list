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
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
