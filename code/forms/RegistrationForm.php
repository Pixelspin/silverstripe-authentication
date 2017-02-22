<?php

class RegistrationForm extends Form {

	/**
	 * RegistrationForm constructor.
	 * @param Controller $controller
	 */
	public function __construct(Controller $controller)
	{
		//Singleton
		$singletonMember = singleton('Member');

		//Form fields
		$fields = $singletonMember->getMemberFormFields();
		if($hiddenFields = Member::config()->hidden_fields_registerform){
			$fields->removeByName($hiddenFields);
		}

		//Form actions
		$actions = new FieldList(array(
			FormAction::create('handle', _t('RegistrationForm.REGISTER', 'Register'))
		));

		//Validator
		$validator = $singletonMember->getValidator();

		//Construct
		parent::__construct($controller, 'RegistrationForm', $fields, $actions, $validator);

		//Spam protection
		if($this->hasExtension('FormSpamProtectionExtension')) {
			$this->enableSpamProtection();
		}

		//Session data
		$sessionData = Session::get("FormInfo.{$this->FormName()}.data");
		if ($sessionData) {
			$this->loadDataFrom($sessionData);
		}
	}

	/**
	 * Handle form post
	 * @param $data
	 * @param Form $form
	 * @return bool|SS_HTTPResponse
	 */
	public function handle($data, Form $form){
		//Validate member
		$data['Password'] = $data['Password']['_Password'];
		$member = new Member($data);
		$validationResult = $member->validate();
		if(!$validationResult->valid()){
			$this->sessionMessage($validationResult->message(), 'bad');
			Session::set("FormInfo.{$this->FormName()}.data", $data);
			return $this->controller->redirectBack();
		}

		//Write member
		$member->write();

		//Add to group
		if($group = $this->controller->RegisteredMembersGroup()){
			$member->Groups()->add($group);
		}

		//Login
		$member->logIn(true);

		//Redirect to account
		$accountPage = $this->controller->AccountPage();
		return $this->controller->redirect($accountPage->Link());
	}

}