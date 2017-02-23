<?php

class AuthenticationSiteTree extends DataExtension {

	/**
	 * Get the first account page
	 * @return AccountPage
	 */
	public function AccountPage()
	{
		return AccountPage::get()->first();
	}

	/**
	 * Get the first registration page
	 * @return RegistrationPage
	 */
	public function RegistrationPage()
	{
		return RegistrationPage::get()->first();
	}

	/**
	 * Login URL
	 * @return string
	 */
	public function LoginLink()
	{
		if($accountpage = $this->AccountPage()){
			return $accountpage->Link();
		}
		return Director::baseURL() . 'Security/Login';
	}

	/**
	 * Logout URL
	 * @return string
	 */
	public function LogoutLink()
	{
		if($accountpage = $this->AccountPage()){
			return $accountpage->Link('logout');
		}
		return Director::baseURL() . 'Security/Logout';
	}

	/**
	 * Remove account url
	 * @return string
	 */
	public function RemoveAccountLink()
	{
		if($accountpage = $this->AccountPage()){
			return $accountpage->Link('removeaccount');
		}
		return false;
	}

	/**
	 * Get a list with enabled social authentication options
	 * @return DataList
	 */
	public function SocialAuthenticationOptions(){
		return AuthenticationSocial::get()->filter(array(
			'Enabled' => true
		));
	}

}