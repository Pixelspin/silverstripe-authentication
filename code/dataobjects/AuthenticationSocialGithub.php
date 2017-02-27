<?php

class AuthenticationSocialGithub extends AuthenticationSocial {

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle(){
		return 'Github';
	}

	public function getProviderName(){
		return 'GitHub';
	}

	public function getHybridauthConfig(){
		$config = parent::getHybridauthConfig();
		$config['wrapper'] = array(
			'class' => 'Hybrid_Providers_GitHub',
			'path' => Director::baseFolder() . '/vendor/hybridauth/hybridauth/additional-providers/hybridauth-github/Providers/GitHub.php'
		);
		return $config;
	}

}