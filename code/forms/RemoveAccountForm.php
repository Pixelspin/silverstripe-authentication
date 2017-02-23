<?php

class RemoveAccountForm extends Form {

	/**
	 * RemoveAccountForm constructor.
	 * @param Controller $controller
	 */
	public function __construct(Controller $controller)
	{
		//Form fields
		$fields = new FieldList(array(
			new PasswordField('Password', _t('RemoveAccountForm.PASSWORD', 'Password'))
		));

		//Form actions
		$actions = new FieldList(array(
			FormAction::create('handle', _t('RemoveAccountForm.CONFIRM', 'Confirm'))
		));

		//Validator
		$validator = new RequiredFields(array(
			'Password'
		));

		//Construct
		parent::__construct($controller, 'RemoveAccountForm', $fields, $actions, $validator);
	}

	/**
	 * Handle form post
	 * @param $data
	 * @param Form $form
	 * @return bool|SS_HTTPResponse
	 */
	public function handle($data, Form $form)
	{
		//Current member
		$member = Member::currentUser();

		//Check password
		$validationResult = $member->checkPassword($data['Password']);
		if(!$validationResult->valid()){
			$this->sessionMessage($validationResult->message(), 'bad');
			return $this->controller->redirectBack();
		}

		//Delete member
		$member->logOut();
		$member->delete();

		//Return
		return $this->controller->redirect(Director::baseURL());
	}

}