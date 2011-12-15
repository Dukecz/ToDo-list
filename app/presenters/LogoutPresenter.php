<?php

/**
 * Sign in/out presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class LogoutPresenter extends BasePresenter
{


  public function renderDefault()
  {
	 $this->getUser()->logout();
	 $this->redirect('Homepage:');
  }

}
