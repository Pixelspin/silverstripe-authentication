<?php

class AuthenticationSocialLinkedin extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Linkedin';
	}

	public function getProviderName(){
		return 'Linkedin';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		return $config;
	}

}