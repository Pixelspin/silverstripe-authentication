<?php

class AccountPage extends SecuredPage {

	private static $icon = 'authentication/images/icons/account-icon.png';
	private static $description = 'Member account page';

}

class AccountPage_Controller extends SecuredPage_Controller {

	private static $allowed_actions = array(
		'logout',
		'AccountDetailsForm',
		'removeaccount',
		'RemoveAccountForm'
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

	/**
	 * Remove account page
	 * @return $this
	 */
	public function removeaccount(){
		return $this;
	}

	public function RemoveAccountForm(){
		return new RemoveAccountForm($this);
	}

}