<?php

use Nette\Application\UI,
    Nette\Security as NS;

/**
 * Categories presenter
 *
 * @author Michal Kruzik
 * @version 1.0
 */
class CategoriesPresenter extends BasePresenter {
/**
 * List users categories
 * 
 * @param VisualPaginator $paginator
 * @return array Array of categories 
 */
    private function listCategories($paginator) {
        $paginator->SetItemCount(dibi::query('SELECT count(*) FROM `categories` WHERE iduser = %i', $this->getUser()->getId())->fetchSingle());
        return $result = dibi::query('SELECT * FROM `categories` WHERE iduser = %i %ofs %lmt', $this->getUser()->getId(), $paginator->getOffset(), $paginator->getItemsPerPage())->fetchAll();
    }

    /**
     * Creates add task form
     *
     * @return UI\Form created add category form
     */
    public function createComponentAddCategoryForm() {
        $form = new UI\Form;

        $form->getElementPrototype()->novalidate = 'novalidate';

        $form->addText('name', 'Task name:')
                ->setRequired('Please provide a category name.');

        $form->addSubmit('addtask', 'Add Task');

        $form->onSuccess[] = callback($this, 'AddCategoryFormSubmitted');
        return $form;
    }

    /**
     * Adds category based on form data
     *
     * @param UI\Form submitted form
     */
    public function AddCategoryFormSubmitted($form) {
        try {
            $values = $form->getValues();

            dibi::begin();

            $arr = array(
                'name' => $values->name,
                'iduser' => $this->getUser()->getId(),
            );

            dibi::query('INSERT INTO categories', $arr);

            dibi::commit();

            $this->redirect('Settings:');
        } catch (Exception $e) {
            $form->addError($e->getMessage());
        }
    }
/**
 * Deletes category from database
 * 
 * @param integer $category category id
 */
    private function deleteCategory($category) {
        try {
            dibi::query('DELETE FROM `categories` WHERE idcategory = %i', $category);
        } catch (Exception $e) {
            $this->template->error = "Nelze vymazat kategorii, která obsahuje úkoly.";
            $this->redirect('Categories:');
        }
    }

    /**
     * Creates edit category form
     *
     * @return UI\Form Category form
     */
    protected function createComponentEditCategoryForm() {
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
     * Edits category based on form data
     *
     * @param UI\Form submitted form
     */
    public function EditCategoryFormSubmitted($form) {
        $values = $form->getValues();

        $result = dibi::query('SELECT count(*) FROM `tasks` WHERE %and', array(
                    array('iduser = %i', $this->getUser()->getId()),
                    array('idcategory = %i', $values->idcategory),
                ))->fetchSingle();

        if ($result == "1") {

            $arr = array(
                'name' => $values->name,
            );

            dibi::query('UPDATE `categories` SET ', $arr, 'WHERE `idcategory`=%i', $values->idcategory);
        }
        $this->redirect('Categories:default');
    }

    /**
     * Puts variables into default template
     */
    public function renderDefault() {
        $this->template->title = "ToDo-list";

        $session = $this->getSession('session');

        if (isset($_GET["deleteCategory"]))
            $this->deleteCategory($_GET["deleteCategory"]);

        if ($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
            $this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";

            $this->template->categories = $this->listCategories($this['vp']->getPaginator());
        } else {
            $this->redirect('Homepage:');
        }
        $this->makeMenu($this->getUser()->isLoggedIn());
    }

    /**
     * Puts variables into EditCategory template
     */
    public function renderEditCategory($id) {
        $this->template->title = "ToDo-list / Categories";

        $session = $this->getSession('session');

        if ($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
            $this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
        } else {
            $this->redirect('Homepage:');
        }
        $this->makeMenu($this->getUser()->isLoggedIn());
    }

}
