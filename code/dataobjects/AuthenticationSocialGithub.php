<?php

class AuthenticationSocialGithub extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Github';
	}

	public function getProviderName(){
		return 'Github';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		return $config;
	}

}