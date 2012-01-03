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

  protected function listUsers($paginator)
  {
    $paginator->SetItemCount(dibi::query('SELECT count(*) FROM `users`')->fetchSingle());
    return $result  = dibi::query('SELECT * FROM `users` ORDER BY username %ofs %lmt', $paginator->getOffset(), $paginator->getItemsPerPage())->fetchAll();
  }

	private function deleteUser()
	{
		if ($this->getUser()->isInRole('2')) { // je uživatel v roli admina?
		dibi::query('DELETE FROM `users` WHERE iduser = %s', $_GET["deleteUser"] );
		}
	}

/**
 * Function that creates edit task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentEditUserForm()
	{

		$form = new UI\Form;

		$form->getElementPrototype()->novalidate = 'novalidate';

		$form->addText('username', 'Username:')
			->setRequired('Please provide a task name.');

		$result = dibi::query('SELECT idroles, role FROM `roles`')->fetchPairs('idroles', 'role');

	  $form->addRadioList('role', 'Role', $result)
      ->setRequired('Please select role.');

		$form->addHidden('iduser');

		$form->addSubmit('editUser', 'Edit User');

		$form->onSuccess[] = callback($this, 'EditUserFormSubmitted');

		$user = dibi::query('SELECT * FROM `users` WHERE iduser = %i', $this->getParam('id'))->fetch();

		$form->setDefaults(array(
    'username' => $user->username,
    'role' => $user->role,
		'iduser' => $this->getParam('id'),
		));

		return $form;
	}

/**
 * Function that is called when edit task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function EditUserFormSubmitted($form)
	{
		if($this->getUser()->isInRole('2')){
		$values = $form->getValues();

		$arr = array(
    	'username' => $values->username,
			'role' => $values->role,
		);

			dibi::query('UPDATE `users` SET ', $arr, 'WHERE `iduser`=%i', $values->iduser);
	}
      $this->redirect('Admin:default');
	}


/**
 * Function puts variables into template
 */
  public function renderDefault()
	{
	  $this->template->title =  "ToDo-list";
	
    $session = $this->getSession('session');

		if(isset($_GET["deleteUser"])) $this->deleteUser();
  
		if($this->getUser()->isInRole('2')) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";

      $this->template->users = $this->listUsers($this['vp']->getPaginator());
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }

/**
 * Function puts variables into template
 */
  public function renderEditUser($id)
	{
	  $this->template->title =  "ToDo-list / Admin";

    $session = $this->getSession('session');

  if($this->getUser()->isInRole('2')) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
