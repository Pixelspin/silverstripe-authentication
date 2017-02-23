<?php

class AuthenticationSocialGoogle extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Google';
	}

	public function getProviderName(){
		return 'Google';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		$config['scope'] = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';
		$config['access_type'] = 'offline';
		$config['approval_prompt'] = 'force';
		return $config;
	}

}