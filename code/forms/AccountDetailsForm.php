<?php

class AccountDetailsForm extends Form
{

	/**
	 * AccountDetailsForm constructor.
	 * @param Controller $controller
	 */
    public function __construct(Controller $controller)
    {
    	//Current member
        $member = Member::currentUser();

		//Form fields
		$fields = $member->getMemberFormFields();
		if($hiddenFields = Member::config()->hidden_fields_accountform){
			$fields->removeByName($hiddenFields);
		}

		//Password field: do not require current password because social logins do not have a password
		$passwordField = $fields->dataFieldByName('Password');
		if($passwordField && $passwordField->class == 'ConfirmedPasswordField'){
			$passwordField->setRequireExistingPassword(false);
		}

		//Form actions
		$actions = new FieldList(array(
			FormAction::create('handle', _t('AccountDetailsForm.SAVE', 'Save'))
		));

		//Validator
		$validator = $member->getValidator();

		//Construct
        parent::__construct($controller, 'AccountDetailsForm', $fields, $actions, $validator);

		//Load data
        $this->loadDataFrom($member);
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

		//Password check
        if (array_key_exists('Password', $data) && array_key_exists('_Password', $data['Password']) && $data['Password']['_Password'] != '') {
            $data['Password'] = $data['Password']['_Password'];
        } else {
            unset($data['Password']);
        }

        //Update member
        $member->update($data);

		//Validate
        $validationResult = $member->validate();
        if (!$validationResult->valid()) {
            $this->sessionMessage($validationResult->message(), 'bad');
            return $this->controller->redirectBack();
        }

        //Write member
        $member->write();

		//Result
        $this->sessionMessage(_t('AccountDetailsForm.SAVE_SUCCESS_MESSAGE', 'Your details are saved successful'), 'success');
        return $this->controller->redirectBack();
    }

}