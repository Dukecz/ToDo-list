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
class ProfilePresenter extends BasePresenter
{

  protected function listCategories($paginator)
  {
    $paginator->SetItemCount(dibi::query('SELECT count(*) FROM `categories` WHERE iduser = %i', $this->getUser()->getId())->fetchSingle());
    return $result  = dibi::query('SELECT * FROM `categories` WHERE iduser = %i %ofs %lmt', $this->getUser()->getId(), $paginator->getOffset(), $paginator->getItemsPerPage())->fetchAll();
  }

/**
 * Function that creates add task form
 *
 * @return UI\Form created add task form
 */
		protected function createComponentAddCategoryForm()
	{
		$form = new UI\Form;

		$form->addText('name', 'Task name:')
			->setRequired('Please provide a category name.');

		$form->addSubmit('addtask', 'Add Task');

		$form->onSuccess[] = callback($this, 'AddCategoryFormSubmitted');
		return $form;
	}

/**
 * Function that is called when add task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function AddCategoryFormSubmitted($form)
	{
		try {
			$values = $form->getValues();

			dibi::begin();

			$arr = array(
      	'name' => $values->name,
				'iduser'  => $this->getUser()->getId(),
        );

			dibi::query('INSERT INTO categories', $arr);

			dibi::commit();

      $this->redirect('Settings:');


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
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";

			$this->template->categories = $this->listCategories($this['vp']->getPaginator());
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
