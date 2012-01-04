<?php
use Nette\Application\UI,
	Nette\Forms\Form,
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
class ProfilePresenter extends BasePresenter
{
private $salt = "sůlnadzlato";
/**
 * Function that creates add task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentEditPasswordForm()
	{
		$form = new UI\Form;

		$form->addPassword('password', 'Passowrd:')
			->setRequired('Please provide a password.')
				->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 5);;

		$form->addSubmit('changepassword', 'Change password');

		$form->onSuccess[] = callback($this, 'EditPasswordFormSubmitted');
		return $form;
	}

/**
 * Function that is called when add task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function EditPasswordFormSubmitted($form)
	{
		try {
			$values = $form->getValues();

			$arr = array(
      	'passw' => md5($values->password . $this->salt),
        );

			dibi::query('UPDATE `users` SET ', $arr, 'WHERE `iduser`=%i', $this->getUser()->getId());

      $this->redirect('Profile:');
		} catch (NS\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
/**
 * Function puts variables into template
 */
  public function renderDefault($id)
	{
	  $this->template->title =  "ToDo-list / Profile";
	
    $session = $this->getSession('session');

		if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
