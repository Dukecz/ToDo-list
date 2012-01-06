<?php

/**
 * Logout presenter.
 *
 * @author Michal Kruzik
 * @version 1.0
 */
class LogoutPresenter extends BasePresenter {
/**
 * Logouts user and redirect him to homepage
 */
    public function renderDefault() {
        $this->getUser()->logout();
        $this->redirect('Homepage:');
    }

}
