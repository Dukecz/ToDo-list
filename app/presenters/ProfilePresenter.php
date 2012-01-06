<?php

use Nette\Application\UI,
    Nette\Forms\Form,
    Nette\Security as NS;

/**
 * Profile presenter.
 *
 * @author Michal Kruzik
 * @version 1.0
 */
class ProfilePresenter extends BasePresenter {

    /**
     *
     * @var strig Password salt 
     */
    private $salt = "sůlnadzlato";

    /**
     * Creates Edit password form
     *
     * @return UI\Form Edit password form
     */
    public function createComponentEditPasswordForm() {
        $form = new UI\Form;

        $form->addPassword('password', 'Password:')
                ->setRequired('Please provide a password.')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 5);
        ;

        $form->addSubmit('changepassword', 'Change password');

        $form->onSuccess[] = callback($this, 'EditPasswordFormSubmitted');
        return $form;
    }

    /**
     * Edits password based on form data
     *
     * @param UI\Form submitted form
     */
    public function EditPasswordFormSubmitted($form) {
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
     * Puts variables into default template
     */
    public function renderDefault() {
        $this->template->title = "ToDo-list / Profile";

        $session = $this->getSession('session');

        if ($this->getUser()->isLoggedIn()) { // přihlášení uživatelé
            $this->template->loggedAs = "Přihlášen jako " . $this->getUser()->identity->data[0] . " (" . $this->getUser()->identity->data[1] . ")";
        } else {
            $this->redirect('Homepage:');
        }
        $this->makeMenu($this->getUser()->isLoggedIn());
    }

}
