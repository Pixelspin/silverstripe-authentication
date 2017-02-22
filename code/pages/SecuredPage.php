<?php

class SecuredPage extends Page {

}

class SecuredPage_Controller extends Page_Controller {

	/**
	 * Index action
	 * @return $this|HTMLText
	 */
	public function index()
	{
		//Check for a logged in member
		if(!Member::currentUser()){
			Session::set('BackURL', $this->Link());
			return $this->renderWith(array('RegisterLoginPage', 'Page'));
		}
		return $this;
	}

}