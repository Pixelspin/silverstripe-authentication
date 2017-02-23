<?php

class SecuredPage extends Page {

	private static $icon = 'authentication/images/icons/lock-icon.png';
	private static $description = 'Page only accesible for logged in users';

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