<?php
use Nette\Application\UI,
	Nette\Security as NS,
	Maite\Tabella;
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
    protected function listTasks($paginator, $idcategory = 0)
    { 
			if($idcategory == 0){
      $paginator->SetItemCount(dibi::query('SELECT count(*) FROM `tasks` WHERE iduser = %i', $this->getUser()->getId())->fetchSingle());
      $result  = dibi::query('SELECT * FROM `tasks` WHERE iduser = %i ORDER BY priority %ofs %lmt', $this->getUser()->getId(), $paginator->getOffset(), $paginator->getItemsPerPage())->fetchAll();
			}else{
				$arr = array(
    		'iduser' => $this->getUser()->getId(),
    		'idcategory' => $idcategory,
				);

				$paginator->SetItemCount(dibi::query('SELECT count(*) FROM `tasks` WHERE %and', $arr)->fetchSingle());
				$result  = dibi::query('SELECT * FROM `tasks` WHERE %and ORDER BY priority %ofs %lmt', $arr, $paginator->getOffset(), $paginator->getItemsPerPage())->fetchAll();
			}
			foreach($result as $row){
				if($row->deadline == "0000-00-00") $row->deadline = "";
			}

			return $result;
			}

/**
 * Function that creates add task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentAddTaskForm()
	{
		$form = new UI\Form;

    $form->getElementPrototype()->novalidate = 'novalidate';

		$form->addText('name', 'Task name:')
			->setRequired('Please provide a task name.');

		$form->addTextArea('description', 'Description:');
    
    $form->addText('date', 'Deadline')->setOption('description', 'Use format: YYYY-MM-DD')
      ->addCondition(UI\Form::FILLED)
        ->addRule(UI\Form::PATTERN, 'Může být v rozmezí 2011-01-01 až 2019-12-31', '^(20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$');

		
    
    $form->addRadioList('priority', 'Priority', array(
    	'1' => '1',
    	'2' => '2',
    	'3' => '3',
		));

    $result = dibi::query('SELECT idcategory, name FROM `categories` WHERE iduser = %i', $this->getUser()->getId())->fetchPairs('idcategory', 'name');
    
    $form->addRadioList('category', 'Category', $result)
      ->setRequired('Please select category.')
				->setDefaultValue($this->getParam('id'));

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
				'deadline'  => $values->date,
				'priority'  => $values->priority,
				'iduser'  => $this->getUser()->getId(),
				'idcategory'  => $values->category,
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

		$form->getElementPrototype()->novalidate = 'novalidate';

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

	private function deleteTask()
	{
		$arr = array(
    	'idtask' => $_GET["deleteTask"],
			'iduser'  => $this->getUser()->getId(),
        );

		dibi::query('DELETE FROM `tasks` WHERE %and', $arr );
	}

/**
 * Function that creates edit task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentEditTaskForm()
	{

		$form = new UI\Form;

    $form->getElementPrototype()->novalidate = 'novalidate';   
    
		$form->addText('name', 'Task name:')
			->setRequired('Please provide a task name.');

		$form->addTextArea('description', 'Description:');

    $form->addText('deadline', 'Deadline')->setOption('description', 'Use format: YYYY-MM-DD')
        ->addCondition(UI\Form::FILLED)
					->addRule(UI\Form::PATTERN, 'Může být v rozmezí 2011-01-01 až 2019-12-31', '^(20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$');

    $form->addRadioList('priority', 'Priority', array(
    	'1' => '1',
    	'2' => '2',
    	'3' => '3',
			'0' => 'bez priority'
		));

    $result = dibi::query('SELECT idcategory, name FROM `categories` WHERE iduser = %i', $this->getUser()->getId())->fetchPairs('idcategory', 'name');

    $form->addRadioList('idcategory', 'Category', $result)
      ->setRequired('Please select category.');

		$status = array(
    'nedokončeno' => 'nedokončeno',
    'odloženo' => 'odloženo',
		'dokončeno' => 'dokončeno',
		);
		$form->addRadioList('status', 'Status', $status)
      ->setRequired('Please select status.');

		$form->addHidden('idtask');

		$form->addSubmit('editTask', 'Edit Task');

		$form->onSuccess[] = callback($this, 'EditTaskFormSubmitted');

		$task = dibi::query('SELECT * FROM `tasks` WHERE idtask = %i', $this->getParam('id'))->fetch();

		if($task->deadline == "0000-00-00") $task->deadline = "";

		$form->setDefaults(array(
    'name' => $task->name,
    'description' => $task->description,
		'deadline' => $task->deadline,
		'status' => $task->status,
		'priority' => $task->priority,
		'idcategory' => $task->idcategory,
		'idtask' => $task->idtask,
		));

		return $form;
	}

/**
 * Function that is called when edit task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function EditTaskFormSubmitted($form)
	{
		$values = $form->getValues();

		$result = dibi::query('SELECT count(*) FROM `tasks` WHERE %and', array(
    	array('iduser = %i', $this->getUser()->getId()),
    	array('idtask = %i', $values->idtask),
			))->fetchSingle();

		if($result == "1"){
			if($values->priority == "0") $values->priority = "";

			$arr = array(
    		'name' => $values->name,
    		'description' => $values->description,
				'deadline' => $values->deadline,
				'status' => $values->status,
				'priority' => $values->priority,
				'idcategory' => $values->idcategory,
				);

				dibi::query('UPDATE `tasks` SET ', $arr, 'WHERE `idtask`=%i', $values->idtask);
		}
    $this->redirect('Homepage:default');
	}

	protected function getCategoryList()
	{
		$result = dibi::query('SELECT idcategory, name FROM `categories` WHERE iduser = %i', $this->getUser()->getId())->fetchAll();

		return $result;
	}

	protected function getCategoryName()
	{
		$arr = array(
    		'iduser' => $this->getUser()->getId(),
    		'idcategory' => $idcategory,
		);
		return $result = dibi::query('SELECT name FROM `categories` WHERE %and', $arr)->fetchSingle();
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
  
	if($this->getParam("deleteTask")) $this->deleteTask();

  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
      

			$this->template->categoryList = $this->getCategoryList();
      $this->template->tasks = $this->listTasks($this['vp']->getPaginator());
    
    }else{
      $this->template->loggedAs = "Nepřihlášen";
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }

	/**
 * Function puts variables into template
 */
  public function renderEditTask($id)
	{
	  $this->template->description =  "Semestrální práce pro WA1.";
	  $this->template->keywords =  "kruzimic, fel, čvut, java, programováni, php, html, css, js, ajax";
	  $this->template->title =  "ToDo-list / Edit Task";
	  $this->template->robots =  "index,follow";

    $session = $this->getSession('session');

  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }

  public function renderCategory($id)
	{
	  $this->template->description =  "Semestrální práce pro WA1.";
	  $this->template->keywords =  "kruzimic, fel, čvut, java, programováni, php, html, css, js, ajax";
	  $this->template->title =  "ToDo-list / Tasks";
	  $this->template->robots =  "index,follow";

    $session = $this->getSession('session');

  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";

			$this->template->categoryList = $this->getCategoryList();

			$this->template->tasks = $this->listTasks($this['vp']->getPaginator(), $id);

    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
	}
}
