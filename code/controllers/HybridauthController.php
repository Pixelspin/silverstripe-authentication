<?php

class HybridauthController extends Controller {

	private static $allowed_actions = array(
		''
	);

	public function index(){
		Hybrid_Endpoint::process();
	}

}





//private static $allowed_actions = array(
//	'hybridauth',
//	'facebook'
//);
//
//public function facebook()
//{
//	$facebookkeys = Config::inst()->get('LoginPage', 'facebookconfig');
//	$facebookkeys['keys'] = $facebookkeys['keys'][Director::get_environment_type()];
//
//	$config = array(
//		"base_url" => $this->AbsoluteLink('hybridauth') . 'hybridauth',
//		"providers" => array(
//			"Facebook" => $facebookkeys
//		)
//	);
//
//	try {
//		$hybridauth = new Hybrid_Auth($config);
////			$adapter = $hybridauth->logoutAllProviders();
//		$adapter = $hybridauth->authenticate("Facebook");
//		$user_profile = $adapter->getUserProfile();
//	} catch (Exception $e) {
//		throw new SS_HTTPResponse_Exception("Error: " . $e->getMessage());
//	}
//
//	var_dump($user_profile);
//	die;
//}
//
//public function hybridauth()
//{
//	Hybrid_Endpoint::process();
//}