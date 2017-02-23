<?php

class RegistrationPage extends Page
{

	private static $icon = 'authentication/images/icons/register-icon.png';
	private static $description = 'Page containing a registration form';

	private static $has_one = array(
		'RegisteredMembersGroup' => 'Group'
	);

	/**
	 * CMS fields
	 * @return FieldList
	 */
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		//Group field
		$allGroups = Group::get()->map()->toArray();
		$fields->addFieldToTab('Root.Main', $groupField = DropdownField::create('RegisteredMembersGroupID', _t('RegistrationPage.REGISTERED_MEMBERS_GROUP', 'Registered members group'), $allGroups), 'Content');
		$groupField->setHasEmptyDefault(true);
		$groupField->setDescription(_t('RegistrationPage.REGISTERED_MEMBERS_GROUP_DESCRIPTION', 'The group to add the members to after they registered'));

		return $fields;
	}

}

class RegistrationPage_Controller extends Page_Controller
{

	private static $allowed_actions = array(
		'RegistrationForm'
	);

	/**
	 * Init
	 * @return SS_HTTPResponse
	 */
	public function init(){
		parent::init();
		if(Member::currentUserID()){
			if($accountPage = $this->AccountPage()){
				return $this->redirect($accountPage->Link());
			}
		}
	}

	/**
	 * Registration form
	 * @return RegistrationForm
	 */
	public function RegistrationForm(){
		return new RegistrationForm($this);
	}

}