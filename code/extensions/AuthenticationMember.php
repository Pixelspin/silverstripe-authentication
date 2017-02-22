<?php

class AuthenticationMember extends DataExtension {

	/**
	 * Absolute profile link
	 * @return string
	 */
	public function AbsoluteProfileLink(){
		return Director::absoluteURL($this->ProfileLink());
	}

	/**
	 * Relative profile link
	 * @return mixed
	 */
	public function ProfileLink(){
		$memberListPage = MembersListPage::get()->first();
		if(!$memberListPage){
			return false;
		}
		return $memberListPage->Link($this->owner->ID);
	}

}