<?php
use Nette\Application\UI,
	Nette\Security as NS;
/**
 * Homepage presenter.
 *
 * @author     Duke
 * @package    MyApplication
 */
class RegistrationPresenter extends BasePresenter
{
  private $salt = "sůlnadzlato";
  
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
            'Odhlášení' => 'Default:logout:',
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

		$form->addSubmit('send', 'Register');

		$form->onSuccess[] = callback($this, 'registerFormSubmitted');
		return $form;
	}
	
	public function registerFormSubmitted($form)
	{
		try {
			$values = $form->getValues();
			$username = $values->username;
      $password = $values->password;
			
		$reg = "#[^a-z0-9]#i";
		
    if(preg_match($reg, $username, $matches) > 0){ // pokud není jméno alfanumerické
      $form->addError("Uživatelské jméno může obsahovat pouze alfanumerické znaky.");
    }else{
      $result = dibi::query('SELECT * FROM `users` WHERE username = %s', $username);  // kontrola jestli je jméno již v db
      
      if(count($result) != 0){ // pokud ano vypíšeme chybu
      $form->addError("Uživatelské jméno je již registrováno.");
      }else{
        $arr = array(
          'username' => mysql_real_escape_string($_POST["username"]),
          'passw'  => md5($password . $this->salt),
        );

        dibi::query('INSERT INTO users', $arr);
        
        $this->redirect('Homepage:');     
      } 
    }	
      
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
