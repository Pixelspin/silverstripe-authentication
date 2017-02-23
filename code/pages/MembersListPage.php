<?php

class MembersListPage extends Page {

	private static $icon = 'authentication/images/icons/memberlist-icon.png';
	private static $description = 'List of all members with a profile';

	private static $db = array(
		'PageLength' => 'Int'
	);

	private static $has_one = array(
		'MembersGroup' => 'Group'
	);

	private static $defaults = array(
		'PageLength' => 10
	);

	/**
	 * CMS fields
	 * @return FieldList
	 */
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		//Page length
		$fields->addFieldToTab('Root.Main', NumericField::create('PageLength', _t('MembersListPage.PAGE_LENGTH', 'Page length')), 'Content');

		//Group field
		$allGroups = Group::get()->map()->toArray();
		$fields->addFieldToTab('Root.Main', $groupField = DropdownField::create('MembersGroupID', _t('MembersListPage.MEMBERS_GROUP', 'Members group'), $allGroups), 'Content');
		$groupField->setHasEmptyDefault(true);
		$groupField->setDescription(_t('MembersListPage.MEMBERS_GROUP_DESCRIPTION', 'Select the group to use as members pool'));

		return $fields;
	}

}

class MembersListPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'profile'
	);

	private static $url_handlers = array(
		'$MemberID!' => 'profile'
	);

	/**
	 * Paginated members
	 * @return PaginatedList
	 */
	public function PaginatedMembers(){
		//Members list
		if($group = $this->MembersGroup()){
			$list = $group->Members();
		}else{
			$list = Member::get();
		}
		//Pagination
		$pagination = new PaginatedList($list, $this->getRequest());
		$pagination->setPageLength($this->PageLength);
		return $pagination;
	}

	/**
	 * Public profiles
	 * @return ViewableData_Customised
	 */
	public function profile(){
		//Member ID
		$memberID = $this->getRequest()->param('MemberID');
		if(!$memberID){
			$this->httpError(404);
		}

		//Get all members
		if($group = $this->MembersGroup()){
			$allMembers = $group->Members();
		}else{
			$allMembers = Member::get();
		}

		//Find member by id
		$member = $allMembers->byID($memberID);
		if(!$member){
			$this->httpError(404);
		}

		//Output
		return $this->customise(array(
			'Member' => $member
		));
	}

}