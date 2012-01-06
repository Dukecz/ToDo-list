<?php

/**
 * Base presenter
 *
 * @author Michal Kruzik
 * @version 1.0
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    /**
     * Creates visual paginator
     * 
     * @return VisualPaginator Visual paginator
     */
    public function createComponentVp() {
        $vp = new VisualPaginator($this, 'vp');
        $paginator = $vp->getPaginator();
        $paginator->SetItemsPerPage(5);
        return $vp;
    }

    /**
     * Creates menu that depends on login status
     *
     * @param boolean $isLogged user login status
     */
    public function makeMenu($isLogged) {
        if (!$isLogged) {
            $this->template->menuItems = array(
                'Domů' => 'Homepage:',
                'Registrace' => 'Registration:',
            );
        } else {
            $this->template->menuItems = array(
                'Domů' => 'Homepage:',
                'Kategorie' => 'Categories:',
                'Profil' => 'Profile:',
                'Odhlášení' => 'Logout:',
            );
            if ($this->getUser()->isInRole('2')) {
                $this->template->menuItems = array(
                    'Domů' => 'Homepage:',
                    'Nastavení' => 'Categories:',
                    'Administrace' => 'Admin:',
                    'Profil' => 'Profile:',
                    'Odhlášení' => 'Logout:',
                );
            }
        }
    }

}
