<?php
use Nette\Application\UI,
	Nette\Forms\Form,
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
  
	protected function createComponentRegisterForm()
	{
		$form = new UI\Form;

		$form->getElementPrototype()->novalidate = 'novalidate';

		$form->addText('username', 'Username:')
			->setRequired('Please provide a username.')
				->addRule(Form::PATTERN, 'Může obsahovat pouze alfanumerické znaky a _', '^[a-zA-Z0-9_]+$');

		$form->addPassword('password', 'Password:')
			->setRequired('Please provide a password.')
				->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 5);

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
        $userDB = array(
          'username' => mysql_real_escape_string($_POST["username"]),
          'passw'  => md5($password . $this->salt),
        );

        dibi::begin();
        
        dibi::query('INSERT INTO users', $userDB); // vytvoření uživatele
        
        $userid = dibi::query('SELECT iduser FROM `users` WHERE username = %s', $username);
        $categoryDB = array(
          'name' => 'Default',
          'iduser'  => $userid,
        );
        
        dibi::query('INSERT INTO categories', $categoryDB); // vytvoření jeho defaultní kategorie
        
        dibi::commit();
        
        $this->redirect('Homepage:');     
      } 
    }	
      
		} catch (NS\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
  	
  public function renderDefault()
	{
	  $this->template->title =  "ToDo-list / Registration";
	
    $session = $this->getSession('session');
  
  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
    $this->redirect('Homepage:');
  }else{
  	$this->template->loggedAs = "Nepřihlášen";
  }
  $this->makeMenu($this->getUser()->isLoggedIn());
  }
}
