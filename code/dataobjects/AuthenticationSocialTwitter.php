<?php

class AuthenticationSocialTwitter extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Twitter';
	}

	public function getProviderName(){
		return 'Twitter';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		return $config;
	}

}