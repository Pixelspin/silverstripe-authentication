<?php

class HybridauthController extends Controller
{

	private static $allowed_actions = array(
		'authenticate'
	);

	private static $url_handlers = array(
		'$SocialID!' => 'authenticate'
	);

	public function authenticate()
	{
		$socialID = $this->getRequest()->param('SocialID');
		if (!$socialID) {
			$this->httpError(404);
		}
		$social = AuthenticationSocial::get()->byID($socialID);
		if (!$social || !$social->Enabled) {
			$this->httpError(404);
		}
		$providerConfig = $social->getHybridauthConfig();
		$config = array(
			"base_url" => Director::absoluteBaseURL() . 'hybridauth',
			"providers" => array(
				$social->getProviderName() => $providerConfig
			)
		);
		try {
			$hybridauth = new Hybrid_Auth($config);
			$adapter = $hybridauth->authenticate($social->getProviderName());
			$userProfile = $adapter->getUserProfile();
			$social->handleLogin($userProfile);
			return $this->redirectBack();
		} catch (Exception $e) {
			throw new SS_HTTPResponse_Exception("Error: " . $e->getMessage());
		}
	}

	public function index()
	{
		Hybrid_Endpoint::process();
	}

}