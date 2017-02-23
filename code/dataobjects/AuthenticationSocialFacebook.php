<?php

class AuthenticationSocialFacebook extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Facebook';
	}

	public function getProviderName(){
		return 'Facebook';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		$config['scope'] = ['email', 'user_about_me', 'user_birthday', 'user_hometown'];
		$config['display'] = 'popup';
		return $config;
	}

}