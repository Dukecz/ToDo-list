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
class HomepagePresenter extends BasePresenter
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
 * Function that creates add task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentAddTaskForm()
	{
		$form = new UI\Form;

		$form->addText('name', 'Task name:')
			->setRequired('Please provide a task name.');

		$form->addTextArea('description', 'Description:');

		$form->addRadioList('priority', 'Priority', array(
    	'1' => '1',
    	'2' => '2',
    	'3' => '3',
		));



		$form->addSubmit('addtask', 'Add Task');

		$form->onSuccess[] = callback($this, 'AddTaskFormSubmitted');
		return $form;
	}

/**
 * Function that is called when add task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function AddTaskFormSubmitted($form)
	{
		try {
			$values = $form->getValues();

			dibi::begin();

			$arr = array(
      	'name' => $values->name,
    		'description'  => $values->description,
				'priority'  => $values->priority,
				'iduser'  => $this->getUser()->getId(),
				'idcategory'  => $values->idcategory,
        );

			dibi::query('INSERT INTO tasks', $arr);

			dibi::commit();

      $this->redirect('Homepage:');


		} catch (NS\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

/**
 * Function that creates sign in form
 *
 * @return UI\Form created sign in form
 */
	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		//$form = new Form;
		$form->addText('username', 'Username:')
			->setRequired('Please provide a username.')
			->addRule(UI\Form::PATTERN, 'Může obsahovat pouze alfanumerické znaky a _', '^[a-zA-Z0-9_]+$');

		$form->addPassword('password', 'Password:')
			->setRequired('Please provide a password.')
			->addRule(UI\Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 5);
    

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = callback($this, 'signInFormSubmitted');
		return $form;
	}

/**
 * Function that is called when sign in form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
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
			$this->createComponentAddTaskForm();
    }else{
      $this->template->loggedAs = "Nepřihlášen";
      $this->createComponentSignInForm();
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
