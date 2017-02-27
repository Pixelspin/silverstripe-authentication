<?php

class AuthenticationSocialLinkedin extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Linkedin';
	}

	public function getProviderName(){
		return 'LinkedIn';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		$config['keys'] = array(
			'key' => $this->AppID ? $this->AppID : '',
			'secret' => $this->AppSecret ? $this->AppSecret : ''
		);
		return $config;
	}

}