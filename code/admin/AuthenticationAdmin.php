<?php

class AuthenticationAdmin extends ModelAdmin {

	public $showImportForm = false;

	private static $menu_icon = 'authentication/images/icons/lock-icon.png';

	private static $managed_models = array(
		'AuthenticationSocial'
	);

	private static $url_segment = 'authentication';

	private static $menu_title = 'Authentication';

	public function getEditForm($id = null, $fields = null)
	{
		$form = parent::getEditForm($id, $fields);

		$authenticationSocialGridField = $form->Fields()->dataFieldByName($this->sanitiseClassName('AuthenticationSocial'));
		if ($authenticationSocialGridField instanceof GridField) {
			$authenticationSocialGridField->getConfig()->removeComponentsByType('GridFieldAddNewButton');
			$authenticationSocialGridField->getConfig()->removeComponentsByType('GridFieldDeleteAction');
			$authenticationSocialGridField->getConfig()->removeComponentsByType('GridFieldExportButton');
			$authenticationSocialGridField->getConfig()->removeComponentsByType('GridFieldPrintButton');
		}
		return $form;
	}

}