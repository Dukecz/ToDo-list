<?php

/**
 * Homepage presenter.
 *
 * @author     Duke
 * @package    MyApplication
 */
class RozvrhPresenter extends BasePresenter{

	
  public function renderDefault()
	{
	  $this->template->description =  "Rozvrh";
	  $this->template->keywords =  "duke, fel, čvut, rozvrh";
	  $this->template->title =  "Rozvrh - duke.dynalias.com";
	  $this->template->robots =  "index,follow";
	}
}
