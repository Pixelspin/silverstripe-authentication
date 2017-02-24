<?php

class AuthenticationSocialTwitter extends AuthenticationSocial
{

	private static $default_records = array(array(
		'Enabled' => true
	));

	public function getTitle()
	{
		return 'Twitter';
	}

	public function getProviderName()
	{
		return 'Twitter';
	}

	public function getHybridauthConfig()
	{
		$config = parent::getHybridauthConfig();
		$config['keys'] = array(
			'key' => $this->AppID ? $this->AppID : '',
			'secret' => $this->AppSecret ? $this->AppSecret : ''
		);
		return $config;
	}

}