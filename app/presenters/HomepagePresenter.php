<?php
use Nette\Application\UI,
	Nette\Security as NS;
/**
 * Homepage presenter.
 *
 * @author     Duke
 * @package    MyApplication
 */
class HomepagePresenter extends BasePresenter
{
    
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
            'Nastavení' => 'Settigns:',
            'Odhlášení' => 'Logout:',
            );    
    }
  }
  
	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		$form->addText('username', 'Username:')
			->setRequired('Please provide a username.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please provide a password.');

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = callback($this, 'signInFormSubmitted');
		return $form;
	}
	
	public function signInFormSubmitted($form)
	{
		try {
			$values = $form->getValues();
			
			$this->getUser()->login($values->username, $values->password);
      $this->redirect('Homepage:');
			
      
		} catch (NS\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
  	
  public function renderDefault()
	{
	  $this->template->description =  "Semestrální práce pro WA1.";
	  $this->template->keywords =  "kruzimic, fel, čvut, java, programováni, php, html, css, js, ajax";
	  $this->template->title =  "ToDo-list";
	  $this->template->robots =  "index,follow";
	
    $session = $this->getSession('session');
  
  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
    $this->template->loggedAs = "Přihlášen jako " . $this->getUser()->getId();
    }else{
        $this->template->loggedAs = "Nepřihlášen";
        $this->createComponentSignInForm();
    }
     $this->makeMenu($this->getUser()->isLoggedIn());
  }
}
