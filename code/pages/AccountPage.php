<?php

class AccountPage extends SecuredPage {

}

class AccountPage_Controller extends SecuredPage_Controller {

	private static $allowed_actions = array(
		'logout',
		'AccountDetailsForm'
	);

	/**
	 * Handle logout
	 * @return SS_HTTPResponse
	 */
	public function logout(){
		if($member = Member::currentUser()){
			$member->logOut();
		}
		return $this->redirect($this->Link());
	}

	/**
	 * Account details form
	 * @return AccountDetailsForm
	 */
	public function AccountDetailsForm(){
		return new AccountDetailsForm($this);
	}

}