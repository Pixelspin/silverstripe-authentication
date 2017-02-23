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
			return Director::baseURL() . 'Security/Login?BackURL=' . $accountpage->Link();
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

	public function SocialAuthenticationOptions(){
		return AuthenticationSocial::get()->filter(array(
			'Enabled' => true
		));
	}

}