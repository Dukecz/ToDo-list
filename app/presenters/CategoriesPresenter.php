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
class CategoriesPresenter extends BasePresenter
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

		$form->getElementPrototype()->novalidate = 'novalidate';

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


		} catch (Exception $e) {
			$form->addError($e->getMessage());
		}
	}

	private function deleteCategory()
	{
		try {
		dibi::query('DELETE FROM `categories` WHERE idcategory = %s', $_GET["deleteCategory"] );
		} catch (Exception $e) {
    $this->template->error = "Nelze vymazat kategorii, která obsahuje úkoly.";
		//$this->redirect('Categories:');
		}
	}

	/**
 * Function that creates edit task form
 *
 * @return UI\Form created add task form
 */
	protected function createComponentEditCategoryForm()
	{
		$form = new UI\Form;

		$form->getElementPrototype()->novalidate = 'novalidate';

		$form->addText('name', 'Category name:')
			->setRequired('Please provide a category name.');

		$form->addHidden('idcategory');

		$form->addSubmit('editCategory', 'Edit Category');

		$form->onSuccess[] = callback($this, 'EditCategoryFormSubmitted');

		$category = dibi::query('SELECT idcategory, name FROM `categories` WHERE idcategory = %i', $this->getParam('id'))->fetch();

		$form->setDefaults(array(
    'name' => $category->name,
		'idcategory' => $this->getParam('id'),
		));

		return $form;
	}

/**
 * Function that is called when edit task form is successfuly submitted
 *
 * @param UI\Form submitted form
 */
	public function EditCategoryFormSubmitted($form)
	{
		$values = $form->getValues();

		$result = dibi::query('SELECT count(*) FROM `tasks` WHERE %and', array(
    	array('iduser = %i', $this->getUser()->getId()),
    	array('idcategory = %i', $values->idcategory),
			))->fetchSingle();

		if($result == "1"){

		$arr = array(
    	'name' => $values->name,
		);

			dibi::query('UPDATE `categories` SET ', $arr, 'WHERE `idcategory`=%i', $values->idcategory);
	}
      $this->redirect('Categories:default');
	}

/**
 * Function puts variables into template
 */
  public function renderDefault()
	{
	  $this->template->title =  "ToDo-list";
	
    $session = $this->getSession('session');

		if(isset($_GET["deleteCategory"])) $this->deleteCategory();

		if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";

			$this->template->categories = $this->listCategories($this['vp']->getPaginator());
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }

	/**
 * Function puts variables into template
 */
  public function renderEditCategory($id)
	{
	  $this->template->title =  "ToDo-list / Categories";

    $session = $this->getSession('session');

  if($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
			$this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
    }else{
      $this->redirect('Homepage:');
    }
    	$this->makeMenu($this->getUser()->isLoggedIn());
  }
}
