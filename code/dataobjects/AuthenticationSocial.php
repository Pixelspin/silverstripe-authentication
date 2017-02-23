<?php

class AuthenticationSocial extends DataObject {

	private static $db = array(
		'Enabled' => 'Boolean',
		'AppID' => 'Varchar(255)',
		'AppSecret' => 'Varchar(255)'
	);

	private static $summary_fields = array(
		'Title',
		'Enabled'
	);

	/**
	 * Disable delete
	 * @param null $member
	 * @return bool
	 */
	public function canDelete($member = null)
	{
		return false;
	}

	/**
	 * Disable create
	 * @param null $member
	 * @return bool
	 */
	public function canCreate($member = null)
	{
		return false;
	}

	/**
	 * CMS fields
	 * @return FieldList
	 */
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', HeaderField::create('Header', $this->getTitle()), 'Enabled');

		return $fields;
	}

	/**
	 * Login link
	 * @return string
	 */
	public function Link(){
		return Director::baseURL() . 'hybridauth/' . $this->ID;
	}

	/**
	 * Hybridauth config
	 * @return array
	 */
	public function getHybridauthConfig(){
		return array(
			'enabled' => $this->Enabled,
			'keys' => array(
				'id' => $this->AppID ? $this->AppID : '',
				'secret' => $this->AppSecret ? $this->AppSecret : ''
			)
		);
	}

	/**
	 * Provider name
	 * @return string
	 */
	public function getProviderName(){
		return '';
	}

	/**
	 * Handle login
	 * @param $profile
	 * @return DataObject
	 */
	public function handleLogin($profile){
		//Find member if exists
		$member = Member::get()->filter(array(
			'Email' => $profile->email
		))->first();
		if(!$member){
			//Create member
			$member = new Member();
			$member->FirstName = $profile->firstName;
			$member->Surname = $profile->lastName;
			$member->Email = $profile->email;
			$member->write();
			//Add to group if needed
			$registrationPage = RegistrationPage::get()->first();
			if($registrationPage){
				if($group = $registrationPage->RegisteredMembersGroup()){
					$member->Groups()->add($group);
				}
			}
			if($member->hasMethod('AfterHybridauthCreate')){
				$member->AfterHybridauthCreate($profile, $this);
			}
		}

		//Login
		$member->login();
		if($member->hasMethod('AfterHybridauthLogin')){
			$member->AfterHybridauthLogin($profile, $this);
		}

		//Return
		return $member;
	}

}